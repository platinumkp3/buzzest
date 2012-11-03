<?php

	require_once 'send_mail.php';
	
	$SMTP_SERVER="";
	$USER_NAME="";
	$EMAIL_PORT="" ;
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
		$EMAIL_FROM=$FROMMAIL;		
		
		$MSG_HTML=$MSG_HTML . "<br><br>" . $EMAIL_FOOTER;	

				
				
			$id = XPM3_MIME::unique();			
			$m = new XPM3_MAIL;
			$m->relay($SMTP_SERVER, $USER_NAME, $EMAIL_PWD, $EMAIL_PORT,$EMAIL_SSL) or $error=1 ; 
			$m->Delivery('relay');
			$m->From($EMAIL_FROM, $EMAIL_FROM);
			$m->AddTo($EMAIL_TO, $EMAIL_TO);
			$m->Text($MSG_TXT);
			$m->Html($MSG_HTML);
			$m->Send($EMAIL_SUBJECT);
			$m->Quit(); 
			
		
		return !$error;
	}
?>