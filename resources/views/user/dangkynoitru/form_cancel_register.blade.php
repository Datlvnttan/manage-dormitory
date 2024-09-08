<div class="modall an" style="">
    <div class="modal__innerr">
        <div class="modal__headerr">
            <p>Bạn muốn hủy bó xét duyệt này? </p>
            <i class="fas fa-times"></i>
        </div>
        <form action="" id="form-huy-dang-ky" method="POST">
            @csrf
            <div class="modal__bodyy">
                <span>Lý do hủy:</span><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Tôi muốn chọn phòng khác" id="mau1" checked />
                <label for="mau1">Tôi muốn chọn phòng khác</label><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Tôi muốn cập nhật lại thông tin sinh viên của mình" id="mau2" />
                <label for="mau2">Tôi muốn cập nhật lại thông tin sinh viên của mình</label><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="Tôi không muốn đăng ký nữa" id="mau3" />
                <label for="mau3">Tôi không muốn đăng ký nữa</label><br />
                <input type="radio" name="ghiChu" class="rdo_lydo" value="" id="khac" />
                <label for="khac">Khác</label>
                <textarea id="lyDoKhac" disabled placeholder="Nhập lý do khác"></textarea>
            </div>
            <div class="modal__footerr">
                <a class="close btn ">Hủy bỏ</a>
                <button type="submit" class="btn">Xác nhận hủy</button>
            </div> 
        </form>                                
    </div>
</div>
<script src="{{asset('/js/HopThoai.js')}}"></script>
<script src="{{asset('/js/HopThoaiCheck.js')}}"></script>
<script src="{{asset('/js/user/infomation/info.callapi.js')}}"></script>
<script src="{{asset('/js/user/infomation/info.handle.js')}}"></script>