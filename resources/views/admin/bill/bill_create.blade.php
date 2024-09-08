@extends('layouts.admin')
@section('content')
<style>
    .btn-search-room{
        height: 50px;
        font-size: 20px;
    }
</style>
    <script>document.getElementById('sidebar-file-invoice').classList.add("active")</script>
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/TaoHoaDon.css')}}" />    
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Tạo hóa đơn mới</h2>
    </div>
    <br><br>
    <div class="container-fluid">
        {{-- <form id="form-create-bill" method="GET"> --}}
            @csrf
            <div class="row">
                {{-- <div class="filter-list"> --}}
                    <div class="filter-box profile--form__text-field col-lg-6">
                        <span class="filter-title">Chọn khu:</span>
                        <select name="khu" id="khu" class="filter-select active">
                            <option value=""> -- Tất cả -- </option>                        
                        </select>
                    </div>                
                    <div class="filter-box profile--form__text-field col-lg-6">
                        <span class="filter-title">Chọn tầng:</span>
                        <select name="tang" id="tang" class="filter-select active">
                            <option value=""> -- Tất cả -- </option>
                        </select>
                    </div>
                    <div class="filter-box profile--form__text-field">
                        <span class="filter-title">Chọn phòng:</span>
                        <select name="phong" id="phong" class="filter-select active">
                            <option value=""> -- Tất cả -- </option>                            
                        </select>
                    </div>
                {{-- </div> --}}
                <div class="col-sm-9 col-md-10 col-lg-11">
                    <div class="profile--form__text-field">
                        <label for="">Tìm theo mã phòng</label>
                        <input value="A705" type="text" placeholder="Mã phòng" name="phong">
                    </div>
                </div>            
                <div class="col-sm-3 col-md-2 col-lg-1">
                    <button type="button" class="w-100 btn btn-primary btn-search-room">Tìm</button>
                </div>
            </div>            
            <h2 class="bill-heading-title">Nhập thông tin dịch vụ</h2>
            <div class="row" id="form-field">
                
                {{-- @foreach (var item in Model)
                {
                    <div class="lg-col-12">
                        <div class="profile--form__text-field">
                            @if (item.TinhTheoChiSo)
                            {
                                <label><strong class="tenDV">@item.TenDichVu</strong>  | Giá hiện tại: <b class="gia"> @item.GiaHienTai</b>đ - Chỉ số cũ: <b id="@("csc" + item.MaDichVu)"> </b><strong class="loi" hidden> * Sai dữ liệu đầu vào</strong></label>
                                <input required type="number" min="" max="999999999" maxlength="10" id="@item.MaDichVu" value="" name="@item.MaDichVu" class="dvPhong" disabled placeholder="Nhập chỉ số mới" /> <br />
                            }
                            else
                            {
                                <label><strong class="tenDV">@item.TenDichVu</strong> | Giá hiện tại: <b class="gia"> @item.GiaHienTai</b>đ <strong class="loi" hidden> * Sai dữ liệu đầu vào</strong></label>
                                <input required type="number" min="0" max="999999999" maxlength="10" value="" name="@item.MaDichVu" class="dvPhong" disabled placeholder="Nhập số lượng" /> <br />
                            }
                        </div>
                    </div>
                } --}}
            </div>        
            <div class="row">
                <h3 class="bill-heading-title">Chi tiết hóa đơn</h3>
                <table class=" main-info-users-table" align="center">
                    <thead>
                        <tr>
                            <td>Tên dịch vụ</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                            <td>Tổng tiền</td>
                        </tr>
                    </thead>
                    <tbody title="Chi tiết dịch vụ phòng" id="dvPhongTable">
                        {{-- @for (var i = 0; i < Model.Count(); i++)
                        {
                            <tr class="ttdichvu"></tr>
                        } --}}
                        {{-- @if(Model.Count()%2==1)
                        {
                            <tr><td></td></tr>
                        } --}}
                    </tbody>
                    <tbody title="Chi tiết dịch vụ đơn" id="dvDon">
                    </tbody>                                        
                </table>
                <div class="form-add-bill">
                    <p class="thanhtien">Thành tiền: <span style="color:crimson" id="into-money"></span></p>
                    <button type="submit" class="open_btn btn btn-primary" id="confirm-create-bill">Tạo hóa đơn</button>
                </div>
    
            </div>
        {{-- </form> --}}
            {{-- <div class="row">
                <div class="modall an">
                    <div class="modal__innerr">
                        <div class="modal__headerr">
                            <p>Bạn đang tạo hóa đơn</p>
                            <i class="fas fa-times" id="exit"></i>
                        </div>
                        <div class="modal__bodyy">
                            <p>Xác nhận tạo hóa đơn cho phòng"<span id="idValue"></span>"?</p>
                        </div>
                        <div class="modal__footerr">
                            <a class="close btn btn-warning">Hủy bỏ</a>
                            <button type="submit" class="Confirm-button ">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div> --}}        
    </div>        
    <script  rel="stylesheet" src="{{asset('js/admin/bill/bill.create.handle.js')}}"></script> 
    {{-- <script src="{{asset('js/HopThoai.js')}}"></script> --}}
    {{-- <script src="{{asset('js/GetdataPhongApi.js')}}"></script> --}}
@endsection