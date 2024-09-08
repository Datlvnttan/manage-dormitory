var ConvertDateToString = (date)=>{
    return new Date(date).toISOString().split('T')[0];
}
var ConvertDateTimeToString = (date)=>{
    let valueTime = new Date(date).toISOString();
    let vls = valueTime.split("T");
    valueTime = vls[0] +" "
    vls = vls[1].split(":");
    valueTime+=vls[0]+":"+vls[1];
    return valueTime;
}


var Subtring = (value, end = 41)=>{
    return value.length <= end-1 ? value : value.substring(0, end)+"...";
}

function containsSpecialCharacter(str) {
    const pattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?\s]+/;
    return pattern.test(str);
}
function checkForUnsignedString(str) {
    const pattern = /[^\x00-\x7F]+/;
    return pattern.test(str);
}

function isDigit(str) {    
    const pattern = /[0-9]+/;
    return pattern.test(str);
}
function isEmail(str) {    
    const pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return pattern.test(str);
}

const createInputNumber = (element,min = null,max = 9999999999,numeric = true)=>{    
    if(typeof element ==="string")
        element = $(element);
    element.data("minimum",min)
    element.data("maximum",max)        
    element.on("keydown",function(ev){                
        if(!isDigit(ev.key) && ev.key!=="Backspace" && ev.key!=="Delete" && ev.key!=="ArrowLeft" && ev.key!=="ArrowRight" && ev.key!=="Shift" && ev.key!=="Home" && ev.key!=="End")    
            ev.preventDefault();
    });
    if(numeric == true)    
        element.on("input",function(ev){             
            if($(this).val()!="")      
            {          
                const minimum = $(this).data("minimum");                
                const maximum = $(this).data("maximum");
                var value = parseInt($(this).val());
                $(this).val(value == (minimum-1) ? minimum : value > maximum ? maximum : value);                    
            }
        });
}

const createEventInputEnter = (element,funcAction)=>{
    element.on("keydown",function(ev){        
        if(ev.key === "Enter")                 
            funcAction()        
    })
}

var createEventSelect = (dom)=>{
    if(typeof dom === "string")
        dom = $(dom);
    dom.click(function(){
        $(this).select();
    })
}



var createEventBlurCheckLength = (element,length,element_msg,msg)=>{
    element.blur(function(){
        checkLength($(this),length,element_msg,msg)
    })
}

var checkLength = (element,length,element_msg,msg)=>{
    if(element.val().length != length)
    {
        errorShow(element,element_msg,msg);
        return false;
    }
    else
    {
        errorHide(element_msg,element);
        return true;
    }            
}

var split = (str,separator)=>{
    ss = str.split(separator);
    let sss = ""
    for(s of ss)
        sss+=s;
    return s;
}

var createEventInputNotSpecialCharacter = (element)=>{
    element.on("keydown",function(ev){
        if(containsSpecialCharacter(ev.key) || checkForUnsignedString(ev.key))    
            ev.preventDefault();
    })
}

var createEventInputNotImptyCustom = (element,element_msg = null,msg = null)=>{
    element.blur(function(){
        checkInputNotImptyCusTom($(this),element_msg,msg);     
    })
}

var errorShow = (input_size,dom_mess = null,msg = null)=>{
    input_size.addClass("border-error") 
    if(dom_mess==null)
        return;
    dom_mess.text(msg);
    dom_mess.slideDown()           
}

var errorHide = (input_size,dom_mess = null)=>{    
    input_size.removeClass("border-error")    
    if(dom_mess==null)
        return;
    dom_mess.text("");
    dom_mess.slideUp();
}
checkInputNotImptyCusTom = (element,element_msg,msg)=>{    
    element.val(element.val().trim());
    if(element.val()=="")
    {
        errorShow(element,element_msg,msg);
        return false;
    }
    else
    {
        errorHide(element,element_msg);
        return true;

    }             
}

const createEventTada = (element)=>{
    element.on("mouseenter",function(){
        $(this).find("i").addClass("bx-tada");                        
     })
     element.on("mouseleave",function(){
        $(this).find("i").removeClass("bx-tada");
     })                        
}

const getParam = (parma)=>{
	var currentURL = window.location.href;
    var url = new URL(currentURL);
    return url.searchParams.get(parma);
}
const getParamPrefix = (index = 0)=>{    
	var currentURL = window.location.toString();    
    var t = currentURL.split("/")
    var prefix = t[t.length-1-index];
    if((index = prefix.indexOf("?"))!=-1)
        return prefix.substring(0,index);
    return prefix;
}
const  addLeadingZero = (value)=>{
    return value < 10 ? "0" + value : value;
}

const ValidateQuantity = (box)=>{      
    let show_quantity = box.querySelector(".show-quantity"); 
    $(show_quantity).data("saved-value",show_quantity.value) 
    const checkShowBtnUpdate = ()=>{
        if(parseInt($(show_quantity).data("saved-value")) != parseInt(show_quantity.value))
            boxShow.slideDown();
        else
            boxShow.slideUp();
    }
    const boxShow = $(box).find(".box-show-btn-update-quantity")
    boxShow.slideUp();
    box.querySelector(".add").addEventListener("click",()=>{
        let max_quantity = parseInt(box.querySelector(".item-present-quantity").innerText);        
        let value = parseInt(show_quantity.value)
        show_quantity.value = value + 1 > max_quantity ? max_quantity : value + 1;
        if(value + 1 > max_quantity)
        {
            return handleCreateToast("info","Đã đạt số lượng tồn tối đa","info");
        }
        show_quantity.value = value + 1;
        checkShowBtnUpdate();
    })
    box.querySelector(".minus").addEventListener("click",()=>{        
        let value = parseInt(show_quantity.value)
        show_quantity.value = value - 1 > 0 ? value - 1 : 1;
        if(show_quantity.value != value)
        checkShowBtnUpdate();
    })
    show_quantity.addEventListener("input",()=>{             
        if (show_quantity.value != "") {
            let max_quantity = parseInt(box.querySelector(".item-present-quantity").innerText);
            var value = show_quantity.value;
            var x = value.substr(0, value.length - 1);
            show_quantity.value = isNaN(value) ? x : value == 0 ? 1 : show_quantity.value > max_quantity ? max_quantity : value;
            checkShowBtnUpdate();
        }
    })
    
}
const buildCountdownt = (element, time,func_operation = null)=>{    
    var targetDate = new Date(time).getTime();   
    var x = setInterval(function() {

        // Lấy thời gian hiện tại
        var currentDate = new Date().getTime();
    
        // Tính thời gian còn lại giữa hiện tại và thời gian đích
        var timeRemaining = targetDate - currentDate;        
        if (timeRemaining < 0) {            
            element.html("00:00:00:00")
            if(typeof func_operation === "function")
                func_operation()
            clearInterval(x);
            return;
        }
        // Tính toán số lượng ngày, giờ, phút và giây
        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
        days = addLeadingZero(days);
        hours = addLeadingZero(hours);
        minutes = addLeadingZero(minutes);
        seconds = addLeadingZero(seconds);
    
        element.html(days + ":" + hours + ":" + minutes + ":" + seconds)  
    }, 1000);
}
