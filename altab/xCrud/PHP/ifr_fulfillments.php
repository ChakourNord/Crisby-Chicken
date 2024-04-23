<?php
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
$xcrud->load_view("edit", "xcrud_detail_view_btn_b_none.php");
$xcrud->load_view("create", "add_ful.php");
$xcrud->table("fd_fulfillments")->table_name("fulfilments");
$xcrud->is_edit_modal(true);
$xcrud->order_by("id", "desc");
$xcrud->unset_remove();
if ($add == true) {
  $xcrud
    //->hide_button("save_return")
    ->hide_button("save_edit")

    ->hide_button("save_new");
}
$xcrud->default_tab("fd");
$xcrud->is_edit_modal(true);
$employee = $xcrud->nested_table(
  "employee",
  "id",
  "fd_referents",
  "id_fulfillment"
);
$employee
  ->relation("id_employee", "employees", "id", ["name", "surname"])
  ->fields("id_fulfillment,id_employee");
$employee->load_view("list", "xcrud_list_view_wo.php");
$employee->load_view("edit", "xcrud_detail_view_btn_c_tost.php");
$employee->load_view("create", "xcrud_detail_view_btn_c.php");
$employee
  ->columns("id_fulfillment,is_active,id_employee")
  ->disabled("id_fulfillment")
  ->validation_required("id_employee");
$costs = $xcrud->nested_table(
  "costs",
  "id",
  "fd_fulfillment_costs",
  "id_fulfillment"
);
$costs->fields("id_fulfillment,name,cost,is_active");
$costs
  ->columns("id_fulfillment,name,cost,is_active")
  ->disabled("id_fulfillment")
  ->validation_required("name");
$costs->load_view("list", "xcrud_list_view_wo.php");
$costs->load_view("edit", "xcrud_detail_view_btn_c.php");
$costs->load_view("create", "xcrud_detail_view_btn_c.php");
$xcrud
  ->relation("id_filiale", "filiali", "id", "des_fil")
  ->relation("id_fulfillment_type", "fd_fulfillment_types", "id", "names");
$xcrud->columns(
  "id,id_filiale,id_fulfillment_type,note,start_date,deadline_value,deadline_period"
);
$xcrud->fields(
  "id,id_filiale,id_fulfillment_type,note,start_date,deadline_value,deadline_period"
);
$xcrud
  ->validation_required("id_filiale")
  ->validation_required("id_fulfillment_type")
  ->validation_required("deadline_value");
$customers = $xcrud->nested_table(
  "employee",
  "",
  "customers",
  "customerNumber"
);
$current_date = date("Y-m-d");

$xcrud->set_attr("start_date", [
  "value" => "$current_date",
]);

$xcrud->after_insert("get_important");
$xcrud->bulk_select_position("left"); //It can be 'left' or 'right'
$xcrud->set_bulk_select();
$xcrud->create_action("bulk_delete", "bulk_delete");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/button.css">
    <script src="../../JS/JSfunctions.js"></script>
    <script src="../xcrud/plugins/jquery-3.5.1.min.js"></script>

    <title>Document</title>
</head>

<body>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"
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
    </script> -->
    <script>
    function deleteItems() {
        var r = confirm("Confirm deletion of " + items.length + " items.");
        if (r == true) {
            Xcrud.request('.xcrud-ajax', Xcrud.list_data('.xcrud-ajax', {
                action: 'bulk_delete',
                task: 'action',
                selected: items,
                table: 'fd_fulfillments',
                identifier: 'id'
            }))
            items = [];
            if (items.length > 0) {
                document.querySelector('#del-btn').classList.remove('none');
            } else {
                document.querySelector('#del-btn').classList.add('none')
            }
        }
    }
    </script>
    <script>
        //eventlistener for disappear the buttons in edit
    $(document).ready(function() {
        $('.xcrud-action[data-task="edit"]').on("click", function() {
            setTimeout(function() {
                if ($('li[data-tab]').first().attr("tabindex") == 0) {
                    $("#save-btn-none-ifr").removeClass("none")
                } else if ($('li[data-tab]').first().attr("tabindex") == -1) {
                    $("#save-btn-none-ifr").addClass("none")
                }
            }, 1000);
        });


        $('.xcrud-action[data-task="edit"]').on("click", function() {
            setInterval(function() {
                if ($('li[data-tab]').first().attr("tabindex") == 0) {
                    $("#save-btn-none-ifr").removeClass("none")
                } else if ($('li[data-tab]').first().attr("tabindex") == -1) {
                    $("#save-btn-none-ifr").addClass("none")
                }
            }, 100);
        });


        $(document).on('click', '.xcrud-bulk-checkbox', function() {
            let checkedCheckboxes = $('.xcrud-bulk-checkbox:checked').length;

            if (checkedCheckboxes > 0) {
                $('#del-btn').removeClass('none');

            } else {
                $('#del-btn').addClass('none');

            }
        });
        $(document).on('click', '.xcrud-bulk-checkbox-main', function() {
            let checkedMainBoxes = $('.xcrud-bulk-checkbox-main:checked').length;
            setTimeout(function() {
                let checkedCheckboxes = $('.xcrud-bulk-checkbox:checked').length;
                if (checkedMainBoxes > 0 && checkedCheckboxes > 0) {
                    $('#del-btn').removeClass('none');

                } else {
                    $('#del-btn').addClass('none');

                }
            }, 20);
        });
    });
    </script>


    <?php include "navbarv2.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-">

                <div class="col-sm" style="display: flex; position: absolute; height: 91vh; align-items:
                    self-end; justify-content: flex-end;">
                    <div class="d-btn-show none" id="del-btn" style="position: fixed; z-index:5886; margin: 13px;">
                        <button class="noselect" onclick="deleteItems()"><span class="text">Delete</span><span
                                class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                                    </path>
                                </svg></span></button>
                    </div>
                </div>
            </div>
        </div>
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