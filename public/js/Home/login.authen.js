$('#form-login').on('submit',(ev)=>{
    ev.preventDefault();
    let fromData = $('#form-login').serialize();
    $("#error").text("");
    $("#btn-login").prop("disabled", true);
    $.ajax({
        url: BASE_URL+API_AUTHEN+API_AUTHEN_LOGIN,
        type: "POST",   
        data:fromData,          
        success: function (res) {                        
            // console.log(res)
            location.replace(res.data.url)      
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseJSON)     
            $("#error").text("Thông tin đăng nhập không chính xác")
            $("#btn-login").prop("disabled", false);
        }
    });        
    // $.post(BASE_URL+API_AUTHEN+API_AUTHEN_LOGIN,fromData,function(res){                                        
    //         if(res.success==true)        
    //             location.replace(res.url)
    //     else
    //         handleCreateToast("error",res.message);
    // })
})