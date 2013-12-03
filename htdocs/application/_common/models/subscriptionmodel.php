<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Subscriptionmodel extends Basemodel
{	
	
	protected $_table_name = "subscription";
	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
	
	function sendemail($data)
	{
		//$subject = $this->config->item('email_from_name') . ": Sub" . lang('restaurant.email.subject.subscription');
		$subject = $this->config->item('email_from_name') . ": Suscripcion Version Beta";
		//GET EMAIL CONTENT FROM DATABASE
		$message = $this->load->view('email/subscription', compact('data'), true);
		
		$from = "{$this->config->item('email_from_name')} <{$this->config->item('email_from_address')}>";
        $to = $data['email'];
		
		//SEND COPY EMAILS
		$cc = "";
		$bcc = $this->config->item('email_from_address');
		//SEND EMAIL
		//$res = send_email($to, $from, $subject, $message);
		$res = send_email($to, $from, $subject, $message, $cc, $bcc);
		/*
		echo "<pre>";
		print_r($res);
		echo "</pre>";
		*/
		return $res;
	}
}

/* End of file subscriptionmodel.php */
/* Location: ./system/application/models/subscriptionmodel.php */
