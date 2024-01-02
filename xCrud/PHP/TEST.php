<?php
//include the login securtiy path
include "../../includes/utils.php";
if (!$_COOKIE["tokenaudit"]) {
  if (checkToken()["id_user"] < 1) {
    header("location: ../../login.php");
  }
}
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();
Xcrud_config::$search_on_typing = true;
$xcrud->table("fd_executions")->table_name("fulfilments");
$xcrud->load_view("list", "xcrud_list_view_wo.php"); // wo stand for no title
$xcrud->load_view("edit", "xcrud_detail_view_btn_b_in.php"); //additional view only for edit 

$xcrud->unset_remove();
//$xcrud->group_by_columns("emp.id");
$xcrud->default_tab("fd");
$xcrud->is_edit_modal(true);
$xcrud->advanced_search_active(true, "left", false);
$costs = $xcrud->nested_table(
  "costs",
  "id",
  "fd_execution_costs",
  "id_execution"
);
$costs->fields("id_execution,expected_cost,actual_cost,name");
$costs
  ->columns("id_execution,expected_cost,actual_cost,name")
  ->disabled("id_execution");
$costs->load_view("list", "xcrud_list_view_wo.php");
$costs->load_view("edit", "xcrud_detail_view_btn_b.php");
$xcrud
  ->join("id_fulfillment", "fd_fulfillments", "id", "ful")
  ->join("ful.id_fulfillment_type", "fd_fulfillment_types", "id", "type")
  ->join("ful.id_filiale", "filiali", "id_fil", "fil")
  ->join("fil.company_id_number", "companies", "company_id_number", "com")
  ->join("ful.id", "fd_referents", "id_fulfillment", "re")
  ->join("re.id_employee", "employees", "id", "emp");
// ->join("id", "fd_execution_costs", "id_execution", "costs");

$xcrud->advanced_filter(2, "type.names", "LIKE", "Fulfillment");
$xcrud->advanced_filter(3, "deadline_date", "<", "Date Less Than");
$xcrud->advanced_filter(4, "deadline_date", ">", "Date Greater than");
$xcrud->advanced_filter(5, "com.company", "LIKE", "Search Company");
$xcrud->advanced_filter(7, "fil.type", "LIKE", "Type search");
$xcrud
  ->relation("emp.id", "employees", "id", ["name", "surname"])
  ->label("emp.id", "names");
$xcrud
  ->relation("ful.id_filiale", "filiali", "id", "des_fil")
  ->relation("ful.id_fulfillment_type", "fd_fulfillment_types", "id", "names")
  ->relation("type.id", "fd_fulfillment_types", "id", "names")
  ->label("type.id", "Fulfillment");

$xcrud->columns(
  "id,com.company,fil.type,type.id,fil.des_fil,type.tags,emp.id ,date,deadline_date"
);
// $xcrud->fields(
//   "id_fulfillment,note,id_employee,is_enabled,com.company_id_number,emp.id",
//   "",
//   "rr",
//   ""
// );
$xcrud->fields("date,note,is_active,deadline_date", "", "Execution", "");
$xcrud->fields(
  "ful.id_fulfillment_type,ful.id_filiale,ful.start_date,ful.deadline_value,ful.deadline_period,ful.note",
  "",
  "Fulfillment",
  ""
);

$xcrud->unset_add();
$xcrud->unset_view();
$xcrud->create_action("Document", "document");
// $xcrud->before_remove("set_fulfill");

