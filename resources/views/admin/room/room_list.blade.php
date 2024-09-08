@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachPhong.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <script>document.getElementById('sidebar-building').classList.add("active");</script>
    <style>              
        .list-room-item-right-edit{
            cursor: pointer;
        }
    </style>
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Quản lý phòng ký túc xá</h2>
        <button class="btn__primary--type" id="btn-add-room" data-bs-toggle="modal" data-bs-target="#modal-edit-room">
            <i class="fa-light fa-plus"></i>
            Thêm phòng mới
        </button>
    </div>
    <div class="container-fluid">
        <div class="sidebar-right-list">
            <div class="sidebar-right-list-filter">
                {{-- <ul class="sidebar-right-list-filter-list">
                    <li class="sidebar-right-list-filter-item">
                        <a href="#" class="sidebar-right-list-filter-item-link active">Tất cả</a>
                    </li>
                    <li class="sidebar-right-list-filter-item">
                        <a href="#" class="sidebar-right-list-filter-item-link">Chưa sử dụng</a>
                    </li>
                    <li class="sidebar-right-list-filter-item">
                        <a href="#" class="sidebar-right-list-filter-item-link">Đã sử dụng</a>
                    </li>
                    <li class="sidebar-right-list-filter-item">
                        <a href="#" class="sidebar-right-list-filter-item-link">Đang sửa chữa</a>
                    </li>
                </ul> --}}
                {{-- <div class="sidebar-right-list-filter-sort">
                    <select name="" id="">
                        <option value="">-- Chọn cách lọc --</option>
                        <option value="">Theo từ A - Z</option>
                        <option value="">Theo từ Z - A</option>
                        <option value="">Theo số phòng thấp - cao </option>
                        <option value="">Theo số phòng cao - thấp</option>
                    </select>
                </div>              --}}
            </div>
<br><br><br>
            <div class="row">
                <div class="profile--form__text-field col-lg-4 col-md-6">
                    <span class="filter-title">Chọn khu:</span>
                    <select name="khu" id="khu" class="active">
                        <option value=""> -- Tất cả -- </option>                        
                    </select>
                </div>                
                <div class="profile--form__text-field col-lg-4 col-md-6">
                    <span class="filter-title">Chọn tầng:</span>
                    <select name="tang" id="tang" class="active">
                        <option value=""> -- Tất cả -- </option>                       
                    </select>
                    <script>
                        show_khu()
                        khu_change();                                                     
                    </script>
                </div>
                <div class="box-btn-filter col-xl-2 col-lg-3 col-3">
                    <button  class="btn__primary--type"  id="btn-filter">Lọc</button>
                </div>                
            </div>

            <div class="sidebar-right-list-room-all">
                <div class="row" id="room-list">                    
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
    </div>   
   
    <div class="modal fade" id="modal-edit-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <center style="font-size: 20px;">Cập nhật thông tin phòng </center>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="form-edit-room">
                <div class="modal-body">                  
                                
                    <div class="p-lg-2 row" >
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="room-id">Mã phòng</label>
                                <input autocomplete="off" class="active" type="text" id="room-id" name="MaPhong" value="" placeholder="Mã phòng" />                                                            
                            </div>                        
                        </div> 
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="room-name">Tên phòng</label>
                                <input autocomplete="off" class="active" type="text" id="room-name" name="TenPhong" value="" placeholder="Tên phòng" />                                                        
                            </div>                        
                        </div> 
                        <div class="col-12">
                            <div class="profile--form__text-field">
                                <label for="room-capacity">Sức chứa</label>
                                <input autocomplete="off" class="active" type="text" id="room-capacity" name="SucChua" value="" placeholder="Tên phòng" />                                                            
                            </div>                        
                        </div> 
                        
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="room-khu">Khu</label>
                                <select name="MaKhu" id="room-khu" class="filter-select active">
                                    <option value=""> -- Tất cả -- </option>                        
                                </select>                          
                            </div>                        
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="room-tang">Tầng</label>
                                <select name="MaTang" id="room-tang" class="filter-select active">
                                    <option value=""> -- Tất cả -- </option>
                                    <script>
                                        show_khu("room-khu")
                                        khu_change("room-khu","room-tang","room-phong");                                                     
                                    </script> 
                                </select>                                                                               
                            </div>                        
                        </div>                                  
                        <span id="error"></span>
                    </div>                    
                </div>
                <div class="modal-footer"> 
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                    <button type="submit" class="btn btn-primary" id="btn-save-room">Lưu</button>                 
                </div>
            </form> 
          </div>
        </div>
    </div>    
    <ul class="pagination " id="pagination">        
    </ul>    
    <script  rel="stylesheet" src="{{asset('js/admin/room/room.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/room/room.handle.js')}}"></script>   
@endsection