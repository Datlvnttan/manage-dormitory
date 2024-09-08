@extends('layouts.admin')
@section('content')
<script src="{{asset('js/admin/damage-equipment/damage-equipment.callapi.js')}}"></script>
<style>
    div{
        font-size:20px;
    }
    .item-xuly{
        border:1px solid #0094ff;
        border-radius:10px;
        padding:15px;
        position:relative;
    }
    .float-right{
        float: right;
    }
    textarea{
        min-height: 40px;
        max-height: 200px;
    }
    button{
        border: 1px solid #0094ff;
        border-radius: 5px;
    }
    #submitInfo{
        font-size: 20px;        
    }
</style>
<div id="body-handing">
    <!--Thông tin khai báo hư hỏng-->
    <div id="damage-report-handing">        
    </div>
    <!--Thực hiện xử lý khai báo-->
    <hr />
    <center><h2>Thống kê quá trình xử lý</h2></center> 
    <div class="float-right">
        <button  id="them" class="btn__primary--type">Thêm xử lý</button>
        <br>
    </div>
    <div style="clear: both"></div>       
    <div class="list-items row" id="listXuLy">
                    {{-- @*<div class="item-xuly row">
                        <button onclick="removeItem(this.parentElement)">xóa</button>
                        <div class="col-lg-5 col-12 item item-left">
                            <div>
                                <input class="number soLuong" type="text" name="txtSoLuong1" placeholder="Nhập số lượng" />   <br /><br />
                                <b>Phương pháp xử lý: </b>       <br />
                                <input name="phuongphap_1" type="radio" id="phuongphap1" value="Sửa chửa" checked />
                                <label for="phuongphap1">Sửa chửa</label>

                                <input name="phuongphap_1" type="radio" id="phuongphap2" value="Thay mới" />
                                <label for="phuongphap2">Thay mới</label><br />
                                <input oninput="checkInputChiPhiPhatSinh(this)" class="phone" type="text" name="txtChiPhiPhatSinh1" placeholder="Nhập chi phi phát sinh" />
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 item item-right">
                            <div>
                                <b>Chọn nguyên nhân:</b>    <br />
                                <input name="nguyennhan_1" type="radio" id="nguyennhan1" value="Môi trường, thời gian hao mòn gây hư hỏng" checked />
                                <label for="nguyennhan1">Môi trường, thời gian hao mòn gây hư hỏng</label>               <br />

                                <input name="nguyennhan_1" type="radio" id="nguyennhan2" value="Do sinh viên làm hư hỏng" />
                                <label for="nguyennhan2">Do sinh viên làm hư hỏng</label>                  <br />

                                <input name="nguyennhan_1" type="radio" id="nguyennhan3" value="Khác" />
                                <label for="nguyennhan3">Khác</label>           <br />
                                <textarea  id="textarea1" placeholder="Nhập nguyên nhân khác"></textarea>    <br />
                            </div>
                        </div>
                    </div>*@ --}}
    </div>    
    <div>
        <br>
        <center><button id="submitInfo" class="btn__primary--type">Xác nhận xử lý</button></center>
    </div>

</div>
<script src="{{asset('js/admin/damage-equipment/damage-equipment.handle.js')}}"></script>
<script>document.getElementById('sidebar-house-chimney-crack').classList.add("active");</script>

@endsection