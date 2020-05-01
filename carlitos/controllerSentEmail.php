<?php

require_once('controllerErrors.php');
require_once('controllerGenPDF.php');
require_once('../REPORT/fpdf.php');
require_once('../REPORT/generaFacPDF.php');
require_once('../CONFIG/config.php');
require_once('../CONFIG/configEmail.php');
require_once('../EMAIL/swift_required.php');
require_once('../DAO/facturaDao.php');
require_once('../DAO/conectaDao.php');
require_once('../DAO/clienteDao.php');
require_once('../DAO/tipoComDao.php');
require_once('../DAO/tipoRespDao.php');
require_once('../DAO/datosClienteFacturaDao.php');
require_once('../GUI/datosToGUI.php');
require_once('../UTIL/util.php');
require_once('includesMails/class.phpmailer.php');

set_error_handler("ERROR::miErrorHandler", E_ALL);

$config = CONFIG_INI::getInstancia();
$configEmail = new CONFIG_EMAIL;
$tipoComDao = TipoComDao::getInstancia();
$coneccionDAO = CONNECTION::getInstancia();
$linkSql = $coneccionDAO->ConectarMySql();
$genPdf = GenPdf::getInstancia();

$allEmails = array();

if((!isset($_POST["losemails"]))||($_POST["losemails"]=="")||($_POST["losemails"]==" ")){
	return "No se han seleccionados emails para enviar";
}
$datos = $_POST["losemails"];
$facturas = explode(",", $datos);
$allEmails = Array();
foreach ($facturas as $cadaFactura) {
    //print_r($cadaFactura);
	$datosFac = explode("LOLLOL", $cadaFactura);
    //print_r($datosFac);
	$para_aux = explode("=",$datosFac[0]);
	$para = $para_aux[1];
	$para2_aux = explode("=",$datosFac[1]);
	$para2 = $para2_aux[1];
	$fac_aux = explode("=",$datosFac[2]);
	$fac = $fac_aux[1];
	$tipoFac_aux = explode("=",$datosFac[3]);
	$tipoFac = $tipoFac_aux[1];
	
	$separeted = split("-",$fac);
	$tipoCom = (int)$separeted[0];
	$letra = $tipoComDao->getLetra($tipoCom);
	$archivo = $config->getPathFacsPDF().$letra."-".$separeted[0]."-".$separeted[1]."-".$separeted[2].".pdf";
	if (!file_exists($archivo)) {
		$genPdf->genPdf($fac,$tipoFac,'F');
	}
	
	if(($para!="")&&($para!=" ")){
		$mailsPara = explode(";",$para);
		foreach($mailsPara as $unMail){
			$unMail = trim($unMail);
			$allEmails[] = $unMail."LOLLOL".$archivo;
		}	
	}
	if(($para2!="")&&($para2!=" ")){
		$mailsCC = explode(";",$para2);
		foreach($mailsCC as $unMail){
			$unMail = trim($unMail);
			$allEmails[] = $unMail."LOLLOL".$archivo;
		}
	}
}
set_time_limit(7200);
$cantEnviados=0;
$cantTotEnviados=0;
$respuestas=null;
//print_r($allEmails);
foreach($allEmails as $unEmail){
	if($cantEnviados<5){
		$tiempoEspera = 1;
	} else {
		$tiempoEspera = 65;
		$cantEnviados=0;
	}
	$datos = explode("LOLLOL",$unEmail);
	$elEmail = $datos[0];
	$elArchivo = $datos[1];
	try {
		sleep($tiempoEspera);
		$exito = SendMAIL($elEmail,$elArchivo,$configEmail);
		if ($exito==1)
			$respuestas[$cantTotEnviados] = "Mail: ".$elEmail.", factura: ".$elArchivo." enviado correctamente.";
		else
			$respuestas[$cantTotEnviados] = "Mail: ".$elEmail.", factura: ".$elArchivo." no se pudo enviar.";
		$cantEnviados++;
		$cantTotEnviados++;
	} catch (Exception $e){
		echo 'Excepción capturada: ' . $e->getMessage();
	}
}

$coneccionDAO->CloseConexionMySql($linkSql);
$msjRespuesta = "";
for($i=0; $i<$cantTotEnviados;$i++){
	$msjRespuesta .= $respuestas[$i]."\n";
}
echo $msjRespuesta;

function ValidarEmail($email){
	$reg = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
	return preg_match($reg, $email);
}

function SendMAIL($para,$nomArchivo,$config){
	$mail = new phpmailer();
		$mail->PluginDir = "includesMails/";
		
		$mail->IsSMTP();
		// $mail->SMTPAuth = $config->getAuthSMTP(); // Autenticación SSL del SMTP: true o false;
		$mail->SMTPAuth = true;
		
		$mail->Host = $config->getHostEmails(); // SMTP a utilizar. Por ej. smtp.elserver.com
		$mail->Username =  $config->getEmailFrom(); // Correo completo a utilizar
		$mail->Password = $config->getPassFrom();; // Contraseña
		$mail->Port = $config->getPuertoSalida();; // Puerto a utilizar
		
		//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
		$mail->From =$config->getEmailFrom(); // Desde donde enviamos (Para mostrar)
		$mail->FromName = $config->getNombreFrom();
		$mail->AddCC($config->getEmailCC(),$config->getNombreCC());
		$mail->ClearReplyTos();
		$mail->AddReplyTo($config->getEmailReplyTo(),$config->getNombreReplyTo());
		
		$mail->Subject = $config->getAsuntoEmail();
		$email = $para;
		$body = $config->getMensajeEmail();
		 
		$mail->Body = $body;
		$mail->AltBody = $body;
		//$mail->Timeout=200;
		$mail->AddAddress($email);
		$vartemp = $nomArchivo;
		$varname = $vartemp;
		$mail->AddAttachment($vartemp, $varname);
		$exito = $mail->Send();
		if ($exito == 1)
			return $exito;
		else
			return $mail->ErrorInfo;
		//echo $exito." - ".$mail->ErrorInfo."<br />";
		/*
		$intentos=1; 
		while((!$exito)&&($intentos<5)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){
			$exito = $mail->Send();
			$intentos=$intentos+1;                
		}		 
		if ($mail->ErrorInfo=="SMTP Error: Data not accepted") {
			$exito=true;
		}
		*/
}


?>