// $xcrud->button(
//   "Javascript:;",
//   "FIN-DATE",
//   " ",
//   "",
//   [
//     "id" => "setcom-d",
//     "data-toggle" => "modal",
//     "data-target" => ".complete",
//     "data-primary" => "{id}",
//     "data-name" => "{costs.name}",
//     "data-ex_cost" => "{costs.expected_cost}",
//     "data-ac_cost" => "{costs.actual_cost}",
//     "data-fulfill" => "{id_fulfillment}",
//     "data-note" => "{note}",
//     "data-id_emp" => "{id_employee}",
//     "data-deadend" => "{deadline_date}",
//     "onclick" => "setting({id})",
//   ],
//   ["is_active", "!=", "1"]
// );
//this button open a modal and in this modal is this button bind with complete-sft
$xcrud->button(
  "Javascript:;",
  "Complete",
  " ",
  "",
  [
    "id" => "setcom",
    "data-toggle" => "modal",
    "data-target" => ".completee",
    "data-primary" => "{id}",
    "data-fulfill" => "{id_fulfillment}",
    "data-note" => "{note}",
    "data-id_emp" => "{id_employee}",
    "data-deadend" => "{deadline_date}",
    "data-dvalue" => "{ful.deadline_value}",
    "data-dperiod" => "{ful.deadline_period}",
    "onclick" => "settingdb(this)",
  ],
  ["is_active", "=", "1"]
);
//execution button complete
$xcrud->button(
  "Javascript:;",
  "Complete-sft none",
  " ",
  "xcrud-action none",
  [
    "id" => "setcom-sft",
    "data-toggle" => "modal",
    "data-target" => ".complete",
    "data-task" => "action",
    "data-action" => "complete-task",
    "data-primary" => "{id}",

    "data-fulfill" => "{id_fulfillment}",
    "data-note" => "{note}",
    "data-id_emp" => "{id_employee}",
    "data-deadend" => "{deadline_date}",
    "data-dvalue" => "{ful.deadline_value}",
    "data-dperiod" => "{ful.deadline_period}",
    "data-datenew" => " ",
    "onclick" => "setting(this)",
  ],
  ["is_active", "=", "1"]
);

$xcrud->create_action("complete-task", "dumb");// send information to the database and create a new record and update the old one
//
//$xcrud->after_update("after_up_exe");
//dokument modal
$xcrud->button(
  "Javascript:;",
  "Document",
  "",
  "doku-btn",
  [
    "data-toggle" => "modal",
    "id" => "uploaddoku",
    "data-target" => ".dokument",
    "prim" => "{id}",
    "onclick" => "settingd({id})",
  ],
  " Operatrice"
);

// $xcrud->button(
//   "Javascript:;",
//   "Add Costs",
//   "costs",
//   "",
//   [
//     "data-toggle" => "modal",
//     "id" => "addcost-btn",
//     "data-target" => ".addcost",
//     "prim" => "{id}",
//     "onclick" => "settingadd({id})",
//   ],
//   " Operatrice"
// );
//remove button and action for fulfillment remove
$xcrud->create_action("remove-ful", "remove_f");
$xcrud->button(
  "Javascript:;",
  "Remove",
  "fa fa-remove",
  "costs xcrud-action btn btn-danger btn-sm xc",
  [
    "id" => "remove-btn",
    "data-primary" => "{id}",
    "data-fulfill" => "{id_fulfillment}",
    "data-task" => "action",
    "data-action" => "remove-ful",
  ],
  ["is_active", "=", "1"]
);
// $xcrud->button(
//   "#",
//   "Document",
//   "icon-close glyphicon glyphicon-remove",
//   "doku-btn",
//   [
//     // set action vars to the button
//     "data-task" => "action",
//     "data-action" => "document",
//     "data-primary" => "{id}",
//   ]
// );
//highlights
$xcrud
  ->column_width("com.company", "25%")
  ->column_width("fil.type", "10%")
  ->column_width("emp.id", "20%")
  ->column_width("type.id", "20%");
