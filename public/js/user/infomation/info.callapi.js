const huyDangKyNoiTru = (formData)=>{
    $.ajax({
        url: BASE_URL + API_PREFIX_USER +API_AUTHEN_REGISTER_RESIDENCE+ API_AUTHEN_CANCEL_BOARDING_REGISTRANTION,
        type: 'POST',
        data: formData,
        success: function (res) {
            if(res.success==true)        
            {
                handleCreateToast("success",res.message);                
                showMessage("Thành công","Bạn đã hủy yêu cầu thành công",function()
                {
                    location.reload();
                },false)                 
            }
            else
                handleCreateToast("error",res.message);                
        },
        error: function (xhr, status, error) {
            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        }
    });   													 
}