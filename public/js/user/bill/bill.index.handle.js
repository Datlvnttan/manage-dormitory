$(()=>{


    const api = new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_BILL);   
    const LocHoaDon = (showAll,thangHienTai,daThanhToan,page) => {
        data = {
            "tatCa":showAll,        
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daThanhToan":daThanhToan,
            "chuaThanhToan":chuaThanhToan.checked,
            "khongChinhXac":khongChinhXac.checked,
            "page":page
        }     
        api.all((res)=>{
            console.log(res)
            if(res.success==true)        
            {                                               
                var data = res.data;
                $('#showHoaDon').html('');        
                if (data.length == 0) {                        
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#showHoaDon').append(title);
                    return;
                }  
                data.forEach(item => {
                    let nut = "";      
                    if(item.TrangThai=="Chưa thanh toán")
                        nut =`<button class="btn_thanhtoan open_btn btn_xacnhan report-bill">Báo cáo</button>`
                    if(item.TrangThai == "Không chính xác")
                        nut= `<button class="btn_thanhtoan open_btn btn_xacnhan cancel-report-bill">Hủy báo cáo</button>`                  
                    let s =` <tr>
                            <td>${item.MaHoaDon}</td>                                
                            <td>${item.Thang.length > 1 ? item.Thang : "0"+item.Thang}-${item.Nam}</td >
                            <td>${parseInt(item.ThanhTien).toLocaleString('de-DE')}đ</td>                                
                            <td>${item.TrangThai}</td>
                            <td>
                                <a href="quanlyhoadon/${item.MaHoaDon}">Chi tiết</a>
                                <br/>
                                ${nut}                                    
                            </td> 
                          </tr>` 
                    const row = $(s);
                    row.find(".report-bill").click(function(){
                        baoCaoHoaDonKhongChinhXac(item.MaHoaDon,function(){
                            LocHoaDon(showAll,thangHienTai,daThanhToan,data.length==1 ? page-1:page);
                        });
                    })
                    row.find(".cancel-report-bill").click(function(){
                        cancelReportBill(item.MaHoaDon,function(){
                            LocHoaDon(showAll,thangHienTai,daThanhToan,data.length==1 ? page-1:page);
                        });
                    })
                    $('#showHoaDon').append(row); 
                })                                       
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    LocHoaDon($("#showAllHD").is(":checked"),thangHienTai.checked,daThanhToan.checked,page)
                })                 
            }
        else        
            handleCreateToast("error",res.message,'er1');
        },(res)=>{
            console.log(res)
        },data)                          
    }
    LocHoaDon(false,true,false,getPage())
    btnLoc = document.getElementById('btn_loc')
    btnLoc.addEventListener("click", () => {
        LocHoaDon($("#showAllHD").is(":checked"),thangHienTai.checked,daThanhToan.checked,1)
    })
    $("#showAllHD").click(()=>{
        LocHoaDon($("#showAllHD").is(":checked"),thangHienTai.checked,daThanhToan.checked,1)
    })
    // const baoCaoHoaDonKhongChinhXac = (MaHoaDon, func_thanhcong)=>{
    //     showMessage("Thông báo",`Xác nhận báo cáo hóa đơn "${MaHoaDon.trim()}" không đúng thông tin?`,function(){              
    //         $.ajax({
    //             url: BASE_URL+API_PREFIX_USER+API_PREFIX_BILL+API_AUTHEN_BILL_REPORT_WRONG_INFO,
    //             type: 'GET',
    //             data: {"MaHoaDon":MaHoaDon} ,
    //             success: function (res) {  
    //                 console.log(res)                 
    //                 if(res.success==true)        
    //                     {                               
    //                         handleCreateToast("success",res.message);  
    //                         if(typeof func_thanhcong==="function")  
    //                             func_thanhcong();                                                  
    //                     }
    //                 else        
    //                     handleCreateToast("error",res.message,'er1');
    //             },
    //             error: function (xhr, status, error) {
    //                 handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
    //             }
    //         }); 
    //     });
    // }
})