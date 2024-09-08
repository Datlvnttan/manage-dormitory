const CallApiDataInfringe = (data,func_success,func_fail,method = METHOD_GET,prefix = "")=>{
    return BuildCallApi(data,
        func_success,
        func_fail,
        method,
        BASE_URL+API_PREFIX_ADMIN+API_PREFIX_INFRINGE,
        prefix) 
}
const CallApiDataInfringeAll = (data,func_success,func_fail)=>{
    CallApiDataInfringe(data,func_success,func_fail)											 
}

const CallApiDataInfringeCreate = (data,func_success,func_fail)=>{
    CallApiDataInfringe(data,func_success,func_fail,METHOD_POST)											 
}

const CallApiDataInfringeUpdate = (id,data,func_success,func_fail)=>{
    CallApiDataInfringe(data,func_success,func_fail,METHOD_PUT,id)											 
}
const CallApiDataInfringeDelete = (id,func_success,func_fail)=>{
    CallApiDataInfringe(null,func_success,func_fail,METHOD_DELETE,id)											 
}




