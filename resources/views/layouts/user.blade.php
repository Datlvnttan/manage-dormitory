    @php
        $user = Auth::user()
    @endphp 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}
    <!-- fontawesome -->
    {{-- <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" /> --}}
    <!-- icon -->
    <link rel="icon" href="https://sinhvien.hufi.edu.vn/Content/AConfig/images/favicon.png">
    <!-- fontfamily -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/213b585f79.js" crossorigin="anonymous"></script> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
    <!-- slickshider -->

    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/Dashboard/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/root.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/styleLayout.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/responsive.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" / --}}
    {{-- <link rel="stylesheet" href="{{asset('css/hopthoai.css')}}" /> --}}


        <!-- config -->

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script rel="stylesheet" src="{{ asset('js/jquery.min.js') }}"></script> --}}
    {{-- <script  rel="stylesheet" src="{{asset('js/config/config.js')}}"></script> --}}
    {{-- <script  rel="stylesheet" src="{{asset('js/user/authen_user.js')}}"></script> --}}

    <!-- toastmessage -->
    {{-- <link rel="stylesheet" href="{{asset('css/toastMessage.css')}}" /> --}}

    <!--TaoHopThongBao-->
    {{-- <script src="{{asset('js/taoHopThoai.js')}}"></script> --}}

    <!-- phân trang  -->
    {{-- <script  rel="stylesheet" src="{{asset('js/pagination.js')}}"></script> --}}

    {{-- <script src="{{asset('js/message.js')}}"></script> --}}
    <title>Dashboard KTX Hufi</title>    
