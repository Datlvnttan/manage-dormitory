@extends('layouts.user')
@section('content')
{{-- <script>document.getElementById('sidebar-hopdong').classList.add("active");</script> --}}

<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/ChiTietHopDong.css')}}" />
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
<br><br>
<div class="sidebar-right-content-heading">
    <center><h1 class="sidebar-right-content-heading-name">Hợp đồng của bạn</h1></center>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="bg-white-content">
            <div class="row" id="contract-details">                
               
            </div> 
                           
            <div class="form-add-bill">
                <div class="form-add-conflim-box" id="browsing-operation">                    
                    
                </div> 
                <a href="/user" class="btn__go-home">
                    <i class="fa-regular fa-chevrons-left"></i>
                    Trở về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>
<script  rel="stylesheet" src="{{asset('js/user/contract/contract.details.handle.js')}}"></script>       
@endsection