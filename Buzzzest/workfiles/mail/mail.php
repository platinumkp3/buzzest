<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

	require_once 'XPM3_MAIL.php';
	//include "../common_db.inc.php";
	//include "../errorlog.php";

	//log_me("test mail");

	//echo base64_decode('WFBNMyB2LjAuNCA8d3d3LnhwZXJ0bWFpbGVyLmNvbT4=');

	//$link_id=db_connect();
	$SMTP_SERVER='';
	$USER_NAME='';
	$EMAIL_PWD='';
	$EMAIL_FOOTER = '';
	$EMAIL_PORT=0;
	$EMAIL_SSL=false;
	$USEMAILSERVER=0;
	$USEPHPMAIL=0;
	$FROMMAIL="";


	$query="Select * from mail_info" ;
		$result=mysql_query($query,$link_id);
		$query_data=mysql_fetch_array($result);

		if(mysql_num_rows($result)>0)
		{
			$SMTP_SERVER=$query_data["SMTPSER"];
			$USER_NAME=$query_data["UNAME"];
			$EMAIL_PORT= (int) $query_data["PORT"];
			$EMAIL_PWD=$query_data["PWD"];
			$EMAIL_FOOTER = $query_data["FOOTER"];
			if( $query_data["SSL"]==0)
			{
				$EMAIL_SSL=false;
			}
			else
			{
				$EMAIL_SSL=true;
			}
			$USEMAILSERVER= $query_data["USEMAILSERVER"];
			$USEPHPMAIL= $query_data["USEPHPMAIL"];
			$FROMMAIL= $query_data["FROMMAILID"];
		}
		else
		{
			$SMTP_SERVER='';
			$USER_NAME='';
			$EMAIL_PWD='';
			$EMAIL_FOOTER = '';
			$EMAIL_PORT=0;
			$EMAIL_SSL=false;
			$USEMAILSERVER=0;
			$USEPHPMAIL=0;
			$FROMMAIL="";
		}

//	log_me ("\n");
//	log_me ("USEMAILSERVER 1 ".$USEMAILSERVER);
//	log_me ("\n");
//	log_me ("USEPHPMAIL 1 ".$USEPHPMAIL);
//	log_me ("\n");
//
	function relyon_email($EMAIL_FROM,$EMAIL_TO,$EMAIL_SUBJECT,$MSG_HTML,$MSG_TXT)
	{
		//log_me ("Hi");
		global $SMTP_SERVER;
		global $USER_NAME;
		global $EMAIL_PWD;
		global $EMAIL_PORT;
		global $EMAIL_FOOTER;
		global $EMAIL_SSL;
		global $USEMAILSERVER;
		global $link_id;
		global $USEPHPMAIL;
		global $FROMMAIL;

		$headers="";
		$remarks="";

		 $currentdate=date("Y-m-d g:i:s");

		$error=0;

		//$ip = gethostbyname(trim($SMTP_SERVER));

		//echo "IP " . $ip ."<br>";

		//$EMAIL_PWD=null;
		//$USER_NAME=null;



		/*$query="Select * from mail_info" ;
		$result=mysql_query($query,$link_id);
		$query_data=mysql_fetch_array($result);

		if(mysql_num_rows($result)>0)
		{
			$SMTP_SERVER=$query_data["SMTPSER"];
			$USER_NAME=$query_data["UNAME"];
			$EMAIL_PORT= (int) $query_data["PORT"];
			$EMAIL_PWD=$query_data["PWD"];
			$EMAIL_FOOTER = $query_data["FOOTER"];
			if( $query_data["SSL"]==0)
			{
				$EMAIL_SSL=false;
			}
			else
			{
				$EMAIL_SSL=true;
			}
			$USEMAILSERVER= $query_data["USEMAILSERVER"];
			$USEPHPMAIL= $query_data["USEPHPMAIL"];
			$FROMMAIL= $query_data["FROMMAILID"];
		}
		else
		{
			$SMTP_SERVER='';
			$USER_NAME='';
			$EMAIL_PWD='';
			$EMAIL_FOOTER = '';
			$EMAIL_PORT=0;
			$EMAIL_SSL=false;
			$USEMAILSERVER=0;
			$USEPHPMAIL=0;
			$FROMMAIL="";
		}	*/



		if($USEMAILSERVER==1)
		{
//			log_me ("USEMAILSERVER".$USEMAILSERVER);
//			log_me ("\n");
			if($EMAIL_FROM=="")
			{
				$EMAIL_FROM=$FROMMAIL;
			}

			/*echo $EMAIL_FROM ."<br>";
			echo $EMAIL_TO  ."<br>";

			echo $EMAIL_SUBJECT."<br>";
			echo $MSG_HTML."<br>";
			echo $MSG_TXT."<br>";*/

			//echo "use PHP Mail " . $USEPHPMAIL;

			$MSG_HTML=$MSG_HTML . "<br><br>" . $EMAIL_FOOTER;
		//	log_me ("USEPHPMAIL".$USEPHPMAIL);
		//	log_me (" ");
			if($USEPHPMAIL==1)
			{

				$file = 'xpertmailer.gif';
				$id = XPM3_MIME::unique();
				$m = new XPM3_MAIL;
				$m->relay($SMTP_SERVER, $USER_NAME, $EMAIL_PWD, $EMAIL_PORT,$EMAIL_SSL) or $error=1 ;
				// or print_r($m->result);
				//echo "result";
				// print_r($m->result);
//				log_me ($m->result);
//				log_me ("Error ".$error);
				$remarks=join(' - ', array_implode($m->result));
				if($error==1)
				{
					echo $remarks;
				}
				else
				{
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

				}

				$remarks=join(' - ', array_implode($m->result));
			}
			else
			{

				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Additional headers
				$headers .= 'From: '. $FROMMAIL .' ' . "\r\n";
				//$headers .= 'To: $EMAIL_TO' . "\r\n";
				//$headers .= 'X-Mailer: PHP/' . phpversion();

				$remarks=mail($EMAIL_TO, $EMAIL_SUBJECT, $MSG_HTML, $headers);


			}
			//echo $remarks;
			$query_log="INSERT INTO mail_log (mailfrom,mailto,maildate,subject,mstatus,remarks)
							VALUES('".$EMAIL_FROM."','".$EMAIL_TO."',
									'". $currentdate."','".$EMAIL_SUBJECT."',".$error.",'".$remarks."')";
						//echo $query_log;
						//log_me ($query_log);
			$result_log=mysql_query($query_log,$link_id);
			return !$error;
		}
		else
		{
			return 0;
		}
	}

	function array_implode($arrays, &$target = array()) {
    foreach ($arrays as $item) {
        if (is_array($item)) {
            array_implode($item, $target);
        } else {
            $target[] = $item;
        }
    }
    return $target;
}
?>