$(document).ready(function(){
    const filterButton = $(".filter-button");
    const getStatus = ()=>{
        let locs = $('input[type="checkbox"]:checked');        
        let ds_trangThai = locs.map(function(){
            return this.value;
        }).get();  
        return ds_trangThai;      
    }
    const LoadDataContract = (statuss,page = 1) =>{
        callContractList(statuss,page,(res)=>{            
            if(res.success==true)        
            {                  
                $('#contract-list').html('');
                if (res.data.data.length == 0) {                    
                    let title = $('<h1 class="no_found-list" >Không tìm thấy dữ liệu</h1>');                                        
                    $('#contract-list').append(title);
                    return;
                }          
                res.data.data.forEach(item=>{
                    let row =$(`<tr>
                            <td>
                                ${item.MaHopDong}
                            </td>
                            <td>
                                ${item.MaSV}
                            </td>
                            <td>
                                ${item.NguoiTao}
                            </td>
                            <td>
                                ${item.NgayTao}
                            </td>
                            <td>
                                ${item.NgayBatDau}
                            </td>
                            <td>
                                ${item.NgayKetThuc}
                            </td>
                            <td>
                                ${item.TrangThai}
                            </td>
                            <td class="td-opreation">
                                <a href="quanlyhopdong/${item.MaHopDong}" class="Contact-detail-link">Chi tiết</a> <br />
                            </td>
                        </tr>`)                        
                if(item.TrangThai == "Chưa hiệu lực"||item.TrangThai == "Xin gia hạn")    
                {
                    const btn = $(`<button value="${item.MaHopDong}" class="open_btn btn_xacnhan ">Xác nhận</button>`)
                    btn.click(()=>{
                        thanhToanHopDong(item.MaHopDong,()=>{
                            btn.remove();
                        })
                    })
                    row.find(".td-opreation").append(btn)
                } 
                $('#contract-list').append(row);  
            })                                                                  
            loadPaginationButtons(page,res.data.last_page,(page,numpages)=>{
                LoadDataContract(statuss,page)
            })                                                                                 
        }                    
        },(res)=>{
            console.log(res);
            handleCreateToast("error",res.error,'er1',true);            
        })
    }
    LoadDataContract(['Chưa hiệu lực','Xin gia hạn'],getPage())
    filterButton.click(function(ev){
        ev.preventDefault();         
        let status = getStatus();
        if(status.length==0)
            return handleCreateToast("error","Vui lòng chọn ít nhất 1 trạng thái","erorr");           
        LoadDataContract(status,1)
    })
})