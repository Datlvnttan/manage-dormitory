$(()=>{
    const tableReportDamage = $('#khaiBaoHuHongs');
    const lichSuKhaiBao = (showAll,thangHienTai,daXuLy,page)=>{
        data = {        
            "tatCa":showAll,        
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daXuLy":daXuLy,
            "chuaXuLy":chuaXuLy.checked,
            "page":page,
        }           
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_USER_DAMAGE+API_AUTHEN_DAMAGE_REPORT_HISTORY,
            type: 'GET',
            data: data ,
            success: function (res) {                              
                if(res.success==true)        
                    {   
                        tableReportDamage.html('');                                                                    
                        var data = res.data   
                        if(data.length == 0)
                        {                        
                            let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                            tableReportDamage.append(title);
                            return;
                        }         
                        data.forEach(item => {                        
                        var s = ` <tr>
                                    <td>${item.MaKhaiBao}</td>
                                    <td>${item.NgayYeuCau}</td>s                                
                                    <td>${item.TenThietBi}</td>
                                    <td>${item.TongSoLuong}</td>
                                    <td>${item.DaXuLy == true ? "Đã" : "Chưa"} xử lý</td>
                                    <td>                                        
                                        ${item.DaXuLy == false ? ( res.isleader == true ? `<button class="btn btn-danger">Xóa</button>` : ""):
                                        `<a href="${"/user/khaibaohuhong/" + item.MaKhaiBao}" class="bill-button-detail">Chi tiết</a>`}
                                    </td>
                                </tr>`;
                            const row = $(s);
                            if(item.DaXuLy == false && res.isleader == true)
                            {
                                row.find(".btn-danger").click(function(){
                                    showMessage("Thông báp","Xác nhận xóa khai báo hư hỏng này?",function(){
                                        CallApiDeleteDamageReport(item.MaKhaiBao,(res)=>{
                                            handleCreateToast("success","Xóa khai báo thành công",null,true);
                                            lichSuKhaiBao($("#showAllHD").is(":checked"),thangHienTai,daXuLy,page)
                                        },(res)=>{
                                            console.log(res)
                                        })
                                    })
                                })  
                            }                        
                            tableReportDamage.append(row);                     
                        })
                        loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                            lichSuKhaiBao($("#showAllHD").is(":checked"),thangHienTai,daXuLy,page)
                        })                 
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 
    }
    lichSuKhaiBao(false,true,false,getPage())   
    $('#btn_loc').on("click", () => {
        lichSuKhaiBao($("#showAllHD").is(":checked"),thangHienTai.checked,daXuLy.checked,1)
    })

    $("#showAllHD").on("click", () => {
        lichSuKhaiBao($("#showAllHD").is(":checked"),thangHienTai.checked,daXuLy.checked,1)
    })


})