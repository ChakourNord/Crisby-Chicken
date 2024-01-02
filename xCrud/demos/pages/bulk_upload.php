<?php

	$xcrud = Xcrud::get_instance();
     $xcrud->table('gallery');
     $xcrud->fields('title,description');
     $xcrud->change_type("description","textarea");

     //Bulk image configuration
     //Param 1; true to activate upload
     //Param 2; Path to store image
     $xcrud->bulk_image_upload_active(true,"gallery1");  
     
     //Param 1; true to allow editing
     $xcrud->bulk_image_upload_edit(false); //Can edit images

     //Param 1; true to allow adding images
     $xcrud->bulk_image_upload_add(false); //Can add images

     //Param 1; true to allow removing images
     $xcrud->bulk_image_upload_remove(false); //Can remove images

     echo $xcrud->render('edit',3);

    
?>