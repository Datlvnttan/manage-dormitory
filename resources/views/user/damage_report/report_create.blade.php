@extends('layouts.user')
@section('content')
<style>
    div{
        font-size:20px;
    }
    select{
        padding:5px;
        font-size: 30px;
    }
    #btn_submit{
        padding: 10px;
        cursor: `;
    }
</style>
<div class="container-lg p-lg-4">
    <center><h1>KHAI BÁO HƯ HỎNG THIẾT BỊ</h1><br></center>
    <form id="form-report" method="POST">
        @csrf
        <div class="profile--form__text-field">
            <label for="thietbis">Thiết bị</label>
            <select name="MaThietBi" id="thietbis" class="active"></select>
        </div>     
        <label for="soluonghuhong">Báo số lượng hư hỏng <span id="soluongdayeucau"></span></label>
        <div class="profile--form__text-field">            
            <input type="number" class="active" disabled name="SoLuongHuHong" id="soluonghuhong" placeholder="Nhập số lượng hư hỏng"/><br /><br />
        </div>   
        <center><button type="submit" value="" disabled class="btn_xacnhan" id="btn_submit">Báo hư hỏng</button></center>
    </form>
</div>

<script  rel="stylesheet" src="{{asset('js/user/damage-report/damage-report.create.handle.js')}}"></script>
<script src="{{asset('js/KiemTraChuoiSo.js')}}"></script>
<script>document.getElementById('sidebar-khaibaohuhong').classList.add("active");</script>
{{-- <script src="{{asset('js/Dashboard/User/khaiBaoHuHongThietBi.js')}}"></script> --}}
@endsection