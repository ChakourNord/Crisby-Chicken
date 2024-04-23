<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../CSS/style.css">
    <script src="../../JS/JSfunctions.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body onload="hide_btn()">
    <script>
    function hide_btn() {
        document.querySelector("#save-btn").children['0'].classList.add("none")
    }
    $(document).on("xcrudafterrequest", function(event, container) {

        if (Xcrud.current_task == 'save') {
            location.href = '"upload.php?id=" + id';

        }
    });
    </script>
    <div class="box_ifr">
        <?php
        $id = $_GET["id"];

        include "../xcrud/xcrud.php";
        $xcrud = Xcrud::get_instance();
        $xcrud->table("fd_execution_documents");
        $xcrud->where("id_execution =", $id);
        $xcrud->after_insert("set_id");
        $xcrud->pass_var("id_execution", $id);
        $xcrud->fields("name,path");
        $xcrud->change_type("path", "file", "", ["not_rename" => true]);
        $xcrud->unset_edit();
        $xcrud->unset_remove();
        $xcrud->unset_view();
        $xcrud->unset_csv();
        $xcrud->unset_limitlist();
        $xcrud->unset_numbers();
        $xcrud->unset_pagination();
        $xcrud->unset_print();
        $xcrud->unset_search();
        $xcrud->unset_title();
        $xcrud->unset_sortable();
        $xcrud
          ->hide_button("save_edit")
          ->hide_button("return")
          ->hide_button("save_new");
        echo $xcrud->render("create");
        ?> </div>
</body>