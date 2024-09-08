//show tất cả
const showAllHD = $("#showAllHD")
showAllHD.on("click", () => {        
    if (showAllHD.is(":checked"))
        $('#showloc').slideUp()        
    else
        $('#showloc').slideDown()
})


var th = (new Date()).getMonth() + 1;
const nam = document.getElementById('nam')
if(nam)
    nam.addEventListener("change", () => {
        XuatThang()
    })
var XuatThang = () => {
    let sl = 12;
    if (nam.selectedIndex == 0)
        sl = th;
    var s = '<option selected value="0"> --Tất cả-- </option>';
    for (var i = 1; i <= sl; i++)
        s += '<option value="' + i + '">Tháng ' + i + '</option>';
    thang.innerHTML = s;
}

//sử lý chọn lọc tháng năm
const thangHienTai = document.getElementById('thangHienTai');
if(thangHienTai)
{
    thangHienTai.addEventListener("click", () => {

        if (!thangHienTai.checked) {
            nam.disabled = thang.disabled = false;
        }
        else
            nam.disabled = thang.disabled = true;
    })    
    XuatThang()
}

//xử lý chọn lọc trạng thái
const locs = document.querySelectorAll('.loctt');
locs.forEach(loc => loc.addEventListener("click", () => {
    if (!loc.checked)
        for (var i = 0; i < locs.length; i++)
            if (locs[i].checked)
                return;
    loc.checked = true;
}))
