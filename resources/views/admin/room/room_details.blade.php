@extends('layouts.admin')
@section('content')

<script>document.getElementById('sidebar-building').classList.add("active");</script>
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinPhong.css')}}">
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
<div class="sidebar-right-content-heading">    
</div>
    <div class="container-fluid">
        <div class="bg-white-content" >
            <div id="room-details">
                {{-- <script>
                    thongTinPhong("{{$MaPhong}}")
                </script> --}}
            </div>        
            <div class="row" id="table-student">
                <h2 class="heading-bill-title">Danh sách thành viên</h2>
                <table class="table main-info-users-table"  style="position: relative">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Mã sinh viên</td>
                            <td>Họ và tên</td>
                            <td>Lớp</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Trạng thái</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="room-details-members"></tbody>
                </table>
            </div>
            <div class="row" id="table-service">
                <h2 class="heading-bill-title">Thông số dịch vụ</h2>
                <table class="table main-info-users-table"  style="position: relative">
                    <thead>
                        <tr>                            
                            <td>Mã dịch vụ</td>
                            <td>Tên dịch vụ</td>
                            <td>Chỉ số hiện tại</td>                          
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="room-service-has-index" style="position: relative"></tbody>
                </table>
            </div>
            <div class="row">
                <div class="form-add-bill">
                    <a href="~/Admin/DanhSachPhong" class="btn__go-home">
                        <i class="fa-regular fa-chevrons-left"></i>
                        Trở về danh sách phòng
                    </a>
                    <div class="form-add-conflim-box" id="browsing-operation">                                            
                        <button class="open_btn btn btn-danger" id="btn-delete-room">Xóa phòng</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script  rel="stylesheet" src="{{asset('js/admin/room/room.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/room/room.details.handle.js')}}"></script> 
@endsection