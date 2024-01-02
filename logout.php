<?php
require_once "includes/utils.php";
//unset($_COOKIE['token']);
destroyToken();
header("location: login.php");
