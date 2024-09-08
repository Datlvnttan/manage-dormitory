create database KyTucXa
go
use KyTucXa
go
CREATE TABLE NhanVien
(
  TenDangNhap VARCHAR(20) NOT NULL,
  MatKhau VARCHAR(256) NOT NULL,
  Ho NVARCHAR(10) NOT NULL,
  Ten NVARCHAR(50) NOT NULL,
  SoDienThoai VARCHAR(10),  
  password VARCHAR(256) NOT NULL,
);
ALTER TABLE NhanVien
add constraint PK_NhanVien PRIMARY KEY (TenDangNhap)

CREATE TABLE Khu
(
  Ma VARCHAR(5) NOT NULL,
  Ten NVARCHAR(15) NOT NULL, 
  DoiTuong nvarchar(5) not null,
);
go
alter table Khu
add DoiTuong nvarchar(5),
constraint CK_Khu_DoiTuong check(DoiTuong in (N'Nam',N'Nữ'))
go
ALTER TABLE Khu
add constraint PK_Khu PRIMARY KEY (Ma)

CREATE TABLE Tang
(
  Ma VARCHAR(5) NOT NULL,
  Ten NVARCHAR(10) NOT NULL,
  MaKhu VARCHAR(5) NOT NULL,
);
ALTER TABLE Tang
add constraint PK_Tang PRIMARY KEY (Ma),
constraint FK_Tang_MaKhu FOREIGN KEY (MaKhu) REFERENCES Khu(Ma)

CREATE TABLE Phong
(
  Ma VARCHAR(10) NOT NULL,
  Ten NVARCHAR(10) NOT NULL,
  MaTang VARCHAR(5) NOT NULL,
  DangSuaChua BIT NOT NULL,
  SoLuongTrong INT NOT NULL,
  SucChua INT NOT NULL,
  TruongPhong VARCHAR(10),
  --deleted_at timestamp,
);

ALTER TABLE Phong
add constraint PK_Phong PRIMARY KEY (Ma),
constraint FK_Phong_MaTang FOREIGN KEY (MaTang) REFERENCES Tang(Ma),
constraint CK_Phong_SoLuongTrong check(SoLuongTrong >=0),
constraint DF_Phong_SoLuongTrong DEFAULT 10 for SoLuongTrong,
constraint DF_Phong_DangSuaChua DEFAULT 0 for DangSuaChua


--xem lại cái vấn đề not null của bảng này
CREATE TABLE SinhVien
(
  MaSV VARCHAR(10) NOT NULL,
  Ho NVARCHAR(70) NOT NULL,
  Ten NVARCHAR(50) NOT NULL,
  AnhDaiDien TEXT,
  Email NCHAR(50),
  GioiTinh NVARCHAR(5),
  NgaySinh DATE,
  QueQuan NVARCHAR(180),
  SoCanCuoc VARCHAR(15),
  SoDienThoai VARCHAR(10),
  Lop VARCHAR(8),
  MaPhong VARCHAR(10),
  TrangThai NVARCHAR(15) NOT NULL,
  MatKhau VARCHAR(256) NOT NULL,
  password VARCHAR(256) NOT NULL,
);
ALTER TABLE SinhVien
add constraint PK_SinhVien PRIMARY KEY (MaSV),
constraint FK_SinhVien_MaPhong FOREIGN KEY (MaPhong) REFERENCES Phong(Ma),
constraint CK_SinhVien_TrangThai check(TrangThai in(N'Chưa đăng ký',N'Đang ở',N'Tạm vắng',N'Bị cấm')),
constraint CK_SinhVien_NgaySinh check(Year(getdate()) - Year(NgaySinh)>=18),
constraint DF_SinhVien_TrangThai DEFAULT N'Chưa đăng ký' for TrangThai,
constraint DF_SinhVien_GioiTinh check (GioiTinh in (N'Nam',N'Nữ')),
constraint UC_SinhVien_SoCanCuoc UNIQUE (SoCanCuoc)
ALTER TABLE Phong
add constraint FK_Phong_TruongPhong FOREIGN KEY (TruongPhong) REFERENCES SinhVien(MaSV)
--trigger ràng buộc giới tính cho sinh viên ở từng khu
--trigger khi sinh viên bị cấm thì không thể đăng ký xin ở ký túc xá
go

create table DangKyChuyenPhong
(
	MaDangKy int identity(1,1) not null,
	MaSV varchar(10) not null,
	MaPhongCu varchar(10) not null,
	MaPhongMoi varchar(10) not null,
	NgayDangKy datetime,
	LyDo NVARCHAR(MAX) not null,
	TrangThaiXetDuyet nvarchar(20) not null,
)
ALTER TABLE DangKyChuyenPhong
add constraint PK_DangKyChuyenPhong PRIMARY KEY (MaDangKy),
constraint FK_DangKyChuyenPhong_MaPhongCu FOREIGN KEY (MaPhongCu) REFERENCES Phong(Ma),
constraint FK_DangKyChuyenPhong_MaPhongMoi FOREIGN KEY (MaPhongMoi) REFERENCES Phong(Ma),
constraint FK_DangKyChuyenPhong_MaSV FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
constraint CK_DangKyChuyenPhong_TrangThaiXetDuyet check(TrangThaiXetDuyet in(N'Chờ xét duyệt',N'Thành công',N'Thất bại')),
constraint DF_DangKyNoiTru_TrangThaiXetDuyet DEFAULT N'Chờ xét duyệt' for TrangThaiXetDuyet

go

--trigger bàng buộc trưởng phòng phải là sinh viên của phòng đó(insert,update)
create trigger TruongPhongPhaiThuocPhongDo
on Phong
after insert, update
as
begin
	declare @maSV VARCHAR(10), @maPhong VARCHAR(10)
	select @maSV = TruongPhong, @maPhong = Ma from inserted
	if((select MaPhong from SinhVien where MaSV = @maSV) != @maPhong)
	begin
		print N'Phòng này không tồn tại sinh viên này'
		rollback tran
	end
end
go
--trigger tự động chọn 1 người khác trong phòng làm trưởng phòng nếu tài khoản trưởng phòng bị xóa hoặc chuyển phòng
create trigger ChuyenTruongPhongKhiSinhVienKhongLaThanhVien_create
on SinhVien
INSTEAD OF update
as
begin
	declare @maPhongCu VARCHAR(10),@maPhongMoi VARCHAR(10),@maSVht VARCHAR(10),@maTP VARCHAR(10), @tt NVARCHAR(15)
	select @maPhongCu = MaPhong from deleted
	select @maPhongMoi = MaPhong, @maSVht = MaSV, @tt = TrangThai from inserted
	select @maTP = TruongPhong from Phong where Ma = @maPhongCu
	if(@maSVht = @maTP and (@maPhongMoi is null or @maPhongMoi != @maPhongCu))
	begin
		declare sv cursor SCROLL
		for select MaSV from SinhVien where MaPhong = @maPhongCu
		open sv
		declare @maSV VARCHAR(10), @chk bit = 0
		Fetch LAST from sv into @maSV
		while(@@FETCH_STATUS=0)
		begin			
			if(@maSVht != @maSV)
			begin		
				set @chk = 1
				update Phong set TruongPhong = @maSV where Ma = @maPhongCu				
				break;
			end			
			Fetch PRIOR from sv into @maSV
		end
		if(@chk = 0)
			update Phong set TruongPhong = null where Ma = @maPhongCu
		update SinhVien set MaPhong = @maPhongMoi, TrangThai = @tt where MaSV = @maSVht
		DEALLOCATE sv
	end
	else
	begin
	update SinhVien set AnhDaiDien = i.AnhDaiDien, 
		MaPhong = i.MaPhong, GioiTinh = i.GioiTinh, 
		NgaySinh = i.NgaySinh, QueQuan = i.QueQuan,Email = i.Email,
		SoCanCuoc = i.SoCanCuoc, SoDienThoai = i.SoDienThoai,
		Lop = i.Lop, TrangThai = i.TrangThai, MatKhau = i.MatKhau 
		from inserted i where SinhVien.MaSV = @maSVht
	end
end


go
--khi xóa
create trigger ChuyenTruongPhongKhiSinhVienKhongLaThanhVien_detele
on SinhVien
INSTEAD OF delete
as
begin
	declare @maPhong VARCHAR(10),@maSVht VARCHAR(10),@maTP VARCHAR(10)
	select @maPhong = MaPhong, @maSVht = MaSV from deleted
	select @maTP = TruongPhong from Phong where Ma = @maPhong
	if(@maSVht = @maTP)
	begin
		declare sv cursor SCROLL
		for select MaSV from SinhVien where MaPhong = MaPhong
		open sv
		declare @maSV VARCHAR(10) = null, @chk bit = 0
		Fetch LAST from gg into @maSV
		while(@@FETCH_STATUS=0)
		begin
			if(@maSVht != @maSV)
			begin		
				set @chk = 1
				update Phong set TruongPhong = @maSV where Ma = @maPhong				
				break
			end
			Fetch PRIOR from sv into @maSV
		end
		if(@chk =0)
			update Phong set TruongPhong = null where Ma = @maPhong
		DEALLOCATE sv
	end
	delete SinhVien where MaSV = @maSVht
end



go
create trigger CapNhatThongTinPhongKhiSinhVienThayDoi
on SinhVien
after update
as
begin
	declare @maPhongCu VARCHAR(10),@maPhongMoi VARCHAR(10),@maSV VARCHAR(10)
	select @maPhongCu = MaPhong from deleted
	select @maPhongMoi = MaPhong, @maSV = MaSV from inserted
	if(@maPhongMoi is not null)
	begin
		if(@maPhongCu is null)
			update Phong set SoLuongTrong = SoLuongTrong-1 where Ma = @maPhongMoi
		else if(@maPhongCu != @maPhongMoi)
			begin				
				update Phong set SoLuongTrong = SoLuongTrong-1 where Ma = @maPhongMoi
				update Phong set SoLuongTrong = SoLuongTrong+1 where Ma = @maPhongCu
			end
		if((select TruongPhong from Phong where Ma = @maPhongMoi) is null)
			update Phong set TruongPhong = @maSV where Ma = @maPhongMoi
	end
	else if(@maPhongCu is not null)
	begin
		update Phong set SoLuongTrong = SoLuongTrong+1 where Ma = @maPhongCu
	end
end

go

create table DangKyNoiTru
(
	MaSV VARCHAR(10) NOT NULL,
	NgayGui DATETIME NOT NULL,
	MaPhong VARCHAR(10) NOT NULL,
	TrangThai NVARCHAR(13) NOT NULL,
	GhiChu NVARCHAR(100)
);
ALTER TABLE DangKyNoiTru
add constraint PK_DangKyNoiTru PRIMARY KEY (MaSV),
constraint FK_DangKyNoiTru FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
constraint FK_DangKyNoiTru_MaPhong FOREIGN KEY (MaPhong) REFERENCES Phong(Ma),
constraint CK_DangKyNoiTru_TrangThai check(TrangThai in(N'Chờ xét duyệt',N'Đã xét duyệt',N'Bị hủy')),
constraint DF_DangKyNoiTru_TrangThai DEFAULT N'Chờ xét duyệt' for TrangThai,
constraint DF_DangKyNoiTru_NgayGui DEFAULT GETDATE() for NgayGui
--Trigger bắt buộc khi trạng thái "bị hủy" thì phải cột ghi chú không được quyền null


