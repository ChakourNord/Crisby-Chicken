<?php
//not in use
include "../../includes/utils.php";
if (!$_COOKIE["tokenaudit"]) {
  if (checkToken()["id_user"] < 1) {
    header("location: ../../login.php");
  }
}
$id = $_GET["id"];
include "../xcrud/xcrud.php";
$xcrud = Xcrud::get_instance();
$xcrud->table("fd_execution_costs");
$xcrud->where("id_execution =", $id);
$xcrud->after_insert("set_id");
$xcrud->pass_var("id_execution", $id);
$xcrud->fields("expected_cost,actual_cost,name");
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
?>
