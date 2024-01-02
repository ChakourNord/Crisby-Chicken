

<?php
include "../../includes/utils.php";
if (!$_COOKIE["tokenaudit"]) {
  if (checkToken()["id_user"] < 1) {
    header("location: ../../login.php");
  }
}
session_start();

require_once "../../includes/utils.php";
require_once "../../includes/database.php";
//select file for stats
$input = $_POST;
//print_r ($input);
$db_dsn = "mysql:host=" . $db_server . ";dbname=workerdb;charset=utf8";

$conn = new PDO($db_dsn, $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function execute_queries($conn, $queries)
{
  $data = [];
  foreach ($queries as $query) {
    $result = $conn->query($query);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      // Access data using column names
      foreach ($row as $key => $value) {
        $data[$key][] = $value;
      }
    }
  }
  return $data;
}
$queries = [
  "SELECT count(id) as user FROM users",
  "SELECT COUNT(*) as exe
    FROM fd_executions
    JOIN fd_fulfillments ful ON fd_executions.id_fulfillment = ful.id
    JOIN fd_fulfillment_types type ON ful.id_fulfillment_type = type.id
    JOIN filiali fil ON ful.id_filiale = fil.id_fil
    JOIN companies com ON fil.company_id_number = com.company_id_number
    JOIN fd_referents re ON ful.id = re.id_fulfillment
    JOIN employees emp ON re.id_employee = emp.id
    WHERE fd_executions.is_active = 1;",
  "SELECT count(id) as employee FROM employees",
  "SELECT count(id) as fil FROM filiali",
  "SELECT count(id) as types FROM fd_fulfillment_types",
];

$data = execute_queries($conn, $queries);

echo custom_json_encode($data);

// echo custom_json_encode([
//   "user" => $data,
//   "exe" => $data2,
//   "employee" => $data3,
//   "filiale" => $data4,
// ]);

