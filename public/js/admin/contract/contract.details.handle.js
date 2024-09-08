$(()=>{
    const maHopDong = getParamPrefix();    
    const chiTietHopDong = (MaHopDong)=>{
        $.ajax({        
            url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_CONTRACT+API_AUTHEN_CONTRACT_DETAILS,
            type: 'GET',
            data: {'MaHopDong':MaHopDong},
            success: function (res) {              
                console.log(res)         
                if(res.success==true)        
                {        
                    let data =  res.data;
                    let s= `<div class="col-lg-3">
                                    <img src="${data.AnhDaiDien ?? URL_HOST+"img/User.png"}" alt="ảnh" class="Approval-user-img w-100" />
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="detail-bill-heading">
                                                <h3 class="detail-bill-heading-title">Mã hợp dồng:</h3>
                                                <span class="detail-bill-heading-name">${data.MaHopDong}</span>
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
                                                <h3 class="detail-bill-heading-title">Người tạo:</h3>
                                                <span class="detail-bill-heading-name">${data.NguoiTao}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="detail-bill-heading">
                                                <h3 class="detail-bill-heading-title">Ngày tạo:</h3>
                                                <span class="detail-bill-heading-name">${data.NgayTao}</span>
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
                                    </div>
                                </div>`;
                                    
                    $('#contract-details').html(s);   
                    if(data.DaThanhToan==0)   
                    {             
                        $('#browsing-operation').html(`<a id="btn_xacnhan" class="btn btn_xacnhan open_btn btn-primary" value="${MaHopDong}">Xác nhận thanh toán</a>`)                                                                                                                   
                        $('#btn_xacnhan').on("click",()=>{                                                
                            thanhToanHopDong(MaHopDong,function(){                            
                                $('#btn_xacnhan').remove();                            
                                $('#contract-status').text("Có hiệu lực");
                                $('#contract-pay').text("Đã thanh toán");
                            })
                        })
                    }
                    // else
                    // {
                    //     $('#browsing-operation').html(`<a id="btn_xacnhan" class="btn btn-warning" value="${MaHopDong}">Chấm dức hợp đồng</a>`)                                                                                                                   
                    //     $('#btn_xacnhan').on("click",()=>{
                    //         showMessage("Xác nhận chấm dức hợp đồng?","")
                    //         thanhToanHopDong(MaHopDong,function(){                            
                    //             $('#btn_xacnhan').remove();                            
                    //             $('#contract-status').text("Có hiệu lực");
                    //             $('#contract-pay').text("Đã thanh toán");
                    //         })
                    //     })
                    // }
                }
                else        
                    handleCreateToast("error",res.message,'er1');                
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 
    }
    chiTietHopDong(maHopDong)
})