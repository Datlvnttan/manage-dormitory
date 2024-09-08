@extends('layouts.admin')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <script src="{{asset('js/admin/student/student.callapi.js')}}"></script>
    {{-- <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Danh sách sinh viên</h2>
        <a href="{{route('admin_taoHoaDon')}}" class="btn__primary--type">
            <i class="fa-light fa-plus"></i>
            Thêm sinh viên mới
        </a>
    </div> --}}
    <div class="filter-list-bill">
        <input type="checkbox" id="showAllHD" hidden />
        <label for="showAllHD" class="showAllHD-button">Tất cả</label>
        <div id="showloc">
            <div class="filter-list">                
                <div class="filter-box">
                    <b class="filter-title">Trạng thái: </b>                    
                    <input type="checkbox" checked class="loctt" id="dangO" name="dangO" />
                    <label for="dangO"  class="filter-title">Đang ở</label>
                    <input type="checkbox" class="loctt" id="tamVang" name="tamVang" />
                    <label for="tamVang"  class="filter-title">Tạm vắng</label>                    
                    <input type="checkbox" class="loctt" id="daXetDuyet" name="daXetDuyet" />
                    <label for="daXetDuyet" class="filter-title">Đã xét duyệt</label>
                    <input type="checkbox" class="loctt" id="choXetDuyet" name="choXetDuyet" />
                    <label for="choXetDuyet" class="filter-title">Chờ xét duyệt</label>
                    <input type="checkbox" class="loctt" id="biHuy" name="biHuy" />
                    <label for="biHuy" class="filter-title">Bị hủy</label>
                    <input type="checkbox" class="loctt" id="chuaDangKy" name="chuaDangKy" />
                    <label for="chuaDangKy" class="filter-title">Chưa đăng ký</label>        
                    <input type="checkbox" class="loctt" id="biCam" name="biCam" />
                    <label for="biCam"  class="filter-title">Bị cấm</label>  
                </div>

            </div>
            <div class="filter-list" id="filter-location">
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
                    <td>Mã sinh viên</td>
                    <td>Họ tên</td>                    
                    <td>Giới tính</td>
                    <td>Lớp</td>
                    <td>Số căn cước</td>                                                         
                    <td>Mã phòng</td>
                    <td>Trạng Thái</td>
                    <td></td>
                </thead>
                <tbody id="show-students"></tbody>
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
    <script src="{{asset('js/admin/student/student.handle.js')}}"></script>
    <script>document.getElementById('sidebar-student').classList.add("active");</script>
@endsection