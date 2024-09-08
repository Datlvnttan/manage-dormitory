var callContractList = (status,page = 0,func_success,func_fail)=>{       
    $.ajax({        
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_CONTRACT+API_AUTHEN_CONTRACT_LIST,
        type: 'GET',
        data: {'ds_trangThai':status,page:page},
        success: function (res) { 
            if(typeof func_success === "function")
                func_success(res)                                                    
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON)            
        }
    }); 
}
