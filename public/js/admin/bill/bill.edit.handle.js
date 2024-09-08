$(()=>{
    const maHoaDon = getParamPrefix(); 
    const formField = $("#form-field");
    var hoaDonDichVuBatBuocTheoPhong = (MaHoaDon)=>{
        new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL+API_AUTHEN_BILL_DETAILS_FORCE_SERVICE)
        .all((res)=>{            
            console.log(res)
            if(res.status==1)        
            {                                   
                let s_bb = '';
                if(res.data.length % 2 ==1)
                    s_bb+=`<tr></tr>`            
                res.data.forEach(item=>{
                    let totalPrice = item.DonGia * item.SoLuong
                    let s=`<div class="lg-col-12">
                            <div class="profile--form__text-field box-input">
                            </div></div>`
                    const row =$(`<tr class="tr-service tr-service-mandatory" id="tr-service-${item.MaDichVu}">
                            <td>${item.TenDichVu}</td>
                            <td>${item.DonGia}</td>
                            <td class="td-quantity">${item.SoLuong}</td>
                            <td class="td-total-price">${totalPrice.toLocaleString("de-DE")}đ</td>
                        </tr>`);                       
                    const boxInput = $(s);                                
                    boxInput.find(".box-input").append(`<label><strong class="tenDV">${item.TenDichVu}</strong>  
                                        | Giá hiện tại: <b class="gia"> ${item.DonGia.toLocaleString('de-DE')}</b>đ ${item.TinhTheoChiSo == true ? `- Chỉ số cũ: <b id="${"csc" + item.MaDichVu}" class="old-index"> ${ item.ChiSoHienTai ? parseInt(item.ChiSoHienTai)-parseInt(item.SoLuong) : 0} </b>` : ""}
                                        <b class="loi error-validate"> * </b>
                                    </label>`)
                    var input = $(`<input id="service-${item.MaDichVu}" required type="number" maxlength="20" value="${item.TinhTheoChiSo == true ? item.ChiSoHienTai : item.SoLuong}" name="${item.MaDichVu}" class="dvPhong ${item.TinhTheoChiSo ==true ? "service-room-has-index" : "service-room"}" placeholder="${item.TinhTheoChiSo ? "Nhập chỉ số mới" : "Nhập số lượng"}" /> <br />`)                
                    input.data("price",item.DonGia);
                    input.data("service-name",item.DonGia);
                    input.data("has-index",item.TinhTheoChiSo);
                    createInputNumber(input,item.TinhTheoChiSo == true ? (item.ChiSoHienTai ? parseInt(item.ChiSoHienTai)-parseInt(item.SoLuong) : 0) : 0,9999999999999)                   
                    boxInput.find(".box-input").append(input);                               
                    formField.append(boxInput)
                    row.data("total-price",totalPrice)
                    $('#dvPhongTable').append(row)
                });               
                $('#dvPhongTable').append(s_bb)   
                chiTietHoaDonDichVuDon(MaHoaDon)
                createInputBill()                                                 
            }
            else if(res.status==0)  
            {        
                btnConfrimEditBill.remove()     
                $('.form-add-bill').append(
                    `<p class="thanhtien" style="color:crimson">
                        Hóa đơn này không bị báo cáo, không thể chỉnh sửa 
                    </p>
                    <a href="/admin/quanlyhoadon/${MaHoaDon}" class="open_btn btn btn-primary" >Xem chi tiết</a>`
                    ) 
                $('.bill-heading-title-service').html("")
                $('#confirm-create-bill').remove()
                let s_bb = '';
                if(res.data.length % 2 ==1)
                    s_bb+=`<tr></tr>`
                res.data.forEach(item=>{                    
                    s_bb+=`<tr class="ttdichvu">
                                <td>${item.TenDichVu}</td>
                                <td>${item.DonGia}</td>
                                <td>${item.SoLuong}</td>
                                <td class="tongtien" >${item.SoLuong*item.DonGia}</td>
                            </tr>`
                });                                   
                $('#dvPhongTable').html(s_bb)
                chiTietHoaDonDichVuDon(MaHoaDon)
            }
            else            
                handleCreateToast("error",res.message,'er1',true);     
        },(res)=>{
            handleCreateToast("error",res.error,'er2',true);
        },{
            'MaHoaDon':MaHoaDon 
        })      
    }  
    const chiTietHoaDonDichVuDon = (MaHoaDon)=>{          
        new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL+API_AUTHEN_BILL_DETAILS_SINGLE_SERVICE)
        .all((res)=>{
            console.log(res)
            $('#dvDon').html("")
            res.data.forEach(item => {                
                var s = `<tr class="tr-service">
                            <td>${item.TenDichVu}</td>
                            <td>${parseInt(item.DonGia).toLocaleString('de-DE')}đ</td>
                            <td>${item.SoLuong}</td>
                            <td class="td-total-price" >${(item.DonGia * item.SoLuong).toLocaleString("de-DE")}</td>
                        </tr>`
                const rowService = $(s);                
                rowService.data("td-total-price",item.DonGia * item.SoLuong)
                rowService.data("total-price",item.DonGia * item.SoLuong)
                $('#dvDon').append(rowService);
            })            
            reloadTotalPrice();
            onSubmitEditBill(MaHoaDon) 
        },(res)=>{

        },{"MaHoaDon": MaHoaDon})       
    }          

    const btnConfrimEditBill = $("#btn-confirm-edit-bill")
    const onSubmitEditBill = (MaHoaDon)=>{        
        btnConfrimEditBill.click(()=>{                                
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
            showMessage('Thông báo',`Xác nhận cập nhật hóa đơn "${MaHoaDon}"`,function(){            
                const services = $('.dvPhong');
                let data = {};
                services.each(function(){                    
                    data[`Sl${$(this).attr("name")}`] = parseInt($(this).val()) - parseInt($(this).data("minimum") ?? 0);
                })                
                capNhatHoaDon(data,MaHoaDon)
            })                
        })                 
    }
    var capNhatHoaDon = (data,MaHoaDon)=>{
        new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL)
        .update(maHoaDon,data,(res)=>{
            handleCreateToast("success","Cập nhật hóa đơn thành công",'success1'); 
            btnConfrimEditBill.remove() 
            $('.form-add-bill').append(
                `<p class="thanhtien" style="color:crimson">
                    Hóa đơn này vừa cập nhật, không thể chỉnh sửa nữa 
                </p>
                <a href="/admin/quanlyhoadon/${MaHoaDon}" class="open_btn btn btn-primary" >Xem chi tiết</a>`
                ) 
            $('.bill-heading-title-service').html("")
            $('#form-field').remove()
            $('#confirm-create-bill').remove()    
        },(res)=>{
            console.log(res)
        })
        // $.ajax({
        //     url: +API_AUTHEN_BILL_EDIT,
        //     type: 'PUT',
        //     contentType: 'application/json',
        //     data: formData ,
        //     success: function (res) {     
        //         console.log(res)                        
        //         if(res.success==true)        
        //             {
                                                                                                                                 
        //             }
        //         else        
        //             handleCreateToast("error",res.message,'er1');            
        //     },
        //     error: function (xhr, status, error) {
        //         handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        //     }
        // });     
    }
    hoaDonDichVuBatBuocTheoPhong(maHoaDon)
})