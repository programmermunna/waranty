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
        $mail->SMTPDebug = 4;                           // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $smtp_host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $smtp_username;                 // SMTP username
        $mail->Password = $smtp_password;                           // SMTP password
        $mail->Port = $smtp_port;                                    // TCP port to connect to
        $mail->SMTPSecure = $smtp_secure;                            // Enable TLS encryption, `ssl` also accepted

        $mail->setFrom($site_email, $sitename);
        $mail->addAddress($addres);     // Add a recipient
        $mail->addReplyTo($site_email, 'Noreplay');

        // $mail->addAttachment('../upload/signature.png', 'signature.png');    // Optional name
        $mail->addEmbeddedImage('../upload/signature.png', 'signature.png');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

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