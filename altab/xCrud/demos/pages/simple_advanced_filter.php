<?php
	$xcrud = Xcrud::get_instance();	
	$xcrud->table("payments");
	$xcrud->label("customerNumber","Customer Number");
	$xcrud->label("paymentDate","Payment Date");
	
	//1st Param: whether to show or hide advanced search button
	//2nd Param: Position to show advanced panel. Can be top, bottom, right or left
	//3rd Param: Makes the advanced panel either opened or closed on window load
	$xcrud->advanced_search_active(true,'left',true); 
	

	//1st Param: Sequence of field arrangement. Start with 1
	//2nd Param: Field Name
	//3rd Param: Operator can be "<",">","=","IN","LIKE"
	//4th Param: Search Column Title
	$xcrud->advanced_filter(1,"amount",">","Amount Greater Than");

	$xcrud->advanced_filter(2,"amount","<","Amount Less Than");
	$xcrud->advanced_filter(3,"paymentDate",">", "Payment date greater than ");
	$xcrud->advanced_filter(4,"checkNumber","LIKE", "Check Number Like ");

	echo $xcrud->render();	

?>

