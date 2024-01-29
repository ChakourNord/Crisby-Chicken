<?php
include "../../includes/utils.php";
function crypt_password($postdata, $xcrud)
{
  $postdata->set("password", encryptPassword($postdata->get("password")));
}
// function addate()
// {
//   $value = 5;
//   $interval = "Day"; 
//   $date = 10.07.03;
//   $ndeadend = date("Y-m-d", strtotime("+".$value." ".$interval, $date));
//   print_r(strtotime('25.07.2003'));
//   print_r($ndeadend);
// }
function remove_f($xcrud)
{
  $db = Xcrud_db::get_instance();
  // $db->query('SELECT id_fulfillment from fd_executions WHERE id = '.$primary.' ORDER BY ID DESC LIMIT 1');
  $db->query(
    "DELETE FROM fd_executions WHERE is_active = 1 and id_fulfillment = " .
      $xcrud->get("fulfill") .
      " AND id = " .
      $xcrud->get("primary") .
      " ORDER BY ID DESC LIMIT 1"
  );
  $db->query(
    "UPDATE fd_executions SET is_active = 1 WHERE id_fulfillment = " .
      $xcrud->get("fulfill") .
      " ORDER BY ID DESC LIMIT 1"
  );
}
function addDate($date, $interval, $value)
{
  $newDate = date(
    "Y-m-d",
    strtotime("+" . $value . " " . $interval, strtotime($date))
  );
  return $newDate;
}
// $value = $xcrud->get("dvalue");
// $interval = $xcrud->get("dperiod");
// $date = $xcrud->get("deadend");
// $ndeadend = date("Y-m-d", strtotime("+" . $value . " " . $interval, $date));

// $date = $xcrud->get("deadend");
// $interval = trim($xcrud->get("dperiod"), "s");
// $value = (int) $xcrud->get("dvalue");
// $newDate = addDate($date, $interval, $value);

function dumb($xcrud)
{
  $db = Xcrud_db::get_instance();
  $date = $xcrud->get("deadend");
  $interval = trim($xcrud->get("dperiod"), "s");
  $value = (int) $xcrud->get("dvalue");
  $dateNew = $xcrud->get("datenew");
  $datee = date("Y-m-d", strtotime($dateNew));
  $newDate = addDate($dateNew, $interval, $value);
  $query1 =
    "UPDATE fd_executions SET date = '" .
    $datee .
    "' WHERE id = " .
    (int) $xcrud->get("primary");
  $query4 =
    "UPDATE fd_executions SET deadline_date = '" .
    $xcrud->get("deadend") .
    "' WHERE id = " .
    (int) $xcrud->get("primary");
  $query2 =
    "UPDATE fd_executions SET is_active = 0 WHERE id = " .
    (int) $xcrud->get("primary");
  $query3 =
    "UPDATE fd_executions SET is_enabled = 0 WHERE id = " .
    (int) $xcrud->get("primary");
  $db->query(
    "INSERT INTO fd_executions (id_fulfillment,note,id_employee,deadline_date) VALUES (
      " .
      (int) $xcrud->get("fulfill") .
      "
      ,
      '" .
      $xcrud->get("note") .
      "',
      " .
      (int) $xcrud->get("id_emp") .
      ",'" .
      $newDate .
      "'
      );"
  );
  //print_r((float) $xcrud->get("ex_cost"));
  $db->query("SELECT id FROM fd_executions ORDER BY ID DESC LIMIT 1");
  $_SESSION["id_execom"] = $db->result();
  $db->query(
    "INSERT INTO fd_execution_costs (id_execution," .
      "name" .
      "
      ,expected_cost,actual_cost) VALUES (
      " .
      $_SESSION["id_execom"][0]["id"] .
      ",
      '" .
      $xcrud->get("name") .
      "',
      " .
      (float) $xcrud->get("ex_cost") .
      ",
      " .
      (float) $xcrud->get("ac_cost") .
      "
      );"
  );

  // print_r($xcrud->get("primary"));
  $db->query($query1);
  $db->query($query2);
  $db->query($query3);
  $db->query($query4);
}
// function after_up_exe($postdata, $primary, $xcrud)
// {
//   print_r("dasds");
//   $db = Xcrud_db::get_instance();
//   $id_ful = (int) $db->query(
//     "SELECT id_fulfillment from fd_executions where id =" .
//       (int) $xcrud->get("primary")
//   );
//   $id_emp = (int) $db->query(
//     "SELECT id_employee from fd_executions where id =" .
//       (int) $xcrud->get("primary")
//   );
//   print_r($db->query("SELECT id_fulfillment from fd_executions where id = 8"));
//   // $db->query(
//   //   "INSERT INTO fd_referents (id_fulfillment,id_employee) VALUES (" .
//   //     $id_ful .
//   //     "," .
//   //     $id_emp .
//   //     ");"
//   // );
// }

