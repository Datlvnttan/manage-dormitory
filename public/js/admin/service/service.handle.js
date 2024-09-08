$(()=>{
    const checkboxShowAll = $(`input[id="filter-tatca"]`)
    const checkboxBatBuoc = $(`input[id="filter-batbuoc"]`)
    const checkboxKhongBatBuoc = $(`input[id="filter-khongbatbuoc"]`)
    const checkboxTinhTheoChiSo = $(`input[id="filter-tinhtheochiso"]`)
    const checkboxKhongTinhTheoChiSo = $(`input[id="filter-khongtinhtheochiso"]`)

    $(".filter").each(function(){
        $(this).change(()=>{    
            const checkLength = $(".filter:checked").length;        
            checkboxShowAll.prop("checked",$(".filter").length == checkLength)
            if(checkLength == 0)
                $(this).prop("checked",true)
        })        
    })
    checkboxShowAll.change(function(){
        $(".filter").each(function(){
            $(this).prop("checked",checkboxShowAll.is(":checked"))
        })
        checkboxTinhTheoChiSo.prop("checked",true)
    })

    const inputServiceId = $(`input[name="MaDichVu"]`)
    const inputServiceName = $(`input[name="TenDichVu"]`)
    const inputServicePrice = $(`input[name="GiaHienTai"]`)
    const checkboxHasIndex = $(`input[name="TinhTheoChiSo"]`)
    const checkboxObligatory = $(`input[name="BatBuoc"]`)
    const btnAddService = $("#btn-add-service")

    createInputNumber(inputServicePrice,0,99999999999)
    inputServiceId.prop("readonly",true)

    new BuildFontendRestFullApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_SERVICE,"#tbody-show-service",
    "#modal-edit-service",btnAddService,"MaDichVu",(item,api)=>{
        const row = $(`<tr>
                        <td>${item.MaDichVu}</td>
                        <td>${item.TenDichVu}</td>
                        <td>${item.GiaHienTai}</td>
                        <td>
                            <center class="form-check form-switch form-check-status ">                                
                                <input class="form-check-input checked-obligatory" type="checkbox" role="switch" ${item.BatBuoc ? "checked" : ""} ${item.Khoa ? "disabled" : ""}>
                            </center> 
                        </td>
                        <td>
                            <center class="form-check form-switch form-check-status">                                
                                <input class="form-check-input checked-has-index" type="checkbox" role="switch" ${item.TinhTheoChiSo ? "checked" : ""} ${item.Khoa ? "disabled" : ""}>
                            </center>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-update" data-bs-toggle="modal" data-bs-target="#modal-edit-service">Sửa</button>                        
                            <button class="btn btn-warning btn-destroy" >Xóa</button>
                        </td>
                    </tr>`)
                    if(!item.Khoa)
                    {
                        const checkboxObligatoryFontend=row.find(".checked-obligatory");
                        const checkboxHasIndexFontend=row.find(".checked-has-index");
                        checkboxObligatoryFontend.click(()=>{
                            const check = checkboxObligatoryFontend.is(":checked")
                            checkboxObligatoryFontend.prop("checked",!check);
                            let title = check ? "Thông báo" :  `Xác nhận xóa dịch vụ "${item.TenDichVu}" khỏi danh sách dịch vụ bắt buộc?`;
                            let msg = check ? `Xác nhận thêm dịch vụ "${item.TenDichVu}" vào danh sách bắt buộc ?` : "Nếu đây là dịch vụ có chỉ số, cũng sẽ bị xóa cùng, vẫn xác nhận?"
                            showMessage(title,msg,()=>{
                                api.patch(item.MaDichVu,{
                                    status:check
                                },(res)=>{
                                    // console.log(res)
                                    handleCreateToast("success","Cập nhật thành công",null,true);
                                    checkboxObligatoryFontend.prop("checked",check);
                                    if(check == false && checkboxHasIndexFontend.is(":checked") == true)
                                        checkboxHasIndexFontend.prop("checked",check);
                                },(res)=>{
                                    // console.log(res)
                                    handleCreateToast("error",res.error,null,true);
                                },API_PREFIX_SERVICE_UPDATE_OBLIGATORY)
                            })
                        })
                        checkboxHasIndexFontend.click(()=>{
                            const check = checkboxHasIndexFontend.is(":checked")
                            checkboxHasIndexFontend.prop("checked",!check);
                            let msg = check ? `Xác nhận thêm dịch vụ "${item.TenDichVu}" vào danh sách dịch vụ có chỉ số ?` : `Xác nhận xóa dịch vụ "${item.TenDichVu}" khỏi danh sách dịch vụ có chỉ số và cả dịch vụ bắt buộc?`
                            showMessage("Thông báo",msg,()=>{
                                api.patch(item.MaDichVu,{
                                    status:check
                                },(res)=>{
                                    // console.log(res)
                                    handleCreateToast("success","Cập nhật thành công",null,true);
                                    checkboxHasIndexFontend.prop("checked",check);
                                    checkboxObligatoryFontend.prop("checked",check);
                                },(res)=>{
                                    // console.log(res)
                                    handleCreateToast("error",res.error,null,true);
                                    // console.log(res)
                                },API_PREFIX_SERVICE_UPDATE_HAS_INDEX)
                            })
                        })
                    }
            
        return row;
    },null,()=>{
        return {
            TenDichVu:inputServiceName.val(),
            GiaHienTai:inputServicePrice.val(),
            TinhTheoChiSo:checkboxHasIndex.is(":checked"),
            BatBuoc:checkboxObligatory.is(":checked"),
        }
    },()=>{
        let dataFilter = {
            tatCa:checkboxShowAll.is(":checked")
        }
        if(checkboxBatBuoc.is(":checked") != checkboxKhongBatBuoc.is(":checked"))
            dataFilter["batBuoc"] = checkboxBatBuoc.is(":checked")
        if(checkboxTinhTheoChiSo.is(":checked") != checkboxKhongTinhTheoChiSo.is(":checked"))
            dataFilter["tinhTheoChiSo"] = checkboxTinhTheoChiSo.is(":checked")        
        return dataFilter;
    }).handle($("#btn_loc"),checkboxShowAll)
})