var loadDanhSachXetDuyet = ()=>{    
    $.get(BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_REVIEW_LIST,function(res){                                       
        if(res.success==true)        
            {      
                if(res.data.length == 0)
                {
                    $('#danh-sach-xet-duyet').html('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');
                    return 
                }                         
                res.data.forEach(item => {
                    let s =`<tr>
                            <td>
                                <input type="checkbox" name="${item.MaSV}" />
                            </td>
                            <td>
                                ${item.MaSV}
                            </td>
                            <td>
                                ${item.NgayGui}
                            </td>
                            <td>
                                ${item.TrangThai}
                            </td>
                            <td>
                                ${item.GhiChu ? item.GhiChu:''}
                            </td>
                            <td class="td-operation">
                                <a class="btn btn-info w-50" href="/admin/quanlyxetduyet/${item.MaSV}">Chi tiết</a>
                            </td>   
                        </tr>` 
                    const row = $(s);
                    if(item.TrangThai == 'Chờ xét duyệt')
                    {                        
                        const btnConfrim = $(`<a class="btn btn-primary">Duyệt</a>`)
                        const btnCancel = $(`<button class="btn btn-warning" id="huyBo" >Hủy bỏ</button>`)
                        btnConfrim.click(()=>{
                            showMessage("Thông báo","Xác nhận phê duyệt đăng ký?",()=>{
                                pheDuyetDangKy(item.MaSV,(res)=>{
                                    btnConfrim.remove();
                                    // btnCalcel.remove();
                                })
                            })
                        })
                        // btnCancel.click(()=>{
                            
                        // })
                        row.find(".td-operation").append(btnConfrim)
                        // row.find(".td-operation").append(btnCancel)
                    }
                    $('#danh-sach-xet-duyet').append(row)
                });  
                
                
            }
        else
            handleCreateToast("error",res.message);													 
})}

var xemThongTinDangKy = (MaSV)=>{    
    $.get(BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_CHECK_REGISTER_INFO,{'MaSV':MaSV},function(res){                                       
        console.log(res.message)
        if(res.success==true)        
            {                
                let data = res.data.info; 
                if(data.TrangThai=="Bị hủy")                
                    $('#browsing-operation').html(`
                    <a style="font-size: 22px" class=" disabled btn btn-dark">Đã hủy</a>`);                              
                else if(data.TrangThai=="Đã xét duyệt")                
                    $('#browsing-operation').html(`
                    <a style="font-size: 22px" class=" btn btn-danger">Đã xét duyệt</a>`);  
                let s = `<div class="row">
                            <h4 class="heading-bill-title">Thông tin sinh viên</h4>
                            <div class="col-lg-3">
                                <img src="${data.AnhDaiDien ?? URL_HOST+"img/User.png"}" alt="ảnh" class="Approval-user-img" />
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Ngày gửi:</h3>
                                            <span class="detail-bill-heading-name">${data.NgayGui}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Mã sinh viên:</h3>
                                            <span class="detail-bill-heading-name">${data.MaSV}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Họ và tên:</h3>
                                            <span class="detail-bill-heading-name">${data.Ho} ${data.Ten}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Giới tính:</h3>
                                            <span class="detail-bill-heading-name">${data.GioiTinh}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Số điện thoại:</h3>
                                            <span class="detail-bill-heading-name">${data.SoDienThoai}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">CMND/CCCD:</h3>
                                            <span class="detail-bill-heading-name">${data.SoCanCuoc}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Quê quán:</h3>
                                            <span class="detail-bill-heading-name">${data.QueQuan}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Đang học tại:</h3>
                                            <span class="detail-bill-heading-name">${data.Lop}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="heading-bill-title">Thông tin đăng ký</h4>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Gửi vào lúc:</h3>
                                    <span class="detail-bill-heading-name">${data.NgayGui}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Phòng đăng ký:</h3>
                                    <span class="detail-bill-heading-name">${data.MaPhong} - ${data.TenPhong}</span><br />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Trạng thái:</h3>
                                    <span class="detail-bill-heading-name"> ${data.TrangThai}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Trạng thái phòng:</h3>
                                    <span class="detail-bill-heading-name"> ${data.SoLuongTrong} chổ trống</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <h1 class="heading-bill-title">Thống kê phòng</h1>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Chờ:</h3>
                                            <span class="detail-bill-heading-name">${res.data.soluongcho}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="detail-bill-heading">
                                            <h3 class="detail-bill-heading-title">Đã xét duyệt:</h3>
                                            <span class="detail-bill-heading-name">${res.data.soluongdaxet}</span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <h4 class="heading-bill-title">Nhận xét: ${res.data.soluongdaxet < 10-data.SoLuongTrong? 'Còn chổ trống':'Đã đủ lượt xét duyệt'} </h4>
                        </div>`;
                        $('#content').html(s);
            }
        else        
            handleCreateToast("error",res.message,'er1');													 
})}

