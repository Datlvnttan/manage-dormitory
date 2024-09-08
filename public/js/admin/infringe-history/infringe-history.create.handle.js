let sinhViens = null;
tblThongTinSinhVien.hidden = true;
thaoTacViPham.hidden = true
tblLichSuViPham.hidden = true;
btnXacNhan.disabled = true

const room = $("#phong");

room.change(() => {   
    CallApiGettudentByRoom(room.val(),(res)=>{        
        let rows = ' <option disable value=""> --Chọn-- </option>';        
        if (res.success) {
            let data = res.data;
            if(data.length == 0)        
                handleCreateToast("info","Phòng này không có sinh viên nào",null,true)            
            else
                clearToasts();
            sinhViens = data;
            data.forEach(dt => {
                rows += `<option value="${dt.MaSV}">${dt.MaSV} - ${dt.Ho + " " + dt.Ten}</option>`;
            });
        }                
        sinhvien.innerHTML = rows;
        resetFrom();
    },(res)=>{
        console.log(res)
    })    
});


$("#khu").change(() => {
    resetFrom();
    sinhvien.innerHTML = `<option disable value=""> --Chọn-- </option>`;
})
$("#tang").change(() => {
    resetFrom();
    sinhvien.innerHTML = `<option disable value=""> --Chọn-- </option>`;
})


var resetFrom = () => {
    tblThongTinSinhVien.hidden = true;
    tblLichSuViPham.hidden = true;
    maSV.value = ""
    // soCanCuoc.value = ""
    //soDienThoai.value = ""
    khongcoLSVP.innerHTML = ""
    thaoTacViPham.hidden = true;
}

$("#sinhvien").change(() => {
    if ($("#sinhvien").val() == "") {
        resetFrom();
        return;
    }
    maSV.value = ""
    //hoTen.value = ""
    // soCanCuoc.value = ""
    //soDienThoai.value = ""
    //ngaySinh.value = ""
    //lop.value = ""
    sinhViens.forEach(sv => {
        if (sv.MaSV == $("#sinhvien").val()) {
            maSV.value = sv.MaSV
            //hoTen.value = sv.Ho +" "+sv.Ten
            // soCanCuoc.value = sv.SoCanCuoc
            // soDienThoai.value = sv.MaSV
            //ngaySinh.value = sv.NgaySinh
            //lop.value = sv.Lop
            let row =`<tr>
                        <td><img style="width:200px" src="#" /></td>
                        <td id="svSelected">${sv.MaSV}</td>
                        <td>${sv.Ho + " " + sv.Ten}</td>
                        <td>${sv.Lop ?? ""}</td>
                        <td>${sv.GioiTinh ?? ""}</td>
                        <td>${sv.NgaySinh ?? ""}</td>
                        <td>${sv.SoCanCuoc ?? ""}</td>
                        <td>${sv.SoDienThoai ?? ""}</td>
                        <td>${sv.TinhTrang ?? ""}</td>                        
                    </tr>`
            thongTinSinhVien.innerHTML = row;
            tblThongTinSinhVien.hidden = false;
            thaoTacViPham.hidden = false;
            getLichSuViPham(sv.MaSV);
            return;
        }
    });    
});
const getgetget = (maSV)=>{
    CallApiStudentManagerGetOne(maSV,(res)=>{
        sv = res.data
        let row = `<tr>
                    <td><img style="width:200px" src="#" /></td>
                    <td id="svSelected">${sv.MaSV}</td>
                    <td>${sv.Ho + " " + sv.Ten}</td>
                    <td>${sv.Lop ?? ""}</td>
                    <td>${sv.GioiTinh ?? ""}</td>
                    <td>${sv.NgaySinh ?? ""}</td>
                    <td>${sv.SoCanCuoc ?? ""}</td>
                    <td>${sv.SoDienThoai ?? ""}</td>
                    <td>${sv.TinhTrang ?? ""}</td>                        
                </tr>`
        thongTinSinhVien.innerHTML = row;
        tblThongTinSinhVien.hidden = false;
        thaoTacViPham.hidden = false;
        getLichSuViPham(sv.MaSV);
    },(res)=>{        
        handleCreateToast("error", res.error, "sinh-vien-dont-exist-"+$("#maSV").val(),true);
        thongTinSinhVien.innerHTML = "";
        tblThongTinSinhVien.hidden = true;
        thaoTacViPham.hidden = true;
        tblLichSuViPham.hidden = true;
    })    
}
tim.addEventListener("click", () => {
    getgetget($("#maSV").val())
})
createEventInputEnter($(maSV),()=>{
    getgetget($("#maSV").val())
})
var hienThiDanhSachViPham = () => {
    CallApiDataInfringeAll(null,(res)=>{                   
        let data = res.data
        let rows = '';                      
            viPhams = data;
            data.forEach(dt => {
                rows += `<option value="${dt.MaViPham}" title="Mức độ nghiêm trọng: ${dt.MucDoNghiemTrong}" >${dt.NoiDung} - (Độ nghiêm trọng: ${dt.MucDoNghiemTrong})</option>`;
            });            
        danhSachViPham.innerHTML = rows;        
    },(res)=>{
        console.log(res)
    })

    // axios({
    //     method: 'GET',
    //     url: hostVP + "GetDanhSachViPham",
    // }).then((response) => {
        
    // }).catch(err => {
    //     console.log(err)
    // })
}

