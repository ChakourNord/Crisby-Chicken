<?php
    phpinfo();
    include('xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('employees');
    echo $xcrud->render();
?>

