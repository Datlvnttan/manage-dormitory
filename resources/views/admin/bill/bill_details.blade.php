@extends('layouts.admin')
@section('content')

<script>document.getElementById('sidebar-file-invoice').classList.add("active");</script>
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemChiTietHoaDon.css')}}" />
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name">Thông tin hóa đơn</h2>
</div>
<meta>
<div class="container-fluid">
    <div class="bg-white-content">
        <div class="row" id="bill-info">
            <script>
                xemChiTietHoaDon('{{$MaHoaDon}}')
            </script>
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
                <div class="form-add-bill">
                    <div id="update-bill" ></div>            
                    <a href="{{route('web.bill.showBillList')}}" class="btn__go-home">
                        <i class="fa-regular fa-chevrons-left"></i>
                        Trở về danh sách hóa đơn
                    </a>
                </div>                
        </div>
    </div>
</div>


@endsection