$(document).ready(function(){
    const khu = $("#khu");
    const tang = $("#tang");
    const roomKhu = $("#room-khu")
    const roomTang = $("#room-tang")
    const btnFilter = $("#btn-filter");
    const roomId = $("#room-id")
    const roomName = $("#room-name")
    const roomCapacity = $("#room-capacity")
    const btnAddRoom = $("#btn-add-room")
    const btnSaveRoom = $("#btn-save-room");
    const formEditRoom = $("#form-edit-room");
    const error = $("#error");
    formEditRoom.on('submit',(ev)=>{
        ev.preventDefault();
        let fromData = formEditRoom.serialize();        
        btnSaveRoom.prop("disabled", true);
        let maphong = btnSaveRoom.data("update-id");        
        showMessage("Thông báo","Xác nhận cập nhật dữ liệu?",function(){
            
            return maphong ? 
                CallApiRoomPut(fromData,maphong,(res)=>{    
                    console.log(res)            
                    showMessage("Thành công","Cập nhật thông tin phòng thành công",()=>{
                        location.reload()
                        btnSaveRoom.prop("disabled", false);
                    },false)
                },(res)=>{
                    console.log(res)
                    error.text(res.error)
                    btnSaveRoom.prop("disabled", false);
                }):
                CallApiRoomPost(fromData,(res)=>{
                    console.log(res)
                    showMessage("Thành công","Thêm phòng thành công",()=>{
                        location.reload()
                        btnSaveRoom.prop("disabled", false);
                    },false)
                },(res)=>{
                    console.log(res)
                    error.text(res.error)
                    btnSaveRoom.prop("disabled", false);
                })       
        })
         
        // $.post(BASE_URL+API_AUTHEN+API_AUTHEN_LOGIN,fromData,function(res){                                        
        //         if(res.success==true)        
        //             location.replace(res.url)
        //     else
        //         handleCreateToast("error",res.message);
        // })
    })
    const setInput = (data = null)=>{
        roomId.prop("readonly",true)
        if(data != null)
        {
            roomKhu.find(`option[value='${data.MaKhu}']`).prop('selected', true);                            
                            // roomKhu.trigger("change")
            reloadTang("room-khu","room-tang","room-phong",data.MaTang);
            btnSaveRoom.data("update-id",data.Ma)                         
        }
        else
        {            
            btnSaveRoom.data("update-id",undefined)
        }
        roomId.val(data ? data.Ma : "")
        roomName.val(data ? data.Ten : "")
        roomCapacity.val(data ? data.SucChua : "")        
    }
    btnAddRoom.click(function(){
        setInput()
    })
    const getData = ()=>{
        return {
            MaPhong:roomId.val(),
            TenPhong:roomName.val(),
            SucChua:roomCapacity.val()
        }
    }
    var danhSachPhong = (page,numpages)=>{
        let data = {
                'khu':khu.val(),
                'tang':tang.val(),
                'page':page,
                'numpages':numpages
            };
        CallApiRoom(data,(res)=>{            
            if(res.success==true)        
            {            
                $('#room-list').html('');
                if(res.data.length == 0)
                {
                    $('#pagination').html("");                    
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#room-list').append(title);
                    return;
                }    
                res.data.forEach(item=>{
                    let s = `<div class="col-lg-6">
                            <div class="sidebar-right-list-room-item">
                                <div class="sidebar-right-list-room-item-left">
                                    <div class="list-room-item-left-status">
                                        <span class="dot-status" style="background-color: #00c000;"></span>
                                        Đang sử dụng
                                    </div>
                                    <div class="list-room-item-left-name">${item.Ten}</div>
                                    <div class="list-room-item-left-type">
                                        <h2>Khu: ${item.TenKhu} - ${item.DoiTuong}</h2>                                        
                                    </div>
                                    <div class="list-room-item-left-number_people">
                                        Số sinh viên
                                        <i class="fa-light fa-user"></i>:
                                        <span>${item.SucChua-item.SoLuongTrong}</span>
                                    </div>
                                </div>
                                <div class="sidebar-right-list-room-item-right">
                                    <div class="list-room-item-right-floor">
                                        <span> ${item.TenTang}</span>
                                        <i class="fa-light fa-escalator"></i>
                                    </div>
                                    <div class="list-room-item-right-img">
                                        <img src="${URL_HOST}img/list-house.png" alt="">
                                    </div>
                                    <div class="list-room-item-right-option">
                                        <a href="quanlyphong/${item.Ma}" class="list-room-item-right-detail">Xem chi tiết</a>
                                        <a data-bs-toggle="modal" data-bs-target="#modal-edit-room" class="list-room-item-right-edit">Chỉnh sửa</a>                                        
                                    </div>
                                </div>
                            </div>
                        </div>`
                    const row = $(s);
                    row.find(".list-room-item-right-edit").click(function(){
                        CallApiRoomDetails(item.Ma,(res)=>{
                            console.log(res)
                            setInput(res.data);
                        })
                    })
                    $('#room-list').append(row);      
                })                                                 
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    danhSachPhong(page,numpages)
                }) 
            }
            else        
                handleCreateToast("error",res.message,'er1');     
        },(res)=>{
            console.log(res)
        })           
    }
    danhSachPhong(getPage());     
    btnFilter.click(function(){
        
        danhSachPhong(1);  
    })     
    createInputNumber(roomCapacity,0,999999,true);
})