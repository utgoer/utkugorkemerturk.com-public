<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'lib/PHPMailer/PHPMailer.php';
require 'lib/PHPMailer/SMTP.php';

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']))
{
    $name= $_POST['name'];
    $email= $_POST['email'];
    $message= $_POST['message'];

    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "{gmail}";
    //Password to use for SMTP authentication
    $mail->Password = '{password}';
    //Set who the message is to be sent from
    $mail->setFrom('no-reply@utkugorkemerturk.com', 'UTGOERWEBSITE');
    //Set who the message is to be sent to
    $mail->addAddress('contact@utkugorkemerturk.com');
    //Set the subject line
    $mail->Subject = $name . '--' . $email;
    $mail->Body = $message;
    if (!$mail->send()) { 
        exit(json_encode(['send'=>'error', 'msg'=>'Message could not be sent. <br>Mailer Error: ' . $mail->ErrorInfo ]));
    } else {
        exit(json_encode(['send'=>'success', 'msg'=>'Message has been sent.' ]));
    }
}
?>