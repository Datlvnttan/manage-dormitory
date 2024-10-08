@extends('layouts.admin')
@section('content')
    {{-- <script>document.getElementById('sidebar-check-to-slot').classList.add("active");</script> --}}
    <link rel="stylesheet" href="{{asset('css/Dashboard/Admin/DanhSachXetDuyet.css')}}" />
    <div class="sidebar-right-content-heading">
        <h2 class="sidebar-right-content-heading-name">Danh sách xét duyệt</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="Approval-all">
                <button>Xét duyệt hàng loạt</button>
            </div> --}}
            <table class="table main-info-users-table">
                <thead>
                    <td></td>
                    <td>
                        Mã sinh viên
                    </td>
                    <td>
                        Ngày gửi
                    </td>   
                    <td>
                        Trạng thái
                    </td>
                    <td>
                        Ghi chú
                    </td>
                    <td></td>
                </thead>
                    <tbody id="danh-sach-xet-duyet">
                        <script>
                            loadDanhSachXetDuyet();
                        </script>
                        {{-- @foreach (var item in Model)
                        {
                            <tr>
                                <td>
                                    <input type="checkbox" name="@("chk"+item.MaSV)" />
                                </td>
                                <td>
                                    @Html.DisplayFor(modelItem => item.MaSV)
                                </td>
                                <td>
                                    @Html.DisplayFor(modelItem => item.NgayGui)
                                </td>
                                <td>
                                    @Html.DisplayFor(modelItem => item.GhiChu)
                                </td>
                                <td>
                                    <a class="btn btn-info" href="@Url.Action("XemThongTinXetDuyet",new {maSV = item.MaSV})">Chi tiết</a>
                                    <a class="btn btn-primary" href="@Url.Action("PhanHoiXetDuyet",new {maSV = item.MaSV, trangThai = "Đã xét duyệt"})">Duyệt</a>
                                    <button class="btn btn-warning" id="huyBo" value="@item.MaSV">Hủy bỏ</button>
                                </td>   
                            </tr>
                        } --}}
                        
                    </tbody>
            </table>
        </div>
    </div>    
@endsection