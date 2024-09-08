@extends('layouts.user')
@section('content')

<script>document.getElementById('sidebar-bill').classList.add("active");</script>
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
                        <td>Mã dịch vụ</td>
                        <td>Tên dịch vụ</td>
                        <td>Giá</td>
                        <td>Số lượng</td>
                        <td>Tổng tiền</td>
                    </tr>
                </thead>
                <tbody id="bill-details">

                </tbody>                
            </table>       
            <link rel="stylesheet" href="{{asset('css/hopThoai.css')}}" />
            <div class="form-add-bill">
                <div id="report-bill" ></div>            
                <a href="{{route('user_quanLyHoaDon')}}" class="btn__go-home">
                    <i class="fa-regular fa-chevrons-left"></i>
                    Trở về danh sách hóa đơn
                </a>
            </div>                
        </div>
    </div>
</div>
<script  rel="stylesheet" src="{{asset('js/user/bill/bill.callapi.js')}}"></script>
<script  rel="stylesheet" src="{{asset('js/user/bill/bill.details.handle.js')}}"></script>
@endsection