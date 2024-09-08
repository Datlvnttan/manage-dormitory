@extends('layouts.user')
@section('content')
<script  rel="stylesheet" src="{{asset('js/user/room/room.callapi.js')}}"></script>
{{-- <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" /> --}}
<style>
    .error-validate{
        color: red;
        font-size: 14px;
    }
    .service-item{
        cursor: pointer;
    }
    #show-register-servise{
        cursor: pointer;
    }
    .room-info-content-none-room{
        cursor: pointer;
    }
</style>
<script>
    document.getElementById('sidebar-trangchu').classList.add("active");
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7 col-md-12 col-12">
            <div class="room-info">               
            </div>
        </div>
        <div class="col-xl-5">
            <div class="row">
                <div class="col-xl-12 col-md-6 col-sm-12">
                    <div class="main-info-violate">
                        <div class="main-info-violate-box">
                            <div class="main-info-violate-box-icon">
                                <i class="fa-solid fa-circle-minus"></i>
                            </div>
                            <h3 class="main-info-violate-box-title">Lỗi vi phạm</h3>
                        </div>
                        <div class="main-info-violate-quantity">
                            0
                        </div>
                        <h3 class="main-info-violate-des">Vi phạm</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-md-6 col-sm-12">
                    <div class="main-info-warning">
                        <div class="main-info-warning-box">
                            <div class="main-info-warning-box-icon">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <h3 class="main-info-warning-box-title">Lỗi cảnh cáo</h3>
                        </div>
                        <div class="main-info-warning-quantity">
                            2
                        </div>
                        <h3 class="main-info-warning-des">cảnh cáo</h3>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <div class="main-contract">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="main-contract-item">
                    <div class="main-contract-item-icon">
                        <i class="fa fa-envelopes"></i>
                    </div>
                    <h1 class="main-contract-item-title">Hộp thư sinh viên</h1>
                    <p class="main-contract-item-des">
                        Phản hồi ý kiến của riêng bạn về ban quản lý ký túc xá
                    </p>
                    <a href="#" class="main-contract-item-link">Đi đến hộp thư <i class="fa-light fa-chevrons-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="main-contract-item">
                    <div class="main-contract-item-icon">
                        <i class="fa fa-money-bill"></i>
                    </div>
                    <h1 class="main-contract-item-title">Hóa đơn sử dụng</h1>
                    <p class="main-contract-item-des">
                        Lịch sử hóa đơn, đơn hàng bạn đã mua
                    </p>
                    <a href="#" class="main-contract-item-link">Đi đến lịch sử hóa đơn <i class="fa-light fa-chevrons-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="main-contract-item">
                    <div class="main-contract-item-icon">
                        <i class="fa fa-mug-saucer"></i>
                    </div>
                    <h1 class="main-contract-item-title">Thông báo hư hỏng vật tư</h1>
                    <p class="main-contract-item-des">
                        Thông báo cho ban quản lý vật tư phòng bị hỏng, hoặc mất
                    </p>
                    <a href="#" class="main-contract-item-link">Đi đến trang thông báo <i class="fa-light fa-chevrons-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="box-service">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="service-info">
                <h2 class="service-info-name">
                    <i class="fa-regular fa-seedling"></i>
                    Dịch vụ của bạn
                </h2>
                <div id="service-signin-contact">
                    {{-- <div class="service-item">
                        <i class="fa-regular fa-bicycle"></i>
                        <h2 class="service-item-name">Giữ xe</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-shield-halved"></i>
                        <h2 class="service-item-name">Bảo quản vật tư</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-hand-sparkles"></i>
                        <h2 class="service-item-name">Vệ sinh phòng</h2>
                    </div> --}}
                </div>
                <a href="#" class="service-info-link">Xem thêm <i class="fa-regular fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="service-info">
                <h2 class="service-info-name" id="show-cancel-servise">
                    <i class="fa-sharp fa-solid fa-pen"></i>
                    Chờ thanh toán
                </h2>
                <div id="service-waiting-review">
                    {{-- <div class="service-item">
                        <i class="fa-solid fa-building"></i>
                        <h2 class="service-item-name">Phòng</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-ticket"></i>
                        <h2 class="service-item-name">Phí gửi xe</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-id-card"></i>
                        <h2 class="service-item-name">Thẻ thành viên</h2>
                    </div> --}}
                </div>
                <a href="#" class="service-info-link">Xem thêm <i class="fa-regular fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12">
            <div class="service-info">
                <h2 class="service-info-name" id="show-register-servise" data-bs-toggle="modal" data-bs-target="#modal-register-service">
                    <i class="fa-sharp fa-solid fa-pen"></i>
                    Đăng ký
                </h2>
                <div id="service-signup-service">
                    {{-- <div class="service-item">
                        <i class="fa-solid fa-building"></i>
                        <h2 class="service-item-name">Phòng</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-ticket"></i>
                        <h2 class="service-item-name">Phí gửi xe</h2>
                    </div>
                    <div class="service-item">
                        <i class="fa-solid fa-id-card"></i>
                        <h2 class="service-item-name">Thẻ thành viên</h2>
                    </div> --}}
                </div>
                <a href="#" class="service-info-link">Xem thêm <i class="fa-regular fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-12 hide-in-mobile">
            <div class="main-info-users">
                <center><h1 class="main-info-users-title">Thông tin phòng</h1></center><br /><br />
                @if ($user->MaPhong==null)
                    <b class="main-info-users-title">Bạn chưa là thành viên của ký túc xá</b>
                @else
                <table class="main-info-users-table w-100">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Mã sinh viên</td>
                            <td>Tên sinh viên</td>                            
                            <td>Lớp</td>
                            <td>Liên hệ</td>
                        </tr>
                    </thead>
                    <tbody id="room-member-list">
                                          
                    </tbody>                        
                </table>
                @endif                
            </div> 
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="main-info-violate">
                        <div class="main-info-violate-box">
                            <div class="main-info-violate-box-icon">
                                <i class="fa-solid fa-circle-minus"></i>
                            </div>
                            <h3 class="main-info-violate-box-title">Lỗi vi phạm</h3>
                        </div>
                        <div class="main-info-violate-quantity">
                            0
                        </div>
                        <h3 class="main-info-violate-des">Vi phạm</h3>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="main-info-warning">
                        <div class="main-info-warning-box">
                            <div class="main-info-warning-box-icon">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <h3 class="main-info-warning-box-title">Lỗi cảnh cáo</h3>
                        </div>
                        <div class="main-info-warning-quantity">
                            2
                        </div>
                        <h3 class="main-info-warning-des">cảnh cáo</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (isset($user->MaPhong))
<div class="modal fade" id="modal-change-room-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Chọn phòng mà bạn muốn thay đổi đăng ký</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="">                
            <div class="p-lg-5">
                @include('user.dangkynoitru.body_show_select')
            </div>
        </div>
        <div class="modal-footer">                  
        </div>
      </div>
    </div>
</div> 
<div class="modal fade" id="modal-register-service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header">
            <h1>Chọn dịch vụ mà bạn muốn đăng ký</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
        <div class="modal-body" style="">                
            <div class="p-lg-5">
                <div class="profile--form__text-field">
                    <label for="username3">Dịch vụ</label>
                    <select autocomplete="off" name="MaDichVu" id="select-service-id" class="active">

                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
            <button type="submit" class="btn btn-primary" id="btn-register-service">Đăng ký</button>                  
        </div>
      </div>
    </div>
</div>
@endif

@if ($user->dangKyNoiTru != null && $user->DangKyNoiTru->TrangThai != "Bị hủy")
    @include("user.dangkynoitru.form_cancel_register")
@endif
<script  rel="stylesheet" src="{{asset('js/user/dashboard/dashborad.handle.js')}}"></script>
@endsection