go
--Trigger khi yêu cầu đăng ký nội trú ở trạng thái 'Đã xét duyệt' thì không được phép chuyển tại thành trạng thái 'Chờ xét duyệt'
create trigger KhongThayDoiDKNoiTruKhiDaXetDuyet
on DangKyNoiTru
after update
as
begin
	declare @ttCu NVARCHAR(13),@ttMoi NVARCHAR(13)
	select @ttMoi = TrangThai from inserted
	select @ttCu = TrangThai from deleted
	if(@ttCu = N'Đã xét duyệt' and @ttMoi = N'Chờ xét duyệt')
		rollback tran
end


go
---Sinh viên có quyền hủy yêu cầu: Tôi muốn chọn phòng khác, tôi muốn cập nhật lại thông tin sinh viên của mình, tôi không muốn ở đăng ký nứa,...

go
CREATE VIEW ThongKeDangKyLuTru
AS Select MaPhong, Count(*) as SoLuongDangKy 
from DangKyNoiTru 
where TrangThai != N'Bị hủy' group by MaPhong

go
--trigger 

go

CREATE TABLE HopDong
(
  MaHopDong VARCHAR(20) NOT NULL,
  MaSV VARCHAR(10) NOT NULL,
  NguoiTao VARCHAR(20) NOT NULL,
  NgayTao DATETIME NOT NULL,  
  NgayBatDau DATE NOT NULL,
  NgayKetThuc DATE NOT NULL,
  TrangThai NVARCHAR(13) NOT NULL,
  DaThanhToan BIT NOT NULL,
  DaGiaHanTrongDot bit not null
);

ALTER TABLE HopDong
add constraint PK_HopDong PRIMARY KEY (MaHopDong),
constraint FK_HopDong_NguoiTao FOREIGN KEY (NguoiTao) REFERENCES NhanVien(TenDangNhap),
constraint FK_HopDong_MaSV FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
constraint CK_HopDong_TrangThai check(TrangThai in(N'Chưa hiệu lực',N'Có hiệu lực',N'Xin gia hạn',N'Hết hiệu lực')),
--constraint CK_HopDong_ThoiGianHopDong check(YEAR(NgayKetThuc)-YEAR(NgayBatDau)>=1),
constraint DF_HopDong_NgayTao DEFAULT getdate() for NgayTao,
constraint CK_HopDong_NgayBatDau check(NgayBatDau>=NgayTao),
constraint CK_HopDong_NgayKetThuc check(NgayKetThuc>=NgayBatDau),
constraint DF_HopDong_TrangThai DEFAULT N'Chưa hiệu lực' for TrangThai,
constraint DF_HopDong_DaThanhToan DEFAULT 0 for DaThanhToan,
constraint DF_HopDong_DaGiaHanTrongDot DEFAULT 0 for DaGiaHanTrongDot




alter table HopDong
drop constraint CK_HopDong_NgayBatDau

go
--Tạo trigger cập nhật trạng thái thành "Có hiệu lực" và thời gian kết thúc tăng thêm 1 năm khi đã thanh toán hợp đồng(DaThanhToan = true) "xin gia hạn"
-- Hợp đồng chỉ đưuọc phép tạo khi sinh viên cập nhật đủ các trường: giới tính, ngày sinh, lớp, quê quán, số điện thoại
 go
--Không được quyền khởi tạo 1 hợp đồng đã hết hiệu lực
--Hợp đồng chỉ được phép chuyển trạng thái 'có hiệu lực' khi mà yêu cầu đăng ký nọi trú đó ở trạng thái đã xét duyệt
--trigger thời gian được phép xin gia hạn thực tế là từ trong tháng 6
go
--trigger Tự động tăng số lượng trống lên 1 khi hợp đồng hết hiệu lực
--Tạo trigger cập nhật DaThanhToan thành false khi trạng thái chyển thành "xin gia hạn"
--trigger tự động chuyển trạng thái hợp đồng thành có hiệu lực khi hợp đồng đã được thanh toán và cập nhật mã phòng cho sinh viên đó
create trigger CapNhatTrangThaiVaThanhToanHopDong
on HopDong
after update
as
begin
	declare @maHD VARCHAR(20), @thanhToanMoi bit,@thanhToanCu bit, @trangThaiMoi NVARCHAR(13),@trangThaiCu NVARCHAR(13),@maSV VARCHAR(10),@maPhong VARCHAR(10)
	select @maHD = MaHopDong, @thanhToanMoi = DaThanhToan, @trangThaiMoi = TrangThai,@maSV = MaSV from inserted	
	select @maPhong = MaPhong from DangKyNoiTru where MaSV = @maSV
	select @trangThaiCu = TrangThai, @thanhToanCu = DaThanhToan from deleted
	if(@trangThaiMoi = N'Hết hiệu lực')
	begin		 
		update SinhVien set MaPhong = null, TrangThai = N'Chưa đăng ký' where MaSV = @maSV
		delete from SuDungDichVuDon where MaSV = @maSV
	end
	else
		if(@thanhToanCu = 1 and @trangThaiMoi = N'Xin gia hạn')
			update HopDong set DaThanhToan = 0 where MaHopDong = @maHD
		else
			if(@thanhToanMoi = 1)
				if(@trangThaiCu = N'Chưa hiệu lực')
				begin	
					update HopDong set TrangThai = N'Có hiệu lực' where MaHopDong = @maHD
					update SinhVien set MaPhong = @maPhong, TrangThai = N'Đang ở' where MaSV = @maSV
					delete DangKyNoiTru where MaSV = @maSV										
				end
				else if(@trangThaiCu = N'Xin gia hạn')
					update HopDong set TrangThai = N'Có hiệu lực',NgayKetThuc = DateAdd(year,1,NgayKetThuc) where MaHopDong = @maHD
