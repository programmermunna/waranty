<?php 
ob_start();
require('database.php');
if(!session_start()){
    session_start();
}

// <!-- ===================php mailer=========== -->

 function sendVarifyCode($smtp_host, $smtp_username, $smtp_password, $smtp_port, $smtp_secure, $site_email, $sitename, $addres, $body, $subject)
    {

        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->SMTPDebug = 4;

        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->Port = $smtp_port;
        $mail->SMTPSecure = $smtp_secure;

        $mail->setFrom($site_email, $sitename);
        $mail->addAddress($addres);
        $mail->addReplyTo($site_email, 'Noreplay');

        // $mail->addAttachment('../upload/signature.png', 'signature.png');
        $mail->addEmbeddedImage('upload/signature.png', 'signature.png');
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $body;

        if (!$mail->send()) {
            echo 'Code could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
        }
    }

// <!-- ===================php mailer=========== -->
    
    
    
    
    ?>