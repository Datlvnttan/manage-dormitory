@extends('layouts.admin')
@section('content')
<script  rel="stylesheet" src="{{asset('js/admin/infringe-history/infringe-history.callapi.js')}}"></script>
<script  rel="stylesheet" src="{{asset('js/admin/infringe/infringe.callapi.js')}}"></script>
<script src="{{asset('js/admin/student/student.callapi.js')}}"></script>
<style>
    div{
        font-size:20px;
    }
    .btn__primary--type.w-100{
        height: 50px;        
    }
    .btn__primary--type{
        border: 1px solid #000;
        border-radius: 5px;
        cursor: pointer;
    }
    #btn-add-infringe{
        float: right;
    }
    #hinhPhat{
        min-height: 50px;
        max-height: 200px;
        padding: 10px;
    }
</style>
<br>
<center><h1>Khai báo vi phạm</h1></center>
<br>
<script>document.getElementById('sidebar-gavel').classList.add("active");</script>
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/danhSachHoaDon.css')}}" />
<div>

    <form action="" method="POST" id="form-add-student-infringe">   
    <!--Chọn sinh viên vi phạm-->
        <div class="row">
            <div class="profile--form__text-field col-lg-6 col-12">
                <span class="filter-title">Chọn khu:</span>
                <select name="khu" id="khu" class="filter-select active">
                    <option value=""> --Chọn-- </option>
                </select>                        
            </div>        
            <div class="profile--form__text-field  col-lg-6 col-12">
                <span class="filter-title">Chọn tầng:</span>
                <select name="tang" id="tang" class="filter-select active">
                    <option value=""> --Chọn-- </option>
                </select>
            </div>
            <div class="profile--form__text-field  col-lg-6 col-12">
                <span class="filter-title">Chọn phòng:</span>
                <select name="phong" id="phong" class="filter-select active">
                    <option value="">-- Chọn-- </option>
                </select>
            </div>

            <div class="profile--form__text-field  col-lg-6 col-12">
                <span class="filter-title">Sinh viên vi phạm:</span>
                <select id="sinhvien" name="MaSV" class="filter-select active">
                    <option value="">--Chọn-- </option>
                    <script>
                        show_khu()
                        khu_change();
                        tang_change();                          
                    </script>
                </select>
            </div>
    

            <div class="profile--form__text-field col-10">
                <span class="filter-title">Tìm theo mã số sinh viên</span>
                <input type="text" id="maSV" name="MaSV" placeholder="Mã số sinh viên" class="phone active" />
                {{-- @*<input type="text" id="hoTen" placeholder="Họ và tên" />
                <input type="text" id="lop" placeholder="Lớp" />*@
                <input type="text" id="soCanCuoc" placeholder="CMND/CCCD" class="phone" />
                <input type="text" id="soDienThoai" placeholder="Số điện thoại" class="phone" />
                @*<input type="text" id="ngaySinh" placeholder="Ngày tháng năm sinh" />*@ --}}                
            </div>
            <div class="col-2">
                <button id="tim" type="button" class="btn__primary--type w-100">Tìm</button>
            </div>
        </div>
        <div id="tblThongTinSinhVien">
            <center><h3>Thông tin sinh viên</h3></center>
            <table class="table table-hover table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <td></td>
                        <td>Mã số sinh viên</td>
                        <td>Họ và tên</td>
                        <td>Lớp</td>
                        <td>Giới tính</td>
                        <td>Ngày sinh</td>
                        <td>CMND/CCCD</td>
                        <td>Số điện thoại</td>
                        <td>Tình trạng</td>
                    </tr>
                </thead>
                <tbody id="thongTinSinhVien">
                </tbody>
            </table>
        </div>
        <!--Thông tin sinh viên-->
        <span id="khongcoLSVP"></span>
        <div id="tblLichSuViPham">
            <center><h3>Lịch sử vi phạm</h3></center>
            <table class="table table-hover table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <td>Mã vi phạm</td>
                        <td>Lỗi vi phạm</td>
                        <td>Ngày vi phạm</td>
                        <td>Hình phạt</td>
                        <td>Ghi chú</td>
                        <td>Trạng thái</td>
                    </tr>
                </thead>
                <tbody id="lichSuViPham">
                </tbody>
            </table>
            <!--Chọn lỗi vi phạm-->
        </div>
        <br>
        <hr>
        <br>
        <div id="thaoTacViPham">          
            <a class="btn__primary--type" id="btn-add-infringe">Thêm vi phạm mới</a>         
            <div style="clear: both"></div>       
            <br>

            <div id="chonViPham">
                <div class="profile--form__text-field col-12">
                    <label for="danhSachViPham">Chọn lỗi vi phạm</label>
                    <select id="danhSachViPham" class="active" name="MaViPham">
                    </select>
                </div>
            </div>        
            <div>
                <div class="profile--form__text-field col-12">
                    <label for="hinhPhat">Hình phạt</label>
                    <textarea id="hinhPhat" class="w-100"  name="HinhPhat"></textarea>
                </div>
            </div>
            <center><button class="btn__primary--type" id="btnXacNhan" type="submit">Xác nhận</button></center>
        
        </div>
    </form>  
</div>
<script  src="{{asset('js/KiemTraChuoiSo.js')}}"></script>
<script src="{{asset('js/callApiPhong.js')}}"></script>
{{-- <script src="{{asset('js/Dashboard/Admin/TaoViPham.js')}}"></script> --}}
<script  rel="stylesheet" src="{{asset('js/admin/infringe-history/infringe-history.create.handle.js')}}"></script> 
@endsection