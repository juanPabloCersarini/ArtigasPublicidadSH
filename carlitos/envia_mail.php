<?
?>
 <div class="espera">
	<img src="img/espera.gif" />"
 </div>	
<?
//  Arma mail para enviar con el <<Pedido>>

require_once('EMAIL/swift_required.php');
require_once('includesMails/class.phpmailer.php');

// Datos del Solicitante //
$nombre = $_POST["nombre"];
$email  = $_POST["email"];
$texto  = $_POST["texto"];

// Artículos //
$a150x1667 = $_POST["a150x1667"];
$a200x1667 = $_POST["a200x1667"];
$a250x1667 = $_POST["a250x1667"];
$a300x1667 = $_POST["a300x1667"];
$a350x1667 = $_POST["a350x1667"];

$a150x1332 = $_POST["a150x1332"];
$a200x1332 = $_POST["a200x1332"];
$a250x1332 = $_POST["a250x1332"];
$a300x1332 = $_POST["a300x1332"];
$a350x1332 = $_POST["a350x1332"];
$a400x1332 = $_POST["a400x1332"];
$a450x1332 = $_POST["a450x1332"];
$a500x1332 = $_POST["a500x1332"];

$a150x1067 = $_POST["a150x1067"];
$a200x1067 = $_POST["a200x1067"];
$a250x1067 = $_POST["a250x1067"];
$a300x1067 = $_POST["a300x1067"];
$a350x1067 = $_POST["a350x1067"];
$a400x1067 = $_POST["a400x1067"];
$a450x1067 = $_POST["a450x1067"];
$a500x1067 = $_POST["a500x1067"];
$a550x1067 = $_POST["a550x1067"];
$a600x1067 = $_POST["a600x1067"];

$a300x0800 = $_POST["a300x0800"];
$a350x0800 = $_POST["a350x0800"];
$a400x0800 = $_POST["a400x0800"];
$a450x0800 = $_POST["a450x0800"];
$a500x0800 = $_POST["a500x0800"];
$a550x0800 = $_POST["a550x0800"];

// Cuerpo del mail //
$body  = "* Solicitante *\n";
$body = $body."Nombre: ".$nombre;
$body = $body."\nMail  : ".$email."\n";
$body = $body."\n";
$body = $body."* Pedido de Presupuesto *\n";

$deta = "";
if($a150x1667 !=""){$deta = $deta."150mm x 1667m = ".$a150x1667." unidades\n";}
if($a200x1667 !=""){$deta = $deta."200mm x 1667m = ".$a200x1667." unidades\n";}
if($a250x1667 !=""){$deta = $deta."250mm x 1667m = ".$a250x1667." unidades\n";}
if($a300x1667 !=""){$deta = $deta."300mm x 1667m = ".$a300x1667." unidades\n";}
if($a350x1667 !=""){$deta = $deta."350mm x 1667m = ".$a350x1667." unidades\n";}

if($a150x1332 !=""){$deta = $deta."150mm x 1332m = ".$a150x1332." unidades\n";}
if($a200x1332 !=""){$deta = $deta."200mm x 1332m = ".$a200x1332." unidades\n";}
if($a250x1332 !=""){$deta = $deta."250mm x 1332m = ".$a250x1332." unidades\n";}
if($a300x1332 !=""){$deta = $deta."300mm x 1332m = ".$a300x1332." unidades\n";}
if($a350x1332 !=""){$deta = $deta."350mm x 1332m = ".$a350x1332." unidades\n";}
if($a400x1332 !=""){$deta = $deta."400mm x 1332m = ".$a400x1332." unidades\n";}
if($a450x1332 !=""){$deta = $deta."450mm x 1332m = ".$a450x1332." unidades\n";}
if($a500x1332 !=""){$deta = $deta."500mm x 1332m = ".$a500x1332." unidades\n";}

