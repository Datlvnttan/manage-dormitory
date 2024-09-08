
    ////let countIdentity = 2;
    ////let nameIdentity = 2;
    ////let ppIdentity = 3;
    ////let nnIdentity = 4;

    /*import { error } from "jquery";*/

    ////let ItemCount = 1;
    var TONGSOLUONG = 0;
    let countIdentity = 1;
    let nameIdentity = 1;
    let ppIdentity = 1;
    let nnIdentity = 1;
    let ItemCount = 0;

    them.addEventListener("click", () => {
        if (!checkAddItem())
            return;    
        save()
        addItem()    
        restore()
    })


    

    function saveRadioState() {
        let radioButtons = document.querySelectorAll('input[type="radio"]:checked');    
        for (var i = 0; i < radioButtons.length; i++) 
            localStorage.setItem(radioButtons[i].name, radioButtons[i].value);            
    }

    // Khôi phục trạng thái radio button
    function restoreRadioState() {
        let radioButtons = document.querySelectorAll('input[type="radio"]');
        for (var i = 0; i < radioButtons.length; i++) {
            let savedValue = localStorage.getItem(radioButtons[i].name);
            if (savedValue === radioButtons[i].value) {
                radioButtons[i].checked = true;
            }
        }
    }



    // Lưu giá trị text
    function saveTextState() {
        var textBoxes = document.querySelectorAll('input[type="text"][name^="txtSoLuong"]');
        textBoxes.forEach(t => localStorage.setItem(t.name, t.value))
        //textterea
        var textareas = document.querySelectorAll('textarea');
        textareas.forEach(t => localStorage.setItem(t.id, t.value))

        //text Chi phí
        var textChiPhiBoxes = document.querySelectorAll('input[type="text"][name^="txtChiPhiPhatSinh"]');
        textChiPhiBoxes.forEach(t => localStorage.setItem(t.name, t.value))
    }

    // Khôi phục giá trị text
    function restoreTextState() {
        var textBoxes = document.querySelectorAll('input[type="text"][name^="txtSoLuong"]');
        textBoxes.forEach(t => {
            var savedValue = localStorage.getItem(t.name);
            if (savedValue !== null) 
                t.value = savedValue;         
        })
        //textterea
        var textareas = document.querySelectorAll('textarea');
        textareas.forEach(t => {
            var savedValue = localStorage.getItem(t.id);
            if (savedValue !== null) 
                t.value = savedValue;       
        })


        var textChiPhiBoxes = document.querySelectorAll('input[type="text"][name^="txtChiPhiPhatSinh"]');
        textChiPhiBoxes.forEach(t => {
            var savedValue = localStorage.getItem(t.name);
            if (savedValue !== null)
                t.value = savedValue;
        })
    }

    var getItemsTotalQuantity = (numbers) => {
        var totalQuantity = 0;
        for (var i = 0; i < numbers.length; i++) {
            totalQuantity += parseInt(numbers[i].value)
        }
        return totalQuantity;
    }


    //check input số lượng
    function checkInputNumber() {
        var numbers = document.querySelectorAll(".number")
        numbers.forEach(num => num.addEventListener("input", () => {
            if (num.value != "") {
                var value = num.value.trim();
                var x = value.substr(0, value.length - 1);
                num.value = (isNaN(value) || getItemsTotalQuantity(numbers) > TONGSOLUONG) ? x : value == 0 ? 1 : value
            }
        }))
    }

    

    //Check add item
    var checkIsEmpty = (numbers) => {
        for (var i = 0; i < numbers.length; i++) 
            if (numbers[i].value == "" || numbers[i].value == null)
                return true;
        return false;
    }

    var checkAddItem = () => {
        var numbers = document.querySelectorAll(".number")
        if (checkIsEmpty(numbers)) {
            handleCreateToast("error", "Để thêm 1 Item mới, mục nhập số lượng không được để trống!!!", "err3",true);
            return false;
        }
        if (getItemsTotalQuantity(numbers) < TONGSOLUONG)
            return true;
        handleCreateToast("error", "Tổng số lượng các xử lý thiết bị hư hỏng đã đạt tối đa!!!", "err2",true);
        return false;
    }

    function save() {
        saveRadioState()
        saveTextState()
    }

    function restore() {
        restoreRadioState()
        restoreTextState()
        localStorage.clear()
        checkInputNumber()
    }
    function removeItem(item) {
        if (ItemCount - 1 == 0) {
            handleCreateToast("error", "Phải có ít nhất 1 thông tin xử lý hư hỏng","err1",true);
            return;
        }
        item.remove();
        ItemCount--;
    }
    var enableTextterea = (id) => {    
        document.getElementById("textarea" + id).disabled = false
    }

    var disabledTextterea = (id) => {
        var textarea = document.getElementById("textarea" + id);
        textarea.value = ""
        textarea.setAttribute("disabled", true)
    }
    //Check input chi phí phát sinh

    var checkInputChiPhiPhatSinh = (me) => {
        if (me.value != "") {
            var value = me.value.trim();
            var x = value.substr(0, value.length - 1);
            me.value = isNaN(value) ? x : value;
        }
    }


    //Import value in textterea from Radio "Khác"
    function valueBindingRadio(me,id) {
        document.getElementById("nguyennhan" + id).value = me.value
    }
    var addItem = () => {
        let s = `<div class="item-xuly col-lg-6 row">
                    <a class="btn btn-danger" onclick="removeItem(this.parentElement)">xóa</a class="btn btn-outline-primary">
                    <div class="col-lg-5 col-12 item item-left">
                        <div>
                            <br />                                                                            
                            <input class="number" type="text" name="txtSoLuong${countIdentity}" placeholder="Nhập số lượng" />   <br />
                            <b>Phương pháp xử lý: </b>       <br />
                            <input name="phuongphap_${nameIdentity}" type="radio" id="phuongphap${ppIdentity}" value="0" checked />
                            <label for="phuongphap${ppIdentity++}">Sửa chửa</label>

                            <input name="phuongphap_${nameIdentity}" type="radio" id="phuongphap${ppIdentity}" value="1" />
                            <label for="phuongphap${ppIdentity++}">Thay mới</label>   <br /> 


                            <input oninput="checkInputChiPhiPhatSinh(this)" type="text" name="txtChiPhiPhatSinh${countIdentity}" placeholder="Nhập chi phi phát sinh" /> VND
                        </div>
                    </div>
                    <div class="col-lg-7 col-12 item item-right">
                        <div>
                            <b>Chọn nguyên nhân:</b>    <br />
                            <input onclick="disabledTextterea(${countIdentity})" name="nguyennhan_${nameIdentity}" type="radio" id="nguyennhan${nnIdentity}" value="Môi trường, thời gian hao mòn gây hư hỏng" checked />
                            <label for="nguyennhan${nnIdentity++}">Môi trường, thời gian hao mòn gây hư hỏng</label>               <br />

                            <input onclick="disabledTextterea(${countIdentity})" name="nguyennhan_${nameIdentity}" type="radio" id="nguyennhan${nnIdentity}" value="Do sinh viên làm hư hỏng" />
                            <label for="nguyennhan${nnIdentity++}">Do sinh viên làm hư hỏng</label>                  <br />

                            <input onclick="enableTextterea(${countIdentity})" name="nguyennhan_${nameIdentity++}" type="radio" id="nguyennhan${nnIdentity}" value="Khác" />
                            <label for="nguyennhan${nnIdentity}">Khác</label>           <br /> 
                            <textarea onchange="valueBindingRadio(this,${nnIdentity++})" id="textarea${countIdentity}" placeholder="Nhập nguyên nhân khác"></textarea>    <br />
                        </div>
                    </div>
                </div>`     
        const ItemElement = $(s);           
        $(listXuLy).append(ItemElement);
        document.getElementById("textarea" + (countIdentity++)).setAttribute("disabled", true)
        ItemCount++;
    }


    const MaKhaiBao = getParamPrefix();    
    xuLyKhaiBaoHuHong(MaKhaiBao)



    //Xử lý submit-info


    //TaoXuLyKhaiBaoHuHong(string maKhaiBao, int soLuong, string nguyenNhan, bool thayMoi, int chiPhiPhatSinh)

    submitInfo.addEventListener("click", () => {
        xacNhanXuLyKhaiBaoHuHong($("#MAKHAIBAO").text())
    })