function get_important($postdata, $primary, $xcrud)
{
  $db = Xcrud_db::get_instance();
  $interval = trim($postdata->get("deadline_period"), "s");
  $value = $postdata->get("deadline_value");
  $dateNew = $postdata->get("start_date");

  // $interval = "days";
  // $value = 5;
  // $dateNew = "2020-11-01";

  $date = addDate($dateNew, $interval, $value);

  $db->query(
    "INSERT INTO fd_executions(id_fulfillment,note,deadline_date) VALUES (
      " .
      $primary .
      ",'" .
      $postdata->get("note") .
      "','" .
      $date .
      "');"
  );

  $db->query("SELECT id FROM fd_executions ORDER BY ID DESC LIMIT 1");

  $_SESSION["id_exe"] = $db->result();
  $_SESSION["id_ful"] = $primary;
}
// function insert_r_into_exe($postdata, $primary, $xcrud)
// {
//   $db = Xcrud_db::get_instance();
//   $id_fulfillment_type = $xcrud->get("id_fulfillment_type");
//   $start_date = $xcrud->get("start_date");
//   $deadline_value = $xcrud->get("deadline_value");
//   $deadline_period = $xcrud->get("deadline_period");
//   $note = $xcrud->get("note");
//   // $postdata->set("id_fulfillment_type", $id_fulfillment_type);
//   // $postdata->set("start_date", $start_date);
//   // $postdata->set("deadline_value", $deadline_value);
//   // $postdata->set("deadline_period", $deadline_period);
//   // $postdata->set("note", $note);

//   $db->query(
//     "INSERT INTO fd_executions (id_fulfillment,'date',note,id_employee,deadline_date ) VALUES ($id_fulfillment_type,$start_date,$deadline_value,$deadline_period,$note)"
//   );
// }
function insert_idful_into_ref($postdata, $primary, $xcrud)
{
  $_SESSION["id_emp"] = $postdata->get("id_employee");
  $db = Xcrud_db::get_instance();

  $query3 =
    "INSERT INTO fd_referents(id_fulfillment,id_employee) VALUES (" .
    $_SESSION["id_ful"] .
    "," .
    $_SESSION["id_emp"] .
    ")";
  $db->query($query3);
}
function update_self_prim_id($postdata, $primary, $xcrud)
{
  $id = $_SESSION["id_exe"];

  // $xcrud->query(
  //   "UPDATE fd_execution_costs SET id_execution = " .
  //     $id .
  //     "WHERE id=" .
  //     $primary
  // );
}
function publish_action($xcrud)
{
  if ($xcrud->get("primary")) {
    $db = Xcrud_db::get_instance();
    $query =
      'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' .
      (int) $xcrud->get("primary");
    $db->query($query);
  }
}

function get_pages()
{
  foreach (new DirectoryIterator(__DIR__) as $file) {
    if ($file->isFile()) {
      print $file->getFilename() . "\n";
    }
  }
}

