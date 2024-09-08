const URL_HOST = window.location.origin + "/";
const BASE_URL = URL_HOST+"api/";
const TOKEN_AUTH = "token-auth";

//prefix auth
const PREFIX_AUTH = "auth/";
const PREFIX_REGISTER = "register";
const PREFIX_VERIFY = "verify/";
const PREFIX_RESEND_VERIFY_EMAIL = "resend-verify-email"



const PREFIX_MANAGER = "manager/"
const PREFIX_PERMISSION = "permission/";
const PREFIX_GRANT = "grant";
const PREFIX_ROLE = "vai-tro";
const PREFIX_GET_BY_ROLE = "get-by-role";
const PREFIX_UPDATE_STATUS = "update-status"



const METHOD_GET = "GET";
const METHOD_POST = "POST";
const METHOD_PUT = "PUT";
const METHOD_PATCH = "PATCH";
const METHOD_DELETE = "DELETE";





const PREFIX_OPEN_FEATURE = "bat-tat-tinh-nang/"
const PREFIX_REGISTER_RESIDENCE = "dang-ky-noi-tru/"
const PREFIX_CONTRACT_EXTENSION = "gia-han-hop-dong/"
const PREFIX_CANCEL_CONTRACT_EXTENSION = "huy-gia-han-hop-dong/"
const PREFIX_CONTRACT = "hopdong/"
const PREFIX_STATUS = "trang-thai/"
const PREFIX_STAFF = "nhan-vien/"
const PREFIX_NOTIFICATION = "thong-bao/"
const PREFIX_RESET_PASSWORD = "dat-lai-mat-khau/"


 //Authen đăng nhập
 const API_AUTHEN = 'Authen/';
 const API_AUTHEN_LOGIN = 'login';

 //Authen user
 const API_PREFIX_USER = 'user/';
 const API_AUTHEN_GET_INFO_SUB = 'get_infoSubscriber';

 const API_AUTHEN_UPDATE_INFO = 'cap-nhat-thong-tin';
 const API_AUTHEN_CANCEL_BOARDING_REGISTRANTION = 'huy-dang-ky-noi-tru';
const API_AUTHEN_REGISTER_RESIDENCE = "dangkynoitru/"
const API_AUTHEN_CHANGE_ROOM = "dang-ky-thay-doi-phong"
 const API_AUTHEN_CONFIRM_RESIDENCE = "xac-nhan-dang-ky"

 //authen user_ khai báo hư hỏng
 const API_PREFIX_USER_DAMAGE = 'khaibaohuhong/';
 const API_AUTHEN_DAMAGE_SUM_REQUETS_NO_PROCESS = 'tong-so-luong-yeu-cau-chua-xu-ly';
 const API_AUTHEN_DAMAGE_SUM_COMFIRM_REPORT = 'xac-nhan-khai-bao-hu-hong';
