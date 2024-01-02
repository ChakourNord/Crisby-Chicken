<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- SBADMIN -->
    <link href="resources/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- BOOTSTRAP 4-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">-->

    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- EXTRA CSS-->
    <link rel="stylesheet" href="resources/css/login.css">
    <link rel="stylesheet" href="resources/css/extra.css">
    <link rel="stylesheet" href="resources/css/float-label.css">

    <title>Login </title>
</head>
<body>
<div class="form-signin">
    <div class="row justify-content-md-center">
        <img src="resources/images/logo.png" alt="Logo" style="margin:auto">
    </div>
    <br>

    <div class="form-group has-float-label input-login">
        <input class="form-control no-shadow" id="login-email" type="text" placeholder="Email" required>
        <label for="login-email" class="label-into">Email</label>
    </div>

    <div class="form-group has-float-label input-login">
        <input class="form-control no-shadow" id="login-password" type="password" placeholder="Password" required>
        <label for="login-password" class="label-into">Password</label>
    </div>

    <button class="btn btn-dark btn-block" id="login-button" style="margin:auto; width:50%;">
        <i class="fas fa-sign-in-alt"></i> Accedi
    </button>

    <div class="row justify-content-md-center">
        <p class="mt-5 mb-3 text-muted"></p>
    </div>
</div>

<!-- BOOTSTRAP 4-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<!-- Sweet Alerts js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- EXTRA JS-->
<script src="resources/js/extra.js"></script>
<script src="resources/js/login.js"></script>
</body>
</html>