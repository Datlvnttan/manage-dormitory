$(document).ready(function(){    


    const createEventCancelRegisterChangeRoom = (btnCancel,MaDangKy)=>{
        btnCancel.click(()=>{
            showMessage("Thông báo","Bạn có chắc chắn muốn xóa bỏ yêu cầu đăng ký chuyển phòng này?",()=>{
                CallApiChangeRoomDelete(MaDangKy,(res)=>{
                    console.log(res)
                    showMessage("Thành công","Xóa thông tin đăng ký chuyển phòng thành công",()=>{
                        location.reload();
                    },false)
                },(res)=>{
                    console.log(res);
                    if(res.message)
                        showMessage("Xóa không thành công",res.message,()=>{
                            location.reload();
                        },false)                                   
                    else
                        errorValidate.text(res.error);
                })
            })
        }) 
    }

    const checkPhong = ()=>{
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_AUTHEN_GET_INFO_SUB,
            type: 'GET',        
            success: function (res) {                              
            var element = null;   
            let data = res.data;
            // var optionALl = document.querySelectorAll(".nccALL");
            // select.on("change",function(){
            //     var options = document.querySelectorAll(".ncc"+select.value);
            //     optionALl.forEach(item=>{
            //         item.style.display = 'none'
            //     })
            //     options.forEach(item=>{
            //         item.style.display = 'block'
            //     })
            // })
            if(res.status==1)        
            {    
                let s = '';
                if(data.dangkychuyenphong == null)
                         s=`<div class="room-info-content-none-room" data-bs-toggle="modal" data-bs-target="#modal-change-room">
                                <p>Đang ở</p> 
                                <i class="fa-light fa-pen-to-square"></i><br>
                                <center>
                                    <button class="change-room btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-change-room">Chuyển phòng</button>                                    
                                </center>                                
                            </div>
                            <div class="room-info-content-room-detail">
                                <ul class="info-room-list">
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">${data.data.TenKhu}</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">${data.data.TenTang}</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">${data.data.TenPhong}</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">${data.count}</span>
                                    </li>
                                </ul>
                            </div>`
                else
                    s=`<div class="room-info-content-none-room" >
                            <p>Đã đăng ký</p>                            
                            <p class="change-room">chuyển phòng</p>
                            <center>
                                <button class="change-room btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-change-room">Thay đổi</button>
                                <button class="btn-delete btn btn-warning">Xóa</button><br>                                
                            </center>
                        </div>
                        <div class="room-info-content-room-detail">
                            <ul class="info-room-list">
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Thông tin phòng muốn chuyển</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">${data.dangkychuyenphong.TenKhu}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">${data.dangkychuyenphong.TenTang}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">${data.dangkychuyenphong.TenPhong}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">${data.count}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Lý do chuyển</span> : <span class="info-room-item-name">${data.dangkychuyenphong.LyDo}</span>
                                </li>
                            </ul>
                        </div>`
                s+=`<div class="modal fade" id="modal-change-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                            Chọn phòng mà bạn muốn thay đổi
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST" id="form-change-room">
                                <div class="modal-body" style="">                
                                    <div class="p-lg-2">
                                        <div class="profile--form__text-field">
                                            <label for="room-khu">Phòng</label>
                                            <select name="MaPhong" class="filter-select active">
                                                <option value=""> -- Tất cả -- </option>                        
                                            </select>                          
                                        </div>
                                        <div class="profile--form__text-field">
                                            <label for="room-khu">Lý do đổi phòng:</label>
                                            <textarea name="LyDo" id="" cols="30" rows="10" class="input active w-100" placeholder="Lý do muốn chuyển phòng">${data.dangkychuyenphong ? data.dangkychuyenphong.LyDo : ""}</textarea>                          
                                        </div>
                                        <div class="row">
                                            <span class="error-validate"></span>
                                        </div>                                            
                                    </div>
                                </div>
                                <div class="modal-footer">   
                                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</a>
                                    <button type="submit" id="btn-confirm-change-room" class="btn btn-primary">Xác nhận</button>                  
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>`            
                element = $(s);     
                const elementSelect = element.find(`select[name="MaPhong"]`);
                const errorValidate = element.find(".error-validate");
                danhSachPhongTrong((res)=>{                    
                    let s= '';
                    res.data.forEach(item => {
                        s+=`<option ${data.dangkychuyenphong ? (data.dangkychuyenphong.MaPhong.trim() == item.MaPhong.trim() ? "selected" :"") : ""} value="${item.MaPhong.trim()}">${item.Ten} (${item.SoLuongTrong} trống)</option>`
                    });
                    elementSelect.html(s); 
                },(res)=>{                    
                    handleCreateToast("error",res.error,null,true);
                });      
                const formChangeRoom = element.find("#form-change-room");
                if(data.dangkychuyenphong == null)     
                {                                       
                    formChangeRoom.on("submit",function(ev){
                        ev.preventDefault();
                        showMessage("Thông báo","Xác nhận thay đổi phòng?",()=>{
                            let fromData = formChangeRoom.serialize();
                            CallApiSendChangeRoom(fromData,(res)=>{
                                console.log(res)
                                showMessage("Thành công","Đăng ký chuyển phòng thành công, vui lòng chờ xét duyệt của quản lý",()=>{
                                    location.reload();
                                },false)
                            },(res)=>{
                                console.log(res);
                                if(res.message)
                                    showMessage("Không thành công",res.message)
                                else
                                    errorValidate.text(res.error);
                            })
                        })
                    })                                      
                }  
                else
                {
                    formChangeRoom.on("submit",function(ev){
                        ev.preventDefault();
                        showMessage("Thông báo","Xác nhận cập nhật thông tin thay đổi phòng?",()=>{
                            let fromData = formChangeRoom.serialize();
                            console.log(data.dangkychuyenphong)
                            CallApiChangeRoomUpdate(data.dangkychuyenphong.MaDangKy,fromData,(res)=>{
                                showMessage("Thành công","Cập nhật thông tin đăng ký chuyển phòng thành công, vui lòng chờ xét duyệt của quản lý",()=>{
                                    location.reload();
                                },false)
                            },(res)=>{
                                console.log(res);
                                if(res.message)
                                   handleCreateToast("info",res.message,"message-change-room",true);
                                else
                                    errorValidate.text(res.error);
                            })
                        })
                    }) 
                    createEventCancelRegisterChangeRoom(element.find(".btn-delete"),data.dangkychuyenphong.MaDangKy)   
                }  
            }
            else if(res.status==0)        
            {	
                element = $(`<a class="room-info-content-none-room">
                                    <p>Đã xét duyệt</p>
                                    <i class="fa-light fa-pen-to-square"></i><br>
                                    <button class="btn btn-warning btn-cancel-register">Hủy bỏ</button>
                                </a>
                                <div class="room-info-content-room-detail">
                                    <ul class="info-room-list">
                                        <li class="info-room-item">
                                            <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">${data.dangky.TenKhu}</span>
                                        </li>
                                        <li class="info-room-item">
                                            <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">${data.dangky.TenTang}</span>
                                        </li>
                                        <li class="info-room-item">
                                            <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">${data.dangky.TenPhong}</span>
                                        </li>
                                        <li class="info-room-item">
                                            <span class="info-room-item-title">Vui lòng thanh toán hợp đồng, để hoàn tất quá trình đăng ký</span>
                                            <br>                                    
                                            <center><span style=" font-style: italic; font-weight:500; font-size:15px;">Trong vòng 7 ngày nếu bạn không hoàn tất thủ tục, <br>yêu cầu này sẽ bị hủy bỏ</span></center>
                                        </li>
                                    </ul>                                    
                                </div>`);                        
                element.find(".btn-cancel-register").click(()=>{
                    toggleModal()
                })
            }	
            else if(res.status==-1)        
            {	
                element = $(`<div class="room-info-content-none-room" >
                        <p>Chờ xét duyệt</p>
                        <i class="fa-light fa-pen-to-square"></i><br>
                        <div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-change-room-register">Thay đổi</button>
                            <button class="btn btn-warning btn-delete">Xóa</button>
                        </div>
                    </div>
                        <div class="room-info-content-room-detail">
                            <ul class="info-room-list">
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">${data.dangky.TenKhu}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">${data.dangky.TenTang}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">${data.dangky.TenPhong}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">${data.count}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Lượt đăng ký</span> : <span class="info-room-item-name">${data.subcount}</span>
                                </li>
                            </ul>
                        </div>`);
                const form_register_residence = $("#form_register_residence");
                // danhSachPhongTrong((res)=>{        
                //     let s= '';
                //     res.data.forEach(item => {
                //         s+=`<option value="${item.MaPhong.trim()}">${item.Ten} (${item.SoLuongTrong} chổ) (${item.LuotDangKy} đăng ký mới)</option>`
                //     });
                //     select_choose_room.html(s); 
                // },(res)=>{
                //     console.log(res)
                //     handleCreateToast("error",res.error,null,true);
                // });
                form_register_residence.on("submit",function(ev){        
                    ev.preventDefault();             
                    showMessage("Bạn muốn thay đổi đăng ký nội trú của mình thành phòng "+select_choose_room.val(), "Xác nhận chọn phòng này, cho dù phòng này có vượt quá số lượng đăng ký?",function(){            
                        let fromData = form_register_residence.serialize();
                        $.ajax({
                            url: BASE_URL + API_PREFIX_USER +API_AUTHEN_REGISTER_RESIDENCE + API_AUTHEN_CHANGE_ROOM,
                            type: 'PUT',        
                            data:fromData,
                            success: function (res) {
                                showMessage("Thành công","Thay đổi phòng thành công!",function(){
                                location.reload();
                                },false)   
                            },
                            error: function (xhr, status, error) {
                                console.log(xhr)
                                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
                            }
                        }); 
                    });        
                })                
                element.find(".btn-delete").click(()=>{
                    showMessage("Thông báo","Xác nhận hủy bỏ đăng ký chuyển phòng này?",()=>{
                        new CallApi(BASE_URL + API_PREFIX_USER +API_AUTHEN_REGISTER_RESIDENCE+ API_AUTHEN_CANCEL_BOARDING_REGISTRANTION)
                        .delete("",(res)=>{
                            showMessage("Thành công","Bạn đã xóa đăng ký nội trú thành công",()=>{
                                location.reload();
                            },false)
                        },(res)=>{
                            console.log(res)
                        })
                    })
                })
            }	
            else if(res.status==-2)        
            {	
                element = $(`<a href="/user/dangkynoitru/dang-ky-noi-tru" class="room-info-content-none-room">
                        <p>Bị hủy</p>
                        <i class="fa-light fa-pen-to-square"></i> <br>
                        <p> Đăng ký lại </p>
                    </a>
                        <div class="room-info-content-room-detail">
                            <ul class="info-room-list">                           
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">${data.dangky.MaPhong}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">${data.count}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Lượt đăng ký</span> : <span class="info-room-item-name">${data.subcount}</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Lý do hủy</span> : <span class="info-room-item-name">${data.dangky.GhiChu}</span>
                                </li>
                            </ul>
                        </div>`);
            }	
            else if(res.status==-3)
                element = $(`<a href="/user/dangkynoitru/dang-ky-noi-tru" class="room-info-content-none-room">
                            <i class="fa-regular fa-plus"></i>
                            <p>Đăng ký phòng</p>
                        </a>
                        <div class="room-info-content-room-detail">
                            <ul class="info-room-list">
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                </li>
                                <li class="info-room-item">
                                    <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                </li>
                            </ul>
                        </div>`);
            else
                element = $(`<div class="room-info-content-none-room">
                                <p>Chưa mở đợt đăng ký</p>
                                <i class="fa-regular fa-plus"></i>
                                <p>Vui lòng chờ</p>
                            </div>
                            <div class="room-info-content-room-detail">
                                <ul class="info-room-list">
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Khu</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Tầng</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Phòng</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                    </li>
                                    <li class="info-room-item">
                                        <span class="info-room-item-title">Đang ở</span> : <span class="info-room-item-name">Chưa đăng ký</span>
                                    </li>
                                </ul>
                            </div>`);
            $('.room-info').append(element);		           
            },
            error: function (xhr, status, error) {
                // console.log(xhr)
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        });          
    }


    const apiService = new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_SERVICE+API_AUTHEN_USE_RETAIL_SERVICE)
    const boxServiceSigninContact = $("#service-signin-contact")
    const boxServiceSignup = $("#service-signup-service")
    const selectServiceIds = $("#select-service-id")
    const btnRegisterService = $("#btn-register-service")
    const modalRegisterService = $("#modal-register-service")
    const boxServiceWaitingReview = $("#service-waiting-review")

    const buildItemService = (item)=>{
        return $(`<div class="service-item" id="div-service-${item.MaDichVu}">
        <i class="fa-regular fa-bicycle"></i>
        <center class="service-item-name">${item.TenDichVu} - ${parseInt(item.GiaHienTai).toLocaleString('de-DE')}đ</center>
    </div>`)
    }
    const buildEventItemServiceSignup = (itemElement,item)=>{        
        boxServiceSignup.append(itemElement)                    
        selectServiceIds.append(`<option id="option-service-${item.MaDichVu}" value="${item.MaDichVu}">${item.TenDichVu} - ${parseInt(item.GiaHienTai).toLocaleString('de-DE')}đ</option>`)
        itemElement.click(()=>{
            modalRegisterService.modal("show")
        })
    }

   
    const getService = ()=>{
        apiService.all((res)=>{
            console.log(res)
            let conutServiceSignup = 0
            let conutServiceWaitingReview = 0
            let conutServiceSignin = 0
            res.data.forEach(item=>{
                const itemElement = buildItemService(item)
                if(item.DangSuDung == true)
                {
                    boxServiceSigninContact.append(itemElement)
                    conutServiceSignin++
                }                
                else if(item.NgayDangKy == null)
                {
                    conutServiceSignup++;
                    buildEventItemServiceSignup(itemElement,item)
                }
                else
                {
                    conutServiceWaitingReview++;                    
                    const btnCancelService = $(`<center><button class="btn btn-outline-secondary btn-cancel-service">Hủy đăng ký</button></center>`)
                    btnCancelService.click(()=>{
                        showMessage("Thông báo",`Xác nhận hủy đăng ký dịch vụ "${item.TenDichVu}" ?`,()=>{
                            apiService.delete(item.MaDichVu,(res)=>{
                                //handleCreateToast("success","Hủy đăng ký thành công",null,true)
                                itemElement.remove();
                                // if(boxServiceWaitingReview.find(".service-item").length==0)
                                // {                                    
                                //     buildServiceWaitingReviewNone();
                                //     boxServiceSignup.find(".service-signup-none").remove();                                    
                                //     buildEventItemServiceSignup(buildItemService(item),item);
                                // }
                                showMessage("Thành công","Hủy đăng ký thành công",()=>{
                                    location.reload();
                                },false)
                            },(res)=>{
                                console.log(res)
                                handleCreateToast("error",res.error,"error-2",true)
                            })
                        })
                    })
                    itemElement.append(btnCancelService)
                    boxServiceWaitingReview.append(itemElement)
                }                       
            })
            if(conutServiceSignin == 0)
            {
                buildBoxServiceSigninNone(conutServiceSignup)
            }
            if(conutServiceWaitingReview == 0)
            {
                buildServiceWaitingReviewNone(conutServiceSignup);
            }
            if(conutServiceSignup == 0)
            {
                buildServiceSignupNone()
            }
            else
            {
                btnRegisterService.click(()=>{
                    showMessage("Thông báo",`Xác nhận đăng ký dịch vụ ${selectServiceIds.find(`option:selected`).text()} ?`,()=>{
                        apiService.create({
                            MaDichVu:selectServiceIds.val()
                        },(res)=>{
                            console.log(res)
                            showMessage("success","Đăng ký thành công, vui lòng thanh toán để hoàn tất quá trình đăng ký!!!",()=>{
                                location.reload()
                            },false);
                            modalRegisterService.modal("hide")
                            // $(`#div-service-${selectServiceIds.val()}`).remove()
                            // $(`#option-service-${selectServiceIds.val()}`).remove()
                            // if(boxServiceSignup.find(".service-item").length==0)
                            //     buildServiceSignupNone()
                        },(res)=>{
                            console.log(res)
                            handleCreateToast("error",res.error,"error-1",true)
                        })
                    })
                })
            }            
            boxServiceSigninContact.slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                arrows: false,                    
            });
            boxServiceWaitingReview.slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                arrows: false,                    
            });
            boxServiceSignup.slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                arrows: false,                    
            });
            
        },(res)=>{
            $("#box-service").remove()
            // console.log(res)
        })        
    }   



    const buildBoxServiceSigninNone = (conutServiceSignup)=>{
        boxServiceSigninContact.html(`<div class="service-item">
                                        <i class="fa-regular fa-bicycle"></i>
                                        <center class="service-item-name">Bạn chưa đăng ký dịch vụ nào <br>
                                            ${conutServiceSignup > 0? `<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-register-service">Đăng ký ngay</button>` :""}
                                        </center>
                                    </div>`)
    }
    const buildServiceWaitingReviewNone = (conutServiceSignup)=>{
        boxServiceWaitingReview.html(`<div class="service-item">
                                        <i class="fa-regular fa-bicycle"></i>
                                        <center class="service-item-name">Bạn chưa gửi yêu cầu đăng ký dịch vụ mới nà0 <br>
                                             ${conutServiceSignup > 0? `<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-register-service">Đăng ký ngay</button>` :""}
                                        </center>
                                    </div>`)
    }
    const buildServiceSignupNone = ()=>{
        boxServiceSignup.html(`<div class="service-item service-signup-none">
                                                <i class="fa-regular fa-bicycle"></i>
                                                <center class="service-item-name">Không có dịch vụ nào mà bạn chưa đăng ký</center>
                                            </div>`)
    }


    const getMemberInRoom = () =>{
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_STUDENT+API_AUTHEN_STUDENT_BY_ROOM,
            type: 'GET',        
            success: function (res) {                   
                if(res.success==true)        
                    {     
                        let data = res.data                          
                        let s= ''
                        let i = 1;
                        data.forEach(item=>{
                            s+=`<tr>
                                    <td>${i++}</td>                                
                                    <td>${item.MaSV}</td>
                                    <td>${item.Ho} ${item.Ten}</td>
                                    <td>${item.Lop ?? ""}</td>
                                    <td>${item.SoDienThoai ? item.SoDienThoai : item.Email ? item.Email : ""}</td>                                
                                </tr>`
                        })                    
                        $('#room-member-list').html(s)               
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                // handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        });
    }
    checkPhong();
    getMemberInRoom()
    getService()
})