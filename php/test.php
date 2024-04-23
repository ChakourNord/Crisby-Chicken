<?php
include "conn.php";
include "includes/utils.php";
if(isset($_COOKIE["tokenaudit"])){
if ($_COOKIE["tokenaudit"]) {
  if (checkToken()["allowed"] = false) {
    header("location: index.php");
  } else if (!$_COOKIE["tokenaudit"]) {
    header("location: index.php");
  }
}}else{header("location: index.php");} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>wer diese</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <!-- <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown button
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        <?php

        // include "conn.php";
        // $sql_a = "SELECT * FROM auto";
        // $stid_a = oci_parse($conn, $sql_a);
        // oci_execute($stid_a);
        // while ($auto = oci_fetch_array(
        //   $stid_a,
        //   OCI_ASSOC + OCI_RETURN_NULLS
        // )) :;
        ?>
         <a class="dropdown-item" value="<?php //echo $auto["ID"]; 
                                          // The value we usually set is the primary key
                                          ?>">
            <?php //echo $auto["MODELL"];
            // To show the category name to the user
            ?>
          </a>
        <?php
        //endwhile; 
        ?>

      </div>
    </div> -->
  <form action="test.php" method="post">
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"></span>
      <input type="text" name="auto" class="form-control" placeholder="autoname" aria-label="autoname" aria-describedby="basic-addon1">
    </div>

    <button type="submit" value="Submit" class="btn btn-primary">Base class</button>


  </form>



  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    add Car
  </button>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#termin">
    add termin
  </button>

  <div class="modal fade" id="termin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">termin hinzufügen</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" action="test.php" method="post">
            <div class="col-md-6">
              <label for="marke_iln" class="form-label">termin</label>
              <input type="datetime-local" name="termin_in" class="form-control" id="in_timestamp">
            </div>
            <div class="col-md-6">
              <label for="auto" class="form-label">auto</label>
              <select class="form-select" name="auto_inid" aria-label="Default select example">
                <option selected>auto</option>
                <?php
                $sql = "SELECT id,marke FROM auto";

                $stid = oci_parse($conn, $sql);
                oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                  echo "<option value=" . $row['ID'] . ">\n";
                  echo  $row['MARKE'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="beschreibung" class="form-label">beschreibung</label>
              <input type="textarea" name="beschreibung_in" class="form-control" id="in_beschreibung">
            </div>


            <div class="col-12">
              <button type="submit" class="btn btn-primary">add</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Auto hinzufügen</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" action="test.php" method="post">
            <div class="col-md-6">
              <label for="marke_iln" class="form-label">Marke</label>
              <input type="text" name="marke_in" class="form-control" id="in_autoid">
            </div>
            <div class="col-md-6">
              <label for="modell_iln" class="form-label">Modell</label>
              <input type="text" name="modell_in" class="form-control" id="in_modellid">
            </div>


            <div class="col-12">
              <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<?php

if (isset($_POST['auto_inid']) && isset($_POST['termin_in']) && isset($_POST['beschreibung_in'])) {
  $termin = htmlentities($_POST['termin_in'], ENT_QUOTES);
  $autoid = htmlentities($_POST['auto_inid'], ENT_QUOTES);
  $beschreibung = htmlentities($_POST['beschreibung_in'], ENT_QUOTES);

  $sql = "BEGIN in_termin(:termin, :beschreibung); END;";


  $stid = oci_parse($conn, $sql);
  oci_bind_by_name($stid, ':termin', $termin);
  oci_bind_by_name($stid, ':beschreibung', $beschreibung);
  oci_bind_by_name($stid, ':marke', $marke);


  oci_execute($stid);

  if (!oci_execute($stid)) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }
}
if (isset($_POST['marke_in']) && isset($_POST['modell_in'])) {
  $marke = htmlentities($_POST['marke_in'], ENT_QUOTES);
  $modell = htmlentities($_POST['modell_in'], ENT_QUOTES);


  $sql = "BEGIN in_auto(:marke, :modell); END;";

  $stid = oci_parse($conn, $sql);
  oci_bind_by_name($stid, ':marke', $marke);
  oci_bind_by_name($stid, ':modell', $modell);

  oci_execute($stid);

  if (!oci_execute($stid)) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }
}

if (isset($_POST['auto'])) {
  $autoname = htmlentities($_POST['auto'], ENT_QUOTES);

  $sql = "SELECT * FROM auto where marke = '$autoname'";

  $stid = oci_parse($conn, $sql);
  oci_execute($stid);

  echo "<table border='1'>\n";
  while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
      echo "  <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
  }
  echo "</table>\n";
}
