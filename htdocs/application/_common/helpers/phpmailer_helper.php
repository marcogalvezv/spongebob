<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_email($recipient, $sender, $subject, $message, $cc = false, $bcc = false, $type = 'sendSMTP')
{
	//return $type($recipient, $sender, $subject, $message, $cc, $bcc);

	if($type == 'sendGmail'){
		return sendGmail($recipient, $sender, $subject, $message, $cc, $bcc);
	} elseif($type == 'sendSMTP'){
		return sendSMTP($recipient, $sender, $subject, $message, $cc, $bcc);
	} else {
		return sendSMTPTEST($recipient, $sender, $subject, $message, $cc, $bcc);
	}
}

function sendGmail($recipient, $sender, $subject, $message, $cc = false, $bcc = false)
{
    include_once("phpmailer/class.phpmailer.php");
	//include_once('../class.phpmailer.php');
    $mail = new PHPMailer();
	error_reporting(E_STRICT);

	date_default_timezone_set('America/Toronto');

	$mail             = new PHPMailer();

	$body             = $message;
	$body             = eregi_replace("[\]",'',$body);

	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

	$mail->Username   = "synapse.carlos@gmail.com";	// GMAIL username
	$mail->Password   = "mastersynapse";            	// GMAIL password

	$mail->AddReplyTo("synapse.carlos@gmail.com","Carlos");

    $mail->From = $sender;
	$mail->FromName   = "";

	$mail->Subject = $subject;

	//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML($body);

	$mail->AddAddress($recipient);
	if($cc) {$mail->AddCC($cc);}
	if($bcc) {$mail->AddBCC($bcc);}

	$mail->IsHTML(true); // send as HTML

    if ( ! $mail->Send())
    {
		$error = "Mailer Error: " . $mail->ErrorInfo;
        return $error; //echo 'Failed to Send';
    }
    else
    {
        return true; //echo 'Mail Sent';
    }	
}

function sendSMTP($recipient, $sender, $subject, $message, $cc = false, $bcc = false)
{
    include_once("phpmailer/class.phpmailer.php");
	//include_once('../class.phpmailer.php');
    $mail = new PHPMailer();
	error_reporting(E_STRICT);

	date_default_timezone_set('America/Toronto');

	$mail             = new PHPMailer();

	$body             = $message;
	$body             = eregi_replace("[\]",'',$body);

	//$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsSendmail(); // telling the class to use SendMail transport
	$mail->Host       = "mail.pidamosalgo.com"; 	// SMTP server

	//$mail->Username   = "info@pidamosalgo.com";
	//$mail->Password   = "S7n4ps30nl1n3#2012";
	
    $mail->From = $sender;
	$mail->FromName   = "";

	$mail->Subject = $subject;

	//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML($body);

	
	if(is_array($recipient)) {
		foreach($recipient as $to) {
			$mail->AddAddress($to);
		}	
	} else {
		$mail->AddAddress($recipient);
	}	
	
	if($cc) {$mail->AddCC($cc);}
	if($bcc) {$mail->AddBCC($bcc);}

	$mail->IsHTML(true); // send as HTML

    if ( ! $mail->Send())
    {
		$error = "Mailer Error: " . $mail->ErrorInfo;
        return $error; //echo 'Failed to Send';
    }
    else
    {
        return true; //echo 'Mail Sent';
    }	
}

function sendSMTPTEST($recipient, $sender, $subject, $message, $cc = false, $bcc = false)
{
    include_once("phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();
	error_reporting(E_STRICT);

	date_default_timezone_set('America/Toronto');

	$mail             = new PHPMailer();

	$body             = $message;
	$body             = eregi_replace("[\]",'',$body);

	$mail->IsSendmail();

	$mail->Username   = "info@pidamosalgo.com";
	$mail->Password   = "S7n4ps30nl1n3#2012";

    $mail->From = $sender;
	$mail->FromName   = "";

	$mail->Subject = $subject;

	//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML($body);
	/*
	echo "<pre>";
	print_r($recipient);
	echo "</pre>";
	*/
	if(is_array($recipient)) {
		foreach($recipient as $tomail) {
			$mail->AddAddress($tomail);
		}
	} else {
		$mail->AddAddress($recipient);
	}	
	
	if($cc) {$mail->AddCC($cc);}
	if($bcc) {$mail->AddBCC($bcc);}

	$mail->IsHTML(true); // send as HTML

    if ( ! $mail->Send())
    {
		$error = "Mailer Error: " . $mail->ErrorInfo;
        return $error; //echo 'Failed to Send';
    }
    else
    {
        return true; //echo 'Mail Sent';
    }	
}
?>