<?php
//no in use !!!
include "../../includes/utils.php";
// if (!$_COOKIE["tokenaudit"]) {
//   if (checkToken()["id_user"] < 1) {
//     header("location: ../../login.php");
//   }
// }
// session_start();

$id = $_SESSION["id_exe"][0]["id"];
print_r($_SESSION["id_ful"]);
//print_r($id);
if (isset($_GET["add"])) {
  $add = $_GET["add"];
} else {
  $add = "false";
}
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();
$xcrud->table("fd_executions")->table_name("exe");

//$xcrud->unset_edit()->unset_remove();
if ($add == true) {
  $xcrud
    //->hide_button("save_return")
    ->hide_button("save_edit")
    ->hide_button("return")
    ->hide_button("save_new");
}

$xcrud->relation("id_employee", "employees", "id", ["name", "surname"]);
$xcrud->fields("id_employee")->label("id_employee", "Employee Name");

$xcrud->after_update("insert_idful_into_ref");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <title>Document</title>
</head>

<body onload="hide_btn()">
    <script>
    function hide_btn() {
        document.querySelector("#save-btn").children['0'].classList.add("none")
    }
    // $(document).ready(function() {
    //     $(".doku-btn").on("click", function() {
    //         document.querySelector(".popup").classList.remove('none');
    //     });

    //     $(".close").on("click", function() {
    //         document.querySelector(".popup").classList.add('none');
    //     });
    //     $(".btn-show").remove(function() {
    //         document.querySelector(".popup").classList.add('none');
    //     });
    //     $(document).on("xcrudafterrequest", function(event, container) {

    //         if (Xcrud.current_task == 'save') {
    //             $.ajax({
    //                 url: '../xCrud/xcrud/functions.php',
    //                 action: 'my_ajax_action',


    //                 success: function() {

    //                     location.href = 'ifr_costs.php?add=true';
    //                 }
    //             });


    //         }
    //     });
    // });



    function deleteItems() {
        var r = confirm("Confirm deletion of " + items.length + " items.");
        if (r == true) {
            Xcrud.request('.xcrud-ajax', Xcrud.list_data('.xcrud-ajax', {
                action: 'bulk_delete',
                task: 'action',
                selected: items,
                table: 'fd_executions',
                identifier: 'id'
            }))
            items = [];
        }
    }
    </script>
    <div class="box_ifr">
        <div class="popup none">
            <div class="docu">
                <div class="close">
                    <span class="zu">close</span>
                </div>
            </div>

        </div>


        <?php if ($add == "true") {
          echo $xcrud->render("edit", $id);
        } else {
          echo $xcrud->render();
        } ?>
        <!-- <div class="d-btn-show">
            <button class="btn btn-primary btn-show" onclick="closeing();">Delete Selected</button>
        </div> -->

    </div>
</body>


</html>