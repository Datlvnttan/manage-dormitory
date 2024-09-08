
const CallApiFilterBill = (data,func_success,func_fail)=>{
    $.ajax({
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL+API_AUTHEN_BILL_LIST,
        type: 'GET',
        data: data ,
        success: function (res) {                   
            if(res.success==true)        
            {
                if(typeof func_success === "function")
                    func_success(res)
            }                
            else        
                handleCreateToast("error",res.message,'er1');
        },
        error: function (xhr, status, error) {
            if(typeof func_fail === "function")
                func_fail(xhr.responseJSON)            
        }
    }); 
}

