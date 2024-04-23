function closeing() {
  document.querySelector(".popup").classList.add("none");
}
var i = 0;
var container = document.querySelector(".xcrud-ajax");
// function save() {
//   if (i == 4) {
//     var btnt = document.querySelector("#save-btn-ifr-top");
//     btnt.innerText = "Save changes";
//     btnt.removeAttribute("data-dismiss");
//     i = 0;
//   }
//   var ifr = document.querySelector("#trans-42");
//   var src = ifr.src;
//   var button = ifr.contentDocument.querySelector("#save-btn-ifr");

//   var btn = button.children["0"];
//   btn.click();
//   i++;

//   if (i == 3) {
//     i = 4;
//     var btnt = document.querySelector("#save-btn-ifr-top");
//     btnt.innerText = "Complete";
//     btn.click();
//     btnt.setAttribute("data-dismiss", "modal");
//     btnt.innerText = "Save changes";
//     Xcrud.show_message(container, "Add Success", "success");
//     Xcrud.reload();
//   } else if (i == 2) {
//     var btnt = document.querySelector("#save-btn-ifr-top");
//     btnt.innerText = "Complete";
//   }
// }
function hide_btn() {
  document.querySelector("#save-btn").children["0"].classList.add("none");
}
function hide_btna() {
  document.querySelector(".add").classList.add("none");
}
function setting(id) {
  document.querySelector("#fin-date").src = "date_change.php?add=true&id=" + id;
}
// costum remove button
function savev2() {
  var btnt = document.querySelector("#save-btn-ifr-top");
  btnt.setAttribute("data-dismiss", "modal");
  var ifr = document.querySelector("#fin-date");
  var button = ifr.contentDocument.querySelector("#save-btn");
  var btn = button.children["0"];
  btn.click();
}
function settingd(id) {
  document.querySelector("#trans-43-doku").src = "upload.php?id=" + id;
}
function settingadd(id) {
  document.querySelector("#trans-43-addcost").src =
    "ifr_costs.php?add=false&ad=false&id=" + id;
}
// send information to a another button
function settingdb(button) {
  // var id = button.getAttribute("id");
  let currentDate = new Date();
  let formattedDate =
    currentDate.getFullYear() +
    "-" +
    ("0" + (currentDate.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + currentDate.getDate()).slice(-2);
  $("#savedate").attr("disabled", true);
  $("#datepicker").attr("disabled", false);
  $("#datepicker").val(formattedDate);
  var action = button.getAttribute("data-action");
  var primary = button.getAttribute("data-primary");
  var name = button.getAttribute("data-name");
  var ex_cost = button.getAttribute("data-ex_cost");
  var ac_cost = button.getAttribute("data-ac_cost");
  var fulfill = button.getAttribute("data-fulfill");
  var note = button.getAttribute("data-note");
  var id_emp = button.getAttribute("data-id_emp");
  var deadend = button.getAttribute("data-deadend");
  var dvalue = button.getAttribute("data-dvalue");
  var dperiod = button.getAttribute("data-dperiod");
  $(button).on("click", function () {
    $('#setcom-sft[data-primary="' + primary + '"]').attr("data-datenew", "");
  });

  datas = [
    button,
    action,
    primary,
    name,
    ex_cost,
    ac_cost,
    fulfill,
    note,
    id_emp,
    deadend,
    dvalue,
    dperiod,
  ];

  var data = document.querySelector("#save-btn-ifr-top-setcom");
  var data2 = document.querySelector("#savedate");
  data.setAttribute("data-primary", primary);
  data2.setAttribute("data-primary", primary);
  data.setAttribute("data-action", "dumb");
  data.setAttribute("data-name", datas[3]);
  data.setAttribute("data-ex_cost", datas[4]);
  data.setAttribute("data-ac_cost", datas[5]);
  data.setAttribute("data-fulfill", datas[6]);
  data.setAttribute("data-note", datas[7]);
  data.setAttribute("data-id_emp", datas[8]);
  data.setAttribute("data-deadend", datas[9]);
  data.setAttribute("data-dvalue", datas[10]);
  data.setAttribute("data-dperiod", datas[11]);
}

function savev2d() {
  var btnt = document.querySelector("#save-btn-ifr-top-d");
  btnt.setAttribute("data-dismiss", "modal");
  var ifr = document.querySelector("#trans-43-doku");
  var button = ifr.contentDocument.querySelector("#save-btn");
  var btn = button.children["0"];
  btn.click();
}
function savev2add() {
  var btnt = document.querySelector("#save-btn-ifr-top-add");
  btnt.setAttribute("data-dismiss", "modal");
  var ifr = document.querySelector("#trans-43-addcost");
  var button = ifr.contentDocument.querySelector("#save-btn");
  var btn = button.children["0"];
  btn.click();
}
function savev2do() {
  var btnt = document.querySelector("#save-btn-ifr-top-setcom");
  btnt.setAttribute("data-dismiss", "modal");
  var date = document.querySelector("#datepicker");
}
