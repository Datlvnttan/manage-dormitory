$(()=>{
    const api = new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_USER_DAMAGE)
    const id = getParamPrefix()
    api.show(id,(res)=>{
        console.log(res)
        let khaiBaoHuHong = res.data.khaibaohuhong
        let xuLyKhaiBaos = res.data.xulykhaibaos
        let s =`<div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Mã khai báo: </h3>
                                        <span class="detail-bill-heading-name"> ${khaiBaoHuHong.MaKhaiBao}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Ngày yêu cầu: </h3>
                                        <span class="detail-bill-heading-name"> ${khaiBaoHuHong.NgayYeuCau}</span>
                                    </div>
                                </div>                                
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Thiết bị: </h3>
                                        <span class="detail-bill-heading-name"> ${khaiBaoHuHong.MaThietBi} - ${khaiBaoHuHong.TenThietBi}</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Số lương khai báo: </h3>
                                        <span class="detail-bill-heading-name"> ${khaiBaoHuHong.TongSoLuong}</span>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title" >Tổng chi phí: </h3>
                                        <span class="detail-bill-heading-name" id="total"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Người xử lý: </h3>
                                        <span class="detail-bill-heading-name"> ${khaiBaoHuHong.NguoiXuLy}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Trạng thái: </h3>
                                        <span class="detail-bill-heading-name" id = "bill-status"> Đã xử lý</span>
                                    </div>
                                </div>`
                        $('#bill-info').html(s);
                        let total = 0;
                        s='';                        
                        xuLyKhaiBaos.forEach(item=>{
                            total+=parseInt(item.ChiPhiPhatSinh);
                            s+=`<tr>
                                    <td>${item.MaXuLy}</td>
                                    <td>${item.SoLuong}</td>
                                    <td>${item.NguyenNhan}</td>
                                    <td>${item.ThayMoi == true ? "Thay mới" : "Sửa chửa"}</td>
                                    <td>${item.ChiPhiPhatSinh ? parseInt(item.ChiPhiPhatSinh).toLocaleString('de-DE') : "0"}đ</td>                                                                        
                                </tr>`
                        })
                        $("#total").text(total.toLocaleString('de-DE')+"đ")
                        $('#bill-details').html(s)                        
                        // if(hoaDon.TrangThai=="Chưa thanh toán")
                        // {                            
                        //     buildEventReportBill(MaHoaDon);
                        // }
                        // else if (hoaDon.TrangThai == "Không chính xác")
                        // {
                        //     buildEventCancelReportBill(MaHoaDon);
                        // }
    },(res)=>{
        console.log(res)
    })

    // ${parseInt(hoaDon.ThanhTien).toLocaleString('de-DE')}đ
})