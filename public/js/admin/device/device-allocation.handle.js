$(()=>{
    const btnFilter = $("#btn_loc");
    const inputKhu = $("#khu");    
    const inputTang = $("#tang");
    const inputPhong = $("#phong");      
    const tableShowDeviceAllocate = $("#table-show-device-allocation");
    const selectDivice = $("#device-allocation-deviceid")
    const inputDeviceAllocateQuantity = $("#device-allocation-quantity")    
    const form = $("#form-edit-device-allocation");
    const elementSelectRoom = $("#device-allocation-phong");
    const modal = $("#modal-edit-device-allocation");
    const api = new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_DEVICE + PREFIX_DEVICE_ALLOCATION);

    const getDataFilter = (page = 1)=>{
        filter = {
            "tatCa":$("#showAllHD").is(":checked"),
            "khu":inputKhu.val(),
            "tang":inputTang.val(),
            "phong":inputPhong.val(),                    
        }
        getData(page,filter);
    }
    const getData = (page,filter)=>{        
        api.all((res)=>{
            console.log(res)                        
            var data = res.data.data;
            if(data.length == 0)
            return tableShowDeviceAllocate.html(`<center><h1 class="no_found-list">Không tìm thấy dữ liệu</h1></center>`)
            tableShowDeviceAllocate.html(`<thead>
                                            <td>Phòng</td>
                                            <td>Thiết bị</td>
                                            <td>Số lượng phân bổ</td>                                  
                                            <td></td>
                                        </thead>`)
            let tbody = $(`<tbody></tbody>`);
            let rowspan = 0;
            for (let index = 0; index < data.length; index++) {                
                const item = data[index];
                rowspan++;
                let s= `<tr class="border-left">
                            ${rowspan == 1 ? `<td class="td-device-allocation">${item.MaPhong} - ${item.TenPhong}<br>${item.TenKhu} - ${item.TenTang}</td>` : ""}                            
                            <td class="spacing">${item.MaThietBi} - ${item.TenThietBi}</td>
                            <td class="spacing index-value">
                                <div class="box-edit-quantity">
                                    <a class="btn  btn-quantity add" >+</a>
                                    <input type="text" class="show-quantity btn input-edit-quantity " value="${item.SoLuongPhanBo}" />
                                    <a class="btn  btn-quantity minus" >-</a>                                        
                                    <a style="padding-left:10px;" hidden><span id="item-present-quantity" class="item-present-quantity"> {{$hanghoas->SoLuongTon}}</span> sản phẩm có sẳn</a>
                                    <br>
                                    <center class="box-show-btn-update-quantity"><button class="btn btn-primary btn-update-quantity">Lưu</button></center>
                                </div>
                            </td>                                  
                            <td class="spacing">                                
                                <button class="btn-delete btn btn-warning">Xóa</button>
                            </td>
                        </tr>`
                const row = $(s);
                const boxShowBtnUpdate = row.find(".box-show-btn-update-quantity");
                const btnUpdateQuantity = row.find(".btn-update-quantity");
                const inputEditQuantity = row.find(".show-quantity");
                ValidateQuantity(row.find(".box-edit-quantity")[0])
                const id = item.MaThietBi+"/"+item.MaPhong
                btnUpdateQuantity.click(()=>{   
                    if(inputEditQuantity.val() == null || inputEditQuantity.val().trim() == "")                 
                        return handleCreateToast("error","Số lượng phân bổ không được để trống","error-quatity-"+item.MaThietBi+item.MaPhong,true)
                    showMessage("Thông báo",`Xác nhận cập nhật lại số lượng phân bổ của thiết bị "${item.TenThietBi}" tại phòng "${item.TenPhong}" ?`,
                    ()=>{
                        api.update(id,{
                            SoLuongPhanBo:inputEditQuantity.val()
                        },(res)=>{
                            console.log(res)
                            handleCreateToast("success","Cập nhật số lượng thành công",null,true)
                            inputEditQuantity.data("saved-value",inputEditQuantity.val())
                            boxShowBtnUpdate.slideUp();
                        },(res)=>{
                            console.log(res)
                            handleCreateToast("error",res.error,null,true)
                        })
                    })
                }) 
                const btnDelete = row.find(".btn-delete")
                btnDelete.click(()=>{
                    showMessage("Thông báo",`Xác nhận xóa phân bổ thiết bị "${item.TenThietBi}" tại phòng "${item.TenPhong}" ?`,
                    ()=>{
                        api.delete(id,(res)=>{
                            console.log(res)
                            handleCreateToast("success","Thao tác xóa thành công",null,true)
                            getData(page,filter)
                        },(res)=>{
                            console.log(res)
                        })
                    })
                })                 
                tbody.append(row)
                if(index + 1 == data.length || item.MaPhong != data[index+1].MaPhong)
                {
                    tbody.append(`<tr class="spacing"></tr>`)
                    tbody.find(".td-device-allocation").attr("rowspan",rowspan)
                    s = "";
                    rowspan=0;
                    tableShowDeviceAllocate.append(tbody)
                    tbody = $(`<tbody></tbody>`);
                }
            }    
            loadPaginationButtons(page,res.data.last_page,(page,numpages)=>{
                getData(page,filter)
            })       
        },(res)=>{
            console.log(res)
        },{
            page:page,
            filter:filter
        })
    }
    form.on("submit",(ev)=>{
        ev.preventDefault()
        if(selectDivice.val() == null || selectDivice.val() == "")
                return handleCreateToast("error","Vui lòng còn thiết bị muốn phân bổ","error-validate-device",true);            
        if(inputDeviceAllocateQuantity.val() == null ||inputDeviceAllocateQuantity.val() == "")
            return handleCreateToast("error","Số lượng phân bổ không được để trống","error-validate-device-quantity",true);            
        showMessage("Thông báo","Xác nhận thêm 1 phân bổ thiết bị ? ",()=>{            
            api.create({
                MaPhong:elementSelectRoom.val(),
                MaThietBi:selectDivice.val(),
                SoLuongPhanBo:inputDeviceAllocateQuantity.val()
            },(res)=>{
                modal.modal("hide")
                handleCreateToast("success","Tạo phân bổ thành công",null,true)
                getDataFilter();                
                elementSelectRoom.trigger("change")
            },(res)=>{
                handleCreateToast("error",res.error,null,true)
            })
        })
    })
    createInputNumber(inputDeviceAllocateQuantity,1,99999999);
    show_khu()
    khu_change();
    tang_change();  
    show_khu("device-allocation-khu")
    khu_change("device-allocation-khu","device-allocation-tang","device-allocation-phong");                                                     
    tang_change("device-allocation-tang","device-allocation-phong")
    phong_change((selectRoom)=>{
        if(selectRoom.val() === "")
            return selectDivice.html("")
        api.get((res)=>{
            console.log(res)            
            let s = ""
            res.data.forEach(item => {
                s+=`<option value="${item.MaThietBi}">${item.MaThietBi} - ${item.TenThietBi}</option>`
            });
            selectDivice.html(s)
        },(res)=>{
            console.log(res)
        },{
            MaPhong:selectRoom.val()
        },PREFIX_UNALLOCATE_DIVICE)
    },"device-allocation-phong")
    getDataFilter(getPage());
    btnFilter.click(()=>{
        getDataFilter(1);
    })
    $("#showAllHD").click(()=>{
        getDataFilter(1);
    })
})