end

go
--Trigger tồn tại hợp đồng ở trạng thái có hiệu lực thì không được phép gửi yêu cầu đăng ký nội trú nữa
create trigger KhongDuocYeuCauDKNTKHiDaTonTaiHopDongHieuLuc
on DangKyNoiTru
after insert
as
begin
	declare @trangThai NVARCHAR(13)
	if(exists(select * from inserted i, HopDong h where i.MaSV = h.MaSV and h.TrangThai != N'Hết hiệu lực'))
		rollback tran
end

go


--trigger hợp đồng chưa có hiệu lực và hết hiệu lực không đc chuyển thành trạng thái "xin gia hạn"


CREATE TABLE DangKyLuuTruHe
(
  MaHopDong VARCHAR(20) NOT NULL,
  NgayBatDau DATE NOT NULL,
  NgayKetThuc DATE NOT NULL,
  DaThanhToan BIT NOT NULL,
);
alter table DangKyLuuTruHe
add constraint PK_DangKyLuuTruHe PRIMARY KEY (MaHopDong,NgayBatDau),
constraint FK_DangKyLuuTruHe_MaHopDong FOREIGN KEY (MaHopDong) REFERENCES HopDong(MaHopDong),
constraint CK_DangKyLuuTruHe_ThoiHan check(NgayKetThuc>NgayBatDau),
constraint DF_DangKyLuuTruHe_DaThanhToan DEFAULT 0 for DaThanhToan
--Ràng buộc chỉ có hợp đồng còn hiệu lực mới được phép đăng ký tạm trú hè

CREATE TABLE DichVu
(
  MaDichVu VARCHAR(10) NOT NULL,
  TenDichVu NVARCHAR(30) NOT NULL,
  GiaHienTai INT NOT NULL,
  BatBuoc bit NOT NULL,
  TinhTheoChiSo bit NOT NULL,
  Khoa bit NOT NULL,
);
ALTER TABLE DichVu
add constraint PK_DichVu PRIMARY KEY (MaDichVu),
constraint CK_DichVu_GiaHienTai check(GiaHienTai>=0),
constraint DF_DichVu_BatBuoc DEFAULT 0 for BatBuoc,
constraint DF_DichVu_TinhTheoChiSo DEFAULT 0 for TinhTheoChiSo,
constraint DF_DichVu_Khoa DEFAULT 0 for Khoa

go
create TABLE DichVuPhongCoChiSo
(
	MaDichVu VARCHAR(10) NOT NULL,
	MaPhong VARCHAR(10) NOT NULL,
	ChiSoHienTai int NOT NULL
)
alter Table DichVuPhongCoChiSo
add constraint PK_ThongTinDichVuPhong PRIMARY KEY (MaDichVu,MaPhong),
constraint FK_DichVuPhongCoChiSo_MaDichVu FOREIGN KEY (MaDichVu) REFERENCES DichVu(MaDichVu),
constraint FK_DichVuPhongCoChiSo_MaPhong FOREIGN KEY (MaPhong) REFERENCES Phong(Ma),
constraint CK_DichVuPhongCoChiSo_ChiSoHienTai check(ChiSoHienTai>=0)


go
--trigger tự động sinh ra 1 bộ dữ liệu trong DichVuPhongCoChiSo nếu dịch vụ mới đc thêm vào là bắt buộc và tính theo chỉ số
create trigger themDichVuTinhTheoChiSo
on DichVu
after insert
as
begin
	declare @maDV VARCHAR(10),@chk bit,@bb bit
	select @maDV = MaDichVu, @chk = TinhTheoChiSo, @bb= BatBuoc from inserted
	if(@chk = 1 and @bb = 1)
	begin
		declare p cursor
		for select Ma from Phong
		open p
		declare @maPhong VARCHAR(10)
		Fetch NEXT from p into @maPhong
		while(@@FETCH_STATUS=0)
		begin
			insert into DichVuPhongCoChiSo values(@maDV,@maPhong,0)
			Fetch NEXT from p into @maPhong
		end
		DEALLOCATE p
	end
end
go
go

--trigger tự động sinh ra 1 bộ dữ liệu trong DichVuPhongCoChiSo nếu dịch vụ mới đc thêm vào là bắt buộc và tính theo chỉ số -update
create trigger themDichVuTinhTheoChiSo_update
on DichVu
after update
as
begin
	declare @maDV VARCHAR(10),@chk bit,@bb bit,@maDVDeleted VARCHAR(10),@chkDeleted bit,@bbDeleted bit
	select @maDV = MaDichVu, @chk = TinhTheoChiSo, @bb= BatBuoc from inserted
	select @maDVDeleted = MaDichVu, @chkDeleted = TinhTheoChiSo, @bbDeleted= BatBuoc from deleted
	if(@chkDeleted != @chk and @chk = 1 and @bb = 1)
	begin
		declare p cursor
		for select Ma from Phong
		open p
		declare @maPhong VARCHAR(10)
		Fetch NEXT from p into @maPhong
		while(@@FETCH_STATUS=0)
		begin
			insert into DichVuPhongCoChiSo values(@maDV,@maPhong,0)
			Fetch NEXT from p into @maPhong
		end
		DEALLOCATE p
	end
	else if(@chk = 0)
	begin
		delete from DichVuPhongCoChiSo where MaDichVu = @maDV
	end
