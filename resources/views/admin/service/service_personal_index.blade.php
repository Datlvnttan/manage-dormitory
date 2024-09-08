@extends('layouts.admin')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
    <style>
        .box-error{
            position: relative;
            height: 20px;            
        }
        .box-error-checkbox{
            position: relative;
        }
        .error-validate-update{
            position: absolute;
            font-size: 13px;
            color: red;
            bottom: 20px;
        }
        .form-check.form-switch{
            font-size: 18px;
        }
    </style>
    <br>
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Dịch vụ cá nhân</h2>
        {{-- <button id="btn-add-service" class="btn__primary--type" data-bs-toggle="modal" data-bs-target="#modal-edit-service-personal">
            <i class="fa-light fa-plus"></i>
            Tạo đăng ký mới
        </button> --}}
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
                    <input id="thangHienTai" type="checkbox" name="thangHienTai" checked />
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
                    <input type="checkbox"  class="loctt" id="dangSuDung" name="dangSuDung" />
                    <label for="dangSuDung" class="filter-title">Đang sử dụng</label>                    
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
                    <td>Ngày gửi</td>
                    <td>Tên dịch vụ</td>
                    <td>Giá dịch vụ</td>
                    <td>Trạng thái</td>                    
                    <td></td>
                </thead>
                <tbody id="tbody-show-service-personal">                    
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
    <ul class="pagination " id="pagination"></ul>   
    <div class="modal fade" id="modal-edit-service-personal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <center style="font-size: 20px;">Cập nhật thông tin dịch vụ </center>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="form-edit-service">
                <div class="modal-body">                  
                                
                    <div class="p-lg-2 row" >
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="service-id">Mã dịch vụ</label>
                                <input autocomplete="off" class="active" type="text" id="service-id" name="MaDichVu" value="" placeholder="Mã dịch vụ" />                                                            
                            </div>                        
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="service-name">Tên dịch vụ</label>
                                <input autocomplete="off" class="active" type="text" id="service-name" name="TenDichVu" value="" placeholder="Tên dịch vụ" />                                                        
                            </div>       
                            <div class="box-error">
                                <span class="error-validate-update TenDichVu"></span>
                            </div>                                             
                        </div> 
                        <div class="col-12">
                            <div class="profile--form__text-field">
                                <label for="service-capacity">Giá hiện tại</label>
                                <input autocomplete="off" class="active" type="number" id="service-price" name="GiaHienTai" value="" placeholder="Giá hiện tại" />                                                            
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update GiaHienTai"></span>
                            </div>                        
                        </div> 
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" value="true" type="checkbox" role="switch" id="BatBuoc" name="BatBuoc">
                                <label class="form-check-label" for="BatBuoc">Bắt buộc</label>
                            </div>
                            {{-- <div class="box-error-checkbox">
                                <span class="error-validate-update BatBuoc"></span>
                            </div>  --}}
                        </div>  
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" value="true" type="checkbox" role="switch" id="TinhTheoChiSo" name="TinhTheoChiSo">
                                <label class="form-check-label" for="TinhTheoChiSo">Tính theo chỉ số</label>
                            </div>
                            {{-- <div class="box-error-checkbox">
                                <span class="error-validate-update TinhTheoChiSo"></span>
                            </div>  --}}
                        </div>                                                                                       
                        <span id="error" class="error-validate-update"></span>
                    </div>                    
                </div>
                <div class="modal-footer"> 
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary" id="btn-save-service">Lưu</button>                 
                </div>
            </form> 
            </div>
        </div>
    </div>                   
    {{-- <script  rel="stylesheet" src="{{asset('js/admin/service/service.callapi.js')}}"></script> --}}
    <script src="{{asset('js/filter-processing.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/service/service-personal.handle.js')}}"></script> 
    <script>document.getElementById('sidebar-street-view').classList.add("active");</script>
@endsection