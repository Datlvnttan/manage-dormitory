$(document).ready(function(){
    const emlemntThietbi = $('#thietbis')
    const input = $("#soluonghuhong")
    createInputNumber(input,1,9999999999);
    const danhSachThietBi = ()=>{        
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_DEVICE+PREFIX_DIVICE_OF_ROOM,
            type: 'GET',
            success: function (res) {    
                console.log(res)                          
                if(res.success==true)        
                    {                                                   
                        let rows = '<option value="-1"> --Chọn-- </option>';    
                        if (res.data != null)
                            res.data.forEach(element => {           
                                rows += `<option title="${element.SoLuongPhanBo}" value="${element.MaThietBi}">${element.TenThietBi} (${element.SoLuongPhanBo})</option>`
                            });
                            emlemntThietbi.html(rows)                
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 
    }
    const getSoLuongDaYeuCauChuaXuLy = ()=>{
        $.ajax({
            url: BASE_URL+API_PREFIX_USER+API_PREFIX_USER_DAMAGE+API_AUTHEN_DAMAGE_SUM_REQUETS_NO_PROCESS,
            type: 'GET',
            data:{'MaThietBi':emlemntThietbi.val()},
            success: function (res) {
                console.log(res)                                                              
                if(res.success==true)        
                    {              
                        let data = res.data                                                                  
                        soluongdayeucau.innerHTML = `(Số lượng báo cáo chưa xử lý: <span id="sldakekhai">${data.TongSoLuongChuaXuLy}</span>)`
                        let soLuong = parseInt(data.ThietBi.SoLuongPhanBo) - parseInt(data.TongSoLuongChuaXuLy)                        
                        input.data("maximum",soLuong) 
                        if (soLuong <1) 
                        {                           
                            $("#soluonghuhong").prop("disabled", true);
                            $("#btn_submit").prop("disabled", true);  
                        }
                        else
                        {                            
                            $("#soluonghuhong").prop("disabled", false);
                            $("#btn_submit").prop("disabled", false);  
                        }               
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 
    }
    var xacNhanKhaiBaoHuHong = (formData)=>{    
        showMessage("Xác nhận khai báo hư hỏng thiết bị?","Nếu khai báo không chính xác, bạn sẽ có thể bị xử lý theo quy định của ký túc xá! Xác nhận ?",function(){
            $.ajax({
                url: BASE_URL+API_PREFIX_USER+API_PREFIX_USER_DAMAGE+API_AUTHEN_DAMAGE_SUM_COMFIRM_REPORT,
                type: 'POST',
                data: formData,
                success: function (res) {   
                    console.log(res)                                      
                    if(res.success==true)        
                        {              
                            handleCreateToast("success", res.message,null,true)
                            thietbis.selectedIndex = 0          
                            reset()                
                        }
                    else        
                        handleCreateToast("error",res.message,'er1');
                },
                error: function (xhr, status, error) {                    
                    handleCreateToast("error",xhr.responseJSON.error ?? "Đã xãy ra lỗi, vui lòng thử lại",null,true);
                }
            }); 
        })
    }
    $("#thietbis").change(() => {   
        if (thietbis.selectedIndex == 0) 
            reset();    
        else {     
            input.val("");       
            getSoLuongDaYeuCauChuaXuLy()
        }
    });        
    // $('#soluonghuhong').on('input',()=>{
    //     let sl = parseInt(soluonghuhong.max)
    //     let slinput = parseInt(soluonghuhong.value)
    //     if (sl < slinput)
    //         soluonghuhong.value = soluonghuhong.value.substring(0, soluonghuhong.value.length - 1)

    // })
    $("#form-report").on('submit',(ev)=>{  
        ev.preventDefault();
        let fromData = $('#form-report').serialize();
        if (soluonghuhong.value == null || soluonghuhong.value == "") {            
            handleCreateToast("error", "Vui lòng nhập số lượng muốn khai báo","error",true)            
            return;
        }
        xacNhanKhaiBaoHuHong(fromData);
        
    })
    // subvalue.addEventListener("click", () => {
    //     axios.get(host + `KhaiBaoHuHong?maThietBi=${$('#thietbis').val()}&soLuong=${soluonghuhong.value}`)
    //         .then((response) => {
    //             ketqua = response.data            
    //             if (data.Success) {
    //                 handleCreateToast("success", ketqua.msg,"thanhcong")
    //                 thietbis.selectedIndex = 0                
    //                 exit.click();
    //                 reset()
    //             }
    //             else
    //                 handleCreateToast("error", ketqua.msg,"thatbai")
    //         });
    // })

    function reset() {
        $("#soluonghuhong").val('')
        $("#soluongdayeucau").html('')
        $("#soluonghuhong").prop("disabled", true);
        $("#btn_submit").prop("disabled", true);    
    }
    danhSachThietBi();
})