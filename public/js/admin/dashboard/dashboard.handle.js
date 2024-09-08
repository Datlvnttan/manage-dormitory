$(()=>{
    const tabInfringe =$("#tab-infringe")
    const tabBill =$("#tab-bill")
    const tabReport =$("#tab-report")
    const api = new CallApi(BASE_URL+API_PREFIX_ADMIN);
    api.get((res)=>{
        tabReport.html("")
        if(res.data.length==0)
        {
            tabReport.html(`<center><h2>Không có báo cáo mới trong tháng này</h2></center>`)
            return 
        }
        res.data.forEach(item => {
            const itemElement = $(`<div class="sidebar-right-content-bill">
                                    <div class="sidebar-right-content-bill-left">
                                        <i class="fa fa-bullhorn"></i>
                                        <div class="sidebar-right-content-bill-left-info">
                                            <div class="bill-left-info-name">
                                                Báo cáo hỏng đồ
                                            </div>
                                            <div class="bill-left-info-des">
                                                Từ: <span>${item.TenPhong}</span>
                                            </div>
                                            <div class="bill-left-info-des">
                                                Ngày: <span>${ConvertDateToString(item.NgayYeuCau)}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-right-content-bill-right">
                                        <a href="${URL_HOST}admin/huhongsuachua/xu-ly-khai-bao-hu-hong/${item.MaKhaiBao}" class="sidebar-right-content-bill-right-detail">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>`)
            tabReport.append(itemElement)
        });
    },(res)=>{
        tabReport.remove()
        $("#click-tab-report").remove()
    },{
        tatCa:false,
        thangHienTai:true,
        chuaXuLy:true,
        paginate:false
    },API_PREFIX_ADMIN_DAMAGE+API_AUTHEN_DAMAGE_EQUIPMENT_LIST)


    api.get((res)=>{
        tabInfringe.html("")
        if(res.data.length==0)
        {
            tabInfringe.html(`<center><h2>Không có đăng ký mới trong tháng này</h2></center>`)
            return 
        }
        res.data.forEach(item => {
            const itemElement = $(`<div class="sidebar-right-content-violent">
                                    <div class="sidebar-right-content-violent-left">
                                        <i class="fa-light fa-circle-minus"></i>
                                        <div class="sidebar-right-content-bill-left-info">
                                            <div class="bill-left-info-name">
                                                ${item.HoSV} ${item.TenSV}
                                            </div>
                                            <div class="bill-left-info-content">
                                                Từ : <span>${item.TenPhongCu}</span> -><span>${item.TenPhongMoi}</span>
                                            </div>                                           
                                            <div class="bill-left-info-des">
                                                Day: <span>${ConvertDateToString(item.NgayDangKy)}</span>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="sidebar-right-content-violent-right">
                                        <a href="/admin/lich-su-chuyen-phong" class="sidebar-right-content-bill-right-detail">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>`)
            tabInfringe.append(itemElement)
        });
    },(res)=>{
        console.log(res)
        tabInfringe.remove()
        $("#click-tab-change-room").remove()
    },{
        filter:{
            tatCa:false,
            thangHienTai:true,
            choXetDuyet:true,            
        }
        ,paginate:false
    },API_PREFIX_ROOM+API_AUTHEN_CHANGE_ROOM_HISTORY)

    api.get((res)=>{        
        console.log(res)
        if(res.data.length==0)
        {
            tabBill.html(`<center><h2>Không còn hóa đơn chưa thánh toán trong tháng này</h2></center>`)
            return 
        }
        tabBill.html("")
        res.data.forEach(item => {
            const itemElement = $(`<div class="sidebar-right-content-bill">
                                    <div class="sidebar-right-content-bill-left">
                                        <i class="fa-light fa-memo"></i>
                                        <div class="sidebar-right-content-bill-left-info">
                                            <div class="bill-left-info-name">
                                                Phòng ${item.TenPhong}
                                            </div>
                                            <div class="bill-left-info-des">
                                                Thành tiền : <span> ${item.ThanhTien}</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="sidebar-right-content-bill-right">
                                        <a href="#" class="sidebar-right-content-bill-right-detail">
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>`)
            tabBill.append(itemElement)
        });
    },(res)=>{
        console.log(res)
        tabBill.remove()
        $("#click-tab-bill").remove()
    },{
        tatCa:false,
        daThanhToan:false,
        chuaThanhToan:true,
        khongChinhXac:true, 
        paginate:false
    },API_PREFIX_BILL+API_AUTHEN_BILL_LIST)

})