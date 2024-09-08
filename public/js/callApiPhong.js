// /*import * as h from Host;*/
// const host = "https://localhost:44354/api/Values/"
// var callApi = (api, select) => {
//     return axios.get(api)
//         .then((response) => {
//             renderData(response.data, select);
//         });
// }

// callApi("https://localhost:44354/api/Values/getKhus", 'khu');
// var renderData = (array, select) => {
//     let row = '<option disable value=""> --Tất cả-- </option>';
//     if (array != null)
//         array.forEach(element => {
//             row += `<option value="${element.Ma}">${element.Ten}</option>`
//         });
//     document.querySelector("#" + select).innerHTML = row
// }

// $("#khu").change(() => {
//     callApi(host + "getTangs?maKhu=" + $("#khu").val(), 'tang');
//     phong.innerHTML = ' <option disable value=""> --Tất cả-- </option>';
// });
// $("#tang").change(() => {
//     callApi(host + "getPhongs?maTang=" + $("#tang").val(), 'phong');
// });
// $("#phong").change(() => {

//     //if ($("#phong").val() != "") {
//     //    disabledDV(false)
//     //    printResult();
//     //    idValue.innerText = $("#phong option:selected").text()
//     //}
//     //else {
//     //    dvDon.innerHTML = "";
//     //    disabledDV(true)
//     //}
// })
