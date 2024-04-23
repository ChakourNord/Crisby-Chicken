<?php

    include('xcrud/xcrud.php');

    Xcrud_config::$theme = 'bootstrap5';
    Xcrud_config::$load_bootstrap5 = true;
    Xcrud_config::$load_bootstrap4 = false;
    Xcrud_config::$load_bootstrap = false;
        
    $xcrud = Xcrud::get_instance();	
	$xcrud->table('payments');
    $xcrud->is_edit_modal(true);	
	echo $xcrud->render();


    $xcrud2 = Xcrud::get_instance();	
	$xcrud2->table('payments');
    $xcrud2->is_edit_modal(true);	
	echo $xcrud2->render();
		
?>
