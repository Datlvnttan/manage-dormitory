$(document).ready(()=>{
    const lichSuViPham = (thangHienTai,daGiaiQuyet,page) => {        
        data = {
            "tatCa":$("#showAllHD").is(":checked"),
            "khu":$("#khu").val(),
            "tang":$("#tang").val(),
            "phong":$("#phong").val(),
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daXuLy":daGiaiQuyet,
            "chuaXuLy":chuaGiaiQuyet.checked,
            "khongChinhXac":khongChinhXac.checked,
            "page":page,
        }    
        CallApiInfringeManagerGet(data,(res)=>{
            const apiInfringe = new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_INFRINGE+API_AUTHEN_INFRINGE_HISTORY_LIST)
            if(res.success==true)        
            {                        
                $('#infringe-history-list').html('');                                           
                var data = res.data 
                console.log(res)
                if (data.length==0) {                    
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#infringe-history-list').append(title);
                    return;
                }   
                data.forEach(item => {                    
                    let s = ` <tr>
                            <td>${item.MaSV}</td>
                            <td>${item.Ho} ${item.Ten}</td>
                            <td>${item.MaViPham}</td>
                            <td>${item.NoiDung}</td >
                            <td>${item.ThoiGianViPham}</td>
                            <td>${item.HinhPhat}</td>
                            <td>${item.NguoiTao}</td>                            
                            <td>${item.TrangThai}</td>
                            <td class="td-operation">

                            </td>
                        </tr>`     
                        const row = $(s)  
                        var btn = null;
                    if (item.TrangThai=="Chưa xử lý")
                    {
                        btn = $(`<a class="btn btn-warning">Xác nhận đã xử lý</a>`)
                        btn.click(()=>{
                            showMessage("Thông báo","Xác nhận đã xử lý vi phạm này?",()=>{
                                apiInfringe.patch(item.MaSV+"/"+item.MaViPham+"/"+item.ThoiGianViPham,undefined,
                                (res)=>{
                                    showMessage("Thành công","Xác nhận thành công",()=>{
                                        location.reload()
                                    },false)
                                },(res)=>{
                                    console.log(res)
                                },API_AUTHEN_CONFRIM)
                            })
                        })
                    }
                    else if (item.TrangThai=="Không chính xác")
                    {
                        btn = $(`<a class="btn btn-primary">Xác thực</a>`)
                        btn.click(()=>{
                            showMessage("Xác thực?","Xác thực khai báo vi phạm này là chính xác?",()=>{
                                apiInfringe.patch(item.MaSV+"/"+item.MaViPham+"/"+item.ThoiGianViPham,undefined,
                                (res)=>{
                                    showMessage("Thành công","Xác thực thành công",()=>{
                                        location.reload()
                                    },false)
                                },(res)=>{
                                    console.log(res)
                                },API_AUTHEN_ACCURACY)
                            })
                        })
                    } 
                    row.find(".td-operation").append(btn ?? "")
                    $('#infringe-history-list').append(row); 
                })                                
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    lichSuViPham(thangHienTai,daGiaiQuyet,page)
                })                                              
            }
            else        
                handleCreateToast("error",res.message,'er1');
        },(res)=>{
            console.log(res)
        })       
        // $.ajax({
        //     url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_INFRINGE+API_AUTHEN_INFRINGE_HISTORY_LIST,
        //     type: 'GET',
        //     data: data ,
        //     success: function (res) { 
        //         console.log(res)                             
                
        //     },
        //     error: function (xhr, status, error) {
        //         handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        //     }
        // }); 
    }
    lichSuViPham(true,false,getPage())
    $('#btn_loc').on("click",()=>{
        lichSuViPham(thangHienTai.checked,daGiaiQuyet.checked,1)
    })
    $("#showAllHD").on("click",()=>{
        lichSuViPham(thangHienTai.checked,daGiaiQuyet.checked,1)
    })
})