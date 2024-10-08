@extends('layouts.home')
@section('content')
    <div class="banner">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-5 col-md-12 ">
                    <div class="banner-logo">
                        <img src="{{ URL('img/logo.png') }}" alt="Logo trường" class="banner-logo-img">
                    </div>
                    <p class="banner-name">
                        trường đại học công nghiệp thực phẩm tp. hồ chí minh
                    </p>
                    <p class="banner-name-title">
                        trung tâm ký túc xá sinh viên
                    </p>
                </div>
                <div class="col-lg-7 hide-on-tablet-and-mobile  ">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/slide/banner-web-hufi-02.jpg?width=1140&height=350&mode=stretch" class="d-block w-100 banner-img-intro-slider" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/pano/abc-1.jpg?width=1140&height=350&mode=stretch" class="d-block w-100 banner-img-intro-slider" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tuyen-dung/abc-2.jpg?width=1140&height=350&mode=stretch" class="d-block w-100 banner-img-intro-slider" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/pano/abc-3.jpg?width=1140&height=350&mode=stretch" class="d-block w-100 banner-img-intro-slider" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/slide/tr.png?width=1140&height=350&mode=stretch" class="d-block w-100 banner-img-intro-slider" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
            <div class="banner_track hide-on-tablet-and-mobile">
                <div class="banner_track-list">
                    <div class="banner_track-item">
                        <a href="#" class="banner_track-item-link">
                            <i class="fa-duotone fa-graduation-cap banner_track-item-icon"></i>
                            Tuyển sinh
                        </a>
                    </div>
                    <div class="banner_track-item">
                        <a href="#" class="banner_track-item-link">
                            <i class="fa-duotone fa-house-laptop banner_track-item-icon"></i>
                            Việc làm
                        </a>
                    </div>
                    <div class="banner_track-item">
                        <a href="#" class="banner_track-item-link">
                            <i class="fa-duotone fa-globe banner_track-item-icon"></i>
                            Dạy học trực tuyến
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-tablet-mobile" style="background-image: url(assets/img/banner-logn-res.jpg)"></div>
    </div>
    <div class="body_categories">
        <div class="container-lg">
            <div class="row">
                <h2 class="body_categories-title">Truy cập nhiều nhất <i class="fa-duotone fa-bookmark body_categories-title-icon"></i></h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-user-graduate body_categories-item-icon"></i>
                            <span>sinh viên</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-browser body_categories-item-icon"></i>
                            <span>giới thiệu</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-megaphone body_categories-item-icon"></i>
                            <span>thông báo</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-shield-virus body_categories-item-icon"></i>
                            <span>sức khỏe</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-user-group body_categories-item-icon"></i>
                            <span>câu lạc bộ / nhóm</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-newspaper body_categories-item-icon"></i>
                            <span>tin tức hoạt dộng</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-seedling body_categories-item-icon"></i>
                            <span>tiêu điểm</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-camera-retro body_categories-item-icon"></i>
                            <span>video / hình ảnh</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-messages-question body_categories-item-icon"></i>
                            <span>Hỏi đáp</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="body_categories-item">
                        <a href="#" class="body_categories-item-link">
                            <i class="fa-duotone fa-calendar-star body_categories-item-icon"></i>
                            <span>sự kiện sắp tới</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body_categories">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <h2 class="body_categories-title">Thông báo <i class="fa-duotone fa-megaphone body_categories-title-icon"></i></h2>
                    <span class="body_categories-title-line"></span>
                    <div class="body_categories-notification">
                        <a href="#" class="body_categories-title-more-link">Xem thông báo nhiều hơn <i class="fa-duotone fa-chevrons-right body_categories-title-more-link-icon"></i></a>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-6 ">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 hide-on-mobile">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 hide-on-mobile">
                                <div class="body_categories-notification-item">
                                    <a href="#" class="body_categories-notification-item-link">
                                        <div class="categories-notification-img">
                                            <div class="categories-notification-item-img"
                                                 style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                            </div>
                                        </div>
                                        <h4 class="categories-notification-item-title">
                                            lịch thông báo chuẩn bị dọn vệ sinh
                                        </h4>
                                        <h5 class="categories-notification-item_post">
                                            Đăng bởi: <span class="User-post">Admin</span>
                                        </h5>
                                        <div class="categories-notification-item-published">
                                            <i class="fa-duotone fa-clock-desk categories-notification-item-published-icon"></i>
                                            12/02/2022 - 10:30 AM
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h2 class="body_categories-title">
                        tiêu điểm
                        <i class="fa-duotone fa-seedling body_categories-title-icon"></i>
                    </h2>
                    <span class="body_categories-title-line"></span>
                    <div class="body_categories-focus">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="body_categories-focus-item" style="background: linear-gradient(356deg, rgba(255,247,153,1) 0%, rgba(219,0,0,1) 100%);">
                                    <a href="#" class="body_categories-focus-item-link">
                                        <i class="fa-duotone fa-seal-question body_categories-focus-item-icon"></i>
                                        Người tốt việt tốt
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="body_categories-focus-item" style="background: linear-gradient(356deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%);">
                                    <a href="#" class="body_categories-focus-item-link">
                                        <i class="fa-duotone fa-seal-question body_categories-focus-item-icon"></i>
                                        Hoạt động sinh viên KTX
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="body_categories-focus-item" style="background: linear-gradient(356deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">
                                    <a href="#" class="body_categories-focus-item-link">
                                        <i class="fa-duotone fa-seal-question body_categories-focus-item-icon"></i>
                                        hoạt động trung tâm ktx
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="body_categories-focus-item" style="background: linear-gradient(365deg, rgba(103,183,255,1) 0%, rgba(0,215,176,1) 100%);">
                                    <a href="#" class="body_categories-focus-item-link">
                                        <i class="fa-duotone fa-seal-question body_categories-focus-item-icon"></i>
                                        thông tin tuyển dụng
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="body_categories">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="body_categories-title">tin tức hoạt động <i class="fa-duotone fa-newspaper body_categories-title-icon"></i></h2>
                    <span class="body_categories-title-line"></span>
                    <div class="body_categoies-common">
                        <a href="#" class="body_categories-title-more-link">Xem thông báo nhiều hơn <i class="fa-duotone fa-chevrons-right body_categories-title-more-link-icon"></i></a>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="categoies-common-item">
                                    <a href="#" class="categoies-common-item-link">
                                        <div class="categoies-common-item-img"
                                             style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                        </div>
                                        <div class="categoies-common-item-content">
                                            <h4 class="categoies-common-item-title">
                                                lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj</h3>
                                                <h5 class="categories-common-item_post">
                                                    Đăng bởi: <span class="User-post">Admin</span>
                                                </h5>
                                                <div class="categories-common-item-published">
                                                    <i class="fa-duotone fa-clock-desk categories-common-item-published-icon"></i>
                                                    12/02/2022 - 10:30 AM
                                                </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="categoies-common-item">
                                    <a href="#" class="categoies-common-item-link">
                                        <div class="categoies-common-item-img"
                                             style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                        </div>
                                        <div class="categoies-common-item-content">
                                            <h4 class="categoies-common-item-title">
                                                lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj</h3>
                                                <h5 class="categories-common-item_post">
                                                    Đăng bởi: <span class="User-post">Admin</span>
                                                </h5>
                                                <div class="categories-common-item-published">
                                                    <i class="fa-duotone fa-clock-desk categories-common-item-published-icon"></i>
                                                    12/02/2022 - 10:30 AM
                                                </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="categoies-common-item">
                                    <a href="#" class="categoies-common-item-link">
                                        <div class="categoies-common-item-img"
                                             style="background-image: url(https://ttktx.hufi.edu.vn/app_web/ttktxsv/images/tin-tuc-hoat-dong/loa-thong-bao.jpg?width=110);">
                                        </div>
                                        <div class="categoies-common-item-content">
                                            <h4 class="categoies-common-item-title">
                                                lịch thông báo chuẩn bị dọn vệ sinh năm 2023 mới nhất đucợ cập nhâoj</h3>
                                                <h5 class="categories-common-item_post">
                                                    Đăng bởi: <span class="User-post">Admin</span>
                                                </h5>
                                                <div class="categories-common-item-published">
                                                    <i class="fa-duotone fa-clock-desk categories-common-item-published-icon"></i>
                                                    12/02/2022 - 10:30 AM
                                                </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 hide-on-mobile">
                    <h2 class="body_categories-title">Các trang mạng xã hội <i class="fa-duotone fa-address-card body_categories-title-icon"></i></h2>
                    <span class="body_categories-title-line"></span>
                    <div class="body_categoies-socials">
                        <div class="row">
                            <div class="col-lg-6 col-md-3">
                                <div class="body_categoies-socials-item">
                                    <a href="#" class="body_categoies-socials-link">
                                        <div class="body_categoies-socials-link-icon" style="background-color: var(--font-color-primary);">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </div>
                                        <div class="body_categoies-socials-link-name" style="background-color: var(--font-color-primary);">
                                            Facebook
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3">
                                <div class="body_categoies-socials-item">
                                    <a href="#" class="body_categoies-socials-link">
                                        <div class="body_categoies-socials-link-icon" style="background-color: #d63031;">
                                            <i class="fa-brands fa-youtube"></i>
                                        </div>
                                        <div class="body_categoies-socials-link-name" style="background-color: #d63031;">
                                            Youtobe
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3">
                                <div class="body_categoies-socials-item">
                                    <a href="#" class="body_categoies-socials-link">
                                        <div class="body_categoies-socials-link-icon" style="background-color: black;">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </div>
                                        <div class="body_categoies-socials-link-name" style="background-color: black;">
                                            TikTok
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-3">
                                <div class="body_categoies-socials-item">
                                    <a href="#" class="body_categoies-socials-link">
                                        <div class="body_categoies-socials-link-icon" style="background: linear-gradient(360deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">
                                            <i class="fa-brands fa-instagram"></i>
                                        </div>
                                        <div class="body_categoies-socials-link-name" style="background: linear-gradient(360deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">
                                            Instagram
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="body_categories hide-on-tablet-and-mobile">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="body_categories-title">video / hình ảnh <i class="fa-duotone fa-camera-retro body_categories-title-icon"></i></h2>
                    <span class="body_categories-title-line"></span>
                    <div class="body_categories-video">
                        <div class="row">
                            <div class="col-lg-6">
                                <iframe width="560" height="315" id="body_categories-video" src="https://www.youtube.com/embed/mavDhuj-SJk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                <h2 id="body_categories-video-title">Name</h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="body_categories-video-list">
                                    <div class="body_categories-video-item" data-video="https://www.youtube.com/watch?v=vAbDajCuswg">
                                        <img src="{{URL('img/logo.png')}}" alt="" class="body_categories-video-item-img">
                                        <h3 class="body_categories-video-item-img-title">Xin chào</h3>
                                    </div>
                                    <div class="body_categories-video-item" data-video="https://www.youtube.com/watch?v=dLQe4qEfVJw">
                                        <img src="{{URL('img/logo.png')}}" alt="" class="body_categories-video-item-img">
                                        <h3 class="body_categories-video-item-img-title">C++</h3>
                                    </div>
                                    <div class="body_categories-video-item" data-video="https://www.youtube.com/watch?v=TIFW6IAUqHY">
                                        <img src="{{URL('img/logo.png')}}" alt="" class="body_categories-video-item-img">
                                        <h3 class="body_categories-video-item-img-title">Javascript</h3>
                                    </div>
                                    <div class="body_categories-video-item" data-video="https://www.youtube.com/watch?v=N3tUmzOySEk">
                                        <img src="{{URL('img/logo.png')}}" alt="" class="body_categories-video-item-img">
                                        <h3 class="body_categories-video-item-img-title">css</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection