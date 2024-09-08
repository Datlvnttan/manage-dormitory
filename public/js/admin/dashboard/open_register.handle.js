$(()=>{
    const apiFeature = new CallApi(BASE_URL+API_PREFIX_ADMIN+PREFIX_OPEN_FEATURE)    
    const modalSetupFeature = $("#modal-setup-feature")
    // const checkboxRegisterResidence = $("#checkbox-register-residence")
    const formFeature = $("#form-feature")
    const boxFeature = $("#box-setup-feature")
    const inputEndTime = $("#end-autotime")

    const buildEventOnFeature = (checkbox,item)=>{
        checkbox.find(`#checkbox-${item.Key}`).change(function(){
            let check = $(this).is(":checked");
            $(this).prop("checked",!check)
            modalSetupFeature.modal("show")                                                            
            modalSetupFeature.find(".modal-title").text("Bật tính năng '"+item.Title+"'")
            inputEndTime.val("")
            formFeature.data("prefix",item.Prefix)
            formFeature.data("title",item.Title)
        })
    }

    const reloadChecbox = (item)=>{
        const box = $(`#box-checkbox-feature-${item.Key}`)
        box.html("")
        box.append(buildCheckbocFeature(item))
    }

    const buildEventOffFeature = (checkbox,item)=>{
        buildCountdownt(checkbox.find(`#countdown-${item.Key}`),item.EndTime,()=>{
            apiFeature.delete(item.Prefix,(res)=>{                
                reloadChecbox(res.data)
            },(res)=>{
                console.log(res)
            })
        });
        checkbox.find(`#checkbox-${item.Key}`).change(function(){
            let check = $(this).is(":checked");
            $(this).prop("checked",!check)
            showMessage("Thông báo","Xác nhận tắt tính năng này trước thời hạn???",()=>{
                apiFeature.delete(item.Prefix,(res)=>{
                    handleCreateToast("success","Bạn đã tắt tính năng này thành công",null,true);
                    reloadChecbox(res.data)
                    // showMessage("Thành công","Bạn đã tắt tính năng này thành công",()=>{
                    //     location.reload();
                    // },false)                            
                },(res)=>{
                    console.log(res)
                })
            })
        })
    }

    const buildCheckbocFeature = (item)=>{
        var s = `<center class="form-check form-switch">
                    <input class="form-check-input" ${item.Running ? "checked" : ""} style="cursor: pointer" type="checkbox" role="switch" id="checkbox-${item.Key}">
                    <label class="form-check-label" style="cursor: pointer" for="checkbox-${item.Key}"><b>${item.Title}</b></label>
                    <div style="font-size: 17px" id="countdown-${item.Key}">
                        00:00:00:00
                    </div>
                </center>`
            var checkbox = $(s);
            if(item.Running)
            {
                buildEventOffFeature(checkbox,item)
            }
            else            
                buildEventOnFeature(checkbox,item) 
        return checkbox
    }

    apiFeature.all((res)=>{
        console.log(res)
        boxFeature.html("")
        res.data.forEach(item => {  
            const box = $(`<div id="box-checkbox-feature-${item.Key}">
                        </div>`)                    
            box.append(buildCheckbocFeature(item))
            boxFeature.append(box)
        });
        boxFeature.append("<hr>")
    },(res)=>{
        console.log(res)
    })


    formFeature.on('submit',(ev)=>{
        ev.preventDefault();       
        let prefix = formFeature.data("prefix");
        console.log(prefix)
        if(inputEndTime.val() == null ||inputEndTime.val() == "")
        {
            handleCreateToast("error","Vui lòng chọn thời gian đặt lịch","error-timeout-empty-"+prefix,true);
            return;
        }  
        times = inputEndTime.val();
        times = new Date(times);
        today = new Date();        
        if(times <= today)
        {
            handleCreateToast("error","Vui lòng chọn ngày lớn hơn hiện tại","error-timeout-"+prefix,true);
            return;
        }        
        const title = formFeature.data("title");
        showMessage("Thông báo",`Xác nhận bật tính năng "${title}" ?`,()=>{            
            apiFeature.update(prefix,{
                thoi_han:inputEndTime.val()
            },(res)=>{
                console.log(res)
                showMessage("Thành công",`Bật tính năng "${title}" thành công!!!`,()=>{
                    location.reload();                    
                },false)                            
            },(res)=>{
                console.log(res)
            })
        }) 
    })
})