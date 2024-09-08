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
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .tr-border-none{
            border-left: none; 
            border-right: none; 
        }
        td.spacing,
        tr.spacing {
            margin-bottom: 20px; 
            border: 1px solid var(--bg-color-primary);
        }
        .border-left{
            border-left: 1px solid var(--bg-color-primary);
        }
        .td-device-allocation{
            border-top: 1px solid var(--bg-color-primary);
        }
        .input-edit-quantity{
            width: 100px;
            border: 1px solid var(--bg-color-primary);
            margin-left: -6px;
            margin-right: -6px;   
            text-align: center         
        }
        #btn-add-device{
            cursor: pointer;
        }
       
       
        .btn-quantity{
            height: 30px;
            width: 30px;
            text-align: center;
            padding-top: 0px;
            border: 1px solid var(--bg-color-primary);
        } 
        .input-edit-quantity:hover,
        .input-edit-quantity:focus,
        .btn-quantity:hover{
            border: 1px solid blue;
        }      
    </style>
    <br>
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Phân bổ thiết bị</h2>
        <a id="btn-add-device" class="btn__primary--type" data-bs-toggle="modal" data-bs-target="#modal-edit-device-allocation">
            <i class="fa-light fa-plus"></i>
            Thêm phân bổ
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
                    </select>
                </div>
            </div>                       
            <button id="btn_loc">Lọc</button>
        </div>        
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table" id="table-show-device-allocation">
                <thead>
                    <td>Phòng</td>
                    <td>Thiết bị</td>
                    <td>Số lượng phân bổ</td>                                  
                    <td></td>
                </thead>                
                <tbody id="tbody-show-device-allocation"> 
                    {{-- <tr>
                        <td rowspan="4">Cột Đơn</td> <!-- Gộp 2 hàng thành 1 cột -->
                        <td>Cột 2</td>
                        <td>Cột 3</td>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>                    --}}
                </tbody>
            </table>            
        </div>

        <div class="modal fade" id="modal-edit-device-allocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <center style="font-size: 20px;">Phân bổ thiết bị </center>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form-edit-device-allocation">
                    <div class="modal-body">                                                      
                        <div class="p-lg-2 row" >                                                                                    
                            <div class="col-lg-6">
                                <div class="profile--form__text-field">
                                    <label for="device-allocation-khu">Khu</label>
                                    <select name="MaKhu" id="device-allocation-khu" class="filter-select active">
                                        <option value=""> -- Tất cả -- </option>                        
                                    </select>                          
                                </div>                        
                            </div>
                            <div class="col-lg-6">
                                <div class="profile--form__text-field">
                                    <label for="device-allocation-tang">Tầng</label>
                                    <select name="MaTang" id="device-allocation-tang" class="filter-select active">
                                        <option value=""> -- Tất cả -- </option>                                        
                                    </select>                                                                               
                                </div>                        
                            </div>  
                            <div class="col-lg-6">
                                <div class="profile--form__text-field">
                                    <label for="device-allocation-phong">Phòng</label>
                                    <select name="MaPhong" id="device-allocation-phong" class="filter-select active">
                                        <option value=""> -- Tất cả -- </option>                                                                              
                                    </select>                                                                               
                                </div>                        
                            </div> 
                            <div class="col-lg-6">
                                <div class="profile--form__text-field">
                                    <label for="device-allocation-deviceid">Thiết bị chưa phân bổ</label>
                                    <select name="MaThietBi" id="device-allocation-deviceid" class="filter-select active">                                                                              
                                    </select>                                                                               
                                </div>                        
                            </div>  
                            <div class="col-12">
                                <div class="profile--form__text-field">
                                    <label for="device-allocation-quantity">Số lượng phần bổ</label>
                                    <input autocomplete="off" class="active" type="number" id="device-allocation-quantity" name="SoLuongPhanBo" value="" placeholder="Tên phòng" />                                                            
                                </div>                        
                            </div>                                
                            <span id="error"></span>
                        </div>                    
                    </div>
                    <div class="modal-footer"> 
                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary" id="btn-save-device-allocation">Lưu</button>                 
                    </div>
                </form> 
              </div>
            </div>
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
    {{-- <script  rel="stylesheet" src="{{asset('js/admin/service/service.callapi.js')}}"></script> --}}
    <script src="{{asset('js/filter-processing.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/device/device-allocation.handle.js')}}"></script> 
    {{-- <script>document.getElementById('sidebar-laptop-medical').classList.add("active");</script> --}}
@endsection