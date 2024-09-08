$(()=>{
    // const btnExtension = $(".btn-contract-extension")
    const boxExtension = $("#box-extension")
    const api = new CallApi(BASE_URL+API_PREFIX_USER+PREFIX_CONTRACT)
    api.show(PREFIX_STATUS,(res)=>{
        console.log(res)
        switch (res.status) {
            case 1:
                buildBtnExtension();
                break;
            case 2:
                buildBtnCancelExtension()
                break;
            case 3:
                boxExtension.html(`<button class="btn btn-primary" style="height: 45px;font-size: 20px;">Gia hạn hợp đồng thành công</button>`)
                break;
            default:
                break;
        }
    },(res)=>{
        console.log(res)
    })
    const buildBtnExtension = ()=>{
        const btnExtension = $(`<button class="btn btn-warning btn-contract-extension" style="height: 45px;font-size: 20px;">Xin gia hạn hợp đồng</button>`)
        btnExtension.click(()=>{
            showMessage("Xác nhận xin gia hạn hợp đồng nội trú của bạn?","Một khi đã xin gia hạn thì không thể hủy bỏ được, xác nhận???",()=>{
                api.patch(PREFIX_CONTRACT_EXTENSION,undefined,(res)=>{
                    console.log(res)
                    buildBtnCancelExtension()
                    handleCreateToast("success","Bạn đã gửi yêu cầu xin gia hạn hợp đồng thành công, vui lòng thanh toán hợp đồng để hoàn tất quá trình gia hạn!!!",null,true);
                    // showMessage("Thành công","Bạn đã gửi yêu cầu xin gia hạn hợp đồng thành công, vui lòng thanh toán hợp đồng để hoàn tất quá trình gia hạn!!!",()=>{
                    //     location.reload();
                    // },false)
                },(res)=>{
                    console.log(res)
                })
            })
        })
        boxExtension.html(btnExtension)
    }
    const buildBtnCancelExtension = ()=>{
        const btnCancelExtension = $(`<button class="btn btn-primary btn-cancel-contract-extension" style="height: 45px;font-size: 20px;">Đã xin gia hạn hợp đồng</button>`)
        boxExtension.html(btnCancelExtension)
        // btnCancelExtension.click(()=>{
        //     showMessage("Thông báo","Xác nhận hủy gia hạn hợp đồng nội trú của bạn??",()=>{
        //         api.patch(PREFIX_CANCEL_CONTRACT_EXTENSION,undefined,(res)=>{
        //             console.log(res)
        //             buildBtnExtension();
        //             handleCreateToast("error","Bạn đã hủy yêu cầu xin gia hạn hợp đồng!!!",null,true);
        //             // showMessage("Thành công","Bạn đã hủy yêu cầu xin gia hạn hợp đồng!!!",()=>{
        //             //     location.reload();
        //             // },false)
        //         },(res)=>{
        //             console.log(res)
        //         })
        //     })
        // })        
    }
})