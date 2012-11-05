<?php

	require_once 'XPM3_MAIL.php';
	
	$SMTP_SERVER="";
	$USER_NAME="";
	$EMAIL_PORT=0;
	$EMAIL_PWD="";
	$EMAIL_SSL=false;
	$EMAIL_FOOTER = "";
	$FROMMAIL= "";	
	
	function sending_email($EMAIL_FROM,$EMAIL_TO,$EMAIL_SUBJECT,$MSG_HTML,$MSG_TXT)
	{
		global $SMTP_SERVER;
		global $USER_NAME;
		global $EMAIL_PWD;
		global $EMAIL_PORT;
		global $EMAIL_FOOTER;
		global $EMAIL_SSL;
		global $FROMMAIL;
		
		$error=0;
		//$EMAIL_FROM=$FROMMAIL;		
		
		$MSG_HTML=$MSG_HTML . "<br><br>" . $EMAIL_FOOTER;	
		
	/*	$id = XPM3_MIME::unique();			
		$m = new XPM3_MAIL;
		//echo ($SMTP_SERVER." ".$USER_NAME." ".$EMAIL_PWD." ".$EMAIL_PORT." ".$EMAIL_SSL);
		$m->relay($SMTP_SERVER, $USER_NAME, $EMAIL_PWD, $EMAIL_PORT,$EMAIL_SSL) or $error=1 ;		
		
		
		$m->Delivery('relay');
		$m->From($EMAIL_FROM, $EMAIL_FROM);
		$m->AddTo($EMAIL_TO, $EMAIL_TO);
		$m->Text($MSG_TXT);
		$m->Html($MSG_HTML);
		//$m->AttachFile($file, null, null, null, 'base64', 'inline', $id); // <- embed image in HTML
		$m->Send($EMAIL_SUBJECT); // <- send mail
		$m->Quit(); // <- quit from relay SMTP server
		//echo "a";
		//print_r($m->result); // <- for debugging
		return !$error;*/
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$FROMMAIL="sonymamtha@gmail.com";
		// Additional headers
		$headers .= 'From: '. $FROMMAIL .' ' . "\r\n";
		//$headers .= 'To: $EMAIL_TO' . "\r\n";
		//$headers .= 'X-Mailer: PHP/' . phpversion();

		if (mail($EMAIL_TO, $EMAIL_SUBJECT, $MSG_HTML, $headers))
		{
			return 1;
		}
		else 
		{
			return 0;
		}
	}
?>