var huyBoDangKy = (fromData,func_success)=>{    
    $.ajax({
        url: BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_CANCEL_REGISTER,
        type: 'POST',
        data: fromData,
        success: function (res) {           
            if(res.success==true)        
                {                
                    handleCreateToast("success",res.message,'success1');  
                    if(typeof func_success === "function")
                        func_success(res)                                                                                                                  
                }
            else        
                handleCreateToast("error",res.message,'er1');
        },
        error: function (xhr, status, error) {
            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        }
    }); 
}


var pheDuyetDangKy = (MaSV,func_success) => {  
    // $.get(BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_REVIEW_LIST,function(res){       
    $.ajax({
        url: BASE_URL+API_PREFIX_ADMIN+API_AUTHEN_AGREE_REGISTER,
        type: 'PUT',
        data: {MaSV:MaSV},
        success: function (res) {           
            if(res.success==true)        
                {   
                    handleCreateToast("success",res.message,null,true); 
                    if(typeof func_success === "function")
                        func_success(res)  
                    else{                         
                        $('#browsing-operation').html(`
                        <a style="font-size: 22px" class=" btn btn-danger">Đã xét duyệt</a>`);   
                    }                                                                                                 
                }
            else        
                handleCreateToast("error",res.message,'er1');
            console.log(res)
        },
        error: function (xhr, status, error) {
            console.log(xhr)
            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại",null,true);
        }
    }); 
    // return axios.get(host + `PhanHoiXetDuyet?maSV=${maSV}&trangThai=${trangThai}&ghiChu=${ghiChu}`)
    //     .then((response) => {
    //         kq = response.data            
    //         handleCreateToast(kq.type, kq.msg, "kq1")
    //         if (kq.Success)
    //             setTimeout(() => { location.replace("DanhSachXetDuyet")},5000)
    //     });
}




function reload(time)
{   
    setTimeout(()=>location.reload(),time);
}


var thanhToanHopDong = (MaHopDong,ham_thanhcong)=>{    
    showMessage("Xác nhận thanh toán hợp đồng '"+MaHopDong+"'",
                "Đồng nghĩa với việc hợp đồng sẽ có hiệu lực, vẫn xác nhận?",
                function(){
                    $.ajax({        
                        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ADMIN_CONTRACT+API_AUTHEN_CONTRACT_PAYMENT,
                        type: 'POST',
                        data: {'MaHopDong':MaHopDong},
                        success: function (res) {              
                            console.log(res)         
                            if(res.success==true)        
                            {
                                handleCreateToast("success",res.message,'success1');
                                if (typeof ham_thanhcong === 'function') {
                                    ham_thanhcong();
                                } 
                            }
                            else        
                                handleCreateToast("error",res.message,'er1');                
                        },
                        error: function (xhr, status, error) {
                            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
                        }
                    }); 
                });   
}


var callApiRoom = (api, select,id = null,dataFilter = null) => {    
    return new CallApi(BASE_URL+api)
        .all((res)=>{
            if(res.success==true)                    
                    renderData(res.data, select,id);                
            else        
                handleCreateToast("error",res.message,'er-room',true);
        },(res)=>{
            console.log(res)
            handleCreateToast("error","Đã xãy ra lỗI","error-data-room",true);
        },dataFilter)        
}

var renderData = (array, select, id = null) => {
    let row = '<option disable value="">-- Tất cả --</option>';
    if (array != null)
        array.forEach(element => {
            row += `<option  value="${element.Ma}" ${id ? (id == element.Ma ? "selected" : "") : ""}>${element.Ma} - ${element.Ten} ${element.DoiTuong ? "("+element.DoiTuong+")" : ""}</option>`
        });          
    $(`#${select}`).html(row)    
}

