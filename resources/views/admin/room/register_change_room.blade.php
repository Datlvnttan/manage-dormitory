@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Lịch sử chuyển phòng</h2>
        {{-- <a href="{{route('admin_khaiBaoViPham')}}" class="btn__primary--type">
            <i class="fa-light fa-plus"></i>
            Khai báo vi phạm
        </a> --}}
    </div>
    <div class="filter-list-bill">
        <input type="checkbox" id="showAllHD" hidden />
        <label for="showAllHD" class="showAllHD-button">Tất cả</label>
        <div id="showloc">
            <div class="filter-list">
                <div class="filter-box">
                    <span class="filter-title">Chọn khu:</span>
                    <select name="khu" id="khu" class="filter-select">
                        <option value=""> -- Tất cả -- </option>                        
                    </select>
                </div>                
                <div class="filter-box">
                    <span class="filter-title">Chọn tầng:</span>
                    <select name="tang" id="tang" class="filter-select">
                        <option value=""> -- Tất cả -- </option>
                    </select>
                </div>
                <div class="filter-box">
                    <span class="filter-title">Chọn phòng:</span>
                    <select name="phong" id="phong" class="filter-select">
                        <option value=""> -- Tất cả -- </option>
                        <script>
                            show_khu()
                            khu_change();
                            tang_change();                          
                        </script>
                    </select>
                </div>
            </div>
            
            <div class="filter-list">
                <div class="filter-box">
                    <input id="thangHienTai" type="checkbox" name="thangHienTai" />
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
                    <input type="checkbox" class="loctt" id="choXetDuyet" name="choXetDuyet" checked />
                    <label for="choXetDuyet"  class="filter-title">Chờ xét duyệt</label>
                    <input type="checkbox"  class="loctt" id="thanhCong" name="thanhCong" />
                    <label for="thanhCong" class="filter-title">Thành công</label>
                    <input type="checkbox" class="loctt" id="thatBai" name="thatBai" />
                    <label for="thatBai" class="filter-title">Thất bại</label>
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
                        <td>Mã đăng ký</td>
                        <td>Mã sinh viên</td>
                        <td>Họ tên</td>
                        <td>Phòng cũ</td>
                        <td>Phòng muốn đổi</td>
                        <td>Ngày đăng ký</td>
                        <td>Lý do</td>
                        <td>Trạng thái xét duyệt</td>
                        <td></td>                        
                    </tr>
                </thead>
                <tbody class="change-room-history-list" style="position: relative">                   
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
    <script src="{{asset('js/callApiPhong.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/change-room-history/change-room-history.handle.js')}}"></script> 
    <script>document.getElementById('sidebar-lichsuchuyenphong').classList.add("active");</script>
@endsection