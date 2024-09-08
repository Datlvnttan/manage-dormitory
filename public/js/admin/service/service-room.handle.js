$(()=>{
    const btnFilter = $("#btn_loc");
    const inputKhu = $("#khu");    
    const inputTang = $("#tang");
    const inputPhong = $("#phong");  
    const tbodyShowServiceRoom = $("#tbody-show-service-room")
    const tableShowServiceRoom = $("#table-show-service-room");
    
    const api = new CallApi(BASE_URL+API_PREFIX_ADMIN+API_PREFIX_SERVICE + API_PREFIX_ROOM_SERVICE_HAS_INDEX);

    const getDataFilter = (page = 1)=>{
        filter = {
            "tatCa":$("#showAllHD").is(":checked"),
            "khu":inputKhu.val(),
            "tang":inputTang.val(),
            "phong":inputPhong.val(),                    
        }
        getData(page,filter);
    }
    const getData = (page,filter)=>{        
        api.all((res)=>{
            console.log(res)                        
            var data = res.data.data;
            if(data.length == 0)
            return tableShowServiceRoom.html(`<center><h1 class="no_found-list">Không tìm thấy dữ liệu</h1></center>`)
            tableShowServiceRoom.html(`<thead>
                                        <td>Phòng</td>
                                        <td>Dịch vụ</td>
                                        <td>Chỉ số hiện tại</td>                                  
                                        <td></td>
                                    </thead>`)
            let tbody = $(`<tbody></tbody>`);
            let rowspan = 0;
            for (let index = 0; index < data.length; index++) {                
                const item = data[index];
                rowspan++;
                let s= `<tr class="border-left">
                            ${rowspan == 1 ? `<td class="td-room">${item.MaPhong} - ${item.TenPhong}<br>${item.TenKhu} - ${item.TenTang}</td>` : ""}                            
                            <td class="spacing">${item.MaDichVu} - ${item.TenDichVu}</td>
                            <td class="spacing index-value">${item.ChiSoHienTai}</td>                                  
                            <td class="spacing">
                                ${item.ChiSoHienTai > 0 ? `<button class="btn btn-warning btn-reset-index">Đặt lại</button>` : ""}
                            </td>
                        </tr>`
                const row = $(s);
                if(item.ChiSoHienTai > 0)
                {
                    const btnResetIndex = row.find(".btn-reset-index")
                    btnResetIndex.click(()=>{
                        showMessage(`Thông báo`,`"Xác nhận đặt lại chỉ số của dịch vụ "${item.TenDichVu}" của phòng "${item.TenPhong}" trở về số 0 ?`,()=>{
                            api.patch(item.MaPhong,null,(res)=>{
                                handleCreateToast("success","Thao tác thành công",null,true);
                                row.find(".index-value").text(0)
                                btnResetIndex.remove();
                            },(res)=>{
                                console.log(res)
                                handleCreateToast("success",res.error,null,true);
                            },item.MaDichVu)
                        })
                    })
                }
                
                tbody.append(row)
                if(index + 1 == data.length || item.MaPhong != data[index+1].MaPhong)
                {
                    tbody.append(`<tr class="spacing"></tr>`)
                    tbody.find(".td-room").attr("rowspan",rowspan)
                    s = "";
                    rowspan=0;
                    tableShowServiceRoom.append(tbody)
                    tbody = $(`<tbody></tbody>`);
                }
            }    
            loadPaginationButtons(page,res.data.last_page,(page,numpages)=>{
                getData(page,filter)
            })       
        },(res)=>{
            console.log(res)
        },{
            page:page,
            filter:filter
        })
    }

    getDataFilter(getPage());
    btnFilter.click(()=>{
        getDataFilter(1);
    })
    $("#showAllHD").click(()=>{
        getDataFilter(1);
    })
})