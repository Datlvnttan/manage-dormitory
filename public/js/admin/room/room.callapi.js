const CallApiRoom = (data,func_success,func_fail)=>{       
    $.ajax({        
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ROOM+API_AUTHEN_ROOM_LIST,
        type: 'GET',
        data: data,
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

const CallApiRoom2 = (data,func_success,func_fail,method,prefix = "")=>{       
    $.ajax({        
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ROOM+prefix,
        type: method,
        data: data,
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
const CallApiRoomPost = (data,func_success,func_fail)=>{
    return CallApiRoom2(data,func_success,func_fail,METHOD_POST)
}
const CallApiRoomPut = (data,maPhong,func_success,func_fail)=>{
    return CallApiRoom2(data,func_success,func_fail,METHOD_PUT,maPhong)
}
const CallApiRoomDelete = (maPhong,func_success,func_fail)=>{
    return CallApiRoom2(null,func_success,func_fail,METHOD_DELETE,maPhong)
}