$(document).ready(function(){
    const btnDeleteRoom = $("#btn-delete-room");
    const maPhong = getParamPrefix();    
    const thongTinPhong = (MaPhong)=>{
        CallApiRoomDetails(MaPhong,(res)=>{
            if(res.success==true)        
                {
                    let data = res.data
                    let s= `<div class="row">
                                <h4 class="heading-bill-title">Thông tin phòng ${data.Ten}</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Mã phòng:</h3>
                                        <span class="detail-bill-heading-name">${data.Ma}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Tầng phòng:</h3>
                                        <span class="detail-bill-heading-name">${data.TenTang}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Số lượng đang ở:</h3>
                                        <span class="detail-bill-heading-name">${10-data.SoLuongTrong}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Trạng thái:</h3>
                                        <span class="detail-bill-heading-name">${data.DangSuaChua ? "Đang sửa chửa":"Đang hoạt động"}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-bill-heading">
                                        <h3 class="detail-bill-heading-title">Trưởng phòng:</h3>
                                        <span class="detail-bill-heading-name">${data.TruongPhong ?? ""}</span>
                                    </div>
                                </div>
                            </div>`                
                    $('#room-details').html(s)            
                    danhSachSinhVienTheoPhong(data.Ma,data.TruongPhong);
                }
                else        
                    handleCreateToast("error",res.message,'er1');
        })       
    }
    btnDeleteRoom.click(function(){
        showMessage("Thông báo","Xác nhận xóa phòng này?",()=>{
            CallApiRoomDelete(maPhong,(res)=>{
                console.log(res)
            },(res)=>{
                console.log(res)
                handleCreateToast("error",res.error,'er-delete',true);
            })
        })
    })

    const apiRoomService = new CallApi(BASE_URL + API_PREFIX_ADMIN + API_PREFIX_SERVICE+API_PREFIX_ROOM_SERVICE_HAS_INDEX+maPhong)
    const tbodyRoomService = $("#room-service-has-index");
    const getServiceHasIndexByRoomId = (roomId)=>{        
        apiRoomService.all((res)=>{
            console.log(res)
            if(res.data.length == 0)
            {
                let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                tbodyRoomService.append(title);
                return;
            }
            res.data.forEach(item=>{
                let row = $(` <tr>
                                <td>${item.MaDichVu}</td>
                                <td>${item.TenDichVu}</td>
                                <td class="tr-index">${item.ChiSoHienTai}</td>
                                <td class="tr-reset-index">                                                       
                                </td>
                            </tr>`)
                if(item.ChiSoHienTai > 0)
                {
                    const btnResetIndex = $(`<button class="btn btn-warning btn-reset-index">Đặt lại</button>`)
                    btnResetIndex.click(()=>{
                        showMessage("Thông báo",`Xác nhận đặt lại chỉ số của dịch vụ ${item.TenDichVu} cho phòng ${maPhong} ?`,
                        ()=>{
                            apiRoomService.patch(item.MaDichVu,undefined,(res)=>{
                                console.log(res)
                                handleCreateToast("success","Cập nhật thành công",null,true)
                                btnResetIndex.remove();
                                row.find(".tr-index").text(0)
                            },(res)=>{
                                console.log(res)
                                handleCreateToast("error",res.error,null,true)
                            })                          
                        })
                    })
                    row.find(".tr-reset-index").append(btnResetIndex);
                }
                tbodyRoomService.append(row)
            });            
        },(res)=>{
            console.log(res)
            $("#table-service").remove()
        })
    }
    const danhSachSinhVienTheoPhong = (MaPhong,TruongPhong)=>{
        $.ajax({        
            url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_STUDENT+API_AUTHEN_STUDENT_BY_ROOM,
            type: 'GET',        
            data:{
                'MaPhong':MaPhong
            },
            success: function (res) {                                       
                if(res.success==true)        
                {
                    let data = res.data
                    showMemberInRoomDetails(MaPhong,data,TruongPhong)                
                }
                else        
                    handleCreateToast("error",res.message,'er1');                
            },
            error: function(xhr, status, error) {
                // handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
                $("#table-student").remove()
            }
        });
    }

    const showMemberInRoomDetails = (MaPhong,data, TruongPhong)=>{
        $('#room-details-members').html('');
        if(data.length==0)
        {
            let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
            $('#room-details-members').append(title);            
            return;
        }
        data.forEach(item=>{
            var row;
            s=`<tr>
                    <td><img src="${item.AnhDaiDien ?? "/img/User.png"}" style="width:100px; height:100px;" /></td>
                    <td>${item.MaSV}</td>
                    <td>${item.Ho} ${item.Ten}</td>
                    <td>${item.Lop ?? ""}</td>
                    <td>${item.SoDienThoai ?? ""}</td>
                    <td>${item.Email ?? ""}</td>
                    <td>${item.TrangThai}</td>`
                    if (TruongPhong == item.MaSV)
                    {
                        s+=`<td class="leader-room td-id"><b class="leader-room-name">Trưởng phòng</b></td></tr>`
                        row=$(s);                    
                    }
                    else
                    {
                        s+=`<td class="td-id"><button value="${item.MaSV}" class="btn_xacnhan">Đổi trưởng phòng</button></td></tr>`
                        row=$(s);
                        row.find(".btn_xacnhan").click(()=>{
                            doiTruongPhong(MaPhong,item.MaSV,(res)=>{
                                if(res.success==true)        
                                {        
                                   showMessage("Thành công","Đổi trưởng phòng thành công!!!",()=>{
                                    location.reload();
                                   },false)     
                                }
                                else        
                                    handleCreateToast("error",res.message,'er1',true); 
                            })
                        })
                    }   
            row.find(".td-id").data("id",item.MaSV);                        
            $('#room-details-members').append(row)
        })       
    }
    thongTinPhong(maPhong)
    getServiceHasIndexByRoomId(maPhong)
})