$currentDate = date("Y-m-d");
$threeDaysBeforeDeadline = date("Y-m-d", strtotime($currentDate . " + 1 days"));
$threeDaysOnDeadline = date("Y-m-d", strtotime($currentDate));
$threeDaysAfterDeadline = date("Y-m-d", strtotime($currentDate . " + 2 days"));
$threeDays3Deadline = date("Y-m-d", strtotime($currentDate . " + 3 days"));
$xcrud->highlight_row("deadline_date", "=", $threeDaysBeforeDeadline, "red");
$xcrud->highlight_row("deadline_date", "=", $threeDaysOnDeadline, "red");
$xcrud->highlight_row("deadline_date", "=", $threeDaysAfterDeadline, "red");
$xcrud->highlight_row("deadline_date", "=", $threeDays3Deadline, "red");

$fourteenDays1Deadline = date("Y-m-d", strtotime($currentDate));
$fourteenDays2Deadline = date("Y-m-d", strtotime($currentDate . " + 1 days"));
$fourteenDays3Deadline = date("Y-m-d", strtotime($currentDate . " + 2 days"));
$fourteenDays4Deadline = date("Y-m-d", strtotime($currentDate . " + 3 days"));
$fourteenDays5Deadline = date("Y-m-d", strtotime($currentDate . " + 4 days"));
$fourteenDays6Deadline = date("Y-m-d", strtotime($currentDate . " + 5 days"));
$fourteenDays7Deadline = date("Y-m-d", strtotime($currentDate . " + 6 days"));
$fourteenDays8Deadline = date("Y-m-d", strtotime($currentDate . " + 7 days"));
$fourteenDays9Deadline = date("Y-m-d", strtotime($currentDate . " + 8 days"));
$fourteenDays10Deadline = date("Y-m-d", strtotime($currentDate . " + 9 days"));
$fourteenDays11Deadline = date("Y-m-d", strtotime($currentDate . " + 10 days"));
$fourteenDays12Deadline = date("Y-m-d", strtotime($currentDate . " + 11 days"));
$fourteenDays13Deadline = date("Y-m-d", strtotime($currentDate . " + 12 days"));
$fourteenDays14Deadline = date("Y-m-d", strtotime($currentDate . " + 14 days"));
$fourteenDays15Deadline = date("Y-m-d", strtotime($currentDate . " + 15 days"));

$xcrud->highlight_row("deadline_date", "=", $fourteenDays5Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays6Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays7Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays8Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays9Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays10Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays11Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays12Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays13Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays14Deadline, "yellow");
$xcrud->highlight_row("deadline_date", "=", $fourteenDays15Deadline, "yellow");

$xcrud->highlight_row("deadline_date", "<", $currentDate, "#00000070");
//bulk delete
$xcrud->bulk_select_position("left"); //It can be 'left' or 'right'
$xcrud->set_bulk_select(false, "is_active", "=", "1");
$xcrud->create_action("bulk_delete", "bulk_delete");

// action callback, function publish_action() in functions.php

