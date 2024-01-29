<?php
    include('xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('base_fields');
    echo $xcrud->render();
?>