function show_khu(idKhu = "khu",dataFilter = null)
{    
    callApiRoom(API_PREFIX_AREA+API_AUTHEN_AREA_LIST,idKhu,null,dataFilter);
}

function khu_change(idKhu = "khu",idTang = "tang",idPhong = "phong",MaTang = null){        
    $("#"+idKhu).change(() => {
        return $("#"+idKhu).val()===''?reloadAddress(idTang,idPhong,MaTang):reloadTang(idKhu,idTang,idPhong);
        
    });
}
var reloadAddress = (idTang = "tang", idPhong = "phong")=>{    
    $('#'+idTang).html('<option value=""> -- Tất cả -- </option>');
    $('#'+idPhong).html('<option value=""> -- Tất cả -- </option>');
}
var reloadTang = (idKhu = "khu",idTang = "tang",idPhong = "phong", MaTang = null,dataFilter = null)=>{       
    $('#'+idPhong).html('<option value=""> -- Tất cả -- </option>');
    callApiRoom(API_PREFIX_FLOOR + API_AUTHEN_FLOOR_BY_AREA+$("#"+idKhu).val(),idTang,MaTang,dataFilter);        
}
function tang_change(idTang = "tang",idPhong = "phong",dataFilter = null)
{                
    $("#"+idTang).change(() => {                
        return $("#"+idTang).val()===''?$('#'+idPhong).html('<option value=""> -- Tất cả -- </option>'):
        callApiRoom(API_PREFIX_ROOM+ API_AUTHEN_ROOM_BY_FLOOR + $("#"+idTang).val(),idPhong,null,dataFilter);
    });
}

var phong_change = (fun_phongChange,idPhong = "phong")=>{
    $("#"+idPhong).change(() => {
        if (typeof fun_phongChange === 'function') {
            fun_phongChange($("#"+idPhong));
        } 
    })
}


// var removeItemTable = (table_class_name,id_maHD)=>{
//     let table = document.querySelector("."+table_class_name); 
//     $(`#${id_maHD}`).remove();   
//     table.classList.remove(table_class_name)
//     table.classList.add(table_class_name)        
// }
var xemChiTietHoaDon = (MaHoaDon)=>{ 
    const buildEventButtonPayment = (maHoaDon)=>{
        $('#update-bill').html('<button class="open_btn btn_xacnhan btn btn-primary">Xác nhận thanh toán</button>')
        $('#update-bill').find('.btn_xacnhan').on("click",()=>{
            thanhToanHoaDon(maHoaDon,function(){{
                $('#update-bill').remove();
                $('#bill-status').html("Đã thanh toán")
            }});
        })
    }                                   
    $.ajax({
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL+API_AUTHEN_BILL_DETAILS,
        type: 'GET', 
        data: { "MaHoaDon": MaHoaDon},
        success: function (res) {                
            if(res.success==true)                    
                {
                    let hoaDon = res.data.hoadon
                    let s =`<div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Mã hóa đơn:</h3>
                                    <span class="detail-bill-heading-name">${hoaDon.MaHoaDon}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Phòng:</h3>
                                    <span class="detail-bill-heading-name">${hoaDon.MaPhong} - ${hoaDon.TenPhong}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Ngày tạo:</h3>
                                    <span class="detail-bill-heading-name">${hoaDon.NgayTao}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Thành tiền:</h3>
                                    <span class="detail-bill-heading-name">${parseInt(hoaDon.ThanhTien).toLocaleString('de-DE')}đ</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Người tạo:</h3>
                                    <span class="detail-bill-heading-name">${hoaDon.NguoiTao}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="detail-bill-heading">
                                    <h3 class="detail-bill-heading-title">Trạng thái:</h3>
                                    <span class="detail-bill-heading-name" id = "bill-status">${hoaDon.TrangThai}</span>
                                </div>
                            </div>`
                    $('#bill-info').html(s)

                    s='';
                    let cthd = res.data.chitiethoadon;
                    cthd.forEach(item=>{
                        s+=`<tr>
                                <td>${item.MaDichVu}</td>
                                <td>${item.TenDichVu}</td>
                                <td>${parseInt(item.DonGia).toLocaleString('de-DE')}đ</td>
                                <td>${item.SoLuong}</td>
                                <td>${parseInt(item.DonGia * item.SoLuong).toLocaleString('de-DE')}đ</td>
                            </tr>`
                    })
                    $('#bill-details').html(s)
                    if(hoaDon.TrangThai=="Chưa thanh toán")
                    {
                        buildEventButtonPayment(MaHoaDon)
                    }
                    else if(hoaDon.TrangThai=="Không chính xác")
                    {
                        $('#update-bill').html(`<button class="open_btn btn_xacnhan btn_xacthuc btn btn-primary">Xác thực chính xác</button>
                                                <a class="btn btn-warning" style="padding:10px;" href="/admin/quanlyhoadon/chinh-sua-hoa-don/${hoaDon.MaHoaDon}">Chỉnh sửa</a>`)
                        $('#update-bill').find('.btn_xacthuc').on("click",()=>{
                            XacThucHoaDon(MaHoaDon,function(){{
                                buildEventButtonPayment(MaHoaDon)
                            }});
                        })
                    }                    
                }                
            else        
                handleCreateToast("error",res.message,'er1');
        },
        error: function (xhr, status, error) {
            console.log(xhr)
            handleCreateToast("error","Đã xãy ra lỗI");
        }
    }); 
}