end
go
CREATE TABLE SuDungDichVuDon
(
  MaSV VARCHAR(10) NOT NULL,
  MaDichVu VARCHAR(10) NOT NULL,
  DangSuDung Bit NOT NULL,
  NgayDangKy DATETIME NOT NULL,
);
ALTER TABLE SuDungDichVuDon
add constraint PK_SuDungDichVuDon PRIMARY KEY (MaSV, MaDichVu),
constraint FK_SuDungDichVuDon_MaSV FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
constraint FK_SuDungDichVuDon_MaDichVu FOREIGN KEY (MaDichVu) REFERENCES DichVu(MaDichVu),
constraint DF_SuDungDichVuDon_DangSuDung DEFAULT 1 for DangSuDung,
constraint DF_SuDungDichVuDon_NgayDangKy DEFAULT GETDATE() for NgayDangKy

--trigger sinh viên không được sử dụng dịch vụ khi chưa có hợp đồng hợp lệ

CREATE TABLE HoaDon
(
  MaHoaDon VARCHAR(20) NOT NULL,
  MaPhong VARCHAR(10) NOT NULL,
  NgayTao DATETIME NOT NULL,
  ThanhTien INT NOT NULL,
  DaThanhToan BIT NOT NULL,  
  NguoiTao VARCHAR(20) NOT NULL, 
  TrangThai NVARCHAR(15) NOT NULL ,
);

ALTER TABLE HoaDon
add constraint DF_HoaDon_TrangThai DEFAULT N'Chưa thanh toán' for TrangThai,
constraint CK_HoaDon_TrangThai CHECK(TrangThai IN (N'Chưa thanh toán',N'Đã thanh toán',N'Không chính xác')),
constraint PK_HoaDon PRIMARY KEY (MaHoaDon),
constraint FK_HoaDon_MaPhong FOREIGN KEY (MaPhong) REFERENCES Phong(Ma),
constraint FK_HoaDon_NguoiTao FOREIGN KEY (NguoiTao) REFERENCES NhanVien(TenDangNhap),
constraint DF_HoaDon_NgayTao DEFAULT GETDATE() for NgayTao,
constraint DF_HoaDon_DaThanhToan DEFAULT 0 for DaThanhToan,
constraint DF_HoaDon_ThanhTien DEFAULT 0 for ThanhTien
--Khi 1 hóa đơn được tạo ra sẽ tự động sinh ra chi tiết hóa đơn về những dịch vụ đơn cũng như tổng số lượng mà thành viên trong phòng đó có sử dụng(Chú ý cái thuộc tính "đang sử dụng" của SuDungDichVuDon)

CREATE TABLE ChiTietHoaDon
(
  MaHoaDon VARCHAR(20) NOT NULL,
  MaDichVu VARCHAR(10) NOT NULL,
  DonGia INT NOT NULL,
  SoLuong INT NOT NULL,
);
ALTER TABLE ChiTietHoaDon
add constraint PK_ChiTietHoaDon PRIMARY KEY (MaHoaDon, MaDichVu),
constraint FK_ChiTietHoaDon_MaHoaDon FOREIGN KEY (MaHoaDon) REFERENCES HoaDon(MaHoaDon),
constraint FK_ChiTietHoaDon_MaDichVu FOREIGN KEY (MaDichVu) REFERENCES DichVu(MaDichVu),
constraint CK_HoaDon_SoLuong Check (SoLuong>=0),
constraint CK_HoaDon_DonGia Check (DonGia>0)
--Tự động cập nhật số điện hiện tại và số nước hiện tại của mỗi phòng khi chi tiết hóa đơn được tạo

CREATE TABLE ViPham
(
  MaViPham VARCHAR(10) NOT NULL,
  NoiDung NVARCHAR(100) NOT NULL,  
  MucDoNghiemTrong int NOT NULL,
  --deleted_at timestamp
);
ALTER TABLE ViPham
add constraint PK_ViPham PRIMARY KEY (MaViPham)

Create TABLE HinhPhatQuaCacLanTaiPham
(
	MaViPham VARCHAR(10) NOT NULL,
	LanTaiPham int NOT NULl,
	HinhPhat NVARCHAR(100) NOT NULL,
)

Create TABLE HinhPhat
(
	MaHinhPhat VARCHAR(10) NOT NULL,
	NoiDung NVARCHAR(100) NOT NULL,
	MucDiemApDung int NOT NULL,
)

-- có 3 hướng giải quyết:
-- Cách 1: có sẳn mã vi phạm và số lần vi phạm sẽ tương đương với hình phạt được gắn cứng với nó

-- Cách 2: ứng với số điểm vi phạm và nhân số điểm đó lên tương ứng theo số lần vi phạm (vi phạm 1 lần 1: 3 điểm, vi phạm 1 lần 2: 3x2 = 6 điểm )
		--- và hệ thống sẽ gợi ý hình phạt dựa vào số điểm đã vi phạm đó 

-- Cách 3: dựa vào tổng điểm lỗi của tất cả các lần vi phạm mà đưa ra gợi ý hình phạt (vi phạm 1: 2 điểm, vi phạm 2: 5 điểm, tổng 2+5 = 7 )

-- Cách 4: Ứng dụng cả cách 2 và cách 3

