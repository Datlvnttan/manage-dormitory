@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<br><br>
<br><br>
<br><br>
<div>
    <center><h1 style="font-size:40px">Không thành công</h1></center>
    <center><h1 style="font-size:30px;">Bạn đã có hợp đồng có thể có hiệu lực nên không thể đăng ký nội trú nữa</h1></center>
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