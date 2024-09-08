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

    const inputDeviceId = $(`input[name="MaThietBi"]`)
    const inputDeviceName = $(`input[name="TenThietBi"]`)
    const inputDeviceTotalQuantity = $(`input[name="TongSoLuong"]`)
    const inputDeviceQuantityPerRoom = $(`input[name="SoLuongMoiPhong"]`)   
    const btnAddDevice = $("#btn-add-device")
    createInputNumber(inputDeviceTotalQuantity,0,9999999999999)
    createInputNumber(inputDeviceQuantityPerRoom,0,9999999999999)    

    new BuildFontendRestFullApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_DEVICE,"#tbody-show-device",
    "#modal-edit-device",btnAddDevice,"MaThietBi",(item,api)=>{
        const row = $(`<tr>
                        <td>${item.MaThietBi}</td>
                        <td>${item.TenThietBi}</td>
                        <td>${item.TongSoLuong}</td>                       
                        <td>${item.SoLuongMoiPhong}</td>                       
                        <td>
                            <button class="btn btn-primary btn-update" data-bs-toggle="modal" data-bs-target="#modal-edit-device">Sửa</button>                                                    
                            <button class="btn btn-warning btn-destroy" >Xóa</button>                            
                        </td>
                    </tr>`)        
        return row;
    }).handle()
})