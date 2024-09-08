$(()=>{
    const api = new CallApi(BASE_URL+API_PREFIX_USER+PREFIX_CONTRACT)
    api.get((res)=>{
        let data = res.data        
        let s= `<div class="col-lg-3">
                <img src="${data.AnhDaiDien ?? URL_HOST+"img/User.png"}" alt="ảnh" class="Approval-user-img w-100" />
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Mã hợp đồng:</h3>
                            <span class="detail-bill-heading-name">${data.MaHopDong}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Người tạo:</h3>
                            <span class="detail-bill-heading-name">${data.NguoiTao}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Mã sinh viên:</h3>
                            <span class="detail-bill-heading-name">${data.MaSV}</span>
                        </div>
                    </div>                   
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Ngày tạo:</h3>
                            <span class="detail-bill-heading-name">${ConvertDateTimeToString(data.NgayTao)}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Ngày bắt đầu:</h3>
                            <span class="detail-bill-heading-name">${data.NgayBatDau}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Ngày kết thúc:</h3>
                            <span class="detail-bill-heading-name">${data.NgayKetThuc}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Trạng thái:</h3>
                            <span id="contract-status" class="detail-bill-heading-name">${data.TrangThai}</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="detail-bill-heading">
                            <h3 class="detail-bill-heading-title">Thanh toán:</h3>
                            <span id="contract-pay"  class="detail-bill-heading-name">${data.DaThanhToan == 0?"Chưa thanh toán":"Đã thanh toán"}</span>
                        </div>
                    </div>
                    
                    ${data.TrangThai == "Chưa hiệu lực" ? `<h4><br><br><br><center>Vui lòng thanh toán hợp đồng để hoàn tất quá trình đăng ký, hợp đồng sẽ tự động bị hủy bỏ trong vòng 7 ngày!!!</center></h4>` : ""}
                </div>
            </div>`;                                    
            $('#contract-details').html(s); 
    },(res)=>{
        console.log(res)
    })
})