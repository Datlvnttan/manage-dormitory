$(document).ready(function(){
    $('#form-huy-dang-ky').on('submit',(ev)=>{
        ev.preventDefault();
        let rdo_lydo = document.querySelectorAll('.rdo_lydo');
        let rdo_check = rdo_lydo[rdo_lydo.length-1];            
        if(rdo_check.checked)
            if(rdo_check.value==null|| rdo_check.value==''|| rdo_check.value==-1) 
            {               
                handleCreateToast("warning","Lý do không được để trống",'err1');                 
                return;
            }
        formData = $('#form-huy-dang-ky').serialize();              
        huyDangKyNoiTru(formData);
    })
})