$(()=>{
    const inputKhu = $("#khu");    
    const inputTang = $("#tang");
    const inputPhong = $("#phong");
    const inputThangHienTai = $("#thangHienTai");
    const inputNam = $("#nam");
    const inputThang = $("#thang");
    const inputChoXetDuyet = $("#choXetDuyet");
    const inputThanhCong = $("#thanhCong");
    const inputThatBai = $("#thatBai");
    const btnFilter = $("#btn_loc");
    inputThangHienTai.prop("checked",true)
    const buildApiFontend =  new BuildFontendRestFullApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ROOM+API_AUTHEN_CHANGE_ROOM_HISTORY,
        ".change-room-history-list",null,null,"MaDangKy",(item)=>{
            return $(`<tr>
                        <td>${item.MaDangKy}</td>
                        <td>${item.MaSV}</td>
                        <td>${item.HoSV} ${item.TenSV}</td>
                        <td>${item.MaPhongCu} - ${item.TenPhongCu}</td>
                        <td>${item.MaPhongMoi} - ${item.TenPhongMoi}</td>
                        <td>${item.NgayDangKy}</td>
                        <td>${item.LyDo}</td>
                        <td class="review-status">${item.TrangThaiXetDuyet}</td>
                        <td>                                                      
                            ${item.TrangThaiXetDuyet == "Chờ xét duyệt" ? 
                            `<button class="open_btn btn_xacnhan btn-update">Duyệt</button><hr>                          
                            <button class="open_btn btn btn-warning btn-destroy">Hủy</button>` : ""}
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
                    "thanhCong":inputThanhCong.is(":checked"),
                    "thatBai":inputThatBai.is(":checked"),    
                },
                btnFilter:btnFilter
            }
        },(item,itemElementUI,Api,self)=>{            
            // alert(self.callCompleted)
            showMessage("Thông báo","Xác nhận xét duyệt chuyển phòng cho sinh viên '"+item.MaSV+"'?",()=>{
                Api.patch(item.MaDangKy,null,(res)=>{
                    handleCreateToast("success","Xét duyệt chuyển phòng thành công",null,true)                                                                       
                },(res)=>{
                    console.log(res)                    
                },API_AUTHEN_AGREE_REGISTER)
            })  
            return true;          
        },(item,itemElementUI,Api,self)=>{
            showMessage("Thông báo","Xác nhận không xét duyệt chuyển phòng cho sinh viên '"+item.MaSV+"'?",()=>{
                Api.patch(item.MaDangKy,null,(res)=>{
                    handleCreateToast("success","Hủy bỏ xét duyệt thành công",null,true)                                                                       
                },(res)=>{
                    console.log(res)                    
                },API_AUTHEN_CANCEL_REGISTER)
            })  
            return true;
        })
    buildApiFontend.handle(null,showAllHD);
})