if($a150x1067 !=""){$deta = $deta."150mm x 1067m = ".$a150x1067." unidades\n";}
if($a200x1067 !=""){$deta = $deta."200mm x 1067m = ".$a200x1067." unidades\n";}
if($a250x1067 !=""){$deta = $deta."250mm x 1067m = ".$a250x1067." unidades\n";}
if($a300x1067 !=""){$deta = $deta."300mm x 1067m = ".$a300x1067." unidades\n";}
if($a350x1067 !=""){$deta = $deta."350mm x 1067m = ".$a350x1067." unidades\n";}
if($a400x1067 !=""){$deta = $deta."400mm x 1067m = ".$a400x1067." unidades\n";}
if($a450x1067 !=""){$deta = $deta."450mm x 1067m = ".$a450x1067." unidades\n";}
if($a500x1067 !=""){$deta = $deta."500mm x 1067m = ".$a500x1067." unidades\n";}
if($a550x1067 !=""){$deta = $deta."550mm x 1067m = ".$a550x1067." unidades\n";}
if($a600x1067 !=""){$deta = $deta."600mm x 1067m = ".$a600x1067." unidades\n";}

if($a300x800 !=""){$deta = $deta."300mm x 800m = ".$a300x800." unidades\n";}
if($a350x800 !=""){$deta = $deta."350mm x 800m = ".$a350x800." unidades\n";}
if($a400x800 !=""){$deta = $deta."400mm x 800m = ".$a400x800." unidades\n";}
if($a450x800 !=""){$deta = $deta."450mm x 800m = ".$a450x800." unidades\n";}
if($a500x800 !=""){$deta = $deta."500mm x 800m = ".$a500x800." unidades\n";}
if($a550x800 !=""){$deta = $deta."550mm x 800m = ".$a550x800." unidades\n";}

$mensa = "\n* Mensaje *\n";
$mensa = $mensa.$texto;

$body = $body.$deta.$mensa;

$mail = new phpmailer();
$mail->PluginDir = "includesMails/";
$mail->IsSMTP();
$mail->SMTPAuth = true;

////// TESTING //////
// $mail->Host     = "mail.carloscampanella.com.ar";		// SMTP a utilizar. Por ej. smtp.fibertel.com.ar
// $mail->Username = "estudio@carloscampanella.com.ar";	// Correo completo a utilizar
// $mail->Password = "jupiVera79";							// La Contraseña
// $mail->Port     = "587";								// Puerto por donde se envía
// $mail->From     = "estudio@carloscampanella.com.ar";	// Desde donde enviamos (Solo para mostrar)
// $mail->FromName = "Contacto AQR Pack Web";				// Quién envía
//  $mail->AddAddress("planetahelen@yahoo.com.ar");		// Destinatario
//$mail->AddAddress("charlycampanella@gmail.com");		// Destinatario
// $mail->AddCC = "";										// Para copiar a alguien
// $mailReplatTo = "";
// $nameReplatTo = "";
// $mail->AddReplyTo($mailReplatTo,$nameReplatTo);			// Para indicar en donde se quiere recibir la respuesta
// $mail->ClearReplyTos();
// $mail->Subject = "Pedido desde la Web";  				// Asunto del email
// $mail->Body = $body;									// Cuerpo del email

////// PRODUCCION //////
$mail->Host     = "mail.aqrpack.com";			// SMTP a utilizar. Por ej. smtp.fibertel.com.ar
$mail->Username = "pedidosweb@aqrpack.com";		// Correo completo a utilizar
$mail->Password = "Pedi2017Web";				// La Contraseña
$mail->Port     = "587";						// Puerto por donde se envía
$mail->From     = "pedidosweb@aqrpack.com";		// Desde donde enviamos (Solo para mostrar)
$mail->FromName = "Contacto AQR Pack Web";		// Quién envía

	// $mail->AddAddress("estudio@carloscampanella.com.ar");		// Destinatario => Jupi
	// $mail->AddAddress("planetahelen@yahoo.com.ar");			// Destinatario => Pel
	$mail->AddAddress("comercial@aqrpack.com");			// Destinatario => Aleida

$mail->AddCC = "";			// Para copiar a alguien
$mailReplatTo = "";
$nameReplatTo = "";
$mail->AddReplyTo($mailReplatTo,$nameReplatTo);	// Para indicar en donde se quiere recibir la respuesta
$mail->ClearReplyTos();
$mail->Subject = "Pedido desde la Web";  		// Asunto del email
$mail->Body = $body;							// Cuerpo del email

$exito = $mail->Send();		// Envía email

// echo $exito;
// die;
?>
<body onLoad = "parent.location = 'gracias.html'" />

