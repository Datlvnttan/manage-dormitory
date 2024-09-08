@extends('layouts.user')
@section('content')

<style>
  .form-check-input{
    position: relative;
    font-size: 20px;
    margin-left: 0px;
  }
  .btn__primary--type{
    font-size: 20px;    
  }
  .float-right{
    float: right;
  }
</style>
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />    
    <div class="test">
        <div class="sidebar-right-content-heading">
            <h1 class="sidebar-right-content-heading-name">Danh sách khai báo</h1>
            @if (auth()->user()->isLeader())
                <a href="{{route('user_taoKhaiBaoMoi')}}" class="btn__primary--type btn_xacnhan float-right">
                    <i class="fa-light fa-plus" style="color: #fff; font-size:20px;"></i>
                    Khai báo mới
                </a>         
            @endif             
        </div>
    <div class="filter-list-bill">
        <div class="form-check">
            <input class="form-check-input " type="checkbox" id="showAllHD" hidden><br>
            <label class="form-check-label showAllHD-button" for="showAllHD">Tất cả</label>
          </div>
        {{-- <input type="checkbox"  id="showAllHD" hidden  />
        <label for="showAllHD" class="showAllHD-button">Tất cả</label> --}}
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
                        <option selected value="0">--Tất cả--</option>
                    </select>

                </div>
                <div class="filter-box">
                    <b class="filter-title">Trạng thái: </b>
                    <input type="checkbox" class="loctt" id="daXuLy" name="daThanhToan" />
                    <label for="daXuLy" class="filter-title">Đã xử lý</label>
                    <input type="checkbox" checked class="loctt" id="chuaXuLy" name="chuaThanhToan" />
                    <label for="chuaXuLy" class="filter-title">Chưa xử lý</label>
                </div>
            </div>           
            <button id="btn_loc">Lọc</button>
        </div>        
    </div>
    <div class="container-fluid">
        <div class="row">
            <table class="main-info-users-table">
                <thead>
                    <tr>
                        <td>Mã khai báo</td>
                        <td>Ngày yêu cầu</td>                        
                        <td>Thiết bị</td>
                        <td>Tổng số lượng</td>
                        <td>Trạng thái</td>
                    </tr>
                </thead>
                <tbody id="khaiBaoHuHongs">
                    
                </tbody>
            </table>
        </div>        
    </div>
</div>
<ul class="pagination " id="pagination">        
</ul>
<script src="{{asset('js/filter-processing.js')}}"></script>
<script  rel="stylesheet" src="{{asset('js/user/damage-report/damage-report.callapi.js')}}"></script>
<script  rel="stylesheet" src="{{asset('js/user/damage-report/damage-report.history.handle.js')}}"></script>

<script>document.getElementById('sidebar-khaibaohuhong').classList.add("active");</script>
@endsection