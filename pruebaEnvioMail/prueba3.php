<?php
	require_once('includesMails/class.phpmailer.php');

	$mail = new phpmailer();
	$mail->PluginDir = "includesMails/";
 
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    // $mail->SMTPDebug = 2;                // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	
    $mail->Host       = 'mail.p4000324.ferozo.com';                    // Set the SMTP server to send through
    $mail->Username   = 'info@artigaspublicidad.com.ar';                     // SMTP username
    $mail->Password   = 'kDmH@Cv8oX';                               // SMTP password

    // $mail->Host       = 'mail.estudiocampanella.com.ar';                    // Set the SMTP server to send through
    // $mail->Username   = 'info@estudiocampanella.com.ar';                     // SMTP username
    // $mail->Password   = 'porQue1379';                               // SMTP password

    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    // $mail->SMTPSsecure='tls';       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    // $mail->SMTPAutoTLS = false;
    
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->SetFrom('info@artigaspublicidad.com.ar', 'ArtigasWEB');
    $mail->AddAddress('jpablocesarini@gmail.com');     // Add a recipient
    

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->IsHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'FORMULARIO WEB';
    $mail->Body    = 'PRUEBA DE RECEPCION <b>FROM WEB</b> #3';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<script>
            alert("Mail enviado correctamente #3");
          </script>';

} catch (Exception $e) {
    echo "Error en envío de mail: {$e->getMessage()}";
}


?>