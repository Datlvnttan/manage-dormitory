@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<br><br>
<br><br>
<br><br>
<div>
    <center><h1 style="font-size:40px">Không thể đăng ký</h1></center>
    <center><h1 style="font-size:30px;">Bạn đã là thành viên của ký túc xá</h1></center>
</div>
<br>
<br>
<br>
<br>
{{-- <div class="form-add-bill">
    <div class="form-add-conflim-box" id="browsing-operation">                    
        {{-- <a class="btn btn-primary" onclick="">Xác nhận thanh toán</a>
        <button class="open_btn btn btn-danger">Hủy bỏ</button>
    </div> 
    <a href="{{route('admin_danhSachHopDong')}}" class="btn__go-home">
        <i class="fa-regular fa-chevrons-left"></i>
        Trở về danh sách hợp dồng
    </a>
</div> --}}
<center>
    <div class="form-add-conflim-box">                    
        <a href="/user/ho-so-sinh-vien" class="btn btn-primary">Cập nhật thông tin cá nhân</a>        
    </div><br><br>
    <div class="form-add-conflim-box">
        <a href="/user" class="btn__go-home">
            <i class="fa-regular fa-chevrons-left"></i>
            Trở về trang chủ
        </a>
    </div>
</center>
<script>document.getElementById('sidebar-dangkynoitru').classList.add("active");</script>
@endsection