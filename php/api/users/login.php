<?php
include  "../../conn.php";
include "../../includes/utils.php";
// include "session_s.php";


header('Content-Type: application/json');
$input = $_POST;
//print_r ($input);

try {
  $params = [];
  $query = 'SELECT
                *
              FROM user_a
              
              WHERE 
               username = :username
              AND pass = :password';
  // if (isset($_GET["autologin"])) {
  //   $params["username"] = $_GET["username"];
  //   $params["password"] = ($_GET["password"]);
  // } else {
  //   $params["username"] = $input["username"];
  //   $params["password"] = ($input["password"]);
  // }

  

  $result = oci_parse($conn, $query);

   
  oci_bind_by_name($result, ':username', $_POST['username'], 100);
  oci_bind_by_name($result, ':password', $_POST['password'] , 100);
  oci_execute($result);
  $username = $_POST['username'];
  $password = $_POST['password'];

if(($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != null){
    if ($row['USERNAME'] == $username && $row['PASS'] == $password) {

      createToken($row);

        echo custom_json_encode([
          "result" => "SUCCESS",
          "message" => "Login Success",
          "link" => "test.php",
        ]);

    } else if (oci_fetch_array($result, OCI_BOTH + OCI_RETURN_NULLS) == null){
      echo custom_json_encode([
        "result" => "ERROR",
        "message" => "Username or password incorrect",
      ]);

    }}
    else if (oci_fetch_array($result, OCI_BOTH + OCI_RETURN_NULLS) == null){
      echo custom_json_encode([
        "result" => "ERROR",
        "message" => "Username or password incorrect",
      ]);

    }
    // if (!$params["username"] = $input["username"] ||
    // !$params["password"] = ($input["password"])) 
    // {
    
    // echo custom_json_encode([
    //   "result" => "ERROR",
    //   "message" => "Username or password incorrect",
    // ]);
  
    // }
  

} catch (Exception $e) {
  echo custom_json_encode([
    "result" => "ERROR",
    "message" => $e->getMessage(),
  ]);
}

 