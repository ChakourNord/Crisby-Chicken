<?php
//in use, the users record site manage new user to login
 include "../../includes/utils.php";
// if (!$_COOKIE["tokenaudit"]) {
//   if (checkToken()["id_user"] < 1) {
//     header("location: ../../login.php");
//   }
// }
// session_start();

if (isset($_GET["add"])) {
  $add = $_GET["add"];
} else {
  $add = "false";
}
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();
$xcrud->load_view("list", "xcrud_list_view_wo.php");
$xcrud->load_view("create", "add.php");
$xcrud->table("users");
 $xcrud->is_edit_modal(true);
 $xcrud->order_by("id", "desc");
 $xcrud->before_insert("crypt_password", "functions.php");
 $xcrud->unset_remove();
 if ($add == true) {
   $xcrud
    //->hide_button("save_return")
     ->hide_button("save_edit")
     ->hide_button("save_new");
 }
  $xcrud->default_tab("Users");
 $xcrud->is_edit_modal(true);
 $roles = $xcrud->nested_table("roles", "id", "users_roles", "id_user");
 $roles
  ->disabled("id_user")
   ->relation("id_role", "roles", "id", "name")
   ->fields("id_user,id_role");
 $roles->load_view("list", "xcrud_list_view_wo.php");
 $roles->load_view("edit", "xcrud_detail_view_btn_b.php");
$xcrud->fields(
  "id_company,name,surname,photo_url,email,username,password,is_active"
);
$xcrud->columns(
  "id_company,name,surname,photo_url,email,username,password,is_active"
);

$xcrud
  ->relation("id_company", "companies", "id","company")
  ->disabled("password", "edit");
//   ->fields("id_fulfillment,id_roles");
$roles
 ->columns("id_user,is_active,id_role")
 ->relation("id_user","users","id","surname");

$costs = $xcrud->nested_table(
  "costs",
  "id",
  "fd_fulfillment_costs",
  "id_fulfillment"
);
$costs->fields("id_fulfillment,name,cost,is_active");
$costs
  ->columns("id_fulfillment,name,cost,is_active")
  ->disabled("id_fulfillment");
// $xcrud
//   ->relation("id_filiale", "filiali", "id", "des_fil")
//   ->relation("id_fulfillment_type", "fd_fulfillment_types", "id", "names");

// $xcrud->fields(
//   "id,id_filiale,id_fulfillment_type,note,start_date,deadline_value,deadline_period"
// );
// $customers = $xcrud->nested_table(
//   "rolessfd",
//   "",
//   "customers",
//   "customerNumber"
// );
$current_date = date("Y-m-d");

// $xcrud->set_attr("start_date", [
//   "value" => "$current_date",
// ]);
// $xcrud->after_insert("get_important");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../CSS/style.css">
    <script src="../../JS/JSfunctions.js"></script>


    <title>Document</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    $(document).ready(function() {
        $('.continue').first().attr('href', 'ifr_exe.php?add=true&=');
        $('.continue').first().removeAttr('data-after');
        $(document).on("xcrudafterrequest", function(event, container) {
            if (Xcrud.current_task == 'save') {
                window.location.href = 'ifr_exe.php?add=true&=';

            }
        });
    });
    </script>
    <?php include "navbarv2.php"; ?>
    <div class="container-fluid">
        <div class="popup none">
            <div class="docu">
                <div class="close">
                    <span class="zu">close</span>
                </div>
            </div>

        </div>


        <?php if ($add == "true") {
          echo $xcrud->render("create");
        } else {
          echo $xcrud->render();
        } ?>
        <!-- <div class="d-btn-show">
            <button class="btn btn-primary btn-show" onclick="closeing();">Delete Selected</button>
        </div> -->

    </div>
</body>


</html>