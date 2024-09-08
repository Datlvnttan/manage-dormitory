@extends('layouts.user')
@section('content')
<title>Thông tin sinh viên</title>
{{-- <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css"> --}}

<style>
    .profile--form__text-field span {
        left: 15px;
    }

    select {
        width: 100%;
        height: 30px;
    }
</style>

<script>document.getElementById('sidebar-hoso').classList.add("active");</script>
<h1 class="profile-contain-heading">Thông tin sinh viên</h1>
<div class="profile-contain-main">
    <form action="" id="form-info" method="post" class="profile-contain-main-form ">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="profile--form__text-field">
                        <label for="username3">Tên sinh Viên</label>
                        <input readonly autocomplete="off" type="text" value=" {{$user->Ho." ".$user->Ten}} " id="username3" placeholder="" />                       
                        {{-- {!! Form::hidden('Ho', $user->Ho) !!}
                        {!! Form::hidden('Ten', $user->Ho) !!} --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="username3">Mã số sinh viên</label>
                                <input readonly autocomplete="off" type="text" id="username3" name="MaSV" value="{{$user->MaSV}}" placeholder="" />                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                {{-- <input type="radio" autocomplete="off" name="GioiTinh" id="nam" value="Nam" /><label for="nam">Nam </label>
                                    <input type="radio" autocomplete="off" name="GioiTinh" id="nu" value="Nữ" /><label for="nu">Nữ</label> --}}
                                <label for="username3">Giới tính</label>
                                {{-- <input autocomplete="off" type="text" id="username3" name="GioiTinh" value="{{$user->GioiTinh}}" placeholder="" />    --}}
                                <select autocomplete="off"name="GioiTinh"  id="username3">
                                    <option {{$user->GioiTinh == "Nam" ? "selected" : ""}} value="Nam">Nam</option>
                                    <option {{$user->GioiTinh == "Nữ" ? "selected" : ""}} value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="username3">Lớp</label>
                                <input autocomplete="off" type="text" id="username3" name="Lop" value="{{$user->Lop}}" placeholder="" />                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                {{-- {{dd($user->NgaySinh)}} --}}
                                <label for="NgaySinh">Ngày sinh</label>
                                <input autocomplete="off" type="date" id="ngaySinh" name="NgaySinh" value="{{$user->NgaySinh}}" class="" placeholder="" />                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="username3">Số căn cước</label>
                                <input autocomplete="off" type="text" id="username3" name="SoCanCuoc" value="{{$user->SoCanCuoc}}" placeholder="" maxlength="13" class="phone" />
                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="username3">Số điện thoại</label>
                                <input autocomplete="off" type="text" id="username3" name="SoDienThoai" value="{{$user->SoDienThoai}}" placeholder="" maxlength="10" class="phone" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile--form__text-field">
                            <label for="username3" style="left:25px;">Email</label>
                            <input autocomplete="off" type="email" id="username3" name="Email" value="{{$user->Email}}" placeholder="" maxlength="50" class="" />                            
                        </div>
                    </div>
                    <div class="profile--form__text-field">                                            
                        @if ($user->QueQuan != null)
                        @php                        
                            $s = explode(",",$user->QueQuan)
                        @endphp                        
                            <input hidden id="xa" value="{{ trim($s[0])}}" />
                            <input hidden id="quan" value="{{trim($s[1])}}" />
                            <input hidden id="tinh" value="{{trim($s[2])}}" />
                        @endif
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="profile--form__text-field">
                                    <span class="quequan">Tỉnh/thành phố</span>
                                    <select class="" name="tinh" id="province">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="profile--form__text-field">
                                    <span class="quequan">Quận/huyện</span>
                                    <select class="" name="quan" id="district">
                                        <option value=""> Chọn </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="profile--form__text-field">
                                    <span class="quequan">Xã/phường</span>
                                    <select class="" name="xa" id="ward">
                                        <option value=""> Chọn </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <input id="result-address" value="{{$user->QueQuan}}" name="QueQuan" hidden />
            
                    {{-- @*<input autocomplete="off" type="text" id="username3" value="@Model.QueQuan" placeholder="" />*@ --}}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <label for="username3">Trạng thái</label>
                                <input autocomplete="off" readonly type="text" id="username3" name="TrangThai" value="{{$user->TrangThai}}" placeholder="" />
                               
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="profile--form__text-field">
                                <style>
                                    .dang-ky-noi-tru{
                                        z-index: -9;                                        
                                        margin-top: 10px;                                        
                                    }
                                </style>
                                <label for="username3">Phòng ở</label> 
                                @if ($user->MaPhong == null)                                                                                                                                  
                                    {{-- <span style="position:relative">Phòng ở: </span> --}}
                                    @if ($user->dangKyNoiTru == null)   
                                        <input autocomplete="off" readonly type="text" id="username3" name="TrangThai" value="Chưa đăng ký nội trú" placeholder="" />                                   
                                        <span class="dang-ky-noi-tru" style="position:relative"> Đăng ký <a href="{{route('DangKyNoiTru')}}">tại đây</a></span>                                                                                                                
                                    @elseif ($user->dangKyNoiTru->TrangThai == "Bị hủy") 
                                        <input autocomplete="off" readonly type="text" id="username3" name="TrangThai" value="Bị hủy" placeholder="" />                                   
                                        <span class="dang-ky-noi-tru" style="position:relative"> Đăng ký lại <a href="{{route('DangKyNoiTru')}}">tại đây</a></span>                                
                                    @else            
                                        <input autocomplete="off" readonly type="text" id="username3" name="TrangThai" value="{{$user->dangKyNoiTru->TrangThai}} ({{trim($user->dangKyNoiTru->MaPhong)}})" placeholder="" />                        
                                        {{-- <span style="position:relative"> {{$user->dangKyNoiTru->TrangThai}} ({{$user->dangKyNoiTru->MaPhong}})</span><br /> --}}
                                        <span style="position:relative"> Hủy yêu cầu <a class="open_btn " href="#">tại đây</a></span>                                    
                                    @endif                                
                                @else                                                                    
                                    <input autocomplete="off" readonly type="text" id="username3" value="{{ $user->MaPhong }}" placeholder="" />                                
                                @endif                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="profile--form__img">
                        <img id="previewImage" src="{{$user->AnhDaiDien}}" alt="ảnh thông tin sinh viên">
                        <div class="profile--form__img-edit">
                            <i class="fa-solid fa-pen"></i>
                            <input type="file" capture="camera" id="imageInput">
                            <input id="avt" value="{{$user->AnhDaiDien}}" type="text" name="AnhDaiDien" hidden>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="profile--form__submit">
                    <button type="submit" class="profile--form__submit-btn">Lưu</button>
                    <span class="profile--form__unsubmit-btn">Sửa</span>
                </div>
            </div>
        </div>
    </form>

</div>

@if ($user->dangKyNoiTru != null && $user->DangKyNoiTru->TrangThai != "Bị hủy")
    @include("user.dangkynoitru.form_cancel_register")
@endif
{{-- @if ($user->GioiTinh != null)
    @if ($user->GioiTinh == "Nam")    
        <script>
            document.getElementById('nam').checked = true;
        </script>    
    @else    
        <script>
            document.getElementById('nu').checked = true;
        </script>    
@endif --}}


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- @*<script type="text/javascript" src="{{asset('/js/date.js')}}"></script>*@ --}}
<script src="{{asset('/js/GetAddressApi.js')}}"></script>
<script src="{{asset('/js/kiemTraChuoiSo.js')}}"></script>
<script src="{{asset('/js/mainProfile.js')}}"></script>
@endsection