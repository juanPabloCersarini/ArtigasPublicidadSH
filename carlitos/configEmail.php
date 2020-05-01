<?php

class CONFIG_EMAIL {
	
	/************************** ATRIBUTOS ************************************/
	
	private $ASUNTO_EMAIL = "Factura Electrónica";
	private $MENSAJE_EMAIL = "Nos dirigimos a Usted a efectos de hacerle llegar la Factura de la última liquidación en Formato PDF.
							  <br>
            			      La misma se encuentra adjunta al presente.
							  <br>
            			      Por favor confirmar la recepción de este mail.
            			      <br>
                              <strong>Importante</strong>: Para poder visualizar el comprobante debe tener instalado <strong>Acrobat Reader</strong>.
							  <br>
                              <br>
                              *******************************************************************************************************<br>
            			      <em>El presente comprobante es confeccionado en cumplimiento de lo estipulado por la AFIP en su Resoluci&oacute;n General N&ordm; 2177 del 21/12/2006, en el 
            			      cual se incluye dentro del Nuevo R&eacute;gimen de Facturaci&oacute;n Electr&oacute;nica a las  Empresas de Servicios de Internet, con car&aacute;cter obligatorio.<br>
            			      El contenido  del presente mensaje es privado, estrictamente confidencial y exclusivo para  sus destinatarios, pudiendo contener informacion 
            			      protegida por normas legales y de secreto profesional. Bajo ninguna circunstancia su contenido puede ser transmitido o revelado a terceros ni 
            			      divulgado en forma alguna. En consecuencia de haberlo recibido por error,solicitamos contactar al remitente y eliminarlo de su sistema.</em><br>
            			      *******************************************************************************************************<br>
							 ";
	// private $AUTH_SMTP = false;	// false;  // true;
	private $PUERTO_SALIDA = 587;	// 25;	// 587;  // 465;
	// private $HOST_EMAILS = "mail.t3000158.ferozo.com";
	// private $HOST_EMAILS = "t3000158.ferozo.com";
	private $HOST_EMAILS = "mail.carloscampanella.com.ar";
	private $PASS_EMAIL_FROM = "jupiVera79";
	private $NOMBRE_FROM = "Facturación | Argiz Publicidad";
	private $EMAIL_FROM = "fe@carloscampanella.com.ar";
	private $NOMBRE_CC = "Argiz Publicidad FE enviada";
	private $EMAIL_CC = "argizpublicidad@gmail.com";
	// private $EMAIL_CC = "charlycampanella@gmail.com";
	private $NOMBRE_REPLY_TO = "Respuestas de FE";
	private $EMAIL_REPLY_TO = "argizpublicidad@gmail.com";
	
	/**************************************************************************/
	
	public function getMensajeEmail () {
		return $this->MENSAJE_EMAIL;
	}
	public function getAsuntoEmail () {
		return $this->ASUNTO_EMAIL;
	}
	public function getNombreFrom () {
		return $this->NOMBRE_FROM;
	}
	public function getEmailFrom () {
		return $this->EMAIL_FROM;
	}
	public function getPassFrom () {
		return $this->PASS_EMAIL_FROM;
	}
	public function getHostEmails () {
		return $this->HOST_EMAILS;
	}
	// public function getAuthSMTP () {
		// return $this->AUTH_SMTP;
	// }
	public function getPuertoSalida () {
		return (int)$this->PUERTO_SALIDA;
	}
	public function getNombreCC () {
		return $this->NOMBRE_CC;
	}
	public function getEmailCC () {
		return $this->EMAIL_CC;
	}
	public function getNombreReplyTo () {
		return $this->NOMBRE_REPLY_TO;
	}
	public function getEmailReplyTo () {
		return $this->EMAIL_REPLY_TO;
	}
}

?>