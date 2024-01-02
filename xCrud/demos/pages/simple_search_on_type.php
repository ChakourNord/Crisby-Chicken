<?php

	$xcrud = Xcrud::get_instance();	
    Xcrud_config::$search_on_typing = true;
	$xcrud->table("payments");
	echo $xcrud->render();	
    
?>
