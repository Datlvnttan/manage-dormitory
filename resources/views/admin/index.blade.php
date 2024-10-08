@extends('layouts.admin')
@section('content')
    
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/style.css')}}">
<script>document.getElementById('sidebar-main').classList.add("active");</script>
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name">Quản lý ký túc xá</h2>
</div>
<div class="container-fluid">    
    <div class="row">
        <div class="sidebar-right-content-main-tabs">
            <div class="sidebar-right-content-titles">
                <ul class="sidebar-right-content-titles-list">
                    <li class="sidebar-right-content-titles-items" id="click-tab-bill">Hóa đơn</li>
                    <li class="sidebar-right-content-titles-items" id="click-tab-change-room">Đang ký chuyển phòng</li>
                    <li class="sidebar-right-content-titles-items active" id="click-tab-report">Thư báo cáo</li>
                </ul>
            </div>
            <div class="sidebar-right-content-tabs">
                <div class="sidebar-right-content-tab" id="tab-bill">
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>

                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-memo"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Hóa đơn tiền rác
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right-content-tab" id="tab-infringe">
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-violent">
                        <div class="sidebar-right-content-violent-left">
                            <i class="fa-light fa-circle-minus"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Huỳnh Đăng Khoa
                                </div>
                                <div class="bill-left-info-content">
                                    Từ : <span>phòng 203</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-violent-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-right-content-tab active" id="tab-report">
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                    <div class="sidebar-right-content-bill">
                        <div class="sidebar-right-content-bill-left">
                            <i class="fa-light fa-bullhorn"></i>
                            <div class="sidebar-right-content-bill-left-info">
                                <div class="bill-left-info-name">
                                    Báo cáo hỏng đồ
                                </div>
                                <div class="bill-left-info-des">
                                    Từ : <span>phòng 304</span>
                                </div>
                                <div class="bill-left-info-des">
                                    Day: <span>10 / 04 / 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-right-content-bill-right">
                            <a href="#" class="sidebar-right-content-bill-right-detail">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="sidebar-right-content-quick-assets">
            <h2 class="sidebar-right-content-quick-assets-name">Truy cập nhanh</h2>
            <div class="quick-assets-content">
                <div class="quick-assets-content-item">
                    <img src="https://img.icons8.com/external-phatplus-lineal-color-phatplus/256/external-user-essential-phatplus-lineal-color-phatplus.png" class="quick-assets-content-item-icon">                    
                    <div class="quick-assets-content-item-info">
                        Danh sách sinh viên
                    </div>
                </div>
                <div class="quick-assets-content-item">
                    <img src="https://img.icons8.com/ultraviolet/256/room.png" class="quick-assets-content-item-icon">

                    <div class="quick-assets-content-item-info">
                        Danh sách phòng
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h2 class="sidebar-right-content-event-title">Sự kiện, việc làm</h2>
        <!-- chỉ nên để 2 sự kiện, hoặc lịch làm ở màn hình chính admin  -->
        <div class="sidebar-right-content-event-list">
            <div class="sidebar-right-content-event-item">
                <div class="sidebar-right-content-event-item-bg-img" style="background-image: url(https://plus.unsplash.com/premium_photo-1673258926559-66730e7b8943?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxNXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60);">
                </div>
                <div class="sidebar-right-content-event-item-content">
                    <div class="event-item-content-left">
                        <h2 class="event-item-content-left-heading">Hội thao hufi</h2>
                    </div>
                    <div class="event-item-content-right">
                        <a href="#" class="event-item-content-right-link">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                    <div class="event-item-content-setting">
                        <i class="fa-regular fa-ellipsis"></i>
                    </div>
                </div>
            </div>
            <div class="sidebar-right-content-event-item">
                <div class="sidebar-right-content-event-item-bg-img" style="background-image: url(https://plus.unsplash.com/premium_photo-1673258926559-66730e7b8943?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxNXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60);">
                </div>
                <div class="sidebar-right-content-event-item-content">
                    <div class="event-item-content-left">
                        <h2 class="event-item-content-left-heading">Hội thao hufi</h2>
                    </div>
                    <div class="event-item-content-right">
                        <a href="#" class="event-item-content-right-link">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<script  rel="stylesheet" src="{{asset('js/admin/dashboard/dashboard.handle.js')}}"></script>
@endsection