--Câu hỏi nghiệp vụ:
---1. có thời gian reset các lần vi phạm hay không? (vd: 1 năm sẽ xoá lịch sử vi phạm 1 lần)
---2. việc chọn hình phạt là nhất quán với tất cả sinh viên hay không, có dựa vào các yếu tố ảnh hưởng từ bên ngoài hay không?
-------                                (như môi trường, thời gian, địa điểm, cố ý, vô ý, vi phạm cá nhân, vi phạm tập thể,...)

CREATE TABLE SinhVienViPham
(
  MaSV VARCHAR(10) NOT NULL,
  MaViPham VARCHAR(10) NOT NULL,  
  ThoiGianViPham DATETIME NOT NULL,
  HinhPhat NVARCHAR(200) NOT NULL,
  NguoiTao VARCHAR(20) NOT NULL,
  GhiChu NVARCHAR(100),
  TrangThai NVARCHAR(15) not null,
  --DaGiaiQuyet BIT NOT NULL,  
);
ALTER TABLE SinhVienViPham
add constraint PK_SinhVienViPham PRIMARY KEY (MaSV, MaViPham,ThoiGianViPham),
constraint FK_SinhVienViPham_MaSV FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV),
constraint FK_SinhVienViPham_MaViPham FOREIGN KEY (MaViPham) REFERENCES ViPham(MaViPham),
constraint FK_SinhVienViPham_NguoiTao FOREIGN KEY (NguoiTao) REFERENCES NhanVien(TenDangNhap),
constraint DF_SinhVienViPham_ThoiGianViPham DEFAULT GETDATE() for ThoiGianViPham,
constraint CK_SinhVienViPham_TrangThai Check (TrangThai in(N'Đã xử lý',N'Không chính xác',N'Chưa xử lý')),
constraint DF_SinhVienViPham_TrangThai DEFAULT N'Chưa giải quyết' for TrangThai
--constraint DF_SinhVienViPham_DaGiaiQuyet DEFAULT 0 for DaGiaiQuyet
go

CREATE TABLE ThietBi
(
  MaThietBi VARCHAR(10) NOT NULL,
  TenThietBi NVARCHAR(25) NOT NULL,
  TongSoLuong INT NOT NULL,
  SoLuongMoiPhong INT NOT NULL,
);
ALTER TABLE ThietBi
add constraint PK_ThietBi PRIMARY KEY (MaThietBi),
constraint CK_ThietBi_TongSoLuong check(TongSoLuong>=0)

Create table PhanBoThietBi
(
	MaThietBi VARCHAR(10) NOT NULL,
	MaPhong VARCHAR(10) NOT NULL,
	SoLuongPhanBo int not null,
)
ALTER TABLE PhanBoThietBi
add constraint PK_PhanBoThietBi PRIMARY KEY (MaThietBi,MaPhong)

CREATE TABLE KhaiBaoHuHong
(
  MaKhaiBao VARCHAR(10) NOT NULL,
  NgayYeuCau DATETIME NOT NULL,
  MaPhong VARCHAR(10) NOT NULL,  
  MaThietBi VARCHAR(10) NOT NULL,
  TongSoLuong INT NOT NULL,
  DaXuLy BIT NOT NULL,  
  NguoiXuLy VARCHAR(20),
);
ALTER TABLE KhaiBaoHuHong
add constraint PK_KhaiBaoHuHong PRIMARY KEY (MaKhaiBao),
constraint FK_KhaiBaoHuHong_MaThietBi FOREIGN KEY (MaThietBi) REFERENCES ThietBi(MaThietBi),
constraint FK_KhaiBaoHuHong_MaPhong FOREIGN KEY (MaPhong) REFERENCES Phong(Ma),
constraint FK_KhaiBaoHuHong_NguoiXuLy FOREIGN KEY (NguoiXuLy) REFERENCES NhanVien(TenDangNhap),
constraint CK_KhaiBaoHuHong_TongSoLuongHuHong check (TongSoLuong > 0),
constraint DF_KhaiBaoHuHong_NgayYeuCau DEFAULT GETDATE() for NgayYeuCau


Create TABLE XuLyKhaiBaoHuHong
(
	MaXuLy int identity(1,1),
	MaKhaiBao VARCHAR(10) NOT NULL,
	SoLuong int NOT NULL,	
	NguyenNhan NVARCHAR(100),
	ThayMoi BIT NOT NULL,
	ChiPhiPhatSinh int,
)
ALTER TABLE XuLyKhaiBaoHuHong
add constraint PK_XuLyKhaiBaoHuHong PRIMARY KEY (MaXuLy),
constraint FK_XuLyKhaiBaoHuHong_MaKhaiBao FOREIGN KEY (MaKhaiBao) REFERENCES KhaiBaoHuHong(MaKhaiBao),
constraint CK_XuLyKhaiBaoHuHong_SoLuong check (SoLuong > 0),
constraint CK_XuLyKhaiBaoHuHong_ThayMoi DEFAULT 0 for ThayMoi,
constraint CK_XuLyKhaiBaoHuHong_ChiPhiPhatSinh check (ChiPhiPhatSinh > 0)

--Trigger Tổng số lượng của các xử lý khai báo hư hỏng phải bằng với tổng số lượng trong khai báo hư hỏng của mã khai báo đó



--Sắp hết hạn thanh toán hóa đơn tháng này, vui lòng hoàn tất thanh toán hóa đơn trong thời gian quy định của ký túc xá
--Hóa đơn tháng 4 năm 2013 phòng 111
--Yêu cầu đăng ký nội trú của bạn đã được phê duyệt, vui lòng đến trung tâm ký túc xá thực hiện thanh toán để hoàn tất quá trình đăng ký
--Yêu cầu đăng ký nội trú của bạn đã bị hủy, lí do:....
--Đăng ký dịch vụ đơn thành công, thông tin ...


