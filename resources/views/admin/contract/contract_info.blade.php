@extends('layouts.admin')
@section('content')
<script>document.getElementById('sidebar-file-contract').classList.add("active");</script>

<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/ChiTietHopDong.css')}}" />
<link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
<div class="sidebar-right-content-heading">
    <h2 class="sidebar-right-content-heading-name">Chi tiết hợp đồng</h2>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="bg-white-content">
            <div class="row" id="contract-details">                
               {{-- <script>                
                chiTietHopDong('{{$MaHopDong}}')
               </script> --}}
            </div> 
                           
            <div class="form-add-bill">
                <div class="form-add-conflim-box" id="browsing-operation">                    
                    {{-- <a class="btn btn-primary" onclick="">Xác nhận thanh toán</a>
                    <button class="open_btn btn btn-danger">Hủy bỏ</button>  --}}
                </div> 
                <a href="{{route('web.contract.contractList')}}" class="btn__go-home">
                    <i class="fa-regular fa-chevrons-left"></i>
                    Trở về danh sách hợp dồng
                </a>
            </div>
        </div>
    </div>
</div>
<script  rel="stylesheet" src="{{asset('js/admin/contract/contract.details.handle.js')}}"></script>       
@endsection