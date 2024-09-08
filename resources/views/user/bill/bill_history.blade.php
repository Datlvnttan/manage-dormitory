@extends('layouts.user')
@section('content')
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />    
    <div class="filter-list-bill">
        <input type="checkbox" id="showAllHD" hidden />
        <label for="showAllHD" class="showAllHD-button">Tất cả</label>
        <div id="showloc">                        
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
                    <input type="checkbox" checked class="loctt" id="khongChinhXac" name="khongChinhXac" />
                    <label for="khongChinhXac"  class="filter-title">Không chính xác</label>
                </div>
    
            </div>
    
        </div>
        <button id="btn_loc">Lọc</button>
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table" style="position: relative">
                <thead>
                    <td>Mã Hóa Đơn</td>                    
                    <td>Tháng</td>
                    <td>Thành Tiền</td>                    
                    <td>Trạng Thái</td>
                </thead>
                <tbody id="showHoaDon">                  
                </tbody>
            </table>
        </div>        
    </div>
    <ul class="pagination " id="pagination">    
    <script src="{{asset('js/filter-processing.js')}}"></script>    
    <script  rel="stylesheet" src="{{asset('js/user/bill/bill.callapi.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/user/bill/bill.index.handle.js')}}"></script>
    <script src="{{asset('js/callApiPhong.js')}}"></script>
    <script>document.getElementById('sidebar-bill').classList.add("active");</script>
@endsection