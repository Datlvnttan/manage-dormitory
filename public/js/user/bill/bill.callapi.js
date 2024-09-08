const baoCaoHoaDonKhongChinhXac = (MaHoaDon, func_success,func_fail)=>{
    showMessage("Thông báo",`Xác nhận báo cáo hóa đơn "${MaHoaDon.trim()}" không đúng thông tin?`,function(){  
        new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_BILL)
        .patch(MaHoaDon,null,(res)=>{
            handleCreateToast("success",res.message,null,true);  
            if(typeof func_success==="function")  
            func_success();  
        },(res)=>{
            console.log(res)
            handleCreateToast("error",res.error,null,true);  
            if(typeof func_fail==="function")  
            func_fail();  
        },API_AUTHEN_BILL_REPORT_WRONG_INFO)            
    });
}

const cancelReportBill = (MaHoaDon, func_success,func_fail)=>{
    showMessage("Thông báo",`Xác nhận hruy báo cáo hóa đơn "${MaHoaDon.trim()}" ?`,function(){  
        new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_BILL)
        .patch(MaHoaDon,null,(res)=>{
            handleCreateToast("success",res.message,null,true);  
            if(typeof func_success==="function")  
            func_success();  
        },(res)=>{
            console.log(res)
            handleCreateToast("error",res.error,null,true);  
            if(typeof func_fail==="function")  
            func_fail();  
        },API_AUTHEN_BILL_REPORT_CANCEL)            
    });
}