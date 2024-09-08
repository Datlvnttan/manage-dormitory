$(document).ready(function() {



    var LocSinhVien = (showAll,dangO,page = 1) => {
        data = {
            "tatCa":showAll,
            "khu":$("#khu").val(),
            "tang":$("#tang").val(),
            "phong":$("#phong").val(),        
            "dangO":dangO,
            "daXetDuyet":daXetDuyet.checked,
            "tamVang":tamVang.checked,
            "choXetDuyet":choXetDuyet.checked,
            "chuaDangKy":chuaDangKy.checked,
            "biHuy":biHuy.checked,
            "biCam":biCam.checked,
            "page":page
        } 
        CallApiStudentManagerGet(data,(res)=>{
            if(res.success==true)        
            {       
                var s = '';
                $("#pagination").html("")
                var data = res.data                              
                data.forEach(item => {                        
                    let nut = "";
                    if (item.TrangThai=="Chưa thanh toán")
                        nut = `<button onclick="thanhToanHoaDon('${item.MaHoaDon}',function(){LocHoaDon(${showAll},${thangHienTai},${daThanhToan},${data.length==1 ? page-1:page})})" class="btn_thanhtoan open_btn btn_xacnhan" value="' + item.MaHoaDon + '">Xác Nhận</button>`
                    else if (item.TrangThai == "Không chính xác")
                        nut = `<a href="quanlyhoadon/chinh-sua-hoa-don/${item.MaHoaDon}" class="btn_xacnhan" value="' + item.MaHoaDon + '">Chỉnh sửa</a>
                                <br/>                                    
                                <button onclick="XacThucHoaDon('${item.MaHoaDon}',function(){LocHoaDon(${showAll},${thangHienTai},${daThanhToan},${data.length==1 ? page-1:page})})" class="btn btn-outline-primary btn_xacnhan" >Xác thực</button>`
                    s +=`<tr>                                
                            <td>${item.MaSV}</td>
                            <td>${item.Ho} ${item.Ten}</td>
                            <td>${item.GioiTinh ?? ""}</td>
                            <td>${item.Lop ?? ""}</td>
                            <td>${item.SoCanCuoc ?? ""}</td>                                                             
                            <td>${item.MaPhong ?? ""}</td>
                            <td>${item.TrangThai == "Chưa đăng ký" ? item.TrangThaiDangKy ?? item.TrangThai:item.TrangThai}</td>
                            <td>
                                
                            </td>
                        </tr>`                        
                })
                if (s == '') {
                    $('#show-students').html('');
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#show-students').append(title);
                    return;
                }  
                $('#show-students').html(s); 
                loadPaginationButtons(page,res.numpages,(page,numpages)=>{
                    LocSinhVien(showAll,dangO,page)
                })                                                                         
            }
            else        
                handleCreateToast("error",res.message,'er1');
        },(res)=>{
            console.log(res)
        })             
    
    }


    show_khu()
    khu_change();
    tang_change();
    $('#btn_loc').on('click',()=>{
        LocSinhVien(showAllHD.checked,dangO.checked,1)
    })
    $('#dangO').on('change', function() {
        if ($(this).is(':checked')) {                                        
            $('#filter-location').slideDown()
        } else {
            $('#filter-location').slideUp()                                    
        }
    });  
    LocSinhVien(false,true,1)
                                                     
});      