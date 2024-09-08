$(()=>{

    var lichSuViPham = (showAll,thangHienTai,daGiaiQuyet,page) => {

        data = {
            "tatCa":showAll,        
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daXuLy":daGiaiQuyet,
            "chuaXuLy":chuaGiaiQuyet.checked,
            "khongChinhXac":khongChinhXac.checked,
            "page":page,
        }           
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_INFRINGE+API_AUTHEN_INFRINGE_HISTORY_LIST,
            type: 'GET',
            data: data ,
            success: function (res) { 
                console.log(res)                             
                if(res.success==true)        
                    {    
                        $('#infringe-history-list').html('');                                                                       
                        var data = res.data
                        if(data.length == 0)
                        {                            
                            let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                            $('#infringe-history-list').append(title);
                            return;
                        }
                        data.forEach(item => {
                            let nut = ""
                            let s = ` <tr>                                
                                    <td>${item.MaViPham}</td>
                                    <td>${item.NoiDung}</td >
                                    <td>${item.ThoiGianViPham}</td>
                                    <td>${item.HinhPhat ? item.HinhPhat :""}</td>                                                                    
                                    <td>${item.TrangThai}</td>
                                    <td class="td-operation">
                                    
                                    </td>
                                </tr>`             
                            const row = $(s);
                            if(item.TrangThai == "Chưa xử lý")
                            {
                                const btnReport = $(`<button class="btn btn-warning">Báo cáo</button> `)
                                btnReport.click(()=>{
                                    showMessage("Báo cáo?","Xác nhận báo cáo lỗi vi phạm này của bạn không chính xác?",()=>{
                                        new CallApi(BASE_URL+API_PREFIX_USER+API_PREFIX_INFRINGE)
                                        .patch(item.MaViPham+"/"+item.ThoiGianViPham,null,(res)=>{                                            
                                            handleCreateToast("success","Báo cáo thành công",null,true)
                                            btnReport.remove();
                                            html("Không chính xác")
                                        },(res)=>{
                                            row.find(".td-operation").console.log(res)
                                        })
                                    })
                                })
                                row.find(".td-operation").append(btnReport)
                            }
                            $('#infringe-history-list').append(row)             
                        })                                                                         
                        loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                            lichSuViPham($("#showAllHD").is(":checked"),thangHienTai,daGiaiQuyet,page)
                        })               
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                console.log(xhr)
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 

    }
    lichSuViPham(false,true,false,getPage());
    $('#btn_loc').on("click",()=>{
        lichSuViPham($("#showAllHD").is(":checked"),thangHienTai.checked,daGiaiQuyet.checked,1)
    })
    $('#showAllHD').on("click",()=>{
        lichSuViPham($("#showAllHD").is(":checked"),thangHienTai.checked,daGiaiQuyet.checked,1)
    })
})