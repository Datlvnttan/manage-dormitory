$(document).ready(function(){        
    const form_register_residence = $("#form_register_residence");
    danhSachPhongTrong((res)=>{        
        let s= '';
        res.data.forEach(item => {
            s+=`<option value="${item.MaPhong.trim()}">${item.Ten} (${item.SoLuongTrong} chổ) (${item.LuotDangKy} đăng ký mới)</option>`
        });
        select_choose_room.html(s); 
    },(res)=>{
        console.log(res)
        handleCreateToast("error",res.error,null,true);
    });
    form_register_residence.on("submit",function(ev){        
        ev.preventDefault();             
        showMessage("Bạn muốn đăng ký nội trú với phòng "+select_choose_room.val(), "Xác nhận chọn phòng này, cho dù phòng này có vượt quá số lượng đăng ký?",function(){            
            let fromData = form_register_residence.serialize();
            location.replace(URL_HOST+API_PREFIX_USER+API_AUTHEN_REGISTER_RESIDENCE+API_AUTHEN_CONFIRM_RESIDENCE+"?"+fromData);
        });        
    })
})