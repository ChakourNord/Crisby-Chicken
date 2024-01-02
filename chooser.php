<?php
header("location: xCrud\PHP\TEST.php");
include "includes/utils.php";
// print_r(checkToken($arr = explode(",", $_COOKIE["ruolo"])));
// $array = [
//   "allowed" => 1,
//   "id_user" => 891,
//   "id_company" => 28,
//   "name" => "Demo1",
//   "surname" => "Demo1",
//   "photo_url" => "profile_1.png",
//   "username" => "demo1",
//   "db_name" => "checklist_xcrud",
//   "roles" => ["SUPERADMIN", "DRIVER"],
// ];

// echo "<br>";
// echo "superadmidn->" . checkToken(["SUPERADMIN"])["allowed"] . "<BR>";
// echo "admin->" . checkToken(["ADMIN"])["allowed"] . "<BR>";
// echo "id_user->" . checkToken()["id_user"] . "<BR>";
// echo "id_company->" . checkToken()["id_company"] . "<BR>";
// echo "dbname->" . checkToken()["db_name"] . "<BR>";
// print_r($_COOKIE["token"] . "<br>");
// print_r($_COOKIE["ruolo"] . "<br>");

// echo "ok";
// exit();
if (!$_COOKIE["tokenaudit"]) {
  if (checkToken()["id_user"] < 1) {
    header("location: login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- SBADMIN -->
    <link href="resources/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- BOOTSTRAP 4-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">-->

    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DROPIFY -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha256-AWdeVMUYtwLH09F6ZHxNgvJI37p+te8hJuSMo44NVm0=" crossorigin="anonymous" />

    <!-- EXTRA CSS-->
    <link rel="stylesheet" href="resources/css/extra.css">
    <link rel="stylesheet" href="resources/css/float-label.css">
    <link rel="stylesheet" href="resources/css/table.css">

    <title>Interventi</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: <?php echo $_COOKIE[
      "background_color"
    ]; ?>;">
        <a class="navbar-brand" href="#">
            <img src="<?php echo "../uploads/companies_photos/company_" .
              $_COOKIE["id_company"] .
              "/" .
              $_COOKIE["logoaudit"]; ?>" style="height: 48px; width:auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"
                style="background-image: url(https://static.thenounproject.com/png/658625-200.png);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active menu-item">
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active menu-item">
                    <a class="nav-link" href="logout.php" style="color:<?php echo $_COOKIE[
                      "foreground_color"
                    ]; ?>;">
                        <i class="fas fa-power-off"></i> Esci
                    </a>
                </li>
            </ul>

        </div>
    </nav>
    <br>

    <div class="form-signin-nomax" style="margin-top:12.5%;">
        <div class="row justify-content-md-center" style="max-width: 100%;">

            <!--<div class="col-md-2">
            <a href="javascript:showModal();"><img src="resources/images/just-send-it.png" class="selecter"></a>
        </div>-->
            <?php
            //echo (strpos($_COOKIE['ruolo'], 'pippo'));
            //print_r ($_COOKIE['ruolo']);
            if (strpos($_COOKIE["ruolo"], "AUDITOR") !== false) {
              echo '<div class="col-md-2">
				<a href="xCrud\PHP\TEST.php" target="_self"><img src="resources/images/checklist.png" class="selecter"></a>
			</div>';
            } else {
              echo '<div class="col-md-2">
				<a href="#" target="_self"><img src="resources/images/checklist-greyscale.png" class="selecter"></a>
			</div>';
            }
            if (
              strpos($_COOKIE["ruolo"], "SUPERADMIN") !== false or
              strpos($_COOKIE["ruolo"], "ADMIN") !== false
            ) {
              echo '<div class="col-md-2">
				<a href="xCrud\PHP\TEST.php" target="_self"><img src="resources/images/admin.png" class="selecter"></a>
			</div>';
            } else {
              echo '<div class="col-md-2">
				<a href="#" target="_self"><img src="resources/images/admin-greyscale.png" class="selecter"></a>
			</div>';
            }
            ?>
            <!--<div class="col-md-2">
            <a href="../adempimenti/panel/dashboard.php" target="_blank"><img src="resources/images/fullfillments.png" class="selecter"></a>
        </div>

        <div class="col-md-2" id="audit-btn">
            <a href="../audit/admin/login.php" target="_blank"><img src="resources/images/audit.png" class="selecter"></a>
        </div>-->
        </div>
    </div>

    <div class="modal fade" id="jsi-details" tabindex="-1" role="dialog" aria-labelledby="details-label"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jsi-label">Seleziona una Società</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="companies-list">
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP 4-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>

    <!-- Sweet Alerts js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- DROPIFY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"
        integrity="sha256-P5JJalvXVqr2UQErk/T/z6meVgxY7ofmixNKfZbkHrA=" crossorigin="anonymous"></script>

    <!-- EXTRA JS-->
    <script src="resources/js/extra.js"></script>
    <!--<script src="resources/js/chooser.js"></script>-->
</body>

</html>