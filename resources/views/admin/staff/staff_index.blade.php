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
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Quản lý nhân viên</h2>
        <button id="btn-add-staff" class="btn__primary--type" data-bs-toggle="modal" data-bs-target="#modal-edit-staff">
            <i class="fa-light fa-plus"></i>
            Tạo tài khoản nhân viên mới
        </button>
    </div>  
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <td>Tên đăng nhập</td>
                    <td>Họ tên</td>
                    <td>Số điện thoại</td>
                    <td>Chức vụ</td>                    
                    <td></td>
                </thead>
                <tbody id="tbody-show-staff">                    
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
    <div class="modal fade" id="modal-edit-staff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <center style="font-size: 20px;">Cập nhật thông tin nhân viên</center>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="form-edit-staff">
                <div class="modal-body">                  
                                
                    <div class="p-lg-2 row" >
                        <div class="col-12">
                            <div class="profile--form__text-field">
                                <label for="staff-TenDangNhap">Tên đăng nhập</label>
                                <input autocomplete="on" class="active" type="text" id="staff-TenDangNhap" name="TenDangNhap" value="" placeholder="Tên đăng nhập" />                                                            
                            </div>  
                            <div class="box-error">
                                <span class="error-validate-update TenDangNhap"></span>
                            </div>                         
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="staff-Ho">Họ</label>
                                <input autocomplete="off" class="active" type="text" id="staff-Ho" name="Ho" value="" placeholder="Họ" />                                                        
                            </div>       
                            <div class="box-error">
                                <span class="error-validate-update Ho"></span>
                            </div>                                             
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="staff-Ten">Tên</label>
                                <input autocomplete="off" class="active" type="text" id="staff-Ten" name="Ten" value="" placeholder="Tên" />                                                            
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update Ten"></span>
                            </div>                        
                        </div>    
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="staff-SoDienThoai">Số điện thoại</label>
                                <input autocomplete="off" class="active" maxlength="10" type="text" id="staff-SoDienThoai" name="SoDienThoai" value="" placeholder="Tên" />                                                            
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update SoDienThoai"></span>
                            </div>                        
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="staff-ChucVu">Chức vụ</label>
                                <select name="ChucVu" id="staff-ChucVu" autocomplete="off" class="active">
                                    <option value="Nhan viên">Nhân viên</option>
                                    <option value="Giám Đốc">Giám Đốc</option>
                                </select>                                
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update "></span>
                            </div>                        
                        </div>                                                                                                        
                        <span id="error" class="error-validate-update"></span>
                    </div>                    
                </div>
                <div class="modal-footer"> 
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary" id="btn-save-staff">Lưu</button>                 
                </div>
            </form> 
            </div>
        </div>
    </div>                   
    {{-- <script  rel="stylesheet" src="{{asset('js/admin/staff/staff.callapi.js')}}"></script> --}}
    <script  rel="stylesheet" src="{{asset('js/admin/staff/staff.handle.js')}}"></script> 
    <script>document.getElementById('sidebar-clipboard-user').classList.add("active");</script>
@endsection