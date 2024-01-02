<?php
///in use, the company record site
include "../../includes/utils.php";
if (!$_COOKIE["tokenaudit"]) {
  if (checkToken()["id_user"] < 1) {
    header("location: ../../login.php");
  }
}
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();
$xcrud->table("companies");
$xcrud->load_view("list", "xcrud_list_view_wo.php");
$xcrud->load_view("edit", "xcrud_detail_view_btn_b_com.php");
$xcrud->advanced_search_active(true, "left", false);
$xcrud->advanced_filter(2, "company_id_number", "=", "Company_id");
$xcrud->advanced_filter(3, "company", "LIKE", "Company Name");
$xcrud->advanced_filter(4, "legal_office", "LIKE", "Office");
$xcrud->advanced_filter(5, "vat_number", "LIKE", "VAT");
$xcrud->advanced_filter(7, "cf", "LIKE", "CF search");
$xcrud->is_edit_modal(true)->disabled("company_id_number");
$xcrud->columns(
  "company_id_number,company,legal_office,vat_number,cf,is_active"
);
$xcrud->fields(
  "company_id_number,company,legal_office,vat_number,cf,is_active"
);
$xcrud->column_width("company_id_number", "3%");
$xcrud->unset_remove();
$xcrud->unset_view();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="../../JS/JSfunctions.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <?php include "navbarv2.php"; ?>
    <div class="container-fluid">

        <?php echo $xcrud->render(); ?>



    </div>
</body>


</html>