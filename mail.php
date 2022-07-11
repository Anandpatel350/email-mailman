<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class sendEmail{
    public function email_send($to_email,$subject,$html,$name){
        $link = md5(time());
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'anand.hestabit@gmail.com';                    
        $mail->Password   = 'bajkegixlupmbcui';                             
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

    
        $mail->setFrom('Ananad@gmail.com', $name);

        $mail->addAddress($to_email);             


        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = 'Verfication link for reset password';

        return $mail->send();
    }
}
// new sendEmail();