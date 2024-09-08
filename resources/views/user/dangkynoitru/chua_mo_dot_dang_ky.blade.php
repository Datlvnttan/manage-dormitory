@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<div>
    <center><h1 style="font-size:40px">Không thể đăng ký</h1></center>
    <center>
        <h1 style="font-size:30px;">Hiện tại ký túc xá chưa mở đợt đăng ký,
            vui lòng chờ đến đợt đăng ký mới
        </h1>
    </center>
    <center style="font-size:20px; font-weight: 350; font-style: italic">(Hãy chờ thông báo từ ký túc xá về đợt đăng ký mới)</center>
    <center style="font-size:15px; font-weight: 350; font-style: italic">Nhớ cập nhật đầy đủ thông tin cá nhân để tránh mất cơ hội</center>
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