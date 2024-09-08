const imageInput = document.getElementById('imageInput');
const imageOut = document.getElementById('avt');
const preview = document.getElementById('previewImage');
const saveProfile = document.querySelector('.profile--form__submit-btn')
const editProfile = document.querySelector('.profile--form__unsubmit-btn')
const textFields = document.querySelectorAll('.profile--form__text-field input')
const selectFields = document.querySelectorAll('.profile--form__text-field select')

imageInput.addEventListener('change', () => {
  const file = imageInput.files[0];
  const reader = new FileReader();

  reader.addEventListener('load', () => {
    preview.src = reader.result;
    imageOut.value=reader.result;    
  }, false);

  if (file) {
      reader.readAsDataURL(file);
      imageInput.value = preview.src;
  }
});

function editProfileInfo(){
      editProfile.onclick = (e) =>{
        console.log(editProfile,saveProfile);
        textFields.forEach(element => {
            element.classList.add('active')
        });
          selectFields.forEach(element => {
              element.classList.add('active')
          });
        imageInput.classList.add('active')
        editProfile.classList.add('edit-active')
        saveProfile.classList.add('save-active')
      }
}

const capNhatThongTin = (formData)=>{
  $.ajax({
      url: BASE_URL + API_PREFIX_USER + API_AUTHEN_UPDATE_INFO,
      type: 'PUT',
      data: formData,
      success: function (res) {
          if(res.success==true)        
              handleCreateToast("success",res.message);
          else
              handleCreateToast("error",res.message);
              console.log(res.message)
      },
      error: function (xhr, status, error) {
          handleCreateToast("error","Đã xãy ra lỗi, vui lòng thử lại");
      }
  });   													 
}

$('#form-info').on('submit',(ev)=>{
  ev.preventDefault();
  let formData = $('#form-info').serialize();
  console.log(formData)
  capNhatThongTin(formData);
  textFields.forEach(element => {
    element.classList.remove('active')
  });
    selectFields.forEach(element => {
        element.classList.remove('active')
    });
    imageInput.classList.remove('active')

  editProfile.classList.remove('edit-active')
  saveProfile.classList.remove('save-active')
})
// function saveProfileInfo(){
//     saveProfile.onclick = (e) =>{      
      
//     }
// }
editProfileInfo();
//saveProfileInfo();