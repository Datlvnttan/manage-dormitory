@extends('layouts.admin')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Danh sách hóa đơn</h2>
        <a href="{{route('web.bill.billCreate')}}" class="btn__primary--type">
            <i class="fa-light fa-plus"></i>
            Tạo hóa đơn mới
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
                    <input type="checkbox" class="loctt" id="daThanhToan" name="daThanhToan" />
                    <label for="daThanhToan"  class="filter-title">Đã thanh toán</label>
                    <input type="checkbox" checked class="loctt" id="chuaThanhToan" name="chuaThanhToan" />
                    <label for="chuaThanhToan" class="filter-title">Chưa thanh toán</label>
                    <input type="checkbox" class="loctt" id="khongChinhXac" name="khongChinhXac" checked/>
                    <label for="khongChinhXac" class="filter-title">Không chính xác</label>
                </div>
    
            </div>
    
        </div>
        <button id="btn_loc" class="btn-filter">Lọc</button>
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <td>Mã Hóa Đơn</td>
                    <td>Mã Phòng</td>
                    <td>Ngày Tạo</td>
                    <td>Thành tiền</td>
                    <td>Người Tạo</td>
                    <td>Trạng Thái</td>
                </thead>
                <tbody id="showHoaDon">                    
                </tbody>
            </table>
        </div>
        <div class="row">
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
        </div>
    </div>
    <ul class="pagination " id="pagination">  
    {{-- <div class="modall an">
        @using (Html.BeginForm("ThanhToanHoaDon", "Admin", new { url = Request.Url.ToString() }))
        {
            <div class="modal__innerr">
                <div class="modal__headerr">
                    <p>Bạn muốn thanh toán hóa đơn</p>
                    <i class="fas fa-times"></i>
                </div>
                <div class="modal__bodyy">
                    <p>Xác nhận thanh toán hóa đơn "<span id="idValue"></span>"?</p>
                </div>
                <div class="modal__footerr">
                    <a class="close btn btn-warning">Hủy bỏ</a>
                    <button type="submit" name="maHoaDon" id="subvalue" class="btn btn-danger">Xác nhận</button>
                </div>
            </div>
        }
    </div> --}}
    <script src="{{asset('js/filter-processing.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/bill/bill.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/bill/bill.handle.js')}}"></script>
    <script src="{{asset('js/callApiPhong.js')}}"></script>
    <script>document.getElementById('sidebar-file-invoice').classList.add("active");</script>
@endsection