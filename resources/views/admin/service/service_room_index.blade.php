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
        .td-room{
            border-top: 1px solid var(--bg-color-primary);
        }
    </style>
    <br>
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Dịch vụ có chỉ số</h2>
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
            <button id="btn_loc">Lọc</button>
        </div>        
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table" id="table-show-service-room">
                <thead>
                    <td>Phòng</td>
                    <td>Dịch vụ</td>
                    <td>Chỉ số hiện tại</td>                                  
                    <td></td>
                </thead>                
                <tbody id="tbody-show-service-room"> 
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
    <script  rel="stylesheet" src="{{asset('js/admin/service/service-room.handle.js')}}"></script> 
    <script>document.getElementById('sidebar-indent').classList.add("active");</script>
@endsection