<pre class="pre-scrollable">

<?php switch($code ?? ''): ?>
<?php case 'base_field_types': ?>
public function base_field_types()
{
  $xcrud = get_xcrud();
  $xcrud->table('base_fields');
  $xcrud->no_editor('text_area');
  
  $data['content'] = $xcrud->render('create');
  
  $this->load-> view('demos', $data);
}
<?php break; ?>




<?php case 'bulk_delete': ?>
public function bulk_delete()
{
  $xcrud = get_xcrud();
  $xcrud->table('million');
  $xcrud->limit_list('20,50,100,1000'); // do not use 'all' for large tables
  $xcrud->bulk_select_position('left'); //It can be 'left' or 'right'
  //$xcrud->set_bulk_select(false);
  $xcrud->set_bulk_select(false,'cd_key','=','EBGC57SXM-VW47I6AF-401X7DYM');//Dont be able to select records with ID 287846
  $xcrud->unset_remove(true,'cd_key','=','EBGC57SXM-VW47I6AF-401X7DYM');
  $xcrud->create_action('bulk_delete', 'bulk_delete'); // action callback, function publish_action() in functions.php
  echo $xcrud->render();
  
  $data['content'] = $xcrud->render();
  
  //this line loads the &lt;button&gt; and &lt;script&gt; below it from a view
  $data['script'] = $this-&gt;load-&gt;view('scripts', 'bulk_delete', true);
  
  &lt;button class="btn btn-primary" onclick="deleteItems();"&gt;Delete Selected&lt;/button&gt;
  
  &lt;script&gt;
  function deleteItems(){
    var r = confirm("Confirm deletion of " + items.length + " items.");
    if (r == true) {
    Xcrud.request('.xcrud-ajax',Xcrud.list_data('.xcrud-ajax',{action: 'bulk_delete',   task:'action',selected:items,table:'million',identifier:'id'}))
      items = [];
    }       
  }
  &lt;/script&gt;
    
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'buttons_panel': ?>
public function buttons_panel()
{
  $xcrud = get_xcrud();
  $xcrud->table('offices');
  $xcrud->buttons_position('left'); // can be left, right or none
  
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'ckeditor_and_custom': ?>
public function ckeditor_and_custom()
{
  $xcrud = get_xcrud();
  Xcrud_config::$editor_url = base_url('assets/vendor/editors/ckeditor/ckeditor.js'); // can be set in config
  $xcrud->table('orders');
  $xcrud->change_type('status','select','','On Hold,In Process,Resolved,Shipped,Disputed,Cancelled');
  $xcrud->change_type('orderDate','none');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'column_width_cut': ?>
public function column_width_cut()
{
  $xcrud = get_xcrud();
  $xcrud->table('productlines');
  $xcrud->columns('productLine,textDescription');
  $xcrud->column_width('textDescription','80%');
  $xcrud->column_cut(250,'textDescription');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'columns_and_fields': ?>
public function columns_and_fields()
{
  $xcrud = get_xcrud();
  $xcrud->table('customers');
  $xcrud->columns('customerName,phone,city,country'); // columns in grid
  $xcrud->fields('customerName,creditLimit,salesRepEmployeeNumber'); // fields in details
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'dependent_dropdowns': ?>
public function dependent_dropdowns()
{
  $xcrud = get_xcrud();
  $xcrud->table('consultation');
  $xcrud->relation('office','offices','officeCode','city');
  $xcrud->relation('manager','employees','employeeNumber',array('firstName','lastName'),'','','',' ','','officeCode','office');
  
  $xcrud->relation('country','meta_location','id','local_name','type = \'CO\'');
  $xcrud->relation('region','meta_location','id','local_name','type = \'RE\'','','','','','in_location','country');
  $xcrud->relation('city','meta_location','id','local_name','type = \'CI\'','','','','','in_location','region');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'edit_modal': ?>
public function edit_modal()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud->is_edit_modal(true);
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'edit_side_panel': ?>
public function edit_side_panel()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud ->is_edit_side(true);
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'field_grouping': ?>
public function field_grouping()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud->unset_remove();
  $xcrud->group_by_columns('customerNumber');//Allows only one field
  $xcrud->group_sum_columns('amount');//Allows only one field
  $xcrud->columns('customerNumber,checkNumber,amount');
  $xcrud->fields_inline('customerNumber,checkNumber,paymentDate,amount');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'gallery': ?>
public function gallery()
{
  $xcrud = get_xcrud();
  $xcrud->table('gallery');
  $xcrud->change_type('image', 'image', false, array(
  'width' => 450,
  'path' => realpath(FCPATH . 'assets/uploads/gallery'),
  'thumbs' => array(array(
    'height' => 55,
    'width' => 120,
    'crop' => true,
    'marker' => '_th'))));
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'grid_tricks': ?>
public function grid_tricks()
{
  $xcrud = get_xcrud();
  $xcrud->table('customers');
  $xcrud->columns('customerName,city');
  $xcrud->hide_button('edit');
  $xcrud->unset_view();
  $xcrud->column_pattern('customerName', '&lt;a href="#" class="xcrud-action" data-task="edit" data-primary="{customerNumber}"&gt;{value}&lt;/a&gt;');
  $xcrud->column_width('city','20%');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'grouping_form_fields': ?>
public function grouping_form_fields()
{
  $xcrud = get_xcrud();
  $xcrud->table('employees');
  $xcrud->table_name('Employees Form fields grouped ');
  $xcrud->validation_required('lastName',2)->validation_required('firstName',2)->validation_required('jobTitle');
  $xcrud->validation_required('email');
  $xcrud->validation_pattern('email','email')->validation_pattern('extension','alpha_numeric')->validation_pattern('officeCode','natural');
  $xcrud->relation('officeCode','offices','officeCode','city');
  $xcrud->limit(10);
  
  //Fields arrangement
  $xcrud->fields_arrange('firstName,lastName,extension','Group 1-Names',true); //First row - {fields,group name,show/hide group name}
  $xcrud->fields_arrange('email','Group 2 - Contacts',true); //Second row
  $xcrud->fields_arrange('officeCode,reportsTo','Group 3 - Location',true); //Third row
  $xcrud->fields_arrange('jobTitle','Group 4 - Position',true); //Fourth row
  
  $xcrud->fields_inline('lastName,firstName,extension,email,jobTitle,officeCode,reportsTo');//set the fields to allow inline editing
  $xcrud->inline_edit_save('enter_only');// Can be 'enter_only' or 'button_only'  or 'enter_button_only'
  
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'highlights': ?>
public function highlights ()
{
  $xcrud = get_xcrud();
  $xcrud->table('orderdetails');
  $xcrud->highlight('quantityOrdered', '<', 25, 'red');
  $xcrud->highlight('quantityOrdered', '>=', 25, 'yellow');
  $xcrud->highlight('quantityOrdered', '>', 40, '#8DED79');
  $xcrud->highlight_row('quantityOrdered', '>=', 50, '#8DED79');
  $xcrud->highlight('priceEach', '>', 100, '#9ADAFF');     
  $xcrud->modal(array('quantityOrdered'=>'glyphicon glyphicon-search'));
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'inline_editing': ?>
public function inline_editing()
{
  $xcrud = get_xcrud();
  $xcrud->table_name('Payments - Single click cell to edit!');
  $xcrud->table('payments');
  $xcrud->unset_remove();
  $xcrud->fields_inline('customerNumber,checkNumber,paymentDate,amount');//set the fields to allow inline editing
  $xcrud->unset_edit();
  $xcrud->set_logging(true);
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'labels_and_classes': ?>
public function labels_and_classes()
{
  $xcrud = get_xcrud();
  $xcrud->table('employees');
  $xcrud->label('lastName','Surname');
  $xcrud->label('firstName','Name');
  $xcrud->label('officeCode','Office code')->label('reportsTo','Reports to')->label('jobTitle','Job title');
  $xcrud->column_name('firstName', 'NaMe!'); // only column renaming
  $xcrud->column_class('extension','align-center font-bold'); // any classname
  // predefined classnames: align-left, align-right, align-center, font-bold, font-italic, text-underline
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'modal_and_buttons': ?>
public function modal_and_buttons()
{
  $xcrud = get_xcrud();
  $xcrud->table('gallery');
  $xcrud->modal('image,description');
  $xcrud->change_type('image', 'image', false, array(
    'width' => 450,
    'path' => realpath(FCPATH . 'assets/uploads/gallery'),
    'thumbs' => array(array(
    'height' => 55,
    'width' => 120,
    'crop' => true,
    'marker' => '_th'))));
  $xcrud->button('#bootstrap', 'bootstrap theme');
  $xcrud->button('#default', 'default theme');
  
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'multiple_instances': ?>
public function multiple_instances()
{
  $xcrud1 = get_xcrud();
  $xcrud1->table('orders');
   
  $xcrud2 = get_xcrud();
  $xcrud2->table('payments');
  
  $data['content'] = $xcrud1->render();
  $data['content'] .= $xcrud2->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'nested_tables': ?>
public function nested_tables()
{
  $xcrud = get_xcrud();
  $xcrud->table('orders');
  $xcrud->default_tab('Order info');
  
  $orderdetails = $xcrud->nested_table('Order details','orderNumber','orderdetails','orderNumber'); // 2nd level
  $orderdetails->columns('productCode,quantityOrdered,priceEach');
  $orderdetails->fields('productCode,quantityOrdered,priceEach');
  $orderdetails->default_tab('Detail information');
  
  $customers = $xcrud->nested_table('Customers','customerNumber','customers','customerNumber'); // 2nd level 2
  $customers->columns('customerName,city,country');
  
  $products = $orderdetails->nested_table('Products','productCode','products','productCode'); // 3rd level
  $products->default_tab('Product details');
  
  $productLines = $products->nested_table('Product Lines','productLine','productlines','productLine'); // 4th level
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'nested_tables_in_tabs': ?>
public function nested_tables_in_tabs()
{
  $xcrud = get_xcrud();
  $xcrud->table('orders');
  $xcrud->default_tab('Order info');
  
  $orderdetails = $xcrud->nested_table('Order details','orderNumber','orderdetails','orderNumber'); // 2nd level
  $orderdetails->columns('productCode,quantityOrdered,priceEach');
  $orderdetails->fields('productCode,quantityOrdered,priceEach');
  $orderdetails->default_tab('Detail information');
  
  $customers = $xcrud->nested_table('Customers','customerNumber','customers','customerNumber'); // 2nd level 2
  $customers->columns('customerName,city,country');
  
  $products = $orderdetails->nested_table('Products','productCode','products','productCode'); // 3rd level
  $products->default_tab('Product details');
  
  $productLines = $products->nested_table('Product Lines','productLine','productlines','productLine'); // 4th level
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'one_million_rows': ?>
public function one_million_rows()
{
  $xcrud = get_xcrud();
  $xcrud->table('million');
  $xcrud->limit_list('20,50,100,1000'); // do not use 'all' for large tables
  $xcrud->benchmark(); // lets see performance
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'parsley_validation': ?>
public function parsley_validation()
{
  $xcrud = get_xcrud();
  $xcrud->table('employees');
  $xcrud->set_attr('lastName',array('id'=>'user','data-role'=>'admin')); 
  //Activate parslet validation
  $xcrud->parsley_active(true);
  //Make extension mandatory
  $xcrud->set_attr('extension',array('required'=>'required'));
  //Ensure First Name is alpha numeric    
  $xcrud->set_attr('firstName',array('data-parsley-trigger'=>'change','required'=>'required','id'=>'user','data-parsley-type'=>'alphanum'));
  $xcrud->set_attr('lastName',array('data-parsley-trigger'=>'change','required'=>'required','id'=>'user','data-parsley-type'=>'alphanum'));
  //ensure valid email and display "Email not valid"
  $xcrud->set_attr('email',array('data-parsley-trigger'=>'change','id'=>'user','data-parsley-type'=>'email',
  'data-parsley-error-message'=>"Email not valid"));   
  //ensure office Code is between 3 and 5 number characters
  $xcrud->set_attr('officeCode',array('id'=>'user','data-parsley-type'=>'digits','data-parsley-length'=>"[3,5]"));  
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'simple_validation': ?>
public function simple_validation()
{
  $xcrud = get_xcrud();
  $xcrud->table('employees');
  $xcrud->validation_required('lastName',2)->validation_required('firstName',2)->validation_required('jobTitle');
  $xcrud->validation_required('email');
  $xcrud->validation_pattern('email','email')->validation_pattern('extension','alpha_numeric')->validation_pattern('officeCode','natural');
  $xcrud->limit(10);
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'subselect_and_sum_row': ?>
public function subselect_and_sum_row()
{
  $xcrud = get_xcrud();
  $xcrud->table('customers');
  $xcrud->columns('customerName,city,creditLimit,Paid,Profit'); // specify only some columns
  $xcrud->subselect('Paid','SELECT SUM(amount) FROM payments WHERE customerNumber = {customerNumber}'); // other table
  $xcrud->subselect('Profit','{Paid}-{creditLimit}'); // current table
  $xcrud->sum('creditLimit,Paid,Profit'); // sum row(), receives data from full table (ignores pagination)
  $xcrud->change_type('Profit','price','0',array('prefix'=>'$')); // number format
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'table_join': ?>
public function table_join()
{
  $xcrud = get_xcrud();
  $xcrud->table('employees');
  $xcrud->join('officeCode','offices','officeCode'); // ... INNER JOIN offices ON employees.officeCode = offices.officeCode ...
  
  //this line loads the &lt;script&gt; below it from a view
  $data['script'] = $this-&gt;load-&gt;view('scripts', 'table_join', true);
  
  &lt;script&gt;
      $(document).ready(function() {
          $(".xcrud-list").tableHeadFixer({"head" : false, "left" : 2}); 
      });
  &lt;/script&gt;
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'tabs': ?>
public function tabs()
{
  $xcrud = get_xcrud();
  $xcrud->table('customers');
  $xcrud->fields('customerName,contactLastName,contactFirstName,phone', false, 'Contact');
  $xcrud->fields('addressLine1,addressLine2,city,state,postalCode,country', false, 'Address');
  $xcrud->fields('customerNumber,salesRepEmployeeNumber,creditLimit', false, 'Finance');
    
  $data['content'] = $xcrud->render('edit', 148); // edit screen with primary id = 148
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'tabulator_simple': ?>
public function tabulator_simple()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud->label('checkNumber','Check No');
  $xcrud->label('paymentDate','Payment Date');
  $xcrud->label('customerNumber','Customer Number');
  $xcrud->label('amount','Amount');
  $xcrud->columns('paymentDate,customerNumber,checkNumber,amount');
  $xcrud->column_width('checkNumber','35%');
  $xcrud->column_width('paymentDate','25%');
  $xcrud->column_width('action','30%');
  
  $xcrud->tabulator_active(true);
  $xcrud->tabulator_main_properties('
    movableColumns: true,
    headerVisible:true,
    width: "100%",
    height: "400px",
    groupStartOpen:true,
    placeholder:"No Data Available",
    tooltipsHeader:true,
    tooltips:true'); //'layout: "fitColumns",
  
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'tabulator_grouping_level_2': ?>
public function tabulator_grouping_level_2()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud->label('checkNumber','Check No');
  $xcrud->label('paymentDate','Payment Date');
  $xcrud->label('customerNumber','Customer Number');
  $xcrud->label('amount','Amount');
  $xcrud->columns('paymentDate,customerNumber,checkNumber,amount');
  $xcrud->column_width('checkNumber','35%');
  $xcrud->column_width('paymentDate','25%');
  $xcrud->column_width('action','30%');
  
  //$xcrud->column_width('action','25%');  
  //$xcrud->column_tabulator_properties('amount','responsiveLayout:"collapse",align:"right",sorter:"date",editable:true,formatter:"star", formatterParams:{color:["#00dd00", "orange", "rgb(255,0,0)"]}');
  $xcrud->tabulator_column_properties('checkNumber','editor:input');
  //$xcrud->tabulator_column_properties('amount','responsiveLayout:"collapse",align:"right",frozen:true,editor:"input", editor:true');
  $xcrud->tabulator_active(true);
  //groupBy:["customerNumber","paymentDate"]
  $xcrud->tabulator_main_properties('responsiveLayout:"collapse",
    movableColumns: true,
    headerVisible:true,
    width: "100%",
    height: "400px",
    groupStartOpen:true,
    placeholder:"No Data Available",
    tooltipsHeader:true,
    tooltips:true,
    groupBy:["customerNumber","paymentDate"]'); //'layout: "fitColumns",
  
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'tooltips': ?>
public function tooltips()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $xcrud->table_name('This is table name!','And this is table tooltip... And tested chars: ö,ü,ß');
  $xcrud->field_tooltip('checkNumber', 'Wow, check number? Really?');
  $xcrud->column_tooltip('customerNumber', 'Yeah! Column tooltip!');
    
  $data['content'] = $xcrud->render();
  
  $this->load->view('demos', $data);
}
<?php break; ?>




<?php case 'uploads': ?>
public function uploads()
{
  //remember to set the path to your uploads folder in xcrud_config.php
  //in relation to xcrud_config.php
  //public static $upload_folder_def = '../../uploads';

  $xcrud = get_xcrud();
  $xcrud->table('uploads');
  
  // simple file upload
  $xcrud->change_type('simple_upload', 'file', '', array('not_rename'=>true));
  
  // simple image upload
  $xcrud->change_type('simple_image', 'image');
  
  // image upload with resizing
  $xcrud->change_type('auto_resize', 'image', '', array('width' => 200, 'height' => 200));
  
  // image upload with resizing
  $xcrud->change_type('auto_crop', 'image', '', array(
  'width' => 200,
  'height' => 200,
  'crop' => true));
  
  // image upload with manual crop
  $xcrud->change_type('manual_crop', 'image', '', array('manual_crop' => true));
  
  // image upload with manual crop and resizing
  $xcrud->change_type('manual_crop_2', 'image', '', array(
  'width' => 200,
  'height' => 200,
  'manual_crop' => true));
  
  // image upload with manual crop and fixed ratio
  $xcrud->change_type('manual_crop_3', 'image', '', array('ratio' => 0.5, 'manual_crop' => true));
  
  // image upload with watermark
  $xcrud->change_type('watermark', 'image', '', array('width' => 400, 'watermark' => '../demos/assets/xCRUD.png'));
  
  // image upload with watermark position (%-left, %-top)
  $xcrud->change_type('watermark_position', 'image', '', array('watermark' => '../demos/assets/xCRUD.png',
  'watermark_position' => array(10, 95)));
  
  // image upload with thumbs
  $xcrud->change_type('image_with_thumbs', 'image', '', array('thumbs' => 
  array(
  array(
    'width' => '300',
    'marker' => '_th',
    'watermark' => '../demos/assets/xCRUD.png'), 
  array(
    'width' => 100,
    'height' => 100,
    'crop' => true,
    'folder' => 'thumbs')
  )));
  
  $data['content'] = $xcrud->render('edit', 14);
  
  $this->load->view('demos', $data);
}
<?php break; ?>



<?php default: ?>
public function demos()
{
  $xcrud = get_xcrud();
  $xcrud->table('payments');
  $data['content'] = $xcrud->render();
  $this->load->view('demos', $data);
}
<?php endswitch; ?>

</pre>