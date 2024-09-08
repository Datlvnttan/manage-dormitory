const CallApiDeleteDamageReport = (MaKhaiBao, func_success, func_fail)=>{
    $.ajax({
        url: BASE_URL+API_PREFIX_USER+API_PREFIX_USER_DAMAGE+MaKhaiBao,
        type: 'DELETE',        
        success: function (res) {                                              
           if(typeof func_success === "function")
                func_success(res)
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
                func_fail(xhr)
            //handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        }
    }); 
}