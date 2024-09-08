@extends('layouts.user')
@section('content')

<script>document.getElementById('sidebar-khaibaohuhong').classList.add("active");</script>
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemChiTietHoaDon.css')}}" />
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name">Thông tin hóa đơn</h2>
</div>
<meta>
<div class="container-fluid">
    <div class="bg-white-content">
        <div class="row" id="bill-info">            
        </div>
        <div class="row">
            <h4 class="heading-bill-title">Chi tiết các khoản dịch vụ</h4>
        </div>
        <div class="row">
            <table class="table main-info-users-table">
                <thead>
                    <tr>
                        <td>Mã xử lý</td>
                        <td>Số lượng</td>
                        <td>Nguyên nhân</td>
                        <td>Hướng xử lý</td>
                        <td>Chi phí phát sinh</td>
                    </tr>
                </thead>
                <tbody id="bill-details">

                </tbody>                
            </table>       
                <link rel="stylesheet" href="{{asset('css/hopThoai.css')}}" />
                <div class="form-add-bill">
                    <div id="report-bill" ></div>            
                    <a href="{{route('user_khaiBaoHuHong')}}" class="btn__go-home">
                        <i class="fa-regular fa-chevrons-left"></i>
                        Trở về trước
                    </a>
                </div>                
        </div>
    </div>
</div>
<script  rel="stylesheet" src="{{asset('js/user/damage-report/damage-report.details.handle.js')}}"></script>
@endsection