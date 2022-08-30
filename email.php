<?php
require 'templates/header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
$mail = new PHPMailer(true);

?>

<html>
    <h2>Email Form</h2>
    <form action="" method="post" class="form--inline">
        <p><label>My Email: </label>
            <input name="sendto" type="email"></p>
        <p><label>Subject: </label>
            <input name="subject" type="text"></p>
        <p><label>Message: </label>
            <input name="body" type="textbox"></p>

    <input type="submit" value="Send">
    </form>
    
</html>

 
 <?php 
 if(!isset($_SESSION['email'])){
     print 'Please <a href="login.php">Login</a> to send an email</h2>';
 }else{
     
 $sendTo = $_POST['sendto'];
 $subject = $_POST['subject'];
 $body = $_POST['body'];
 
include('../config.php');
include('templates/footer.html'); 
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->SMTPAuth   = true;                             
    $mail->Username   = $username;                 
    $mail->Password   = $password;                      
    $mail->SMTPSecure = $SMTPsecure;                              
    $mail->Port       = $port; 

    $mail->setFrom($username, 'Perry Andrysczyk');           
    $mail->addAddress($sendTo);
       
    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
 }



  

