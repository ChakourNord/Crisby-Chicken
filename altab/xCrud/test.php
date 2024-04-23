<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="schede-maltrattate.php">
            <img src="./assets/img/artemisia.png" height="50" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collape" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
//if (isset($_SESSION['user_auth']) && $_SESSION['user_auth'] == 1) { <?php echo ($page == 'utenti' ? ' active' : '')
?>

                <li class="nav-item">
                    <a class="nav-link" href="utenti.php">
                        <i class="fas fa-users"></i> USERS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schede-maltrattate.php">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="scheda-persona-crud.php">
                        <i class="fas fa-id-card"></i> Schede Persone
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistiche.php">
                        <i class="fas fa-chart-pie"></i> Statistiche
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <?php
        include "../xCrud/xcrud/xcrud.php";
        $xcrud = Xcrud::get_instance();
        $xcrud->table("fd_executions")->table_name("fulfilments");
        $xcrud
          ->unset_add()
          ->unset_edit()
          ->unset_remove();
        // $xcrud->group_by_columns("emp.id");
        //$xcrud->limit(7);
        $xcrud
          ->join("id_fulfillment", "fd_fulfillments", "id", "ful")
          ->join(
            "ful.id_fulfillment_type",
            "fd_fulfillment_types",
            "id",
            "type"
          )
          ->join("ful.id_filiale", "filiali", "id_fil", "fil")
          ->join(
            "fil.company_id_number",
            "companies",
            "company_id_number",
            "com"
          )
          ->join("ful.id", "fd_referents", "id_fulfillment", "re")
          ->join("re.id_employee", "employees", "id", "emp");
        $xcrud
          ->relation("emp.id", "employees", "id", ["name", "surname"])
          ->label("emp.id", "name");
        $xcrud
          ->relation("type.id", "fd_fulfillment_types", "id", "name")
          ->label("type.id", "Fulfillment");
        $xcrud->tabulator_active(true);
        $xcrud->tabulator_main_properties('responsiveLayout:"collapse",
                                      movableColumns: true,
                                      headerVisible:true,
                                      width: "100%",
                                      height: "400px",
                                      groupStartOpen:true,
                                      groupClosedShowCalcs:true,
                                      placeholder:"No Data Available",
                                      tooltipsHeader:true,
                                      tooltips:true,
                                      groupBy:["company"]'); //'layout: "fitColumns",

        $xcrud->columns("ful.id,com.company,emp.id,type.id,fil.des_fil");
        $xcrud ->

        //$xcrud->columns("c.company,fil.name,id_fulfillments");
        echo $xcrud->render();
        ?>
    </div>
</body>


</html>