$(()=>{
    const api = new CallApi(BASE_URL+API_PREFIX_USER+PREFIX_NOTIFICATION)
    const dotNotification = $("#dot-notification");
    const ulNotification = $("#notification-ul")
    api.all((res)=>{
        console.log("res")
        console.log(res)
        ulNotification.html("")
        if(res.data.length == 0)
        {
            ulNotification.html(`<li><a>Không có thông báo</a></li>`)
            dotNotification.remove()
            return 
        }
        let countUnseen = 0;
        res.data.forEach(item => {
            if(!item.DaXem)
                countUnseen++;
            const li = $(`<li title="${item.NoiDung}" class="${item.DaXem ? "watched" : ""}"><a ${item.Uri ? `href="/user/thong-bao/${item.Id}" class="link"` : ""}>${item.TieuDe}<br>
                                    <span>${item.NoiDung}</span>
                            </a></li>`)
            ulNotification.append(li)
        });
        if(countUnseen > 0)
            dotNotification.text(countUnseen > 10 ? "9+":countUnseen);
        else
            dotNotification.remove()
    },(res)=>{
        
    })
})