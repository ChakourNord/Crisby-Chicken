<?php

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])) {
  exit();
}

$config = "proj_altab";

switch ($config) {
  case "proj_altab":
    $db_server = "127.0.0.1";
    $db_username = "blackstar";
    $db_password = "Mim922145?";
    break;
  case "DEV_XAMPP":
    $db_server = "127.0.0.1";
    $db_username = "checklis_root";
    $db_password = "_Fr1ng3_";

    break;
  case "PRODUCTION":
    $db_server = "127.0.0.1";
    $db_username = "checklis_root";
    $db_password = "_Fr1ng3_";
    break;
}
