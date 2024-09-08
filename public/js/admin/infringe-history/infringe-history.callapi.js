
const CallApiInfringeManager = (data,func_success,func_fail,method = METHOD_GET,prefix = "")=>{
    return BuildCallApi(data,
        func_success,
        func_fail,
        method,
        BASE_URL+API_PREFIX_ADMIN+API_PREFIX_INFRINGE+API_AUTHEN_INFRINGE_HISTORY_LIST + "/",
        prefix) 
}
const CallApiInfringeManagerGet = (data,func_success,func_fail)=>{
    CallApiInfringeManager(data,func_success,func_fail)											 
}
const CallApiInfringeManagerGetByMaSinhVien = (maSinhVien,func_success,func_fail)=>{
    CallApiInfringeManager(null,func_success,func_fail,METHOD_GET,maSinhVien)											 
}

const CallApiInfringeManagerCreate = (data,func_success,func_fail)=>{
    CallApiInfringeManager(data,func_success,func_fail,METHOD_POST)											 
}