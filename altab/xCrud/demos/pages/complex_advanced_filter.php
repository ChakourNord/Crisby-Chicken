<?php
    
	$xcrud = Xcrud::get_instance();	
	$xcrud->table("payments");
	$xcrud->label("customerNumber","Customer Number");
	$xcrud->label("paymentDate","Payment Date");
	//$xcrud->change_type("customerNumber","select","",array(1=>"MPESA",2=>"Cash"));
	
	//1st Param: whether to show or hide advanced search button
	//2nd Param: Position to show advanced panel. Can be top, bottom, right or left
	//3rd Param: whether top make adavanced panel always opened or closed
	$xcrud->advanced_search_active(true,'left',true); 
	//
	$xcrud->advanced_filter(1,"customerNumber","IN","Customer Numer In List");
	$xcrud->advanced_filter(2,"amount",">","Amount Greater Than");
	$xcrud->advanced_filter(3,"amount","<","Amount Less Than");
	$xcrud->advanced_filter(4,"paymentDate",">", "Payment date greater than ");
	$xcrud->advanced_filter(5,"checkNumber","LIKE", "Check Number Like ");

	//$xcrud->change_type("amount","checkboxes","",array(10000=>10000,20000=>20000));
	//$xcrud->change_type("customerNumber","textarea");

	$db = Xcrud_db::get_instance();
	$query = 'SELECT * from payments' ;
	$db->query($query);
	$result = $db->result();
	$cnt = 0;
	$array_customer_number = array();
	foreach ($result as $key => $item)
	{      		
		$customerNumber = $item['customerNumber'];
		$array_customer_number[$customerNumber] = $customerNumber;
	}

	$xcrud->change_type("customerNumber","multiselect","",$array_customer_number);
	echo $xcrud->render();	

?>
<link href="../xcrud/plugins/select2-develop/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../xcrud/plugins/select2-develop/dist/js/select2.full.js"></script>
<script type="text/javascript">
$(document).on("xcrudbeforerequest", function(event, container) {
    if (container) {
        try{
            $(container).find("select").select2('destroy');
        }catch(e){

        }
        
    } else {
        try{
            $(".xcrud").find("select").select2('destroy');
        }catch(e){

        }
       
    }
});
$(document).on("ready xcrudafterrequest", function(event, container)
 {
    if (container) {
        try{
            $(container).find("select").select2();
        }catch(e){

        }
       
    } else {
        try{
            $(".xcrud").find("select").select2();
        }catch(e){

        }
    }
});

$(document).on("xcrudbeforedepend", function(event, container, data) {
    console.log(data.name);
    //if (container) {
        console.log(!$.isEmptyObject($(container).find('select[name="' + data.name + '"]')));
        console.log(data.name);
        //if(!$.isEmptyObject($(container).find('select[name="' + data.name + '"]'))){
             if ($(container).find('select[name="' + data.name + '"]').data('select2')) {
                  console.log("select2 item");
                  $(container).find('select[name="' + data.name + '"]').select2('destroy');
             }  else {
                  console.log("Not a select2 ");
             }              
        //}
   // }
});

$(document).on("xcrudafterdepend", function(event, container, data) {
    $(container).find('select[name="' + data.name + '"]').select2();
	
	try{
		$(container).find("select").select2();
	}catch(e){

	}
       
});

$( document ).ready(function() {
	$(".xcrud").find("select").select2();
});
</script>
