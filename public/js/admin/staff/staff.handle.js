$(()=>{
    // const checkboxShowAll = $(`input[id="filter-tatca"]`)
    // const checkboxBatBuoc = $(`input[id="filter-batbuoc"]`)
    // const checkboxKhongBatBuoc = $(`input[id="filter-khongbatbuoc"]`)
    // const checkboxTinhTheoChiSo = $(`input[id="filter-tinhtheochiso"]`)
    // const checkboxKhongTinhTheoChiSo = $(`input[id="filter-khongtinhtheochiso"]`)

    // $(".filter").each(function(){
    //     $(this).change(()=>{    
    //         const checkLength = $(".filter:checked").length;        
    //         checkboxShowAll.prop("checked",$(".filter").length == checkLength)
    //         if(checkLength == 0)
    //             $(this).prop("checked",true)
    //     })        
    // })
    // checkboxShowAll.change(function(){
    //     $(".filter").each(function(){
    //         $(this).prop("checked",checkboxShowAll.is(":checked"))
    //     })
    //     checkboxTinhTheoChiSo.prop("checked",true)
    // })

    const inputStaffUsername = $(`input[name="TenDangNhap"]`)
    const inputStaffLastName = $(`input[name="Ho"]`)
    const inputStaffFirstName = $(`input[name="Ten"]`)
    const inputStaffPhoneNumber = $(`input[name="SoDienThoai"]`)
    const selectPosition = $(`select[name="ChucVu"]`)    
    const btnAddStaff = $("#btn-add-staff")

    new CallApi(BASE_URL+PREFIX_ROLE)
    .all((res)=>{
        console.log(res)
        let s = '';
        res.data.forEach(item => {
            s+=`<option value="${item.id}">${item.role_name}</option>`
        });
        selectPosition.html(s);
    },(res)=>{

    })

    createInputNumber(inputStaffPhoneNumber,0,9999999999,false)    

    new BuildFontendRestFullApi(BASE_URL+API_PREFIX_ADMIN+PREFIX_STAFF,"#tbody-show-staff",
    "#modal-edit-staff",btnAddStaff,"TenDangNhap",(item,api)=>{
        const row = $(`<tr>
                        <td>${item.TenDangNhap}</td>
                        <td>${item.Ho} ${item.Ten}</td>
                        <td>${item.SoDienThoai}</td>                       
                        <td>${item.ChucVu}</td>                       
                        <td>
                            <button class="btn btn-primary btn-update" data-bs-toggle="modal" data-bs-target="#modal-edit-staff">Sửa</button>                                                    
                            <button class="btn btn-warning btn-destroy" >Xóa</button>
                            <button class="btn btn-reset-password btn-info" >Đặt lại mật khẩu</button>
                        </td>
                    </tr>`)                    
        row.find(".btn-reset-password").click(()=>{
            showMessage("Đặt lại mật khẩu?","Xác nhận đặt lại mật khẩu cho tài khoản '"+item.TenDangNhap+"'?",()=>{
                api.patch(item.TenDangNhap,undefined,(res)=>{
                    handleCreateToast("success","Đặt lại mật khẩu thành công",null,true);
                },(res)=>{                    
                    handleCreateToast("error","Đã xảy ra lỗi, vui lòng thử lại",null,true)
                },PREFIX_RESET_PASSWORD)
            })
        })
        return row;
    }).handle()
})