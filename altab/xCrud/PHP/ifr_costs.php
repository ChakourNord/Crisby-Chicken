<?php
//no in use !!!
include "../../includes/utils.php";
// if (!$_COOKIE["tokenaudit"]) {
//   if (checkToken()["id_user"] < 1) {
//     header("location: ../../login.php");
//   }
// }
// session_start();

// $id = $_SESSION["id_emp"];
// print_r($_SESSION["id_exe"]);
// print_r($_SESSION["id_emp"]);
if (isset($_SESSION["id_exe"][0]["id"])) {
  $id = $_SESSION["id_exe"][0]["id"];
} else {
  $id = 0;
}
if (isset($_GET["add"]) && isset($_GET["ad"])) {
  $add = $_GET["add"];
  $ad = $_GET["ad"];
} else {
  $add = "false";
  $ad = "false";
}
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();

$xcrud->table("fd_execution_costs")->table_name("costs");
if ($ad == "true") {
  $xcrud->set_attr("id_execution", [
    "value" => "{$id}",
  ]);
} elseif ($ad == "false") {
  $xcrud->set_attr("id_execution", [
    "value" => "{$_GET["id"]}",
  ]);
}
$xcrud->load_view("create", "add.php");

//$xcrud->unset_edit()->unset_remove();
if ($add == true) {
  $xcrud
    //->hide_button("save_return")
    ->hide_button("save_edit")
    ->hide_button("return")
    ->hide_button("save_new");
}

// $xcrud->relation("id_employee", "employees", "id", ["name", "surname"]);
$xcrud->no_editor("id_execution");
$xcrud->fields("id_execution,name,expected_cost,actual_cost");
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
    $(document).ready(function() {
        $(".doku-btn").on("click", function() {
            document.querySelector(".popup").classList.remove('none');
        });

        $(".close").on("click", function() {
            document.querySelector(".popup").classList.add('none');
        });
        $(".btn-show").remove(function() {
            document.querySelector(".popup").classList.add('none');
        });
        $(document).on("xcrudafterrequest", function(event, container) {

            if (Xcrud.current_task == 'save') {
                location.href = 'ifr_fulfillments.php?add=true&rpage=2';
            }
        });
    });



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