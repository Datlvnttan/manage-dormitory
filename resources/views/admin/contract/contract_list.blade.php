@extends('layouts.admin')
@section('content')
    {{-- <script>document.getElementById('sidebar-file-contract').classList.add("active");</script> --}}
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachHopDong.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Quản lý hợp dồng</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            <form method="post" id="form-filter" class="filter-list">
                <div class="filter-box">
                    <input type="checkbox" name="showAll" id="loc0" class="showAll" value="All" /> <label class="filter-title" for="loc0">Tất cả </label>
                </div>
                <div class="filter-box">
                    <input type="checkbox" checked name="loc" id="loc1" class="loc" value="Chưa hiệu lực" /> <label class="filter-title" for="loc1">Chưa hiệu lực </label>
                </div>
                <div class="filter-box">
                    <input type="checkbox" name="loc" id="loc2" class="loc" value="Có hiệu lực" /> <label class="filter-title" for="loc2">Có hiệu lực </label>
                </div>
                <div class="filter-box">
                    <input type="checkbox" checked name="loc" id="loc3" class="loc" value="Xin gia hạn" /> <label class="filter-title" for="loc3">Xin gia hạn </label>
                </div>
                <div class="filter-box">
                    <input type="checkbox" name="loc" id="loc4" class="loc" value="Hết hiệu lực" /> <label class="filter-title" for="loc4">Hết hiệu lực </label>
                </div>
                <button type="submit" class="filter-button">Lọc</button>
            </form>           
        </div>
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <tr>
                        <td>
                            Mã hợp đồng
                        </td>
                        <td>
                            Mã sinh viên
                        </td>
                        <td>
                            Người tạo
                        </td>
                        <td>
                            Ngày tạo
                        </td>
                        <td>
                            Ngày bắt đầu
                        </td>
                        <td>
                            Ngày kết thúc
                        </td>
                        <td>
                            Trạng thái
                        </td>
                        <td></td>
                    </tr>
                </thead>

                <tbody id="contract-list">                    
                </tbody>               
            </table>
            <ul class="pagination " id="pagination"> </ul>
        </div>
        {{-- <div class="row">
            <div class="sidebar-right-content-pagination">
                <ul class="pagination-list">
                    <li class="pagination-item">
                        <a href="#" class="pagination-link">
                            <i class="fa-regular fa-chevron-left"></i>
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="#" class="pagination-link active">
                            1
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="#" class="pagination-link">
                            2
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="#" class="pagination-link">
                            3
                        </a>
                    </li>
                    <li class="pagination-item">
                        <a href="#" class="pagination-link">
                            <i class="fa-regular fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>         --}}
    </div>    
    <script  rel="stylesheet" src="{{asset('js/admin/contract/contract.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/contract/contract.handle.js')}}"></script>        
    <script src="{{asset('js/loc.js')}}"></script>
@endsection