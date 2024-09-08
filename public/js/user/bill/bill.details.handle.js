$(()=>{
    const maHoaDon = getParamPrefix()
    const xemChiTietHoaDon = (MaHoaDon)=>{                                    
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_BILL+API_AUTHEN_BILL_DETAILS,
            type: 'GET', 
            data: { "MaHoaDon": MaHoaDon},
            success: function (res) {                
                if(res.success==true)                    
                    {
                        let hoaDon = res.data.hoadon
                        let s =`<div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Mã hóa đơn:</h3>
                                        <span class="detail-bill-heading-name">${hoaDon.MaHoaDon}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Mã phòng:</h3>
                                        <span class="detail-bill-heading-name">${hoaDon.MaPhong}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Ngày tạo:</h3>
                                        <span class="detail-bill-heading-name">${hoaDon.NgayTao}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Thành tiền:</h3>
                                        <span class="detail-bill-heading-name">${parseInt(hoaDon.ThanhTien).toLocaleString('de-DE')}đ</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Người tạo:</h3>
                                        <span class="detail-bill-heading-name">${hoaDon.NguoiTao}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Trạng thái:</h3>
                                        <span class="detail-bill-heading-name" id = "bill-status">${hoaDon.TrangThai}</span>
                                    </div>
                                </div>`
                        $('#bill-info').html(s)
                        s='';
                        let cthd = res.data.chitiethoadon;
                        cthd.forEach(item=>{
                            s+=`<tr>
                                    <td>${item.MaDichVu}</td>
                                    <td>${item.TenDichVu}</td>
                                    <td>${parseInt(item.DonGia).toLocaleString('de-DE')}đ</td>
                                    <td>${item.SoLuong}</td>
                                    <td>${parseInt(item.DonGia * item.SoLuong).toLocaleString('de-DE')}đ</td>
                                </tr>`
                        })
                        $('#bill-details').html(s)                        
                        if(hoaDon.TrangThai=="Chưa thanh toán")
                        {                            
                            buildEventReportBill(MaHoaDon);
                        }
                        else if (hoaDon.TrangThai == "Không chính xác")
                        {
                            buildEventCancelReportBill(MaHoaDon);
                        }
                    }                
                else        
                {
                    $('.sidebar-right-content-heading-name').text(res.message)
                    $('.container-fluid').remove();
                }
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗI");
            }
        }); 
    }
    const buildEventCancelReportBill = (MaHoaDon)=>{
        $('#report-bill').html('<button class="open_btn btn_xacnhan btn btn-primary">Hủy báo cáo</button>')
        $('.btn_xacnhan').on("click",()=>{            
            cancelReportBill(MaHoaDon,function(){
                buildEventReportBill(MaHoaDon);
            });            
        })     
    }
    const buildEventReportBill = (MaHoaDon)=>{
        $('#report-bill').html('<button class="open_btn btn_xacnhan btn btn-primary">Báo cáo sai sót</button>')
        $('.btn_xacnhan').on("click",()=>{
            baoCaoHoaDonKhongChinhXac(MaHoaDon,function(){{
                buildEventCancelReportBill(MaHoaDon);
            }});
        })  
    }
    xemChiTietHoaDon(maHoaDon);
})