@extends('layouts.admin')
@section('content')

<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
<script src="{{asset('js/admin/damage-equipment/damage-equipment.callapi.js')}}"></script>
<div class="test">
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Danh sách các khai báo</h2>
    </div>
    <div class="filter-list-bill">
        <input type="checkbox"  id="showAllHD" hidden  />
        <label for="showAllHD" class="showAllHD-button">Tất cả</label>
        <div id="showloc">
            <div class="filter-list">
                <div class="filter-box">
                    <span class="filter-title">Chọn khu:</span>
                    <select name="khu" id="khu" class="filter-select">
                        <option value=""> --Tất cả-- </option>
                    </select>
                </div>
                <div class="filter-box">
                    <span class="filter-title">Chọn tầng:</span>
                    <select name="tang" id="tang" class="filter-select">
                        <option value=""> --Tất cả-- </option>
                    </select>
                </div>
                <div class="filter-box">
                    <span class="filter-title">Chọn phòng:</span>
                    <select name="phong" id="phong" class="filter-select">
                        <option value="">--Tất cả-- </option>
                        <script>
                            show_khu()
                            khu_change();
                            tang_change();                          
                        </script>
                    </select>
                </div>
                <div class="filter-box">
                    <b class="filter-title">Trạng thái: </b>
                    <input type="checkbox" class="loctt" id="daXuLy" name="daThanhToan" />
                    <label for="daXuLy" class="filter-title">Đã xử lý</label>
                    <input type="checkbox" checked class="loctt" id="chuaXuLy" name="chuaThanhToan" />
                    <label for="chuaXuLy" class="filter-title">Chưa xử lý</label>
                </div>
            </div>
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
                        <option selected value="0">--Tất cả--</option>
                    </select>

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
                        <td>Mã khai báo</td>
                        <td>Ngày yêu cầu</td>
                        <td>Phòng </td>
                        <td>Thiết bị</td>
                        <td>Tổng số lượng</td>
                        <td>Trạng thái</td>
                    </tr>
                </thead>
                <tbody id="khaiBaoHuHongs">                    
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
</div>
<ul class="pagination " id="pagination">        
</ul>
<script src="{{asset('js/callApiPhong.js')}}"></script>
<script src="{{asset('js/filter-processing.js')}}"></script>
{{-- <script src="{{asset('js/Dashboard/Admin/QuanLyKhaiBaoHuHong.js')}}"></script> --}}
<script src="{{asset('js/admin/damage-equipment/damage-equipment.manager.handle.js')}}"></script>
{{-- <script>document.getElementById('sidebar-house-chimney-crack').classList.add("active");</script> --}}

@endsection