$(()=>{
    const inputStudentcode = $("#studentcode");
    const inputLastName = $("#lastname");
    const inputFirstName = $("#firstname");
    const inputPhonenumber = $("#phonenumber");
    const inputPassword = $("#password");
    const inputRePassword = $("#re-password");
    createInputNumber(inputStudentcode,0,9999999999,false)
    createInputNumber(inputPhonenumber,0,9999999999,false)
    const inputShowPassword = $(`input[name="showPassword"]`);
    inputShowPassword.click(()=>{
        let type = inputShowPassword.is(":checked") ? "text" : "password";
        inputPassword.attr("type",type);
        inputRePassword.attr("type",type);
    })
    $('#form-register').on('submit',(ev)=>{
        ev.preventDefault();
        let fromData = $('#form-register').serialize();
        $("#error").text("");
        $("#btn-login").prop("disabled", true);
        $.ajax({
            url: BASE_URL+API_AUTHEN+PREFIX_REGISTER,
            type: "POST",   
            data:fromData,          
            success: function (res) {                        
                // console.log(res)
                showMessage("Thành công","Tạo tài khoản thành công",()=>{
                    location.replace("login");
                },false)
                // location.replace(res.data.url)      
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON)     
                $("#error").text(xhr.responseJSON.error)
                $("#btn-login").prop("disabled", false);
            }
        });        
    })
})