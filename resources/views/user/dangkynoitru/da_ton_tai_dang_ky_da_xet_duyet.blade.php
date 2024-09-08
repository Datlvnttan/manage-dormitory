@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<div>
    <center><h1 style="font-size:40px">Không thể gửi thêm nữa</h1></center>
    <center>
        <h1 style="font-size:30px;">Yêu cầu đăng ký nội trú của bạn đã được xét duyệt
        </h1>
    </center>
    <center style="font-size:20px; font-weight: 350; font-style: italic">Vui lòng thanh toán hợp đồng để hoàn tất quá trình đăng ký</center>    
</div>
<br>
<br>
<br>
<br>
<center>    
    <div class="form-add-conflim-box">
        <a href="/user" class="btn__go-home">
            <i class="fa-regular fa-chevrons-left"></i>
            Trở về trang chủ
        </a>
    </div>
</center>
<script>document.getElementById('sidebar-dangkynoitru').classList.add("active");</script>
@endsection