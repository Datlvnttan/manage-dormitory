$(document).ready(()=>{
    var LocKhaiBaoHuHong = (thangHienTai,daXuLy,page) => {

        const data = {
            "tatCa":$("#showAllHD").is(":checked"),
            "khu":$("#khu").val(),
            "tang":$("#tang").val(),
            "phong":$("#phong").val(),
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daXuLy":daXuLy,
            "chuaXuLy":chuaXuLy.checked,
            "page":page,
        }   
        console.log(data)
        CallApiDamaRepostManagerGet(data,(res)=>{
            console.log(res)
            if(res.success==true)        
            {                                                   
                var s = '';
                var data = res.data            
                data.forEach(item => {
                    let nut = ""
                    if (item.DaXuLy==false)
                        nut = ` | <a href="huhongsuachua/xu-ly-khai-bao-hu-hong/${item.MaKhaiBao}" class="bill-button-detail">Xử lý</a>`
                        //nut = '<button class="btn_thanhtoan open_btn btn_xacnhan " value="' + item.MaHoaDon + '">Xác nhận</button>';
                    s += ` <tr>
                            <td>${item.MaKhaiBao}</td>
                            <td>${item.NgayYeuCau}</td>
                            <td>${item.MaPhong} - ${item.TenPhong}</td >
                            <td>${item.TenThietBi}</td>
                            <td>${item.TongSoLuong}</td>
                            <td>${item.DaXuLy == true ? "Đã" : "Chưa"} xử lý</td>
                            <td>
                                <a href="${"XemThongTinXuLyKhaiBaoHuHong?MaKhaiBao=" + item.MaKhaiBao}" class="bill-button-detail">Chi tiết</a> ${nut}
                            </td>
                        </tr>`                           
                })
                if (s == '') {
                    $('#khaiBaoHuHongs').html('');
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#khaiBaoHuHongs').append(title);
                    return;
                }  
                $('#khaiBaoHuHongs').html(s); 
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    LocKhaiBaoHuHong(thangHienTai,daXuLy,page)
                })                                                                                                                                   
            }
            else        
                handleCreateToast("error",res.message,'er1');
        },(res)=>{
            console.log(res)
        })                
    
    }
    LocKhaiBaoHuHong(true,false,1);
    
    btnLoc = document.getElementById('btn_loc')
    btnLoc.addEventListener("click", () => {
        LocKhaiBaoHuHong(thangHienTai.checked,daXuLy.checked,1)
    })
    $(showAllHD).click(()=>{
        LocKhaiBaoHuHong(thangHienTai.checked,daXuLy.checked,1)
    })
})