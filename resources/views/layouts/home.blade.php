@extends('layouts.app')
@section('main')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <link rel="icon" href="https://sinhvien.hufi.edu.vn/Content/AConfig/images/favicon.png"> --}}
        {{-- <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css?fbclid=IwAR2Lefv1ZTLJsKEsnl4HGMf5XRZuPqx5yOFnFaOFbVgCiCeU87S0up6ptKU">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet"> --}}
        {{-- <link rel="stylesheet" type="text/css" href=" {{asset('lib/slick-1.8.1/slick/slick.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('lib/slick-1.8.1/slick/slick-theme.css')}}" />             --}}
        <link rel="stylesheet" href="{{asset('css/root.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">    
        <title>Home</title>
        <style>
            a{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <input type="checkbox" id="menu-model" hidden class="menu-model-check">
        <label for="menu-model" class="model-over-play"></label>
        <div class="header-intro_school">
            <a href="https://hufi.edu.vn/" class="header-intro_school-link">
                <p class="header-intro_school-title">hufi.edu.vn</p>            
            </a>
        </div>
        <header id="header-info">
            <div class="container-lg">
                <div class="header-top">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-6">
                            <div class="header-top-left hide-on-tablet-and-mobile">
                                <div class="header-top-left_logo hide-on-tablet-and-mobile">
                                    <a href="#" class="header-top-left_logo-link">
                                        <img src="data:image/png;base64,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" alt="logo hufi 40 năm" class="header-top-left_logo-img">
                                    </a>
                                </div>
                                <div class="header-top-left_categories">
                                    <span style="cursor:pointer" href="" class="header-top-left_categories-icon-link">
                                        <i class="fa-duotone fa-bars"></i>
                                        <span class="hide-on-pc-md">Danh sách</span>
                                    </span>
                                    <ul class="header-top-left_categories-list">
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link"><i class="fa-duotone fa-house header-top-left_categories-item-link-icon"></i>Trang chủ</a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">Giới thiệu</a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">Thông báo</a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">sức khỏe</a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">Câu lạc bộ / nhóm</a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">Biểu mẫu </a>
                                        </li>
                                        <li class="header-top-left_categories-item">
                                            <a href="" class="header-top-left_categories-item-link">Liên hệ</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="header-top-left-tablet-mobile-bar">
                                <label for="menu-model" class="header-top-left-tablet-mobile-icon hide-on-pc">
                                    <i class="fa-duotone fa-bars"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 col-6">
                            <div class="header-top-right">
                                <div class="header-top-left_input-search hide-on-mobile ">
                                    <input type="text" class="header-top-left_input-search-input" placeholder="Nhập từ khóa cần tìm...">
                                    <i class="fa-duotone fa-magnifying-glass header-top-left_input-search-icon"></i>
                                </div>
                                <div class="header-top-right_sitemap hide-on-tablet-and-mobile">
                                    <a href="#" class="header-top-right_sitemap-icon-link ">
                                        Thông tin thêm
                                        <i class="fa-regular fa-angle-down header-top-right_sitemap-icon"></i>
                                    </a>
                                    <table class="header-top-right_sitemap-table ">
                                        <tbody class="header-top-right_sitemap-table-list">

                                            <tr class="header-top-right_sitemap-table-row">
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">HUFI</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Lãnh đạo</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Khoa - Viện</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Phòng ban</a>
                                                </td>
                                            </tr>
                                            <tr class="header-top-right_sitemap-table-row">
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Trung tâm</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Các chuyên trang</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Doanh nghiệp</a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Đoàn thể</a>
                                                </td>
                                            </tr>
                                            <tr class="header-top-right_sitemap-table-row">
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="#" class="header-top-right_sitemap-table-row-item-link">
                                                        Văn bản quy định
                                                    </a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="#" class="header-top-right_sitemap-table-row-item-link">
                                                        Hỏi đáp
                                                    </a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="#" class="header-top-right_sitemap-table-row-item-link">
                                                        Sitemap
                                                    </a>
                                                </td>
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="#" class="header-top-right_sitemap-table-row-item-link">
                                                        Liên hệ
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="header-top-right_sitemap-table-row">
                                                <td class="header-top-right_sitemap-table-row-item">
                                                    <a href="" class="header-top-right_sitemap-table-row-item-link">Hội đồng</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="header-top-right_language hide-on-tablet-and-mobile ">
                                    <div class="header-top-right_language-select">
                                        <i class="fa-duotone fa-earth-americas hide-on-tablet"></i>
                                        Ngôn ngữ
                                        <i class="fa-regular fa-angle-down "></i>
                                    </div>
                                    <ul class="header-top-right_language-list">
                                        <li class="header-top-right_language-item">
                                            <a href="" class="header-top-right_language-item-link"><img src="{{asset('img/VietNam_flag-icon.png')}}" alt=""> Việt Nam</a>
                                        </li>
                                        <li class="header-top-right_language-item">
                                            <a href="" class="header-top-right_language-item-link"><img src="{{asset('img/English_flag-icon.png')}}" alt="">EngLish</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-top-left_input-search-mobile hide-on-tablet hide-on-pc">
                                    <label for="" class="header-top-left_title-input">Tìm kiếm</label>
                                    <i class="fa-duotone fa-magnifying-glass header-top-left_input-search-icon-mobile"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <!-- Khi chưa đăng nhập -->                        
                            @if(!($user = Auth::user()))                        
                            <div class="header-top-right_register_login hide-on-mobile">
                                <a href="{{ route('login') }}" class="btn_page btn-Register">Đăng ký</a>
                                <a href="{{ route('login') }}" class="btn_page btn-login">Đăng nhập</a>
                            </div>                      
                            @else
                                <div class="header-top-right_has_login">
                                    <div class="header-top-right_has_login-name ">{{$user->Ho ." ".$user->Ten}}</div>
                                    <div class="header-top-right_has_login-img element-tooltip" data-tooltip="Tài khoản">
                                        <img src="{{asset('img/User.png')}}" alt="Ảnh người dùng">
                                        <div class="header-top-right_has_login-img-menu ">
                                            <a href="{{route("TrangChu")}}" class="has_login-img-menu-info">
                                                <div class="has_login-img-menu-info-img">
                                                    <img src="{{asset('img/User.png')}}" alt="Ảnh người dùng">
                                                </div>
                                                <div class="has_login-img-menu-info-name">{{$user->Ho ." ".$user->Ten}} </div>
                                            </a>
                                            <div class="has_login-img-menu-setting ">
                                                <div class="has_login-img-menu-setting-list">
                                                    <a href="{{ route('logout') }}" class="has_login-img-menu-setting-list-link">
                                                        <span class="has_login-img-menu-setting-list-logo">
                                                            <i class="fa-duotone fa-right-from-bracket"></i>
                                                        </span>
                                                        <div class="has_login-img-menu-setting-list-name">Đăng xuất </div>
                                                    </a>
                                                </div>
                                                <div class="has_login-img-menu-setting-list">
                                                    <a href="{{ route('TrangChu') }}" class="has_login-img-menu-setting-list-link">
                                                        <span class="has_login-img-menu-setting-list-logo">
                                                            <i class="fa-duotone fa-bars-progress"></i>
                                                        </span>
                                                        <div class="has_login-img-menu-setting-list-name">Quản lý Phòng </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                      
                            @endif                                                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-search-mobile hide-on-tablet hide-on-pc">
                <input type="text" class="header-search-mobile-input" placeholder="Nhập nội dung cần tìm">
                <div class="header-search-mobile-close">
                    <i class="fa-duotone fa-magnifying-glass header-search-mobile-close-icon"></i>
                </div>
            </div>
        </header>
        <div class="header-top-left-tablet-mobile hide-on-pc hide-on-tablet">
            <label for="menu-model" class="header-top-left-tablet-mobile-close">
                <i class="fa-duotone fa-xmark header-top-left-tablet-mobile-close-icon"></i>
            </label>
            <div class="model-main-menu">
                <h2 class="model-main-menu-name">Thông tin chung</h2>
                <span class="model-main-menu-name-line"></span>
                <ul class="model-main-menu-list">
                    <li class="model-main-menu-item">
                        <div class="model-main-menu-item-title">
                            <a href="#" class="model-main-menu-item-link">
                                <i class="fa-duotone fa-circle-dot model-main-menu-item-link-icon"></i>
                                Danh sách
                            </a>
                            <span class="model-main-menu-item-icon">
                                <i class="fa-duotone fa-caret-down "></i>
                            </span>
                        </div>
                        <ul class="model-main-submenu-list ">
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    Trang chủ
                                </a>
                            </li>
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    Trang chủ
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="model-main-menu-item">
                        <div class="model-main-menu-item-title">
                            <a href="#" class="model-main-menu-item-link">
                                <i class="fa-duotone fa-circle-dot model-main-menu-item-link-icon"></i>
                                Danh sách
                            </a>
                            <span class="model-main-menu-item-icon">
                                <i class="fa-duotone fa-caret-down "></i>
                            </span>
                        </div>
                        <ul class="model-main-submenu-list">
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    Trang chủ
                                </a>
                            </li>
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    Trang chủ
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <h2 class="model-main-menu-name">Giới thiệu</h2>
                <span class="model-main-menu-name-line"></span>
                <div class="model-main-menu-item-title">
                    <a href="#" class="model-main-menu-item-link">
                        <i class="fa-duotone fa-graduation-cap model-main-menu-item-link-icon"></i>
                        Tuyển sinh
                    </a>
                </div>
                <div class="model-main-menu-item-title">
                    <a href="#" class="model-main-menu-item-link">
                        <i class="fa-duotone fa-house-laptop model-main-menu-item-link-icon"></i>
                        Việc làm
                    </a>
                </div>
                <div class="model-main-menu-item-title">
                    <a href="#" class="model-main-menu-item-link">
                        <i class="fa-duotone fa-globe model-main-menu-item-link-icon"></i>
                        Dạy học trực tuyến
                    </a>
                </div>
                <ul class="model-main-menu-list">
                    <li class="model-main-menu-item">
                        <div class="model-main-menu-item-title">
                            <a href="#" class="model-main-menu-item-link">
                                <i class="fa-duotone fa-circle-dot model-main-menu-item-link-icon"></i>
                                Ngôn ngữ
                            </a>
                            <span class="model-main-menu-item-icon">
                                <i class="fa-duotone fa-caret-down "></i>
                            </span>
                        </div>
                        <ul class="model-main-submenu-list ">
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    Tiếng việt
                                </a>
                            </li>
                            <li class="model-main-submenu-item">
                                <a href="#" class="model-main-submenu-item-link">
                                    <i class="fa-duotone fa-turn-down-right model-main-submenu-item-link-icon"></i>
                                    EngLish
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <h2 class="model-main-menu-name hide-on-tablet">Tài khoản</h2>
                <span class="model-main-menu-name-line hide-on-tablet"></span>
                <!-- Nếu chưa đăng nhập -->
                <div class="model-main-menu-btn hide-on-tablet">
                    <a href="DangNhap" class="btn btn-login-mobile">Đăng nhập</a>
                    <a href="@Url.Action("DangKy","Home",new { url = Request.Url.ToString() })" class="btn btn-register-mobile">Đăng ký</a>
                </div>

                <!-- Nếu đăng nhập rồi -->
                <!-- <div class="model-main-menu-btn">
                    <button class="btn btn-manager-mobile"><i class="fa-duotone fa-bars-progress"></i>Quản lý phòng</button>
                </div> -->
            </div>
            <div class="header-top-left-tablet-mobile-logo">
                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/logo/logo-40-nam-thanh-lap-hufi-xanh-01.png" alt="Ảnh logo" class="header-top-left-tablet-mobile-logo-img">
            </div>
            <div class="header-top-left-tablet-mobile-location hide-on-tablet hide-on-pc">
                <table>
                    <tr class="header-top-left-tablet-mobile-location-row">
                        <td class="header-top-left-tablet-mobile-location-title">
                            <i class="fa-duotone fa-house"></i>
                            Đơn vị
                        </td>
                        <td class="header-top-left-tablet-mobile-location-des">Trung tâm Ký túc xá Sinh viên</td>
                    </tr>
                    <tr class="header-top-left-tablet-mobile-location-row">
                        <td class="header-top-left-tablet-mobile-location-title">
                            <i class="fa-duotone fa-location-dot"></i>
                            Địa chỉ
                        </td>
                        <td class="header-top-left-tablet-mobile-location-des">102-104-106 Nguyễn Quý Anh, P. Tân Sơn Nhì, Q. Tân Phú, TP. HCM</td>
                    </tr>
                    <tr class="header-top-left-tablet-mobile-location-row">
                        <td class="header-top-left-tablet-mobile-location-title">
                            <i class="fa-duotone fa-phone"></i>
                            Điện thoại
                        </td>
                        <td class="header-top-left-tablet-mobile-location-des">
                            0123456789 - 0987654321
                        </td>
                    </tr>
                    <tr class="header-top-left-tablet-mobile-location-row">
                        <td class="header-top-left-tablet-mobile-location-title">
                            <i class="fa-duotone fa-envelope"></i>
                            Email
                        </td>
                        <td class="header-top-left-tablet-mobile-location-des">
                            infor@hufi.edu.vn
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @yield('content')
        <footer id="footer">
            <div class="container-lg">
                <div class="row">
                    <div class="footer-categories">
                        <div class="row">
                            <div class="col-lg-3 col-md-2 hide-on-tablet-and-mobile">
                                <div class="footer-categoires-menu">
                                    <h2 class="footer-categoires-list-title">Hỗ trợ</h2>
                                    <ul class="footer-categoires-list">
                                        <li class="footer-categoires-item">
                                            <a href="#" class="footer-categoires-item-link">Sitemap</a>
                                        </li>
                                        <li class="footer-categoires-item">
                                            <a href="#" class="footer-categoires-item-link">Liên hệ</a>
                                        </li>
                                        <li class="footer-categoires-item">
                                            <a href="#" class="footer-categoires-item-link">Hỏi đáp</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7 hide-on-mobile">
                                <div class="footer-categoires-menu">
                                    <ul class="footer-categoires-list">
                                        <li class="footer-categoires-item">
                                            <span class="footer-categoires-item-logo">
                                                <i class="fa-duotone fa-house"></i> Đơn vị
                                            </span>
                                            <h4 class="footer-categoires-item-detail">
                                                Trung tâm Ký túc xá Sinh viên
                                            </h4>
                                        </li>
                                        <li class="footer-categoires-item">
                                            <span class="footer-categoires-item-logo">
                                                <i class="fa-duotone fa-location-dot"></i> Địa chỉ
                                            </span>
                                            <h4 class="footer-categoires-item-detail">
                                                102-104-106 Nguyễn Quý Anh, P. Tân Sơn Nhì, Q. Tân Phú, TP. HCM
                                            </h4>
                                        </li>
                                        <li class="footer-categoires-item">
                                            <span class="footer-categoires-item-logo">
                                                <i class="fa-duotone fa-phone"></i> Điện thoại
                                            </span>
                                            <h4 class="footer-categoires-item-detail">
                                                0123456789 - 0987654321
                                            </h4>
                                        </li>
                                        <li class="footer-categoires-item">
                                            <span class="footer-categoires-item-logo">
                                                <i class="fa-duotone fa-envelope"></i> Email
                                            </span>
                                            <h4 class="footer-categoires-item-detail">
                                                infor@hufi.edu.vn
                                            </h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="footer-categoires-menu">
                                    <a href="#" class="footer-categoires-logo">
                                        <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/logo/logo-40-nam-thanh-lap-hufi-xanh-01.png" alt="" class="footer-categoires-logo-img">
                                    </a>
                                    <ul class="footer-categoires-socials-list">
                                        <li class="footer-categoires-socials-item">
                                            <a href="#" class="footer-categoires-socials-item-link"><i class="fa-brands fa-facebook"></i></a>
                                        </li>
                                        <li class="footer-categoires-socials-item">
                                            <a href="#" class="footer-categoires-socials-item-link"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li class="footer-categoires-socials-item">
                                            <a href="#" class="footer-categoires-socials-item-link"><i class="fa-brands fa-tiktok"></i></a>
                                        </li>
                                        <li class="footer-categoires-socials-item">
                                            <a href="#" class="footer-categoires-socials-item-link"><i class="fa-brands fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                    <p class="footer-categoires-socials-coppyright">
                                        &copyCoppy right 2023 Hufi.edu.vn All Rights Reserved
                                    </p>
                                    <div class="footer-categoires-socials-teams">
                                        <a href="#" class="footer-categoires-socials-teams-link">Terms Of Use</a>
                                        <a href="#" class="footer-categoires-socials-teams-link">Privacy Policy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="scroll_up hide-on-mobile">
            <a href="#" class="scroll_up-logo">
                <i class="fa-duotone fa-angles-up"></i>
            </a>
        </div>
        <!-- Tạo một Slider -->
        <script src="{{asset('lib/OwlCarousel2-2.3.4/docs_src/assets/vendors/jquery.min.js')}}"></script>
        <script src="{{asset('lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')}}"></script>
        {{-- <script type="text/javascript" src="{{asset('lib/slick-1.8.1/slick/slick.min.js')}}"></script> --}}
        <script src="{{asset('js/main.js')}}"></script>
    </body>
    </html>
@endsection