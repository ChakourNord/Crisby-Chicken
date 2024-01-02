<?php
include("../../xcrud/xcrud.php");
$xcrud = Xcrud::get_instance();


$subject = "Loan Application Approved!";
				//$email = "pchieni25@gmail.com";
				$emailBody = "Your Loan application has been approved.  <br>
				           You will receive the loan amount on your MPESA within 24 hors<br><br> 			           
				           Regards<br> 
				           ALHP System App";
$to = $email;
$xcrud->send_email_public($to, $subject, $emailBody, $cc = array(), true);

  /*
    SMPT Mail configuration in file xcrud_config.php
    
    public static $mail_host = mail.gmail.com; 
    public static $mail_port = 587; 
    public static $smtp_auth = true; 
    public static $username = xcrud17@gmail.com; 
    public static $pass = abc123; 
    public static $emailfrom = xCRUD Company; 
    public static $smtpsecure = 'tls';
    */

?>