//$xcrud->columns("c.company,fil.name,id_fulfillments");
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
    <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered h-25">
            <div class="modal-content h-100 " style="height: 83%!important">
                <iframe src='ifr_fulfillments.php?add=true&rpage=2' class='w-100 h-100' id="trans-42"></iframe>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary xcrud-action" id="save-btn-ifr-top" onclick="save();">Save
                        changes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- dokument modal -->
    <div class="modal bd-example-modal-lg dokument" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered h-25">
            <div class="modal-content h-100 " style="height: 83%!important">
                <iframe src='' class='w-100 h-100' id="trans-43-doku"></iframe>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary xcrud-action" id="save-btn-ifr-top-d" onclick="savev2d();">Save
                        changes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- addcost modal -->
    <div class="modal bd-example-modal-lg addcost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered h-25">
            <div class="modal-content h-100 " style="height: 83%!important">
                <iframe src='' class='w-100 h-100' id="trans-43-addcost"></iframe>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary xcrud-action" id="save-btn-ifr-top-add" onclick="savev2add();">Save
                        changes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- complete modal -->
    <div class="modal bd-example-modal-lg complete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered h-25">
            <div class="modal-content h-100 " style="height: 83%!important">
                <iframe src=' ' class='w-100 h-100' id="fin-date"></iframe>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary xcrud-action" id="save-btn-ifr-top" data-dismiss="modal"
                        onclick="savev2();">Save
                        changes</a>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // get the element
        // var element = document.querySelector("#navbarDropdownMenuLink");

        // // create a clone of the element
        // var clone = element.cloneNode(true);

        // // replace the original element with the clone
        // element.parentNode.replaceChild(clone, element);

        // $("#navbarDropdownMenuLink").off();


        // var ful =
        //     $('.xcrud-action[data-task="remove"][data-primary="2403"]').attr("data-ful");


        //function to set correctly the time of a complete fulfillment
        $('#save-btn-ifr-top-setcom').on('click', function() {
            var prim = $(this).attr("data-primary");


            $('#setcom-sft[data-primary="' + prim + '"]').click();



            $('#datepicker').attr('disabled', false);
            $('#datepicker').val('2003-03-30');

        });


        $('#savedate').attr('disabled', true);
        $('#datepicker').on('input', function() {
            if ($(this).val() == '') {
                $('#savedate').attr('disabled', true);
            } else {
                $('#savedate').attr('disabled', false);
            }
        });
        $('#savedate').on('click', function() {
            var prim = $(this).attr('data-primary');
            $('#datepicker').attr('disabled', true);

            $('#setcom-sft[data-primary="' + prim + '"]').attr("data-datenew", $('#datepicker').val());
        });
    });
    </script>
    <!-- complete modal -->
    <div class="modal bd-example-modal-lg completee" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered h-25">
            <div class="modal-content h-100 " style="height: 83%!important">
                <!--<iframe src=' ' class='w-100 h-100' id="fin-date1"></iframe>-->
                <div class="container h-100">
                    <div class="row rowselfcost">
                        <div class="col-sm">
                            <div class="p-4 mt-5 " id="dateRangePicker">
                                <input class="form-control" type="date" name="nvlaue" id="datepicker">
                            </div>
                            <div class="space container p-3">
                                <button type="button" class="btn btn-success " id="savedate">Confirm Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary xcrud-action" id="save-btn-ifr-top-setcom"
                                    data-task="action" data-action="complete-task" data-primary="{id}"
                                    data-name="{costs.name}" data-ex_cost="{costs.expected_cost}"
                                    data-ac_cost="{costs.actual_cost}" data-fulfill="{id_fulfillment}"
                                    data-note="{note}" data-id_emp="{id_employee}" data-deadend="{deadline_date}"
                                    data-dvalue="{ful.deadline_value}" data-dperiod="{ful.deadline_period}"
                                    onclick="savev2do();" data-dismiss="modal">Complete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- <div class="popup none">
        <div class="docu">
            <div class="close">
                <span class="zu">close</span>
            </div>
        </div>

    </div> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    function closeing() {
        document.querySelector(".popup").classList.add('none');
    }

    // function redirect() {
    //     //location.href = 'fulfillments.php?add=true';
    //     document.querySelector(".popup").classList.remove('none');
    //     document.querySelector(".docu").innerHTML =
    //         '<div class="w-100 h-100"><iframe src=\'ifr_fulfillments.php?add=true&rpage=2\' class=\'w-100 h-100\' ></iframe></div><button type=\'button\' class=\'btn btn-danger\' data-dismiss=\'modal\' ><i class=\'fa fa-window-close ttt\'></i> Close</button>'

    // }

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
    });
    </script>
    <script>
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
            if (items.length > 0) {
                document.querySelector('#del-btn').classList.remove('none');
            } else {
                document.querySelector('#del-btn').classList.add('none')
            }
        }
    }
    </script>
    <script>
    // bulk delete function 
    $(document).ready(function() {
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
        <!-- <button class="btn btn-success" onclick="redirect();">Delete Selected</button> -->
        <?php echo $xcrud->render(); ?>


    </div>
</body>


</html>