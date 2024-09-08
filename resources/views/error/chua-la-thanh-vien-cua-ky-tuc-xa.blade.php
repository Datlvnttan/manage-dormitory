@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<br><br>
<br><br>
<br><br>
<div>
    <center><h1 style="font-size:40px">Không được phép</h1></center>
    <center><h1 style="font-size:30px;">Bạn chưa là thành viên của ký túc xá</h1></center>    
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
@endsection