const reloadTotalPrice = () => {
    const elementIntoMoney = $("#into-money");
    let totalPrice = 0;
    const trServicess = $('.tr-service');   
    // const tdTotalPrices = $(".total-price");
    for (var trServices of trServicess) {
        trServices = $(trServices)
        if(trServices.data("pass") == false)        
            return elementIntoMoney.text("---");                            
        totalPrice +=parseInt(trServices.data("total-price"))
    }
    elementIntoMoney.text(totalPrice.toLocaleString('de-DE') + 'đ')
}

const createInputBill=()=>{
    var errors = $('.error-validate');
    var trServices = $('.tr-service-mandatory');        
    const services = $('.dvPhong')            
    services.each(function(index,element){
        let error = $(errors[index]);
        let rowService = $(trServices[index]);
        let price = parseInt($(this).data("price"))
        // let serviceName = $(this).data("service-name");
        $(this).on("input", function () {                           
            let newQuantity = parseInt($(this).val()), oldQuantity = parseInt($(this).data("minimum") ?? 0);                   
            if ($(this).val() == "" || newQuantity < oldQuantity) {
                error.text("* " + ($(this).val() == "" ? "Không để trống" : "Số mới phải lớn hơn số cũ"))      
                rowService.data("pass",false)  
                rowService.find(".td-quantity").text("-")                    
                rowService.find(".td-total-price").text("-")                                
            }
            else {
                error.text("*")   
                let totalPrice = (newQuantity - oldQuantity) * price
                rowService.find(".td-quantity").text(newQuantity-oldQuantity)                    
                rowService.find(".td-total-price").text(totalPrice.toLocaleString("de-DE")+"đ")
                rowService.data("pass",true)
                rowService.data("total-price",totalPrice)
                // let s = "";     
                // // s += `<td>${serviceName}</td>
                // //     <td>${price}</td>
                // //     <td>${newQuantity-oldQuantity}</td>
                // //     <td class="total-price" >${}</td>`
                // //     rowService.html(s);                
            }
            reloadTotalPrice();
        })
    })        
}


// var ThanhTien = () => {
//     let tong = 0;
//     const trServices = $('.tr-service');   
//     const tdTotalPrices = $(".total-price");
//     for (var tdTotalPrice of tdTotalPrices) {
//         tdTotalPrice = $(tdTotalPrice)
//         if(tdTotalPrice.)
//     }
//     document.querySelectorAll('.total-price').forEach(t => tong += parseInt(t.innerText))
//     thanhtien.innerText = tong.toLocaleString('de-DE') + 'đ';
// } 




// const createInputBill=()=>{
//     var lois = document.querySelectorAll('.loi');
//     var trServices = document.querySelectorAll('.tr-service');
//     var gias = document.querySelectorAll('.gia')
//     var dvs = document.querySelectorAll('.dvPhong')    
//     var tenDVs = document.querySelectorAll('.tenDV');
//     for (var i = 0; i < dvs.length; i++) {
//         let l = lois[i];
//         let tb = trServices[i];
//         let gia = parseInt(gias[i].innerText)
//         let tendv = tenDVs[i].innerText;
//         dvs[i].addEventListener("input", function () {
//             let moi = parseInt(this.value), cu = parseInt(this.min);            
//             if (this.value == "" || moi < cu) {
//                 l.hidden = false;
//                 tb.innerHTML = "";
//             }
//             else {
//                 l.hidden = true;
//                 let s = "";     
//                 s += `<td>${tendv}</td>
//                     <td>${gia}</td>
//                     <td> <input type="text" name="Sl${this.name}" value="${moi - cu}" readonly class="soluong btn" /></td>
//                     <td class="tongtien" >${(moi - cu) * gia}</td>`
//                 tb.innerHTML = s;                
//             }
//             ThanhTien();
//         })
//     }
// }

