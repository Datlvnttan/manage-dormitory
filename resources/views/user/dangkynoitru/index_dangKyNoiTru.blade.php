@extends('layouts.user')
@section('content')

<script>document.getElementById('sidebar-xetduyet').classList.add("active");</script>
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name">Đăng ký nội trú</h2>
</div>
<div class="container-fluid">
    <div class="bg-white-content">              
        <div class="row" id="content">
            <div class="row">
                <h4 class="heading-bill-title">Xem trước thông tin cá nhân</h4>
                <div class="col-lg-3">
                    <img src="{{$user->AnhDaiDien ?? url("img/User.png")}}" alt="ảnh" class="Approval-user-img" />
                </div>
                <div class="col-lg-9">
                    <div class="row">                    
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Mã sinh viên:</h3>
                                <span class="detail-bill-heading-name">{{ $user->MaSV }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Họ và tên:</h3>
                                <span class="detail-bill-heading-name">{{$user->Ho}} {{$user->Ten}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Ngày sinh:</h3>
                                <span class="detail-bill-heading-name">{{$user->NgaySinh}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Giới tính:</h3>
                                <span class="detail-bill-heading-name">{{$user->GioiTinh}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Số điện thoại:</h3>
                                <span class="detail-bill-heading-name">{{$user->SoDienThoai}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">CMND/CCCD:</h3>
                                <span class="detail-bill-heading-name">{{$user->SoCanCuoc}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Quê quán:</h3>
                                <span class="detail-bill-heading-name">{{$user->QueQuan}}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-bill-heading">
                                <h3 class="detail-bill-heading-title">Đang học tại:</h3>
                                <span class="detail-bill-heading-name">{{$user->Lop}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="heading-bill-title">Chọn phòng đăng ký</h4>
                <div class="row">                    
                        <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                @include('user.dangkynoitru.body_show_select')                            
                            </div>
                        <div class="col-lg-3"></div>                                         
                    <script  rel="stylesheet" src="{{asset('js/user/register-residence/residence.handle.js')}}"></script>
                    <script>document.getElementById('sidebar-dangkynoitru').classList.add("active");</script>
                </div>                            
            </div>
        </div>
        {{-- <div class="row">
            <div class="form-add-conflim">
                <div class="form-add-conflim-box" id="browsing-operation">                    
                    <a class="btn btn-primary">Đăng ký</a>                    
                </div>
                <div class="form-add-conflim-box">
                    <a href="{{route('admin_xetDuyetDangKy')}}" class="btn__go-home">
                        <i class="fa-regular fa-chevrons-left"></i>
                        Trở về danh sách xét duyệt
                    </a>
                </div>
            </div>

        </div> --}}
    </div>

</div>
@endsection