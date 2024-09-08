@extends('layouts.admin')
@section('content')

<script>document.getElementById('sidebar-check-to-slot').classList.add("active");</script>
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/XemThongTinXetDuyet.css')}}" />
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name"> Chi tiết đơn xét duyệt</h2>
</div>
<div class="container-fluid">
    <div class="bg-white-content">              
        <div class="row" id="content">
            <script>
                xemThongTinDangKy({{$MaSV}});
            </script>
        </div>
        <div class="row">
            <div class="form-add-conflim">
                <div class="form-add-conflim-box" id="browsing-operation">                    
                    <a class="btn btn-primary" onclick="pheDuyetDangKy('{{$MaSV}}')">Phê duyệt</a>
                    <button class="open_btn btn btn-danger">Hủy bỏ</button>
                </div>
                <div class="form-add-conflim-box">
                    <a href="{{route('web.register_residence.registrationReview')}}" class="btn__go-home">
                        <i class="fa-regular fa-chevrons-left"></i>
                        Trở về danh sách xét duyệt
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>


<div class="modall an">
    <div class="modal__innerr">
        <div class="modal__headerr">
            <p>Bạn muốn hủy bó xét duyệt này? </p>
            <i class="fas fa-times"></i>
        </div>
        <form action="" id="form-cancel" method="post">            
            @csrf
            <input type="hidden" name="MaSV" value="{{$MaSV}}">
            <div class="modal__bodyy">
                <span>Lý do hủy:</span><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Đã hết chổ trống" id="mau1" checked />
                <label for="mau1">Phòng này đã hết chổ trống, hãy chọn phòng khác</label><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Thông tin cá nhân không hợp lệ" id="mau2" />
                <label for="mau2">Thông tin cá nhân không hợp lệ</label><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Ký túc xá đã hết chổ trống" id="mau3" />
                <label for="mau3">Ký túc xá đã hết chổ trống</label><br />
                <input type="radio" name="ghiChu" value="-1" id="khac" />
                <label for="khac">Khác</label>
                <textarea id="lyDoKhac" disabled placeholder="Nhập lý do khác"></textarea>
            </div>
            <div class="modal__footerr">
                <a class="close btn btn-warning">Hủy bỏ</a>
                <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
            </div>  
        </form>   
        <script>
            $('#form-cancel').on('submit',(ev)=>{
                ev.preventDefault();
                let fromData = $('#form-cancel').serialize();    
                huyBoDangKy(fromData,()=>{
                    $('#browsing-operation').html(`
                    <a style="font-size: 22px" class=" disabled btn btn-dark">Đã hủy</a>`);
                    $(".modall").addClass("an")
                })
        })            
        </script>       
    </div>
</div>
{{-- <script src="{{asset('js/Dashboard/Admin/phanHoiXetDuyetDangKyNoiTru.js')}}"></script> --}}
<script src="{{asset('js/HopThoai.js')}}"></script>
<script src="{{asset('js/HopThoaiCheck.js')}}"></script> 
@endsection