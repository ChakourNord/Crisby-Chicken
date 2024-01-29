<?php
include("../../xcrud/xcrud.php");
$xcrud = Xcrud::get_instance();

$email = $_GET["email"];
$password = $_GET["password"];

$subject = "ALHP Account Created Successfully";
				//$email = "pchieni25@gmail.com";
				$emailBody = "You ALHP Cash app account has been created and is ready to use.  <br>
				           Find below your login credentials for the web and mobile app <br><br> 
				           Username/Email: <b>$email</b> <br> <b>Password:</b> $password <br> 
				           Link:<a href='http://161.97.135.70/alhp/login.php'>Here</a><br><br> 
						   
						   To access the mobile app, go to google play store on your android application, search and download ALHP Cash App.
						   Use the above credentials to login to the app.<br><br>
				           Regards<br> 
				           ALHP Cash App";
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