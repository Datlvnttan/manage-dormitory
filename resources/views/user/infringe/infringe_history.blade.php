@extends('layouts.user')
@section('content')
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />

<div class="filter-list-bill">
    <input type="checkbox" id="showAllHD" hidden />
    <label for="showAllHD" class="showAllHD-button">Tất cả</label>
    <div id="showloc">                
        <div class="filter-list">
            <div class="filter-box">
                <input id="thangHienTai" type="checkbox" checked name="thangHienTai" />
                <label for="thangHienTai" class="filter-title">Tháng hiện tại</label>
                <select disabled name="nam" id="nam" class="filter-select">
                    @for ($nam = $today_year; $nam >= 2020; $nam--)                        
                        <option value="{{$nam}}">{{$nam}}</option>                        
                    @endfor
                </select>
                <select disabled name="thang" id="thang" class="filter-select">
                    <option selected value="0">Chọn</option>
                </select>

            </div>
            <div class="filter-box">
                <b class="filter-title">Trạng thái: </b>
                <input type="checkbox" class="loctt" id="daGiaiQuyet" name="daGiaiQuyet" />
                <label for="daGiaiQuyet"  class="filter-title">Đã xử lý</label>
                <input type="checkbox" checked class="loctt" id="chuaGiaiQuyet" name="chuaGiaiQuyet" />
                <label for="chuaGiaiQuyet" class="filter-title">Chưa xử lý</label>
                <input type="checkbox" checked class="loctt" id="khongChinhXac" name="khongChinhXac" />
                <label for="khongChinhXac" class="filter-title">Không chính xác</label>
            </div>

        </div>

    </div>
    <button id="btn_loc">Lọc</button>
</div>
<div class="container-fluid">
    <div class="row">
        <table class="main-info-users-table">
            <thead>
                <tr>
                    <td>Mã vi phạm</td>
                    <td>Nội dung vi phạm</td>
                    <td>Thời gian</td>
                    <td>Hình phạt</td>                                        
                    <td>Trạng thái</td>
                    <td></td>
                </tr>
            </thead>
            <tbody id="infringe-history-list" style="position: relative">               
            </tbody>
        </table>
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
    </div> --}}
</div>
<ul class="pagination " id="pagination">    
<script src="{{asset('js/filter-processing.js')}}"></script>
<script  rel="stylesheet" src="{{asset('js/user/infringe-history/infringe-history.history.handle.js')}}"></script>
<script src="{{asset('js/callApiPhong.js')}}"></script>
<script>document.getElementById('sidebar-vipham').classList.add("active");</script>
@endsection