function bulk_delete($xcrud)
{
  //print_r($xcrud.selected);
  $selected = $xcrud->get("selected");
  $table = $xcrud->get("table");
  $identifier = $xcrud->get("identifier");
  $cnt = count($selected);

  $insertString = "";
  $count = 0;
  foreach ($selected as $value) {
    $count++;
    if ($count == 1) {
      $insertString .= $value;
    } else {
      $insertString .= "," . $value;
    }
  }

  $db = Xcrud_db::get_instance();
  $query = "DELETE from $table WHERE $identifier IN ($insertString)";
  //echo $query;
  $db->query($query);

  $xcrud->set_exception(
    "Bulk Delete",
    "You have Deleted " . $cnt . " items",
    "error"
  );
  //$xcrud->set_exception('You have deleted ' . $cnt . ' items', 'error');
}

function unpublish_action($xcrud)
{
  if ($xcrud->get("primary")) {
    $db = Xcrud_db::get_instance();
    $query =
      'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' .
      (int) $xcrud->get("primary");
    $db->query($query);
  }
}

function exception_example($postdata, $primary, $xcrud)
{
  // get random field from $postdata
  $postdata_prepared = array_keys($postdata->to_array());
  shuffle($postdata_prepared);
  $random_field = array_shift($postdata_prepared);
  // set error message
  $xcrud->set_exception($random_field, "This is a test error", "error");
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
  return $value . " - nice!";
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
  $ext = trim(strtolower(strrchr($file_name, ".")), ".");
  if ($ext != "pdf" && $field == "uploads.simple_upload") {
    unlink($file_path);
    $xcrud->set_exception("simple_upload", "This is not PDF", "error");
  }
}

function movetop($xcrud)
{
  if ($xcrud->get("primary") !== false) {
    $primary = (int) $xcrud->get("primary");
    $db = Xcrud_db::get_instance();
    $query =
      "SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`";
    $db->query($query);
    $result = $db->result();
    $count = count($result);

    $sort = [];
    foreach ($result as $key => $item) {
      if ($item["officeCode"] == $primary && $key != 0) {
        array_splice($result, $key - 1, 0, [$item]);
        unset($result[$key + 1]);
        break;
      }
    }

    foreach ($result as $key => $item) {
      $query =
        "UPDATE `offices` SET `ordering` = " .
        $key .
        " WHERE officeCode = " .
        $item["officeCode"];
      $db->query($query);
    }
  }
}
function movebottom($xcrud)
{
  if ($xcrud->get("primary") !== false) {
    $primary = (int) $xcrud->get("primary");
    $db = Xcrud_db::get_instance();
    $query =
      "SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`";
    $db->query($query);
    $result = $db->result();
    $count = count($result);

    $sort = [];
    foreach ($result as $key => $item) {
      if ($item["officeCode"] == $primary && $key != $count - 1) {
        unset($result[$key]);
        array_splice($result, $key + 1, 0, [$item]);
        break;
      }
    }

    foreach ($result as $key => $item) {
      $query =
        "UPDATE `offices` SET `ordering` = " .
        $key .
        " WHERE officeCode = " .
        $item["officeCode"];
      $db->query($query);
    }
  }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
  $result = "";
  if ($value == "1") {
    $result = '<i class="fa fa-check" />' . "OK";
  } elseif ($value == "2") {
    $result = '<i class="fa fa-circle-o" />' . "Pending";
  }
  return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
  return '<input type="text" readonly class="xcrud-input" name="' .
    $xcrud->fieldname_encode($fieldname) .
    '" value="' .
    $value .
    '" />';
}
function unset_val($postdata)
{
  $postdata->del("Paid");
}

function format_phone($new_phone)
{
  $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

  if (strlen($new_phone) == 7) {
    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
  } elseif (strlen($new_phone) == 10) {
    return preg_replace(
      "/([0-9]{3})([0-9]{3})([0-9]{4})/",
      "($1) $2-$3",
      $new_phone
    );
  } else {
    return $new_phone;
  }
}

function before_list_example($list, $xcrud)
{
  var_dump($list);
}

function after_update_test($pd, $pm, $xc)
{
  $xc->search = 0;
}

/*function after_upload_test($field, &$filename, $file_path, $upload_config, $this)
{
    $filename = 'bla-bla-bla';
}*/
