$(document).ready(function(){
    const btnFilter = $(".btn-filter");
    const showBill = $('#showHoaDon');
    var LocHoaDon = (thangHienTai,daThanhToan,page = 1) => {
        data = {
            "tatCa":$(showAllHD).is(":checked"),
            "khu":$("#khu").val(),
            "tang":$("#tang").val(),
            "phong":$("#phong").val(),
            "thangHienTai":thangHienTai,
            "nam":$("#nam").val(),
            "thang":$("#thang").val(),
            "daThanhToan":daThanhToan,
            "chuaThanhToan":chuaThanhToan.checked,
            "khongChinhXac":khongChinhXac.checked,
            "page":page
        }           
        CallApiFilterBill(data,(res)=>{  
            console.log(res)          
            var data = res.data   
            showBill.html('');
            if (data.length == 0) {                
                let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                showBill.append(title);
                return;
            }                            
            data.forEach(item => {                        
                var btns =  null;
                if (item.TrangThai=="Chưa thanh toán")
                {
                    let nut = `<button class="btn_thanhtoan open_btn btn_xacnhan" value="' + item.MaHoaDon + '">Xác Nhận</button>`
                    btns = $(nut);
                    btns.click(function(){
                        thanhToanHoaDon(item.MaHoaDon,()=>{
                            LocHoaDon(thangHienTai,daThanhToan,data.length==1 ? page-1:page);
                        })
                    })
                }
                else if (item.TrangThai == "Không chính xác")
                {
                    let nuts = `<div><a href="quanlyhoadon/chinh-sua-hoa-don/${item.MaHoaDon}" class="btn_xacnhan" value="' + item.MaHoaDon + '">Chỉnh sửa</a>
                    <br/>                                    
                    <button class="btn_xacthuc btn btn-outline-primary btn_xacnhan" >Xác thực</button></div>`
                    btns = $(nuts);
                    btns.find(".btn_xacthuc").click(function(){                        
                        XacThucHoaDon(item.MaHoaDon,()=>{
                            LocHoaDon(thangHienTai,daThanhToan,data.length==1 ? page-1:page);
                        });
                    })
                }
                s =` <tr>
                        <td>${item.MaHoaDon}</td>
                        <td>${item.MaPhong}</td>
                        <td>${item.NgayTao}</td >
                        <td>${parseInt(item.ThanhTien).toLocaleString('de-DE')}đ</td>
                        <td>${item.NguoiTao}</td>
                        <td>${item.TrangThai}</td>
                        <td class="btn-options"><a href="quanlyhoadon/${item.MaHoaDon}">Chi tiết</a><br/></td>                                
                      </tr>`
                const row = $(s); 
                row.find(".btn-options").append(btns);
                showBill.append(row);
            })  
            loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                LocHoaDon(thangHienTai,daThanhToan,page)
            })                                       
        },(res)=>{
            console.log(res)
        })             
    }
    btnFilter.click(function(){        
        LocHoaDon(thangHienTai.checked,daThanhToan.checked,1)
    })
    $(showAllHD).click(function(){           
        LocHoaDon(thangHienTai.checked,daThanhToan.checked,1)
    })
    LocHoaDon(true,false,getPage())
})