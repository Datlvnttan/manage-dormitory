@extends('layouts.app')
@section('main')
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://sinhvien.hufi.edu.vn/Content/AConfig/images/favicon.png">
    {{-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css?fbclid=IwAR2Lefv1ZTLJsKEsnl4HGMf5XRZuPqx5yOFnFaOFbVgCiCeU87S0up6ptKU"> --}}
   {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet"> --}}
    <!--  -->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/slick-1.8.1/slick/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('lib/slick-1.8.1/slick/slick-theme.css')}}" />

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('lib/slick/slick-theme.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/root.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">

{{-- 
    <script rel="stylesheet" src="{{ asset('js/jquery.min.js') }}"></script>

    <script  rel="stylesheet" src="{{asset('js/config/config.js')}}"></script>


    <link rel="stylesheet" href="{{asset('css/toastMessage.css')}}" />         --}}

    <title>Đăng nhập</title>
    <style>
        body {
            position: relative;
            height: 100vh;
            width: 100vw;
        }
    </style>
</head>
<body>
    <ul class="notifications"></ul>
    <div class="baner-login-page" style="background-image: url(/img/banner-logn-res.jpg)">
    </div>
    <div class="baner-contact-login-regis-page" >
        <div class="container-lg">
            <div class="row">
                <form action="" id="form-login" class="baner-contact-form" method="post">                    
                    <div class="row">
                        <h2 class="baner-contact-form-title">Đăng nhập</h2>
                    </div>
                    <div class="row">
                        <div class="baner-contact-form-text-field">
                            <label for="username" class="baner-contact-form-label">Mã sinh viên</label>
                            <input value="123" autocomplete="off" type="text" name="TenDangNhap" id="username"  required="required" placeholder="Nhập mã sinh viên" class="baner-contact-form-input" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="baner-contact-form-text-field">
                            <label for="password" class="baner-contact-form-label">Mật khẩu </label>
                            <input value="123" autocomplete="off" type="password"  required="required" name="MatKhau" id="password" placeholder="Nhập mật khẩu" class="baner-contact-form-input" />
                        </div>
                    </div>
                    <div class="row">
                        <span style="margin-top:3px; font-size:13px;color:crimson" id="error"></span>
                    </div>
                    <div class="row">
                        <div class="baner-contact-form-checkbox">
                            <input autocomplete="off" type="checkbox" name="DangNhapAdmin" id="renemberme" value="true" />
                            <label for="renemberme">Đăng nhập admin</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="baner-contact-form-small-title">
                            <a href="#" class="baner-contact-form-small-title-link">Quên mật khẩu ?</a>
                        </div>
                    </div>
                    <span class="baner-contact-form-line"></span>
                    <div class="row">
                        <div class="baner-contact-form-button">
                            <button class="baner-contact-form-button-submit btn_page" type="submit" id="btn-login">
                                Đăng nhập
                            </button>
                            <a href="index" class="baner-contact-form-button-cancel btn_page">Quay lại</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="baner-contact-form-small-title">
                            Bạn chưa có tài khoản <a href="./register" class="baner-contact-form-small-title-link">Đăng ký ngay</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script  rel="stylesheet" src="{{asset('js/home/login.authen.js')}}"></script>
<script type="text/javascript" src="{{asset('js/Toastmessage.js')}}"></script>
</html>
@endsection