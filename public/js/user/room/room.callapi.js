const CallApiChangeRoom = (data,func_success,func_fail,method,prefix = "")=>{
    return BuildCallApi(data,
        func_success,
        func_fail,
        method,
        BASE_URL + API_PREFIX_USER + API_PREFIX_ROOM + API_AUTHEN_CHANGE_ROOM + "/",
        prefix)    												 
}
const CallApiSendChangeRoom = (data,func_success,func_fail)=>{
    CallApiChangeRoom(data,func_success,func_fail,METHOD_POST)											 
}
const CallApiChangeRoomUpdate = (id,data,func_success,func_fail)=>{
    CallApiChangeRoom(data,func_success,func_fail,METHOD_PUT,id)											 
}
const CallApiChangeRoomDelete = (id,func_success,func_fail)=>{
    CallApiChangeRoom(null,func_success,func_fail,METHOD_DELETE,id)											 
}
