
const CallApiStudentManager = (data,func_success,func_fail,method = METHOD_GET,prefix = "")=>{
    return BuildCallApi(data,
        func_success,
        func_fail,
        method,
        BASE_URL+API_PREFIX_ADMIN+API_PREFIX_STUDENT,
        prefix) 
}
const CallApiStudentManagerGet = (data,func_success,func_fail)=>{
    CallApiStudentManager(data,func_success,func_fail)											 
}

const CallApiStudentManagerGetOne = (maSinhVien,func_success,func_fail)=>{
    CallApiStudentManager(null,func_success,func_fail,METHOD_GET,maSinhVien)											 
}

const CallApiGettudentByRoom = (maPhong,func_success,func_fail)=>{
    return BuildCallApi({
        MaPhong:maPhong
    },
        func_success,
        func_fail,
        METHOD_GET,
        BASE_URL+API_PREFIX_ADMIN+API_PREFIX_STUDENT+API_AUTHEN_STUDENT_BY_ROOM
        ) 
}
