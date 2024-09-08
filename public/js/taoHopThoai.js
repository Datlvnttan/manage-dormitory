function DoThongBao2(slTrong, slDangKy, name, value) {
    if (slTrong - slDangKy > 0)
        DoThongBao("Xác nhận chọn phòng", "Xác nhận rằng bạn chọn phòng này để đăng ký nội trú trú");
    else
        DoThongBao("Xác nhận chọn phòng", "Phòng này đã đủ số người đăng ký, vẫn chọn?");
    idValue = name;
    console.log("àkjdsfh");
}
function DoThongBao(tieuDe, noiDung) {
    document.getElementById('tieuDe').innerHTML = tieuDe;
    document.getElementById('noiDung').innerHTML = noiDung;
}
function WriteHopThoai(tieuDe, noiDung, link = null, method = null, name = null, value = null, id = null) {
    let s = CreateBox(tieuDe, noiDung, link, method, name, value);
    if (id == null)
        document.write(s);
    else
        id.innerHTML = CreateBox(tieuDe, noiDung, link, method, name, value);
}
function CreateBox(tieuDe, noiDung, link, method, name, value = null) {
    let str = ''
    if (link != null)
        str = `<form action="${link}" method="${method}">`    
    str +=` <div class="modall an">
        <div class="modal__innerr">
            <div class="modal__headerr">
                <p><span id="tieuDe" >${tieuDe} </span>"<span id="idValue">${value}</span>"?</p>
                <i class="fas fa-times" id="exit"></i>
            </div>
            <div class="modal__bodyy">
                <span id="noiDung">${noiDung}</span>
            </div>
            <div class="modal__footerr">
                <a class="close" >Hủy bỏ</a>
                <button type="submit" name="${name}" value="${value}" id="subvalue" class="btn ">Xác nhận</button>
            </div>
        </div>
    </div>`
     if (link != null)
        str += `</form>`
    return str
}