</head>
@extends('layouts.app')
@section('main')
<body>
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
    {{-- <ul class="notifications"></ul> --}}
    <div class="sidebar-content">
        <input type="checkbox" id="modal-background" class="modal-background-overplay" hidden>
        <label for="modal-background" class="modal-background"></label>
        <div class="sidebar-left">
            <a href="/" class="sidebar-left-logo">
                <div class="sidebar-left-list-mobile">
                    <i class="fa-solid fa-list-ul"></i>
                </div>
                <img src="{{asset('img/logo-2.png')}}" alt="">
            </a>
            <div class="sidebar-left-navbar">
                <ul class="sidebar-left-navbar-nav ">
                    <li class="sidebar-left-navbar-nav-item " id="sidebar-trangchu">
                        <a href="{{route('TrangChu')}}" class="sidebar-left-navbar-nav-item-link">
                            <i class="fa fa-house"></i>
                            Trang chủ
                        </a>
                    </li>
                    <li class="sidebar-left-navbar-nav-item " id="sidebar-hoso">
                        <a href="{{route('HoSoSinhVien')}}" class="sidebar-left-navbar-nav-item-link">
                            <i class="fa fa-user"></i>
                            Hồ sơ sinh viên
                        </a>
                    </li>
                    @if ($user->MaPhong == null)                    
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-dangkynoitru">
                            <a href="{{route('DangKyNoiTru')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-leaf"></i>
                                Đăng ký nội trú
                            </a>
                        </li>                                                                              
                    @else
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-bill">
                            <a href="{{route('user_quanLyHoaDon')}}" class="sidebar-left-navbar-nav-item-link"id="sidebar-bill">
                                <i class="fa fa-money-bill"></i>
                                Thanh toán - Hóa đơn
                            </a>
                        </li>                        
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-khaibaohuhong">
                            <a href="{{route('user_khaiBaoHuHong')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-circle-minus"></i>
                                Khai báo hư hỏng
                            </a>
                        </li>
                        @if ($user->isLeader())
                            <li class="sidebar-left-navbar-nav-item" id="sidebar-room">
                                <a href="{{route('user_thayDoiPhong')}}" class="sidebar-left-navbar-nav-item-link">
                                    <i class="fa fa-building"></i>
                                    Phòng
                                </a>
                            </li>
                        @endif                        
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-vipham">
                            <a href="{{route('user_viPham')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-circle-minus"></i>
                                Vi phạm
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-left-navbar-nav-item">
                        <a href="#" class="sidebar-left-navbar-nav-item-link">
                            <i class="fa fa-file"></i>
                            Biễu mẫu
                        </a>
                    </li>
                    <li class="sidebar-left-navbar-nav-item">
                        <a href="#" class="sidebar-left-navbar-nav-item-link">
                            <i class="fa fa-memo"></i>
                            Nội quy - quy định
                        </a>
                    </li>
                    <li class="sidebar-left-navbar-nav-item">
                        <a href="#" class="sidebar-left-navbar-nav-item-link">
                            <i class="fa fa-flag"></i>
                            Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-right">
            <div class="sidebar-right-content">
                <div class="sidebar-right-content-search">
                    <div class="search">
                        <div class="search-link">
                            <a href="#" class="search-logo">
                                <img src="{{asset('img/logo-2.png')}}" alt="">
                            </a>
                            <a href="#" class="search-icon">
                                <i class="fa fa-magnifying-glass"></i>
                            </a>
                        </div>
                        <input type="text" class="search-input" placeholder="Tìm kiếm ...">
                    </div>

                    <div class="today">
                        <span class="calender-icon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <div class="today-content">
                            <div class="time-today">
                                <span class="hour">12</span>:
                                <span class="minute">00</span>
                            </div>
                            <div class="day-today">
                                <span class="number-day">Monday</span>
                                <span class="day">24 </span> tháng
                                <span class="month">04 </span>
                                <span class="year">2002</span>
                            </div>
                        </div>
                    </div>
                    <label for="modal-background" class="sidebar-right-content-search-tablet-bar">
                        <i class="fa-solid fa-bars"></i>
                    </label>
                </div>
                <div class="sidebar-right-content-main">
                    {{-- @*<div class="buttons">
                        <button class="btn" id="success">Success</button>
                        <button class="btn" id="error">error</button>
                        <button class="btn" id="warning">warning</button>
                        <button class="btn" id="info">info</button>
                    </div>*@                     --}}
                    @yield('content')
                </div>
            </div>
            <div class="sidebar-right-info">
                <div class="sidebar-right-info-intro">
                    <div class="sidebar-right-info-intro-setting">
                        <label for="modal-background" class="shutdown">
                            <i class="fa-solid fa-xmark"></i>
                        </label>
                        <div class="setting">
                            <i class="fa-sharp fa fa-gear"></i>
                        </div>
                        <div class="notification">
                            <i class="fa fa-bell"></i>
                            <span id="dot-notification" class="dot"></span>
                            <ul class="message" id="notification-ul">
                                <li title="Xem chi tiết" ><a href="~/ThongBao/ThongBaoHoaDon?maHoaDon=HDA1030">Hóa đơn tháng 4 năm 2023 phòng 101</a></li>
                                <li><a href="~/ThongBao/ThongBaoHoaDon">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                                <li><a href="#">Thông báo 1</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-right-info-intro-user">
                        <h2 class="name">Xin chào<p>{{$user->Ho}} {{$user->Ten}}</p></h2>
                        <div class="image">
                            <img src="{{ $user->AnhDaiDien ?? asset('img/User.png')}}" alt="User image">
                        </div>
                    </div>
                </div>                
                <div class="sidebar-right-info-money">                    
                    <div class="sidebar-right-info-money-title">
                        <h1 class="sidebar-right-info-money-title-name">Hóa đơn</h1>
                        <div class="sidebar-right-info-money-title-setting">
                            <i class="fa fa-ellipsis"></i>
                        </div>
                    </div>
                    <div class="sidebar-right-info-money-types">
                        <div class="sidebar-right-info-money-types-item">
                            <div class="items-type" style="background-color:rgb(255, 255, 159) ;">
                                <i style="color: #ffb520fe;" class="fa-solid fa-bolt"></i>
                                <span class="dot" style="background-color:#ffb520fe;"></span>
                            </div>
                            <h2>
                                Hóa đơn điện
                            </h2>
                        </div>
                        <div class="sidebar-right-info-money-types-item">
                            <div class="items-type" style="background-color:#c1c1ff ;">
                                <i style="color: #2525ff;" class="fa-sharp fa-solid fa-droplet"></i>
                                <span class="dot" style="background-color:#2525ff ;"></span>
                            </div>
                            <h2>
                                Hóa đơn nước
                            </h2>
                        </div>
                        <div class="sidebar-right-info-money-types-item">
                            <div class="items-type" style="background-color: #E7F7FF;">
                                <i style="color:#04549F ;" class="fa-solid fa-building"></i>
                                <span class="dot" style="background-color:#04549F ;"></span>
                            </div>
                            <h2>
                                Hóa đơn phòng
                            </h2>
                        </div>
                        <div class="sidebar-right-info-money-types-item">
                            <div class="items-type" style="background-color:rgb(182, 255, 182) ;">
                                <i style="color: #018d01;" class="fa-solid fa-trash"></i>
                                <span class="dot" style="background-color: #018d01;"></span>
                            </div>
                            <h2>
                                Hóa đơn rác
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row p-4" id="box-extension">
                                       
                </div>  
                <script  rel="stylesheet" src="{{asset('js/user/contract/contract.extension.handle.js')}}"></script>                                       
                <div class="sidebar-right-info-dayOfWeek">
                    <div class="sidebar-right-info-dayOfWeek-title">
                        <h2>Ngày trong tuần này</h2>
                        <div class="month">
                            <i class="fa fa-calendar-days"></i>
                            Tháng <span>1</span>
                        </div>
                    </div>
                    <div class="sidebar-right-info-dayOfWeek-content">

                        <ul class="week">
                            <li class="dayOfWeek">
                                CN
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th2
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th3
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th4
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th5
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th6
                                <span class="day">1</span>
                            </li>
                            <li class="dayOfWeek">
                                Th7
                                <span class="day">1</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="sidebar-right-info-topic">
                    <h3 class="sidebar-right-info-topic-title">Chủ đề: </h3>
                    <div id="topic-light-dark" class="sidebar-right-info-topic-wraper">
                        <div class="icon-light">
                            <i class="fa-duotone fa-sun"></i>
                        </div>
                        <input type="checkbox" name="switch" id="switch-light-dark" class="switch-light-dark-change">
                        <div class="icon-dark">
                            <i class="fa-solid fa-moon"></i>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right-info-coppy-right">
                    <h2>&COPY; coppy right by <a href="https://hufi.edu.vn">hufi.edu.vn</a></h2>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/main_Das.js')}}"></script>
    <script src="{{asset('js/main_dasboard.js')}}"></script>
    <script  rel="stylesheet" src="{{asset('js/user/notification/notification.handle.js')}}"></script>     
    {{-- <script type="text/javascript" src="{{asset('lib/slick-1.8.1/slick/slick.min.js')}}"></script> --}}
    {{-- <script type="text/javascript" src="{{asset('js/Toastmessage.js')}}"></script> --}}
    {{-- <script src="{{asset('js/HopThoai.js')}}"></script> --}}
    {{-- <script src="{{asset('js/hopXacNhan.js')}}"></script> --}}

</body>
@endsection

</html>

