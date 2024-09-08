@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Quản lý vi phạm</h2>
        <button id="btn-add-infringe" class="btn__primary--type" >
            <i class="fa-light fa-plus"></i>
            Tạo vi phạm
        </button>
    </div>   
    <br>
    <div class="filter-list-bill">        
        <div id="showloc">
            <div class="filter-list">                                
                <div class="filter-box">
                    <input id="thangHienTai" type="checkbox" checked name="tatCa" />
                    <label for="thangHienTai" class="filter-title">Tất cả</label>
                    <select disabled name="mucDoNghiemTrong" id="nam" class="filter-select">
                        @for ($mucDo = 1 ;$mucDo<11;$mucDo++)                        
                            <option value="{{$mucDo}}">Mức {{$mucDo}}</option>                        
                        @endfor
                    </select>
                    <select disabled name="mucDoNghiemTrong" id="thang" hidden class="filter-select">                        
                    </select>
                </div>       
                {{-- <button id="btn_loc">Lọc</button>          --}}
            </div>                       
        </div>            
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <tr>
                        <td>Mã vi phạm</td>
                        <td>Nội dung</td>
                        <td>Mức độ nghiêm trọng</td>                        
                        <td></td>                        
                    </tr>
                </thead>
                <tbody id="tbody-infringe">                   
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
        <div class="modal fade" id="modal-edit-infringe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <center style="font-size: 20px;">Cập nhật nội dung vi phạm</center>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form-edit-infringe">
                    <div class="modal-body">                  
                                    
                        <div class="p-lg-2 row" >
                            <div class="col-12">
                                <div class="profile--form__text-field">
                                    <label for="infringe-id">Mã vi phạm</label>
                                    <input autocomplete="off" class="active" type="text" id="infringe-id" name="MaViPham" value="" placeholder="Mã vi phạm" />                                                            
                                </div>                        
                            </div> 
                            <div class="col-12">
                                <div class="profile--form__text-field">
                                    <label for="infringe-title">Nội dung</label>
                                    <input autocomplete="off" class="active" type="text" id="infringe-title" name="NoiDung" value="" placeholder="Nội dung vi phạm" />                                                        
                                </div>                        
                            </div> 
                            <div class="col-12">
                                <div class="profile--form__text-field">
                                    <label for="infringe-level">Mức độ nghiêm trọng</label>
                                    {{-- <input autocomplete="off" class="active" type="text" id="infringe-level" name="MucDoNghiemTrong" value="" placeholder="Mức độ nghiêm trọng" />                                                             --}}
                                    <select name="MucDoNghiemTrong" id="infringe-level" autocomplete="off" class="active" >
                                        @for ($mucDo = 1 ;$mucDo<11;$mucDo++)                        
                                            <option value="{{$mucDo}}">Mức {{$mucDo}}</option>                        
                                        @endfor
                                    </select>
                                </div>                        
                            </div>                                                                                          
                            <span id="error"></span>
                        </div>                    
                    </div>
                    <div class="modal-footer"> 
                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary" id="btn-save-infringe">Lưu</button>                 
                    </div>
                </form> 
              </div>
            </div>
        </div> 
    </div>
    </div>
    <ul class="pagination " id="pagination"> 
        
        
               
    <script src="{{asset('js/filter-processing.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/infringe/infringe.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/admin/infringe/infringe.handle.js')}}"></script> 
    {{-- <script>document.getElementById('sidebar-vipham').classList.add("active");</script> --}}
@endsection