const XacThucHoaDon = (MaHoaDon, func_thanhcong)=>{
    showMessage("Thông báo",`Xác thực hóa đơn "${MaHoaDon}" chính xác thông tin?`,function(){        
        new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL)
        .patch(undefined,null,(res)=>{
            
            handleCreateToast("success",res.message,null,true);    
            if(typeof func_thanhcong === "function")    
                func_thanhcong()
        },(res)=>{            
            handleCreateToast("error",res.error,null,true);
        },MaHoaDon+"/"+API_AUTHEN_BILL_REPORT_CANCEL)    
    })
}
var thanhToanHoaDon = (MaHoaDon,ham_thanhcong)=>{
    showMessage(`Thông báo`,`Xác nhận thanh toán hóa đơn"${MaHoaDon}"`,function(){
        var token = document.querySelector('meta[name="csrf-token"]');
        $.ajax({        
            url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_BILL+API_AUTHEN_BILL_PAYMENT,
            type: 'POST',
            data: {'MaHoaDon':MaHoaDon,
                    _token:token ? token.getAttribute('content') : ""
                },
            success: function (res) {                                      
                if(res.success==true)        
                {
                    handleCreateToast("success",res.message,'success1');
                    if (typeof ham_thanhcong === 'function') {
                        ham_thanhcong();
                    } 
                }
                else        
                    handleCreateToast("error",res.message,'er1');                
            },
            error: function(xhr, status, error) {
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        });
    })
}

const CallApiRoomDetails = (MaPhong,func_success,func_fail)=>{
    $.ajax({        
        url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ROOM+API_AUTHEN_ROOM_DETAILS,
        type: 'GET',        
        data:{
            'MaPhong':MaPhong
        },
        success: function (res) {   
            if (typeof func_success === 'function') {
                func_success(res);
            }                         
        },
        error: function(xhr, status, error) {
            if (typeof func_fail === 'function') {
                func_fail(xhr.responseJSON);
            } 
            handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
        }
    });
}


// const CreateEnventDoiTruongPhongSuccess = (MaPhong,MaSV,row)=>{
//     doiTruongPhong(MaPhong,MaSV,(res)=>{
//         if(res.success==true)        
//         {        
//             handleCreateToast("success",res.message,null,true);             
//             row.find(".btn_xacnhan").remove(); 
//             row.find(".td-id").html(`<b class="leader-room-name">Trưởng phòng</b></td>`)
//             btnChangeLeader  = $(`<button value="${MaSV}" class="btn_xacnhan">Đổi trưởng phòng</button>`)
//             let id = $(".leader-room").data("id");
//             btnChangeLeader.click(()=>{
//                 CreateEnventDoiTruongPhongSuccess(MaPhong,id,$(".leader-room").parent())
//             })
//             $(".leader-room").html("")
//             $(".leader-room").append(btnChangeLeader);
//             $(".leader-room").removeClass("leader-room");  
//             row.find(".td-id").addClass("leader-room")      
//         }
//         else        
//             handleCreateToast("error",res.message,'er1',true); 
//     })
// }

var doiTruongPhong = (MaPhong,MaSV,func_success,func_fail)=>{
    showMessage("Thông báo",`Xác nhận đổi trưởng phòng cho sinh viên "${MaSV}"?`,function(){
        $.ajax({        
            url: BASE_URL+API_PREFIX_ADMIN+API_PREFIX_ROOM+API_AUTHEN_CHANGE_MANAGER,
            type: 'POST',        
            data:{
                'MaPhong':MaPhong,
                'MaSV':MaSV
            },
            success: function (res) {  
                if(typeof func_success === "function")  
                    return func_success(res);                                                  
            },
            error: function(xhr, status, error) {
                if(typeof func_fail === "function")  
                    func_fail(res); 
                handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
            }
        });
    })
}




