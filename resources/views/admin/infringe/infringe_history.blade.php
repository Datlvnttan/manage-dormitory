@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Lịch sử vi phạm</h2>
        <a href="{{route('web.infringe_history.infringeHistoryCreate')}}" class="btn__primary--type">
            <i class="fa-light fa-plus"></i>
            Khai báo vi phạm
        </a>
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
                    <label for="khongChinhXac" class="filter-title">Chưa xử lý</label>
                    <input type="checkbox" checked class="loctt" id="khongChinhXac" name="khongChinhXac" />
                    <label for="khongChinhXac" class="filter-title">Không chính xác</label>
                </div>
    
            </div>
    
        </div>
        <button id="btn_loc">Lọc</button>
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table" style="position: relative;">
                <thead>
                    <tr>
                        <td>Mã sinh viên</td>
                        <td>Họ tên</td>
                        <td>Mã vi phạm</td>
                        <td>Nội dung vi phạm</td>
                        <td>Thời gian</td>
                        <td>Hình phạt</td>
                        <td>Người tạo</td>                        
                        <td>Trạng thái</td>
                    </tr>
                </thead>
                <tbody id="infringe-history-list" >                   
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
    <script  rel="stylesheet" src="{{asset('js/admin/infringe-history/infringe-history.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/infringe-history/infringe-history.handle.js')}}"></script> 
    {{-- <script>document.getElementById('sidebar-gavel').classList.add("active");</script> --}}
@endsection