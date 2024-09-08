insert into Khu values('A','Khu A',N'Nữ')
insert into Khu values('B','Khu B',N'Nam')
insert into Tang values(1,N'Tầng 1','B')
insert into Tang values(7,N'Tầng 7','A')
insert into Tang values(8,N'Tầng 8','A')

insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A101',N'Phòng 101',1,10,10)
insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A102',N'Phòng 102',1,3,10)
insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A103',N'Phòng 103',1,4,10)
insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A104',N'Phòng 104',1,6,10)
insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A105',N'Phòng 105',1,0,10)
insert into Phong(Ma,Ten,MaTang,SoLuongTrong,SucChua) values('A705',N'Phòng 705',7,0,10)

insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('123',N'Lê Phát',N'Đạt','321634059','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('124',N'Lê Hoàng',N'Huy Huỳnh','32354059','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('125',N'Kiều Minh',N'Ngọc','321634159','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('126',N'Lê Minh',N'Mẫn','321634723','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('127',N'Chung Hoài Yến',N'Linh','326745059','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('128',N'Lê Yến',N'Nhung','326355059','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
insert into SinhVien(MaSV,Ho,Ten,SoCanCuoc,MatKhau,password) values('129',N'Lê Yến',N'Nhung','326355069','123','$2y$10$3ug1Tn4nS6dFY5JQNYQksea8a0hKsXc5Db9k5vgTsZ5cBl.kzgtaa')
update SinhVien set GioiTinh = N'Nam' where MaSV = '123'

insert into DangKyNoiTru(MaSV,MaPhong) values('123','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('124','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('125','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('126','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('127','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('128','A101')
insert into DangKyNoiTru(MaSV,MaPhong) values('129','A103')


insert into NhanVien values('admin1','123',N'Lê Phát',N'Đạt','0387079343',N'Giám Đốc')
insert into NhanVien values('admin2','123',N'Lê Phát',N'Đạt','0387079343',N'Giám Đốc')
insert into NhanVien values('admin3','123',N'Lê Phát',N'Đọt','0387079343',N'Nhân viên')
insert into NhanVien values('admin4','123',N'Lê Phát',N'Đẹt','0387079343',N'Nhân viên')
insert into NhanVien values('admin5','123',N'Lê Phát',N'Đụt','0387079343',N'Nhân viên')
insert into NhanVien values('admin6','123',N'Lê Phát',N'Đột','0387079343',N'Nhân viên')

exec TaoHopDong '123','admin1'
exec TaoHopDong '124','admin1'
exec TaoHopDong '125','admin1'
exec TaoHopDong '126','admin1'
exec TaoHopDong '127','admin1'
exec TaoHopDong '128','admin1'


INSERT into DichVu values('DV001',N'Nước',3000,1,1)
INSERT into DichVu values('DV002',N'Điện',3600,1,1)
INSERT into DichVu values('DV003',N'Giặt ủi',7000,0,0)
INSERT into DichVu values('DV004',N'Giữ xe',100000,0,0)

INSERT into DichVu values('DV005',N'Bán culi',1000,1,0)

--insert into DichVuPhongCoChiSo values('DV001','A101',34)
--insert into DichVuPhongCoChiSo values('DV001','A102',28)
--insert into DichVuPhongCoChiSo values('DV001','A103',67)
--insert into DichVuPhongCoChiSo values('DV001','A104',43)
--insert into DichVuPhongCoChiSo values('DV001','A105',34)
--insert into DichVuPhongCoChiSo values('DV001','A705',23)

--insert into DichVuPhongCoChiSo values('DV002','A101',35)
--insert into DichVuPhongCoChiSo values('DV002','A102',23)
--insert into DichVuPhongCoChiSo values('DV002','A103',23)
--insert into DichVuPhongCoChiSo values('DV002','A104',56)
--insert into DichVuPhongCoChiSo values('DV002','A105',29)
--insert into DichVuPhongCoChiSo values('DV002','A705',10)


INSERT into SuDungDichVuDon values('123','DV003',1,getdate())
INSERT into SuDungDichVuDon values('124','DV003',1,getdate())
INSERT into SuDungDichVuDon values('125','DV003',0,getdate())
INSERT into SuDungDichVuDon values('126','DV003',1,getdate())
INSERT into SuDungDichVuDon values('127','DV003',0,getdate())
INSERT into SuDungDichVuDon values('128','DV003',1,getdate())

INSERT into SuDungDichVuDon values('123','DV004',1)
INSERT into SuDungDichVuDon values('124','DV004',1)
INSERT into SuDungDichVuDon values('125','DV004',0)
INSERT into SuDungDichVuDon values('126','DV004',1)
INSERT into SuDungDichVuDon values('127','DV004',1)
INSERT into SuDungDichVuDon values('128','DV004',1)

INSERT into ThietBi values('TB001',N'Quạt',129,3)
INSERT into ThietBi values('TB002',N'Bóng đèn huỳnh quang',232,2)
INSERT into ThietBi values('TB003',N'Ghế nhựa',345,3)

insert into LoaiThongBao values('LTB001','','',N'Dữ liệu')