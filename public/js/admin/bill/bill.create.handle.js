$(()=>{

    const api = new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_SERVICE);


    const formField = $("#form-field");
    var danhSachDichVuBatBuoc = ()=>{
        api.all((res)=>{                                           
            let s_bb = '';
            if(res.data.length % 2 ==1)
                s_bb+=`<tr></tr>`            
            res.data.forEach(item=>{
                let s=`<div class="lg-col-12">
                        <div class="profile--form__text-field box-input">
                        </div></div>`
                const row =$(`<tr class="tr-service tr-service-mandatory" id="tr-service-${item.MaDichVu}">
                        <td>${item.TenDichVu}</td>
                        <td>${item.GiaHienTai}</td>
                        <td class="td-quantity">0</td>
                        <td class="td-total-price">0đ</td>
                    </tr>`);
                // if (item.TinhTheoChiSo==true)
                // {
                //     s+=`<label><strong class="tenDV">${item.TenDichVu}</strong>  | Giá hiện tại: <b class="gia"> ${item.GiaHienTai}</b>đ - Chỉ số cũ: <b id="${"csc" + item.MaDichVu}"> </b><strong class="loi" hidden> * Sai dữ liệu đầu vào</strong></label>
                //     <input required type="number" min="" max="999999999" maxlength="10" id="service-${item.MaDichVu}" value="" name="${item.MaDichVu}" class="dvPhong" disabled placeholder="Nhập chỉ số mới" /> <br />`
                // }
                // else
                // {
                //     s+=`<label><strong class="tenDV">${item.TenDichVu}</strong> | Giá hiện tại: <b class="gia"> ${item.GiaHienTai}</b>đ <strong class="loi" hidden> * Sai dữ liệu đầu vào</strong></label>
                //     <input required type="number" min="0" max="999999999" maxlength="10" value="" name="${item.MaDichVu}" class="dvPhong" disabled placeholder="Nhập số lượng" /> <br />`
                // }
                const boxInput = $(s);                                
                boxInput.find(".box-input").append(`<label><strong class="tenDV">${item.TenDichVu}</strong>  
                                    | Giá hiện tại: <b class="gia"> ${item.GiaHienTai.toLocaleString('de-DE')}</b>đ ${item.TinhTheoChiSo == true ? `- Chỉ số cũ: <b id="${"csc" + item.MaDichVu}" class="old-index"> _ </b>` : ""}
                                    <b class="loi error-validate"> * </b>
                                </label>`)
                var input = $(`<input id="service-${item.MaDichVu}" required readonly type="number" maxlength="20" value="" name="${item.MaDichVu}" class="dvPhong ${item.TinhTheoChiSo ==true ? "service-room-has-index" : "service-room"}" disabled placeholder="${item.TinhTheoChiSo ? "Nhập chỉ số mới" : "Nhập số lượng"}" /> <br />`)                
                input.data("price",item.GiaHienTai);
                input.data("service-name",item.GiaHienTai);
                input.data("has-index",item.TinhTheoChiSo);
                createInputNumber(input,0,9999999999999)                   
                boxInput.find(".box-input").append(input);                               
                formField.append(boxInput)
                row.data("total-price",0)
                $('#dvPhongTable').append(row)
            });               
            $('#dvPhongTable').append(s_bb)                               
            createInputBill(); 
        },(res)=>{                        
            handleCreateToast("error",res.error,'er1');
        },null,API_AUTHEN_SERVICE_MANDATORY_LIST)        
    }


    // const createInputBill=()=>{
    //     var errors = $('.error-validate');
    //     var trServices = $('.tr-service-mandatory');        
    //     const services = $('.dvPhong')            
    //     services.each(function(index,element){
    //         let error = $(errors[index]);
    //         let rowService = $(trServices[index]);
    //         let price = parseInt($(this).data("price"))
    //         // let serviceName = $(this).data("service-name");
    //         $(this).on("input", function () {                           
    //             let newQuantity = parseInt($(this).val()), oldQuantity = parseInt($(this).data("minimum") ?? 0);                   
    //             if ($(this).val() == "" || newQuantity < oldQuantity) {
    //                 error.text("* " + ($(this).val() == "" ? "Không để trống" : "Số mới phải lớn hơn số cũ"))      
    //                 rowService.data("pass",false)  
    //                 rowService.find(".td-quantity").text("-")                    
    //                 rowService.find(".td-total-price").text("-")                                
    //             }
    //             else {
    //                 error.text("*")   
    //                 let totalPrice = (newQuantity - oldQuantity) * price
    //                 rowService.find(".td-quantity").text(newQuantity-oldQuantity)                    
    //                 rowService.find(".td-total-price").text(totalPrice.toLocaleString("de-DE")+"đ")
    //                 rowService.data("pass",true)
    //                 rowService.data("total-price",totalPrice)
    //                 // let s = "";     
    //                 // // s += `<td>${serviceName}</td>
    //                 // //     <td>${price}</td>
    //                 // //     <td>${newQuantity-oldQuantity}</td>
    //                 // //     <td class="total-price" >${}</td>`
    //                 // //     rowService.html(s);                
    //             }
    //             reloadTotalPrice();
    //         })
    //     })        
    // }


// const reloadTotalPrice = () => {
//     const elementIntoMoney = $("#into-money");
//     let totalPrice = 0;
//     const trServicess = $('.tr-service');   
//     // const tdTotalPrices = $(".total-price");
//     for (var trServices of trServicess) {
//         trServices = $(trServices)
//         if(trServices.data("pass") == false)        
//             return elementIntoMoney.text("---");                            
//         totalPrice +=parseInt(trServices.data("total-price"))
//     }
//     elementIntoMoney.text(totalPrice.toLocaleString('de-DE') + 'đ')
//     // document.querySelectorAll('.total-price').forEach(t => tong += parseInt(t.innerText))
//     // elementIntoMoneytong.toLocaleString('de-DE') + 'đ';
// } 
    const thongKeDichVuCoChiSo = (MaPhong)=>{   
        const elementOldIndexs = $(".old-index")     
        api.all((res)=>{
            clearToasts("er1-room-does-not-exist") 
            thongKeDichVuDonTheoPhong(MaPhong)
            btnConfrimCreateBill.data("room-id",MaPhong)
            var dtt = res.data             
            if(dtt.length == 0)
            {                                
                const services = $(".service-room-has-index")
                const trServicess =$(".tr-service-mandatory");
                services.each(function(index){
                    const elementOldIndex = $(elementOldIndexs[index])
                    const row = $(trServicess[index]);
                    $(this).data("minimum",0)
                    elementOldIndex.text(0)                    
                    row.data("pass",true)
                    row.data("total-price",0)
                })                
                return;
            }          
            dtt.forEach(item => {
                const input = $("#service-"+item.MaDichVu)                            
                input.data("minimum",item.ChiSoHienTai);
                input.val(item.ChiSoHienTai)
                $("#csc" + item.MaDichVu).text(item.ChiSoHienTai);
                const rowService = $(`#tr-service-${item.MaDichVu}`);
                rowService.data("pass",true)
                rowService.data("total-price",0)
            })               
        },(res)=>{           
            resetOutput(true);           
            handleCreateToast("error",res.error,'er1-room-does-not-exist',true);
        },{"MaPhong":MaPhong},API_AUTHEN_SERVICE_WITH_INDEX_STATISTICS_BY_ROOM)
    }
    const thongKeDichVuDonTheoPhong = (MaPhong)=>{        
        api.all((res)=>{                       
            $('#dvDon').html("")
            res.data.forEach(item => {
                var s = '';
                s += '<tr class="tr-service">';
                s += `<td>${item.TenDichVu}</td>`;
                s += `<td>${item.GiaHienTai}</td>`;
                s += `<td>${item.SoLuong}</td>`;
                s += `<td class="td-total-price" >${(item.GiaHienTai * item.SoLuong).toLocaleString("de-DE")}</td>`;
                s += '</tr>'
                const rowService = $(s);                
                rowService.data("td-total-price",item.GiaHienTai * item.SoLuong)
                rowService.data("total-price",item.GiaHienTai * item.SoLuong)
                $('#dvDon').append(rowService);
            })            
            reloadTotalPrice();
        },(res)=>{                        
            handleCreateToast("error",res.error,'er1-room-does-not-exist',true);            
        },{"MaPhong":MaPhong},API_AUTHEN_SERVICE_STATISTICS_INDIVIDUAL_BY_ROOM)        
    }

    // API_AUTHEN_BILL_CREATE
    var taoHoaDon = (formData)=>{
        new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL)
        .create(formData,(res)=>{
            handleCreateToast("success","Tạo thành công hóa đơn "+res.data.MaHoaDon,'success1',"success-bill",true);
            $("#tang").trigger("change")
        },(res)=>{
            handleCreateToast("error",res.error,null,true);
            console.log(res)
        })            
    }

    const btnSearchRoom = $(".btn-search-room");
    const selectRoom = $("#phong");
    const inputRoom = $(`input[name="phong"]`);
    const btnConfrimCreateBill = $("#confirm-create-bill");
    btnSearchRoom.click(()=>{
        printResult(inputRoom.val())
    })
    createEventInputEnter(inputRoom,()=>{
        printResult(inputRoom.val())
    })    







    $("#khu").change(() => {
        resetOutput();
    });
    $("#tang").change(() => {
        resetOutput();        
    });
    selectRoom.change(() => {
        if (selectRoom.val() != "") {           
            printResult(selectRoom.val());
        }
        else {            
            resetOutput()       
        }
    })
    var resetOutput = (resetValue = false) => {        
        $("#dvDon").html("")
        disabledDV(true,resetValue)
        btnConfrimCreateBill.data("room-id",null)
        resetChiSo()
    }

    function disabledDV(val,resetValue = false) {
        var dvs = document.querySelectorAll('.dvPhong')
        var errors = $('.error-validate');
        errors.each(function(index){
            $(this).text("*")
            $(dvs[index]).prop("disabled",val)
            $(dvs[index]).prop("readonly",val)            
            $(dvs[index]).val($(dvs[index]).data("has-index") == false ? (resetValue == true ? "":0) : "");  
        })       
    }
    var resetChiSo = () => {
        var chiSoCus = document.querySelectorAll('.old-index');
        chiSoCus.forEach(cs => cs.innerText = "_")        
    }
    var printResult = (maPhong) => {
        disabledDV(false)        
        thongKeDichVuCoChiSo(maPhong)          
    }
    function CheckValue(elem) {
        var value = elem.value;
        var x = value.substr(0, value.length - 1);
        elem.value = isNaN(value) ? x : value < elem.min ? elem.min: value
    }
    

    btnConfrimCreateBill.click(()=>{        
        const maPhong = btnConfrimCreateBill.data("room-id");  
        console.log(maPhong)
        if(maPhong == undefined)
        {        
            handleCreateToast("info", "Vui lòng chọn phòng","errphong",true)            
                return;        
        }   
        var trServices = $('.tr-service');
        if(!trServices)
        {
            handleCreateToast("info", "Vui lòng điền đầy đủ thông tin","errorvalue")            
            return;
        }
        for (var i = 0; i < trServices.length;i++)
        
            if ($(trServices[i]).data("pass") == false) {                
                handleCreateToast("info", "Vui lòng điền đầy đủ thông tin","errorvalue")            
                return;
            }
            // let formData = $('#form-create-bill').serialize()        
            showMessage('Thông báo',`Xác nhận tạo hóa đơn cho phòng "${maPhong}"`,function(){            
                const services = $('.dvPhong');
                let data = {
                    phong:maPhong,
                }
                services.each(function(){                    
                    data[`Sl${$(this).attr("name")}`] = parseInt($(this).val()) - parseInt($(this).data("minimum") ?? 0);
                })                
                taoHoaDon(data);
            })
    })   
    show_khu()
    khu_change();
    tang_change(undefined,undefined,{
        check_invoice:true
    });  
    danhSachDichVuBatBuoc();
    disabledDV(true)
    // phong_change(function(){
    //     thongKeDichVuCoChiSo(selectRoom.val())
    // });
   
})


