$(()=>{
    const tbodyInfringe = $("#tbody-infringe");
    const inputInfringeId = $("#infringe-id")
    const inputInfringeTitle = $("#infringe-title")
    const inputInfringeLevel = $("#infringe-level")
    const formEditInfringe = $("#form-edit-infringe");
    const btnAddInfringe = $("#btn-add-infringe");
    const modalEditInfringe = $("#modal-edit-infringe")
    const error = $("#error")
    const chkBoxShowAll = $(`input[name="tatCa"]`); 
    console.log(chkBoxShowAll)   
    const inputLevel = $(`select[name="mucDoNghiemTrong"]`);  
    const btnFilter = $("#btn_loc")         
    createInputNumber(inputInfringeLevel,1,10);
    inputInfringeId.attr("readonly",true)
    const LoadDataInfringe = (page = 1)=>{
        CallApiDataInfringe({
            tatca:chkBoxShowAll.is(":checked"),
            mucdonghiemtrong:inputLevel.val(),
            page:page
        },(res)=>{
            // console.log(res)
            tbodyInfringe.html("")
            if(res.data.data.length == 0)
            {
                tbodyInfringe.html(`<td></td><td><center><h1>Không tìm thấy dữ liệu</h1></center></td><td></td>`)
                return 
            }
            res.data.data.forEach(item => {
                const row = $(`<tr>
                                <td>${item.MaViPham}</td>
                                <td>${item.NoiDung}</td>
                                <td>${item.MucDoNghiemTrong}</td>                        
                                <td>
                                    <button class="btn btn-primary btn-update">Sửa</button>
                                    <button class="btn btn-outline-danger btn-delete">Xóa</button>
                                </td>                        
                            </tr>`)  
                row.find(".btn-update").click(function(){
                    bindingData(item);
                    modalEditInfringe.modal("show")
                    formEditInfringe.data("update-id",item.MaViPham);
                })   
                row.find(".btn-delete").click(function(){
                    showMessage("Thông báo","Xác nhận xóa vi phạm '"+item.MaViPham+"'?",()=>{
                        CallApiDataInfringeDelete(item.MaViPham,(res)=>{
                            handleCreateToast("success","Xóa vi phạm thành công",null,true);
                            row.remove();
                        },(res)=>{
                            console.log(res)
                        })
                    })
                })            
                tbodyInfringe.append(row)
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    lichSuViPham($("#showAllHD").is(":checked"),thangHienTai,daGiaiQuyet,page)
                }) 
            });            
        },(res)=>{

        })
    }
    btnAddInfringe.click(()=>{
        bindingData();
        formEditInfringe.data("update-id",undefined);
        modalEditInfringe.modal("show")
    })
    const bindingData = (viPham = {})=>{
        inputInfringeId.val(viPham.MaViPham ?? "")
        inputInfringeTitle.val(viPham.NoiDung ?? "")
        inputInfringeLevel.find(`option[value="${viPham.MucDoNghiemTrong ?? 1}"]`).prop("selected",true)
    }
    formEditInfringe.on("submit",function(ev){
        ev.preventDefault();
        let formData = $(this).serialize();
        const id = $(this).data("update-id");
        if(id != null)
        {
            showMessage("Thông báo","Xác nhận cập nhật vi phạm '"+id+"'?",()=>{
                CallApiDataInfringeUpdate(id,formData,(res)=>{                    
                    handleCreateToast("success","Cập nhật vi phạm thành công",null,true);                     
                    LoadDataInfringe(getPage())
                    modalEditInfringe.modal("hide")
                    error.text("") 
                },(res)=>{   
                    console.log(res)                 
                    error.text(res.error)
                    // resetErrors();
                    // showErrors(res.errors)        
                })
            })
        }
        else
        {
            showMessage("Thông báo","Xác nhận tạo vi phạm?",()=>{
                CallApiDataInfringeCreate(formData,(res)=>{                                    
                    handleCreateToast("success","Tạo vi phạm thành công",null,true);   
                    modalEditInfringe.modal("hide")                  
                    LoadDataInfringe(getPage())
                    error.text("") 
                },(res)=>{          
                    console.log(res) 
                    error.text(res.error)                           
                    // resetErrors();
                    // showErrors(res.errors)        
                })
            })
        }
    })

    // const showErrors = (errors)=>{
    //     for (const key in errors) {
    //         if (Object.hasOwnProperty.call(errors, key)) {
    //             const error = errors[key];
    //             $(`.error-validate-update.${key}`).text(error[0])
    //         }
    //     }   
    // }
    // const refreshTab = ()=>{
    //     getPromotion(statusPresent,tabPresent); 
    //     modalEditPromotiom.modal("hide") 
    // }

    // const resetErrors = ()=>{
    //     $(`.error-validate-update`).each(function(){
    //         $(this).text("")
    //     })
    // }
    LoadDataInfringe(getPage())
    inputLevel.change(()=>{
        LoadDataInfringe(1)
    })
    chkBoxShowAll.click(()=>{
        LoadDataInfringe(1)
    })
})