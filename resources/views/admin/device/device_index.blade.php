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
        #btn-add-device{
            cursor: pointer;
        }
    </style>
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Thiết bị</h2>
        <a id="btn-add-device" class="btn__primary--type" data-bs-toggle="modal" data-bs-target="#modal-edit-device">
            <i class="fa-light fa-plus"></i>
            Thêm thiết bị
        </a>
    </div>  
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <td>Mã thiết bị</td>
                    <td>Tên thiết bị</td>
                    <td>Tổng số lượng</td>
                    <td>Số lượng mỗi phòng</td>                    
                    <td></td>
                </thead>
                <tbody id="tbody-show-device">                    
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
    <ul class="pagination " id="pagination"></ul>   
    <div class="modal fade" id="modal-edit-device" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <center style="font-size: 20px;">Cập nhật thông tin thiết bị</center>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="form-edit-device">
                <div class="modal-body">                  
                                
                    <div class="p-lg-2 row" >
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="device-MaThietBi">Mã thiết bị</label>
                                <input autocomplete="off" class="active" type="text" id="device-MaThietBi" name="MaThietBi" value="" placeholder="Mã thiết bị" />                                                            
                            </div>  
                            <div class="box-error">
                                <span class="error-validate-update MaThietBi"></span>
                            </div>                         
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="device-TenThietBi">Tên thiết bị</label>
                                <input autocomplete="off" class="active" type="text" id="device-TenThietBi" name="TenThietBi" value="" placeholder="Tên thiết bị" />                                                        
                            </div>       
                            <div class="box-error">
                                <span class="error-validate-update TenThietBi"></span>
                            </div>                                             
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="device-TongSoLuong">Tổng số lượng</label>
                                <input autocomplete="off" class="active" type="number" id="device-TongSoLuong" name="TongSoLuong" value="" placeholder="Tổng số lượng" />                                                            
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update TongSoLuong"></span>
                            </div>                        
                        </div>    
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="device-SoLuongMoiPhong">Số lượng mỗi phòng</label>
                                <input autocomplete="off" class="active" maxlength="10" type="number" id="device-SoLuongMoiPhong" name="SoLuongMoiPhong" value="" placeholder="Số lượng mỗi phòng" />                                                            
                            </div> 
                            <div class="box-error">
                                <span class="error-validate-update SoLuongMoiPhong"></span>
                            </div>                        
                        </div>                                                                                                                              
                        <span id="error" class="error-validate-update"></span>
                    </div>                    
                </div>
                <div class="modal-footer"> 
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary" id="btn-save-device">Lưu</button>                 
                </div>
            </form> 
            </div>
        </div>
    </div>                   
    {{-- <script  rel="stylesheet" src="{{asset('js/admin/device/device.callapi.js')}}"></script> --}}
    <script  rel="stylesheet" src="{{asset('js/admin/device/device.handle.js')}}"></script> 
    {{-- <script>document.getElementById('sidebar-toolbox').classList.add("active");</script> --}}
@endsection