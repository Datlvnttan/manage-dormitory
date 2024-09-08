  
const select_choose_room = $("#select_choose_room")
const danhSachPhongTrong = (func_success,func_fail)=>{    
    $.ajax({
        url: BASE_URL + API_PREFIX_ROOM + API_AUTHEN_EMPTY_ROOM,
        type: 'GET',        
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


// var danhSachPhongTrong = ()=>{
//     $.ajax({
//         url: BASE_URL + API_PREFIX_ROOM + API_AUTHEN_EMPTY_ROOM,
//         type: 'GET',        
//         success: function (res) {
//             if(res.success==true)        
//             {
//                 console.log(res.data)
                               
//             }
//             else
//                 handleCreateToast("error",res.message);                
//         },
//         error: function (xhr, status, error) {
//             handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
//         }
//     });   													 
// }