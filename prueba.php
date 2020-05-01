<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    $mail->SMTPDebug = 2;                // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.p4000324.ferozo.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@artigaspublicidad.com.ar';                     // SMTP username
    $mail->Password   = 'kDmH@Cv8oX';                               // SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
     $mail->SMTPSsecure='tls';       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    // $mail->SMTPAutoTLS = false;
    
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('info@artigaspublicidad.com.ar', 'ArtigasWEB');
    $mail->addAddress('jpablocesarini@gmail.com');     // Add a recipient
    

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'FORMULARIO WEB';
    $mail->Body    = 'PRUEBA DE RECEPCION <b>FROM WEB</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mail enviado correctamente';
} catch (Exception $e) {
    echo "Error en envío de mail: {$e->getMessage()}";
}


?>