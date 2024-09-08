$(()=>{
    const btnFilter = $("#btn_loc");
    const inputKhu = $("#khu");    
    const inputTang = $("#tang");
    const inputPhong = $("#phong");
    const inputThangHienTai = $("#thangHienTai");
    const inputNam = $("#nam");
    const inputThang = $("#thang");
    const inputChoXetDuyet = $("#choXetDuyet");
    const inputDangSuDung = $("#dangSuDung");
    new BuildFontendRestFullApi(BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_SERVICE_PERSONAL,
        "#tbody-show-service-personal",null,null,["MaDichVu","MaSV"],(item,Api)=>{
            return $(`<tr>
                        <td>${item.MaSV}</td>
                        <td>${item.HoSV + " " + item.TenSV}</td>
                        <td>${ConvertDateTimeToString(item.NgayDangKy)}</td>
                        <td>${item.MaDichVu} - ${item.TenDichVu}</td>
                        <td>${parseInt(item.GiaHienTai).toLocaleString("de-DE")}đ</td>
                        <td>${item.DangSuDung ? "Đang sử dụng" : "Chờ xét duyệt"}</td>                    
                        <td>
                            ${!item.DangSuDung ? `<button class="btn btn-primary btn-update">Duyệt</button>` : ""}
                            <button class="btn btn-warning btn-destroy">Hủy</button>
                        </td>
                    </tr>`)
        },null,null,()=>{
            return {
                dataFilter:{
                    "tatCa":showAllHD.is(":checked"),
                    "khu":inputKhu.val(),
                    "tang":inputTang.val(),
                    "phong":inputPhong.val(),
                    "thangHienTai":inputThangHienTai.is(":checked"),
                    "nam":inputNam.val(),
                    "thang":inputThang.val(),
                    "choXetDuyet":inputChoXetDuyet.is(":checked"),
                    "dangSuDung":inputDangSuDung.is(":checked"),  
                },
                btnFilter:btnFilter
            }
        },(item,itemElementUI,Api,self)=>{
            showMessage("Thông báo","Xác nhận xét duyệt cho sinh viên đăng ký dùng dịch vụ "+item.TenDichVu+" ?",
                ()=>{
                    // alert(self.getPrefixWithPrimaryKey(item))
                    Api.patch(self.getPrefixWithPrimaryKey(item),undefined,(res)=>{
                        handleCreateToast("success","Thao tác thành công",null,true)
                        self.callCompleted = true;
                    },(res)=>{                        
                        self.callCompleted = null;
                        handleCreateToast("error",res.error,null,true)
                    })                                        
                })
            return true;
        },(item,itemElementUI,Api,self)=>{
            showMessage("Thông báo",`Xác nhận hủy bỏ đăng ký sử dụng dịch vụ "${item.TenDichVu}" của sinh viên ${item.MaSV}`+item.TenDichVu+" ?",
                ()=>{                    
                    Api.delete(self.getPrefixWithPrimaryKey(item),(res)=>{
                        handleCreateToast("success","Hủy đăng ký thành công",null,true)                        
                        self.callCompleted = true;
                    },(res)=>{                        
                        handleCreateToast("error",res.error,null,true)
                        self.callCompleted = null;
                    })
                })
            return true;
        }).handle(null,$("#showAllHD"))
})