CREATE TABLE LoaiThongBao
(
	Khoa varchar(20) not null,
	Loai NVARCHAR(20),--cảnh cáo, đóng tiền,xét duyệt thành công thao tác,xét duyệt thất bại thao tác...	
	MauSac varchar(100)
)
ALTER TABLE LoaiThongBao
add constraint PK_LoaiThongBao PRIMARY KEY (Khoa)

insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Thành công','success',null)
insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Thất bại',  'failed',null)
insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Nhắc nhở',  'remind',null)
insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Cảnh cáo',  'warning',null)
insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Thông tin', 'info',null)
insert LoaiThongBao(Loai,Khoa,MauSac) values(N'Báo cáo', 'report',null)
 


CREATE TABLE ThongBaoSinhVien
(	
	Id int identity(1,1) not null,
	NguoiNhan VARCHAR(10), -- nếu null là dành cho tất cả mọi người
	NgayTao DateTime NOT NULL,
	KhoaLoaiThongBao varchar(20) NOT NULL,
	TieuDe NVARCHAR(50),
	NoiDung NVARCHAR(500) not null,
	Uri nvarchar(100),
	DaXem bit NOT NULL
)
ALTER TABLE ThongBaoSinhVien
add constraint PK_ThongBaoSinhVien PRIMARY KEY (Id),
constraint FK_ThongBaoSinhVien_KhoaLoaiThongBao FOREIGN KEY (KhoaLoaiThongBao) REFERENCES LoaiThongBao(Khoa),
constraint FK_ThongBaoSinhVien_NguoiNhan FOREIGN KEY (NguoiNhan) REFERENCES SinhVien(MaSV),
constraint DF_ThongBaoSinhVien_NgayTao DEFAULT GETDATE() for NgayTao,
constraint DF_ThongBaoSinhVien_DaXem DEFAULT 0 for DaXem


CREATE TABLE ThongBaoNhanVien
(	
	Id int identity(1,1) not null,
	role_id bigint, -- nếu null là dành cho tất cả nhân viên
	NgayTao DateTime NOT NULL,
	KhoaLoaiThongBao varchar(20) NOT NULL,
	TieuDe NVARCHAR(50),
	NoiDung NVARCHAR(500) not null,
	Uri nvarchar(100),
)
ALTER TABLE ThongBaoNhanVien
add constraint PK_ThongBaoNhanVien PRIMARY KEY (Id),
constraint FK_ThongBaoNhanVien_KhoaLoaiThongBao FOREIGN KEY (KhoaLoaiThongBao) REFERENCES LoaiThongBao(Khoa),
constraint FK_ThongBaoNhanVien_role_id FOREIGN KEY (role_id) REFERENCES roles(id),
constraint DF_ThongBaoNhanVien_NgayTao DEFAULT GETDATE() for NgayTao

select * from ThongBaoNhanVien left join roles 
			on ThongBaoNhanVien.role_id = roles.id
			where ThongBaoNhanVien.role_id is null
			or roles.priority >=2


go
create VIEW ThongKeDichVuDonMoiPhong
AS Select p.Ma as MaPhong, dv.MaDichVu,TenDichVu, GiaHienTai, Count(*) as SoLuong
	from (((SuDungDichVuDon dv join SinhVien sv 
	on dv.MaSV = sv.MaSV) join Phong p
	on sv.MaPhong = p.Ma) join DichVu d
	on d.MaDichVu = dv.MaDichVu)
	where dv.DangSuDung = 1 group by p.Ma,dv.MaDichVu,TenDichVu,GiaHienTai

go

select p.Ma , sd.MaDichVu, count(*) as SoLuong
	from SuDungDichVuDon sd , SinhVien sv, Phong p
	where sd.MaSV = sv.MaSV and sv.MaPhong = p.Ma group by p.Ma, sd.MaDichVu
--Ràng buộc số lần yêu cầu sửa chửa với tổng số lượng của trạng thái "chưa tiếp nhận" phải < = số lượng mỗi phòng => nếu thỏa sẽ cập nhật lại số lượng của yêu cầu trước đó thay vì tạo mới
--Ràng buộc chỉ có trưởng phòng mới có quyền insert vào bảng Yêu Cầu Sửa Chửa

go
--Sinh viên không được phép tồn tại cùng lúc 2 hợp đồng không phải trạng thái "hết hiệu lực"
create trigger SinhVienKhongDuocTaoHaiHopDongCoHieuLuc
on HopDong
after insert,update
as
begin
	declare @maSV VARCHAR(10)
	select @maSV = MaSV  from inserted
	if((select count(*) from HopDong where MaSV = @maSV and TrangThai != N'Hết hiệu lực')>1)
	begin
		rollback tran
	end
end

go
--trigger tự động cập nhật thành tiền cho hóa đơn_insert
create trigger CapNhatThanhTienHoaDon_insert
on chiTietHoaDon
after insert
as
begin
	declare @tinhCS bit 
	select @tinhCS = TinhTheoChiSo from inserted i join DichVu dv on dv.MaDichVu = i.MaDichVu
	update HoaDon 
		set ThanhTien = ThanhTien + (i.SoLuong*DonGia) 
		from inserted i 
		where HoaDon.MaHoaDon = i.MaHoaDon
	if(@tinhCS = 1)
	update DichVuPhongCoChiSo 
		set ChiSoHienTai = ChiSoHienTai +i.SoLuong 
		from inserted i join HoaDon hd
		on i.MaHoaDon = hd.MaHoaDon
		where DichVuPhongCoChiSo.MaDichVu =  i.MaDichVu and DichVuPhongCoChiSo.MaPhong = hd.MaPhong
