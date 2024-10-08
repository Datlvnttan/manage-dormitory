@extends('layouts.user')
@section('content')

<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Xác nhận đăng ký</title>
    <link rel="stylesheet" href="~/assets/css/dkhopdong.css">
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
    <style>
        .label-checkbox{
            cursor: pointer;
            font-size: 17px;
            font-weight: 600;
        }
    </style>
</head>
<body>
   
    <div class="container">
        <div class="hopdong" style="width:100%; font-size:18px">
        <div>
            <div style="width:50%; float:left">
                <center class="to">TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP</center>
                <center class="to">THỰC PHẨM TP.HỒ CHÍ MINH</center>
                <center class="in-dam" style="font-weight:bolder"><u>TRUNG TÂM KÝ TÚC XÁ SINH VIÊN</u></center>
            </div>
            <div style="width:50%; float:left">
                <center class="in-dam">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</center>
                <center class="in-dam"><u>Độc lập – Tự do – Hạnh phúc</u></center>
            </div>
            <div style="clear:both"></div>
            <br />
            <center><h1 style="font-weight:900;font-size:25px;">HỢP ĐỒNG THUÊ CHỖ Ở NỘI TRÚ</h1></center><br />
<div style="white-space: pre-wrap; text-align: justify;">
    Hôm nay, ngày {{$today->day}} tháng {{$today->month}} năm {{$today->year}}, tại Trung tâm Ký túc xá sinh viên Trường đại học Công nghiệp Thực phẩm thành phố Hồ Chí Minh, 102-104-106 Nguyễn Quý Anh, phường Tân Sơn Nhì, quận Tân Phú, thành phố Hồ Chí Minh. Hai bên gồm:
    <span class="in-dam">BÊN CHO THUÊ (Bên A): TRUNG TÂM KÝ TÚC XÁ SINH VIÊN TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP THỰC PHẨM TP. HỒ CHÍ MINH</span>
    Đại diện:   Ông Võ Duy Ân, Trung tâm Ký túc xá sinh viên
    Chức vụ: Giám đốc
    Số điện thoại: ……………….
    <span class="in-dam">BÊN THUÊ CHỖ Ở (Bên B):</span>
    Họ và tên: {{$user->Ho." ".$user->Ten}}              Giới tính: {{$user->GioiTinh}}     Năm sinh: {{$user->NgaySinh}}
    MSV: {{$user->MaSV}} Lớp: {{$user->Lop}}  Khoa:………………….Khóa:..……………...
    Số điện thoại: {{$user->SoDienThoai}}
    Email: {{$user->Email}}
    Hộ khẩu thường trú: {{$user->QueQuan}}

    Bên A <span style="font-style:italic">được sự ủy quyền của Hiệu trưởng Trường đại học Công nghiệp Thực phẩm thành phố Hồ Chí Minh</span> cùng Bên B, thống nhất ký kết <b>Hợp đồng cho thuê chỗ ở nội trú tại Ký túc xá trường đại học Công nghiệp Thực phẩm thành phố Hồ Chí Minh với các điều khoản sau:</b>

    <span class="in-dam gach-chan"><u>Điều 1:</u></span>
    Bên A đồng ý cho Bên B thuê 01 chỗ ở nội trú tại phòng số: {{$phong->TenPhong}} Tầng {{$phong->TenTang}}, Nhà: {{$phong->TenKhu}}. Ký túc xá Trường đại học <i>Công nghiệp Thực phẩm thành phố Hồ Chí Minh.</i> Bên B được phép sử dụng các tài sản do nhà trường trang bị tại phòng ở cũng như các phòng sinh hoạt tập thể thuộc khuôn viên Ký túc xá theo Quy chế tổ chức & hoạt động, các quy định và nội quy của Ký túc xá.

    <span class="in-dam gach-chan"><u>Điều 2:</u> Giá cả, thời gian và phương thức thanh toán.</span>
    <b>2.1. Đơn giá cho thuê:</b> 300.000đ/ tháng.
    <b>2.2. Thời gian cho thuê:</b> 01 năm học 10 tháng tính từ ngày 01/09/{{$today->year}} đến ngày 30/06/{{1+$today->year}}
    Ngoài ra Bên B phải đóng tiền điện, nước thực tế sử dụng theo đơn giá của nhà nước.
    <b>2.3. Phương thức thanh toán:</b>  Bên B thanh toán cho Bên A tiền thuê chỗ ở nội trú bằng tiền mặt 1 lần tại phòng Kế hoạch Tài chính của nhà trường trong vòng 05 ngày sau khi hợp đồng được ký kết .

    <span class="in-dam gach-chan"><u>Điều 3:</u> Hợp đồng hết hiệu lực và bên A không có trách nhiệm hoàn trả tiền cho bên B khi:</span>
    - Thời hạn ghi trong hợp đồng kết thúc.
    - Bên B đề nghị chấm dứt hợp đồng trước thời hạn.
    - Bên B hiện không còn là sinh viên của trường: đã tốt nghiệp, bị đình chỉ học tập, bị đuổi học hoặc tự ý bỏ học.
    - Bên B không đảm bảo về sức khỏe, mắc các chứng bệnh về lây nhiễm theo kết luận của cơ quan y tế cấp quận (huyện) trở lên.
    - Bên B vi phạm Nội quy Ký túc xá, bị xử lý kỷ luật theo Khung kỷ luật ban hành mức chấm dứt hợp đồng, cho ra khỏi Ký túc xá.

    <span class="in-dam gach-chan"><u>Điều 4:</u> Trách nhiệm của bên B.</span>
    - Ở đúng nơi đã được Trung tâm Ký túc xá sắp xếp (vị trí phòng ở và giường ở).
    - Chấp hành sự điều chuyển chỗ ở của Trung tâm Ký túc xá trong trường hợp cần thiết và có lý do chính đáng: (<i>Ký túc xá sửa chữa nâng cấp, lý do về an ninh trật tự và một số lý do khác</i>).
    - Không được cho thuê lại chỗ ở cũng như tự ý chuyển nhượng lại hợp đồng cho người khác.
    - Không được đun nấu trong phòng ở và xung quanh khu nội trú.
    - Chấp hành nghiêm chỉnh các quy định của Nhà nước, của Trường, Nội quy Ký túc xá
    - Tự bảo quản tài sản và đồ dùng cá nhân, tự chịu trách nhiệm về việc bảo vệ an toàn cho mình đối với việc sử dụng các dụng cụ, thiết bị cũng như các hoạt động khác.
    - Có ý thức tự giác trong việc bảo quản tài sản công, triệt để tiết kiệm, chống lãng phí, thực hiện nghĩa vụ đầy đủ về trật tự vệ sinh Ký túc xá. Bồi thường các mất mát hư hỏng tài sản công do mình gây ra theo quy định chung của nhà trường.
    - Tự thanh toán các chi phí dịch vụ cá nhân khác như dịch vụ ăn uống, gửi xe...
    - Thanh toán đầy đủ các khoản phí đúng hạn, lưu giữ phiếu thu để đối chiếu khi cần thiết.
    - Cam kết giữ nghiêm kỷ luật nội trú, có tinh thần trách nhiệm và ý thức tập thể.
    - Phải trả phòng và ra khỏi ký túc xá vào ngày hợp đồng hết hiệu lực.

    <span class="in-dam gach-chan"><u>Điều 5:</u> Trách nhiệm của Bên A.</span>
    - Sắp xếp chỗ ở cho Bên B ngay sau khi Bên B đã hoàn thành các thủ tục đăng ký chỗ ở theo quy định và thời gian trong hợp đồng.
    - Đảm bảo các điều kiện về việc sinh hoạt và học tập cho Bên B theo quy định chung.
    - Hướng dẫn Bên B sử dụng các trang thiết bị trong phòng ở.
    - Lưu hoá đơn (phiếu thu) các khoản tiền do Bên B đóng.

    <span class="in-dam gach-chan"><u>Điều 6:</u> Điều khoản chung.</span>
    - Bên nào muốn chấm dứt hợp đồng trước thời hạn phải có văn bản báo cho bên thứ hai biết trước ít nhất là 15 ngày (trừ trường hợp SV bị sử lý kỷ luật vì các lý do khác, hay bị kỷ luật vì vi phạm quy định KTX).
    - Quy chế tổ chức & hoạt động Ký túc xá, Nội quy Ký túc xá, Phiếu đăng ký ở nội trú, Bản cam kết đã ký là bộ phận chung của hợp đồng này.
    - Hai bên cam kết thực hiện theo đúng các điều khoản của hợp đồng và Bản cam kết.
    - Hợp đồng được lập thành 02 bản có giá trị ngang nhau, Bên A giữ 01 bản và Bên B giữ 01 bản.
    - Bên B phải bàn giao trang thiết bị phòng ở cho bên A khi nghỉ Lễ, Tết, thực tập và trước khi kết thúc hợp đồng.
</div>
</div>
        <hr />
        <form action="xac-nhan-dang-ky" method="POST">
            @csrf
            <input type="hidden" name="maPhong" value="{{$phong->MaPhong}}">            
            <div class="row">
                <div class="form-add-conflim">                    
                    <div class="form-add-conflim-box" id="browsing-operation">                    
                        <input type="checkbox" name="checkXacNhan" value="1" id="xacNhan"  />
                        <label for="xacNhan" class="label-checkbox">Tôi chấp nhận các điều khoản và điều kiện của hợp đồng!</label>
                    </div>
                    <div class="form-add-conflim-box">
                        <button type="submit" style="float:right" disabled id="submit" class="btn btn-primary">Xác Nhận</button>
                    </div>
                </div>
            </div>                                    
        </form>                
    </div>

    </div>
</body>
</html>
<script>document.getElementById('sidebar-dangkynoitru').classList.add("active");</script>
<script type="text/javascript" src="{{asset('js/CheckDieuKhoan.js')}}"></script>
@endsection