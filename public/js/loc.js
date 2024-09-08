const locs = $('.loc');
const showAll = $('.showAll');
locs.each(function(){
    $(this).click(function(){
        if($(`input[class="loc"][class="loc"]:checked`).length == locs.length)
            return showAll.prop("checked",true)
        showAll.prop("checked",false)
    })
})
showAll.on("click", () => {
    if (showAll.is(":checked"))
        locs.each(function(){
            $(this).prop("checked",true)
        })
    else
        locs.each(function(){
            $(this).prop("checked",false)
        })
})