end
go
--trigger tự động cập nhật thành tiền cho hóa đơn_update
create trigger CapNhatThanhTienHoaDon_update
on chiTietHoaDon
after update
as
begin
	declare @tinhCS bit
	select @tinhCS = TinhTheoChiSo from inserted i join DichVu dv on dv.MaDichVu = i.MaDichVu
	update HoaDon 
		set ThanhTien = ThanhTien + (i.SoLuong*i.DonGia)-(d.SoLuong*d.DonGia) 
		from inserted i, deleted d
		where HoaDon.MaHoaDon = i.MaHoaDon and HoaDon.MaHoaDon = d.MaHoaDon
	if(@tinhCS = 1)
	update DichVuPhongCoChiSo 
		set ChiSoHienTai = ChiSoHienTai +i.SoLuong - d.SoLuong 
		from inserted i join HoaDon hd
		on i.MaHoaDon = hd.MaHoaDon
		join deleted d
		on d.MaHoaDon = hd.MaHoaDon
		where DichVuPhongCoChiSo.MaDichVu =  i.MaDichVu and DichVuPhongCoChiSo.MaPhong = hd.MaPhong
end


go
create trigger CapNhatCTHDCuaDVDon
on HoaDon
after insert
as
begin
	declare @maPhong VARCHAR(10), @maHD VARCHAR(20)
	select @maHD = MaHoaDon, @maPhong = MaPhong from inserted
	declare cthd cursor
	for select MaDichVu, GiaHienTai, SoLuong from ThongKeDichVuDonMoiPhong where MaPhong = @maPhong
	open cthd
	declare @maDV VARCHAR(10), @gia int, @sl int
	Fetch NEXT from cthd into @maDV,@gia,@sl 
	while(@@FETCH_STATUS=0)
	begin
		insert into ChiTietHoaDon values(@maHD,@maDV,@gia,@sl)
		Fetch NEXT from cthd into @maDV,@gia,@sl 
	end
	DEALLOCATE cthd
end


--Hợp đồng khi đã hết hiệu lực thì kh có quyền sửa đổi nữa



--TRIGGER hơp đồng chỉ được phép tạo vào tháng 6 của năm
--create trigger BatBuocChiDuocTaoHDTrongThangSau
--on HopDong
--after insert
--as
--begin
--	if(MONTH(getdate())!=6)
--	begin
--		rollback tran
--	end
--end


--Đặt lịch tự động xóa hợp đồng chưa hiệu lực vào cuối mỗi kì mở đăng ký nội trú(đầu tháng 7 hàng năm)
--Đặt lịch tự động xét trạng thái hợp đồng thành hết hiệu lực nếu thời gian của hợp đồng đã hết mà chưa được gia hạn
-- Hợp đồng chưa có hiệu lực trong vòng 1 tuần mà chưa được thanh toán sẽ tự động hủy hợp đồng
--Đầu tháng 6 hàng tháng là sẽ thông báo đến các sinh viên về gia hạn hợp đồng


--proc
go
Create PROC TaoHopDong(@maSV VARCHAR(10),@tenDN VARCHAR(20))
as
begin
	declare @sl int = (select COUNT(*) from HopDong where MaSV = @maSV), @y int = year(getdate())
	declare @bd VARCHAR(20) = '01/09/'+str(@y,4), @kt VARCHAR(10) ='30/06/'+str(@y+1,4)
	declare @maHD VARCHAR(20) = ('HD'+RIGHT(@y,2)+Rtrim(@maSV)+convert(char,@sl+1))
	insert into HopDong(MaHopDong,MaSV,NguoiTao,NgayBatDau,NgayKetThuc) 
			values(@maHD,@maSV,@tenDN,convert(date,@bd,103),convert(date,@kt,103))
end

go
Create PROC TaoDangKyNoiTru(@maSV VARCHAR(10),@maPhong VARCHAR(20))
as
begin
	if(exists(select MaSV from DangKyNoiTru where MaSV = @maSV))
		update DangKyNoiTru set TrangThai = N'Chờ xét duyệt', MaPhong = @maPhong,GhiChu = null where MaSV = @maSV
	else
		insert into DangKyNoiTru(MaSV,MaPhong) values(@maSV,@maPhong)
end
go
CREATE PROC CapNhatSoLuongKhaiBaoHuHong  @maThietBi varchar(10),@maPhong VARCHAR(10), @soLuong int
as
begin
	update KhaiBaoHuHong set TongSoLuong = TongSoLuong + @soLuong 
		where MaThietBi = @maThietBi and @maPhong = @maPhong and DaXuLy = 0
end



create table Schedule
(	
	[Key] varchar(50) primary key,
	Title nvarchar (100) not null,
	EndTime dateTime,
	Running bit not null default 0,
	Prefix varchar(100) not null,
	FlagStart bit not null default 0,
)
insert Schedule([Key],Title,EndTime,Running,Prefix,FlagStart) values('REGISTER_RESIDENCE',N'Đăng ký nội trú',null,0,'dang-ky-noi-tru',0)
insert Schedule([Key],Title,EndTime,Running,Prefix,FlagStart) values('CONTRACT_EXTENSION',N'Gia hạn hợp đồng',null,0,'gia-han-hop-dong',0)

--create table HopThuSinhVien
--(
--	Id int identity(1,1) not null,
--	MaSV 
--)