
const CallApiDamaRepostManager = (data,func_success,func_fail,method = METHOD_GET,prefix = "")=>{
    return BuildCallApi(data,
        func_success,
        func_fail,
        method,
        BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_DAMAGE+API_AUTHEN_DAMAGE_EQUIPMENT_LIST + "/",
        prefix) 
}
const CallApiDamaRepostManagerGet = (data,func_success,func_fail)=>{
    CallApiDamaRepostManager(data,func_success,func_fail)											 
}



var xuLyKhaiBaoHuHong = (MaKhaiBao) => {
    
    $.ajax({
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_DAMAGE+API_AUTHEN_DAMAGE_REPORT_HANDING,
        type: 'GET',
        data: {"MaKhaiBao":MaKhaiBao} ,
        success: function (res) {    
            if(res.data == null)
            $('#body-handing').html(`<br><br><center><h1>Khai báo này không tồn tại</h1></center>`);            
            if(res.success==true)        
                {              
                    let data = res.data                                
                    let s = `<span>Mã khai báo: </span><span id="MAKHAIBAO">${data.MaKhaiBao}</span>  <br />
                                <span>Ngày yêu cầu: </span><span>${data.NgayYeuCau}</span>  <br />
                                <span>Phòng: </span><span>${data.MaPhong} - ${data.TenPhong}</span>   <br />
                                <span>Thiết bị hư hỏng: </span><span>${data.MaThietBi} - ${data.TenThietBi}</span>  <br />
                                <span>Tổng số lượng hư hỏng:</span><span id="TONGSOLUONG">${data.TongSoLuong}</span>   <br />`;                    
                    $('#damage-report-handing').html(s);     
                    TONGSOLUONG = data.TongSoLuong; 
                    addItem()
                    checkInputNumber()          
                }
            else        
                handleCreateToast("error",res.message,'er1');
        },
        error: function (xhr, status, error) {
            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        }
    }); 

}

var xacNhanXuLyKhaiBaoHuHong = (MaKhaiBao)=>{
    var numbers = document.querySelectorAll(".number")
    if (checkIsEmpty(numbers)) {
        handleCreateToast("error", "Để lưu dữ liệu, tất cả mục nhập số lượng không được để trống!!!", "err3");
        return;
    }
    if (getItemsTotalQuantity(numbers) < TONGSOLUONG) {
        handleCreateToast("error", "Để lưu dữ liệu, cần phải xử lý toàn bộ các thiết bị (đạt tổng số lượng tối đa)!!!", "err4");
            return;
    }
    showMessage("Thông báo","Xác nhận hoàn thành thao tác xử lý?",function()
    {
        let list = []
        var itemXulys = document.querySelectorAll('.item-xuly')
        itemXulys.forEach(item => {
            var soLuong = item.querySelector('.number').value
            var thayMoi = item.querySelector('input[name^="phuongphap_"]:checked').value == 1 ? true : false
            var nguyenNhan = item.querySelector('input[name^="nguyennhan_"]:checked').value
            var chiPhiPhatSinh = item.querySelector('input[type = "text"][name ^= "txtChiPhiPhatSinh"]').value            
            list.push({
                "SoLuong":soLuong,
                "ThayMoi":thayMoi,
                "NguyenNhan":nguyenNhan,
                "ChiPhiPhatSinh":chiPhiPhatSinh
            })
        })        
        $.ajax({
            url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_DAMAGE+API_AUTHEN_DAMAGE_REPORT_CONFIRM_HANDING,
            type: 'POST',
            data: {"list":list,
                "MaKhaiBao":MaKhaiBao} ,
            success: function (res) {                             
                if(res.success==true)        
                    {
                        handleCreateToast("success",res.message,'success1');
                        setTimeout(()=>location.replace('/admin/huhongsuachua'),1500)
                    }
                else        
                    handleCreateToast("error",res.message,'er1');
            },
            error: function (xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        }); 
        
    })
}
