<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- fontawesome --> --}}
    {{-- @*<link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />*@ --}}
    <!-- icon -->
    <link rel="icon" href="https://sinhvien.hufi.edu.vn/Content/AConfig/images/favicon.png">
    <!-- fontfamily -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}


    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/Dashboard/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/base2.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/root.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/styleLayout.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/Style2.css')}}">
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/hopthoai.css')}}" />    
    <!--toastMessage-->
    {{-- <link rel="stylesheet" href="{{asset('css/toastMessage.css')}}" />     --}}



    {{-- <script rel="stylesheet" src="{{ asset('js/jquery.min.js') }}"></script>
    <script  rel="stylesheet" src="{{asset('js/config/config.js')}}"></script> --}}
    <script  rel="stylesheet" src="{{asset('js/admin/authen_admin.js')}}"></script>    
    <title>Dashboard KTX HUIT</title>
    <style>
        #error{
            font-size: 15px;
            color: red;
        }
        .form-check-status{
            position: relative!important;
            display: flex!important;
            flex-wrap: wrap!important;
            justify-items: center!important;
            justify-content: center !important;
            align-items: center!important;
        }
    </style>
    @php
        $user = Auth::guard('admin-api')->user();
        // dd($user->getRouteMenus());
    @endphp
</head>
@extends('layouts.app')
@section('main')
    <body>    
        <div class="sidebar-content">
            <input type="checkbox" id="modal-background" class="modal-background-overplay" hidden>
            <label for="modal-background" class="modal-background"></label>
            <div class="sidebar-left">
                <a href="#" class="sidebar-left-logo">
                    <div class="sidebar-left-list-mobile">
                        <i class="fa-solid fa-list-ul"></i>
                    </div>
                    <img src="{{asset('img/logo-2.png')}}" alt="">
                </a>
                <div class="sidebar-left-navbar">
                    <ul class="sidebar-left-navbar-nav">
                        @foreach ($user->getRouteMenus() as $route)                        
                            <li class="sidebar-left-navbar-nav-item {{request()->url() == route($route->route_name) ? 'active' :'' }}" id="sidebar-{{$route->icon}}">
                                {{-- {{đ}} --}}
                                <a href="{{route($route->route_name)}}" class="sidebar-left-navbar-nav-item-link">
                                    <i class="fa fa-{{$route->icon}}"></i>
                                    {{$route->menu_title}}                                   
                                </a>
                            </li>
                        @endforeach
                        {{-- <li class="sidebar-left-navbar-nav-item" id="sidebar-main">
                            <a href="{{route('web.index')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-house"></i>
                                Trang chủ
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-xetduyet">
                            <a href="{{route('web.register_residence.registrationReview')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-check-to-slot"></i>
                                Xét duyệt - kiểm tra
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-hopdong">
                            <a href="{{route('web.contract.contractList')}}" class="sidebar-left-navbar-nav-item-link" id="sidebar-hopdong">
                                <i class="fa fa-money-bill"></i>
                                Danh sách hợp đồng
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-hoadon">
                            <a href="{{route('web.bill.showBillList')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-file-invoice"></i>
                                Danh sách hóa đơn
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-service">
                            <a href="{{route('web.service.index')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-street-view"></i>
                                Dịch vụ
                            </a>
                        </li>   
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-service-personal">
                            <a href="{{route('web.service_personal.servicePersonal')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-shekel-sign"></i>
                                Quản lý dịch vụ cá nhân
                            </a>
                        </li>     
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-service_room">
                            <a href="{{route('web.service_room.serviceRoom')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-indent"></i>
                                Dịch vụ có chỉ số
                            </a>
                        </li>                                          
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-phong">
                            <a href="{{route('web.room.showRoomList')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa-regular fa-building"></i>
                                Quản lý phòng
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-lichsuchuyenphong">
                            <a href="{{route('web.change_room_history.index')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa-regular fa-user"></i>
                                Lịch sử chuyển phòng
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-device">
                            <a href="{{route('web.device.index')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-toolbox"></i>
                                Thiết bị 
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-device">
                            <a href="{{route('web.device_allocation.deviceAllocation')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-laptop-medical"></i>
                                Phân bổ thiết bị 
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-QuanLyKhaiBaoHuHong">
                            <a href="{{route('web.damage_report.damageEquipmentList')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-house-chimney-crack"></i>
                                Hư hỏng - sửa chửa
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-student">
                            <a href="{{route('web.student.studentList')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-chalkboard-user"></i>
                                Quản lý sinh viên
                            </a>
                        </li>                    
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-vipham">
                            <a href="{{route('web.infringe.index')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-scale-balanced"></i>
                                Quản lý vi phạm
                            </a>
                        </li>
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-lichsuvipham">
                            <a href="{{route('web.infringe_history.InfringeHistory')}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-gavel"></i>
                                Lịch sử vi phạm
                            </a>
                        </li>                        
                        <li class="sidebar-left-navbar-nav-item" id="sidebar-staff">
                            <a href="{{route("web.staff.index")}}" class="sidebar-left-navbar-nav-item-link">
                                <i class="fa fa-clipboard-user"></i>
                                Quản lý nhân viên
                            </a>
                        </li> --}}
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
                                    <span class="hour">12 </span>:
                                    <span class="minute">00</span>
                                </div>
                                <div class="day-today">
                                    <span class="number-day">Monday</span>
                                    <span class="day">12 </span> tháng
                                    <span class="month">04 </span>
                                    <span class="year">2022</span>
                                </div>
                            </div>
                        </div>
                        <label for="modal-background" class="sidebar-right-content-search-tablet-bar">
                            <i class="fa-solid fa-bars"></i>
                        </label>
                    </div>
                    <div class="sidebar-right-content-main">
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
                            <h2 class="name">Xin chào<b>Huỳnh Đăng Khoa</b>(Admin)</h2>
                            <div class="image">
                                <img src="{{asset('img/User.png')}}" alt="User image">
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-right-info-money">
                        <div class="sidebar-right-info__content-info">
                            <div class="sidebar-right-mailbox-stdudent-title">
                                <div class="row" style="font-size:20px; " id="box-setup-feature">
                                    {{-- <center class="form-check form-switch">
                                        <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch" id="checkbox-REGISTER_RESIDENCE" data-bs-toggle="modal" data-bs-target="#modal-edit-timeout-register">
                                        <label class="form-check-label" style="cursor: pointer" for="checkbox-REGISTER_RESIDENCE"><b>Mở đăng ký nội trú</b></label>
                                        <div style="font-size: 17px" id="countdown-REGISTER_RESIDENCE">
                                           00:00:00
                                        </div>
                                    </center>
                                    <center class="form-check form-switch">
                                        <input class="form-check-input" style="cursor: pointer" type="checkbox" role="switch" id="checkbox-CONTRACT_EXTENSION">
                                        <label class="form-check-label" style="cursor: pointer" for="checkbox-CONTRACT_EXTENSION"><b>Mở gia hạn hợp đồng</b></label>
                                        <div style="font-size: 17px" id="countdown-CONTRACT_EXTENSION">
                                            00:00:00
                                         </div>
                                    </center> --}}
                                </div>                                
                                <center><h1 class="sidebar-right-mailbox-stdudent-title-name">Hộp thư sinh viên</h1></center>
                                <div class="sidebar-right-mailbox-stdudent">
                                    <div class="sidebar-right-mailbox-stdudent-title-info">Có <span> 5 </span> tin từ hộp thư</div>
                                    <div class="sidebar-right-mailbox-stdudent-item">
                                        <div class="mailbox-stdudent-item-content">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (Chưa xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-mailbox-stdudent-item active">
                                        <div class="mailbox-stdudent-item-content ">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (đã xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-mailbox-stdudent-item">
                                        <div class="mailbox-stdudent-item-content">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (Chưa xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-mailbox-stdudent-item active">
                                        <div class="mailbox-stdudent-item-content ">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (đã xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-mailbox-stdudent-item">
                                        <div class="mailbox-stdudent-item-content">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (Chưa xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-mailbox-stdudent-item active">
                                        <div class="mailbox-stdudent-item-content ">
                                            <i class="fa-solid fa-envelope"></i>
                                            <div class="mailbox-stdudent-item-content-name">
                                                Huỳnh Đăng Khoa
                                            </div>
                                            <div class="mailbox-stdudent-item-content-status">
                                                (đã xem)
                                            </div>
                                        </div>
                                        <div class="mailbox-stdudent-item-option">
                                            <i class="fa fa-ellipsis"></i>
                                            <div class="item-option-box">
                                                <div class="item-option-box-watch">Xem tin</div>
                                                <div class="item-option-box-delete">Xóa tin</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <h2>&COPY;copyright by <a href="#">hufi.edu.vn</a></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-setup-feature" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title">MỞ ĐĂNG KÝ NỘI TRÚ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>  
                    <form action="" id="form-feature">    
                        <div class="modal-body" style="">                
                            <div class="p-lg-5">
                                <div class="profile--form__text-field">
                                    <label for="username3">Đặt lịch đóng tự động</label>
                                    <input type="datetime-local" name="thoi_han" id="end-autotime" class="active">
                                </div>
                                <center style="font-size: 15px; font-style: italic">Thiết lập thời gian tự động đóng tính năng</center>
                                <center style="font-size: 13px; font-style: italic">Bạn không thể sửa cái này, chỉ có thể mở thêm đợt nếu muốn</center>
                            </div>
                        </div>
                        <div class="modal-footer" >
                            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 20px">Hủy bỏ</a>
                            <button type="submit" class="btn btn-primary" id="btn-confrim-register" style="font-size: 20px">Xác nhận mở</button>                  
                        </div>
                    </form>  
                </div>
            </div>
        </div>
        <script src="{{asset('js/Dashboard/man.js')}}"></script>
        <script src="{{asset('js/Dashboard/Admin/main.js')}}"></script>
        <script src="{{asset('js/admin/dashboard/open_register.handle.js')}}"></script>
        <script  rel="stylesheet" src="{{asset('js/admin/notification/notification.handle.js')}}"></script>     
        {{-- <script type="text/javascript" src="{{asset('js/Toastmessage.js')}}"></script>     --}}
    </body>
</html>
@endsection