const API_AUTHEN_DAMAGE_REPORT_HISTORY = "lich-su-khai-bao"

 //Authen phòng
 const API_PREFIX_ROOM = 'phong/';
 const API_AUTHEN_EMPTY_ROOM = 'danh-sach-phong-trong';
 const API_AUTHEN_ROOM_LIST = 'danh-sach-phong';
 const API_AUTHEN_ROOM_BY_FLOOR = 'danh-sach-phong-theo-tang/';
 const API_AUTHEN_ROOM_DETAILS = 'thong-tin-phong';
 const API_AUTHEN_CHANGE_MANAGER = 'doi-truong-phong';
 const API_AUTHEN_CHANGE_ROOM_HISTORY = 'lich-su-chuyen-phong/';

 //Authen SinhVien
 const API_PREFIX_STUDENT = 'sinhvien/';
 const API_AUTHEN_STUDENT_BY_ROOM = 'danh-sach-sinh-vien-theo-phong';
 const API_AUTHEN_STUDENT_LIST = 'danh-sach-sinh-vien';



 //Authen tầng
 const API_PREFIX_FLOOR = 'tang/';
 const API_AUTHEN_FLOOR_BY_AREA = 'danh-sach-tang-theo-khu/';


 //Authen khu
 const API_PREFIX_AREA = 'khu/';
 const API_AUTHEN_AREA_LIST = 'danh-sach-khu';

  //Authen thiết bị
  const API_PREFIX_DEVICE = 'thietbi/';
  const PREFIX_DEVICE_ALLOCATION = 'phan-bo-thiet-bi/';
  const API_AUTHEN_DEVICE_LIST = 'danh-sach-thiet-bi';
  const PREFIX_UNALLOCATE_DIVICE = 'thiet-bi-chua-phan-bo';
  const PREFIX_DIVICE_OF_ROOM = 'danh-sach-thiet-bi-theo-phong';




 ///ADMIN-------------------------------------------------------------------------
 const API_PREFIX_ADMIN = 'admin/';
 const API_AUTHEN_REVIEW_LIST = 'danh-sach-xet-duyet';
 const API_AUTHEN_CHECK_REGISTER_INFO = 'xem-thong-tin-dang-ky';
 const API_AUTHEN_CANCEL_REGISTER = 'huy-bo-dang-ky';
 const API_AUTHEN_AGREE_REGISTER = 'phe-duyet-dang-ky';


 //admin Hop dong
 const API_PREFIX_ADMIN_CONTRACT = 'quanlyhopdong/';
 const API_AUTHEN_CONTRACT_LIST = 'danh-sach-hop-dong';
 const API_AUTHEN_CONTRACT_DETAILS = 'chi-tiet-hop-dong';
 const API_AUTHEN_CONTRACT_PAYMENT = 'thanh-toan-hop-dong';

 //admin hoa don
  const API_PREFIX_BILL = 'quanlyhoadon/';
  const API_AUTHEN_BILL_LIST = 'danh-sach-hoa-don';
  const API_AUTHEN_BILL_LIST_BY_ROOM = 'danh-sach-hoa-don-theo-phong';
  const API_AUTHEN_BILL_DETAILS = 'chi-tiet-hoa-don';
  const API_AUTHEN_BILL_DETAILS_SINGLE_SERVICE = 'chi-tiet-hoa-don-dich-vu-don';
  const API_AUTHEN_BILL_DETAILS_FORCE_SERVICE = 'chi-tiet-hoa-don-dich-vu-bat-buoc';
  const API_AUTHEN_BILL_PAYMENT = 'thanh-toan-hoa-don';
  const API_AUTHEN_BILL_CREATE = 'tao-hoa-don';
  const API_AUTHEN_BILL_REPORT_WRONG_INFO = 'bao-cao-hoa-don-sai-thong-tin';
  const API_AUTHEN_BILL_REPORT_CANCEL = 'huy-bo-bao-cao-hoa-don';
  const API_AUTHEN_BILL_EDIT = 'chinh-sua-hoa-don';


   //admin quảy lý hư hỏng
   const API_PREFIX_ADMIN_DAMAGE = 'huhongsuachua/';
   
   const API_AUTHEN_DAMAGE_EQUIPMENT_LIST = 'danh-sach-thiet-bi-hu-hong';
   const API_AUTHEN_DAMAGE_REPORT_HANDING_DETAILS = 'chi-tiet-xu-ly-khai-bao-hu-hong';
   const API_AUTHEN_DAMAGE_REPORT_HANDING = 'xu-ly-khai-bao-hu-hong';
   const API_AUTHEN_DAMAGE_REPORT_CONFIRM_HANDING = 'xac-nhan-xu-ly-khai-bao-hu-hong';
   const API_AUTHEN_DAMAGE_REPORT_DETAILS = 'chi-tiet-khai-bao-hu-hong';


   //admin dịch vụ
   const API_PREFIX_SERVICE = 'dichvu/';
   const API_AUTHEN_SERVICE_UNREGISTER = "dich-vu-chua-dang-ky";
   const API_AUTHEN_SERVICE_PERSONAL = "dich-vu-ca-nhan/";
   const API_AUTHEN_USE_RETAIL_SERVICE = "su-dung-dich-vu-don";
   const API_PREFIX_ROOM_SERVICE_HAS_INDEX= 'dichvuphongcochiso/';
   const API_PREFIX_SERVICE_UPDATE_OBLIGATORY = 'cap-nhat-dich-vu-bat-buoc';   
   const API_PREFIX_SERVICE_UPDATE_HAS_INDEX = 'cap-nhat-dich-vu-co-chi-so';   
   const API_AUTHEN_SERVICE_MANDATORY_LIST = 'danh-sach-dich-vu-bat-buoc';
   const API_AUTHEN_SERVICE_INDEX_BY_ROOM = 'chi-so-dich-vu-theo-phong';
   const API_AUTHEN_SERVICE_STATISTICS_INDIVIDUAL_BY_ROOM = 'thong-ke-dich-vu-don-theo-phong';
   const API_AUTHEN_SERVICE_WITH_INDEX_STATISTICS_BY_ROOM = 'thong-ke-dich-vu-co-chi-so-theo-phong';
   


   //admin vi phạm
   const API_PREFIX_INFRINGE = 'vipham/';
   const API_AUTHEN_ACCURACY = 'xac-thuc';
   const API_AUTHEN_CONFRIM = 'xac-nhan';
   const API_AUTHEN_INFRINGE_HISTORY_LIST = 'lich-su-vi-pham';



   





const BuildCallApi = (data,func_success,func_fail,method = "GET",url,prefix = "")=>{
$.ajax({
    url: url + prefix,
    type: method, 
    data:data,     
    success: function (res) {
        if(typeof func_success === "function")
            func_success(res)               
    },
    error: function (xhr, status, error) {        
        if(typeof func_fail === "function")
            func_fail(xhr.responseJSON)               
    }
});   													 
}

// class CallApi 
// {
//   constructor(url) {
//       this.url = url        
//   }
//   build(data,func_success,func_fail,method = "GET",prefix = "")
//   {
//     return $.ajax({
//       url: this.url + prefix,
//       type: method, 
//       data:data,     
//       success: function (res) {
//           if(typeof func_success === "function")
//               func_success(res)               
//         },
//         error: function (xhr, status, error) {        
//             if(typeof func_fail === "function")
//                 func_fail(xhr.responseJSON)               
//         }
//     }); 
//   }
//   all(func_success,func_fail,data = null)
//   {
//     return this.build(data,func_success,func_fail)
//   }
//   show(id,func_success,func_fail)
//   {
//     return this.build(null,func_success,func_fail,METHOD_GET,id)
//   }
//   create(data,func_success,func_fail)
//   {
//     return this.build(data,func_success,func_fail,METHOD_POST)
//   }
//   update(id,data,func_success,func_fail)
//   {
//     return this.build(data,func_success,func_fail,METHOD_PUT,id)
//   }
//   delete(id,func_success,func_fail)
//   {
//     return this.build(null,func_success,func_fail,METHOD_DELETE,id)
//   }
// }