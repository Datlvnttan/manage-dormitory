@extends('layouts.admin')
@section('content')
    <script>document.getElementById('sidebar-file-invoice').classList.add("active");</script>
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/TaoHoaDon.css')}}" />    
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Cập nhật hóa đơn "{{$MaHoaDon}}"</h2>
    </div>
    <div class="container-fluid">
        {{-- <form id="form-edit-bill" method="GET">
            @csrf   --}}
            <input type="hidden" value="{{$MaHoaDon}}" name="MaHoaDon">                      
            <h2 class="bill-heading-title bill-heading-title-service">Nhập thông tin dịch vụ</h2>
            <div class="row" id="form-field">                            
            </div>        
            <div class="row">
                <h3 class="bill-heading-title">Chi tiết hóa đơn</h3>
                <table class=" main-info-users-table" align="center">
                    <thead>
                        <tr>
                            <td>Tên dịch vụ</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                            <td>Tổng tiền</td>
                        </tr>
                    </thead>
                    <tbody title="Chi tiết dịch vụ phòng" id="dvPhongTable">                        
                    </tbody>
                    <tbody title="Chi tiết dịch vụ đơn" id="dvDon">                        
                    </tbody>                                        
                </table>
                <div class="form-add-bill">
                    <p class="thanhtien">Thành tiền: <span style="color:crimson" id="into-money"></span></p>                    
                    <button class="open_btn btn btn-primary" id="btn-confirm-edit-bill">Cập nhật hóa đơn</button>
                </div>
    
            </div>
        {{-- </form>                  --}}
    </div>
    <script  rel="stylesheet" src="{{asset('js/admin/bill/bill.edit.handle.js')}}"></script>                
@endsection