var getLichSuViPham = (maSV) => {
    CallApiInfringeManagerGetByMaSinhVien(maSV,(res)=>{
        var data = res.data        
        if(data.length == 0)
        {
            tblLichSuViPham.hidden = true;
            lichSuViPham.innerHTML = "";
            var title = $(`<center><h2>Không có lịch sử vi phạm</h2></center>`)            
            $(khongcoLSVP).html(title);
            //lichSuViPham.appendChild(title);
            return;
        }
        let rows = "";
        var viPhams = new Array();
        data.forEach(dt => {
            let NoiDung = "";
            if (dt.MaViPham != undefined) {
                NoiDung = dt.NoiDung
                viPhams.push(dt.ViPham)
            }
            else
                for (let i = 0; i < viPhams.length; i++)
                    if (dt.MaViPham == viPhams[i].MaViPham) {
                        NoiDung = viPhams[i].NoiDung
                        break
                    }
                
            rows += `<tr>
                        <td>${dt.MaViPham}</td>
                        <td>${NoiDung}</td>
                        <td >${ConvertDateTimeToString(dt.ThoiGianViPham)}</td>
                        <td>${dt.HinhPhat}</td>
                        <td>${dt.GhiChu ?? "-"}</td>
                        <td>${dt.DaGiaiQuyet ? "Đã giải quyết" : "Chưa giải quyết"}</td>
                    </tr>`
        })       
        tblLichSuViPham.hidden = false;            
        khongcoLSVP.innerHTML = "";
        lichSuViPham.innerHTML = rows;
    },(res)=>{
        console.log(res)
    })    
}

$("#danhSachViPham").change(() => {
    if ($("#danhSachViPham").val() == "") {
        hinhPhat.disabled = true
        btnXacNhan.disabled = true
    }
    else {
        hinhPhat.disabled = false
        btnXacNhan.disabled = false
    }
})
const formAddStudentInfringe = $("#form-add-student-infringe")
formAddStudentInfringe.on("submit",function(ev){
    ev.preventDefault();
    let fromData = $(this).serialize();
    console.log(fromData)
    if ($("#danhSachViPham").val() === "") {
        handleCreateToast("error", "Vui lòng chọn lỗi vi phạm", "err",true);
        return;
    }
    console.log(fromData)
    showMessage("Thông báo","Xác nhận khai báo vi phạm?",()=>{
        CallApiInfringeManagerCreate(fromData,(res)=>{            
            showMessage("Thành công","Khái báo vi phạm thành công",()=>{
                location.reload();
            },false);
        },(res)=>{
            console.log(res)
        })
    })
})
// btnXacNhan.addEventListener("click", () => {
//     axios({
//         method: 'GET',
//         url: hostMain + "XuLyViPhamApi/TaoViPham?maSV=" + document.getElementById('svSelected').innerHTML
//             + "&maViPham=" + $("#danhSachViPham").val()
//             + "&hinhPhat=" + hinhPhat.value,
//     }, { headers: { 'Content-Type': 'application/json' } })
//         .then(response => {
//             var data = response.data;
            
//             if (data.Success) {
//                 handleCreateToast(data.type, data.msg);
//                 return;
//             }
//             handleCreateToast(data.type, data.msg, "err1");
//         })
//         .catch(error => {
//             // Xử lý lỗi
//         });

//     //$.ajax({
//     //    url: hostVP + "TaoViPham",
//     //    type: 'POST',
//     //    dataType: 'json',
//     //    contentType: 'application/json',
//     //    data: JSON.stringify({
//     //        'maSV': svSelected.innerHTML,
//     //        'maViPham': $("#danhSachViPham").val(),
//     //        'hinhPhat': hinhPhat.value
//     //    }),
//     //    success: function (response) {
//     //        var data = response.data.data;
//     //        console.log(data)
//     //        if (data.Success) {
//     //            handleCreateToast(data.type, data.msg);
//     //            return;
//     //        }
//     //        handleCreateToast(data.type, data.msg, "err1");
//     //    },
//     //    error: function (xhr, textStatus, errorThrown) {
//     //        // Xử lý lỗi
//     //    }
//     //});


//     //$.post(hostVP + "TaoViPham", {
//     //    'maSV': svSelected.innerHTML,
//     //    'maViPham': $("#danhSachViPham").val(),
//     //    'hinhPhat': hinhPhat.value
//     //    }, function (data) {
//     //    var data = JSON.parse(data);
//     //    console.log(data)
//     //    if (data.Success) {
//     //        handleCreateToast(data.type, data.msg);
//     //        return;
//     //    }
//     //    handleCreateToast(data.type, data.msg,"err1");

//     //})
// })

hienThiDanhSachViPham();
