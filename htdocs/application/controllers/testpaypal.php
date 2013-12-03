<?php
class Testpaypal extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		
		$this->load->helper('layout');
		get_layout()->set_layout("layout/base");
    }
    
    function index() {
		redirect('testpaypal/testnvp1');
	}
	
	function testnvp1() {
		$this->session->set_userdata('paypal_token', FALSE);
        $this->load->library('payment');
		$this->payment->AMT = "255.55";
		//$this->payment->GETDETAILS = FALSE;
		
		//echo "<pre>";
		//print_r($this->payment);
		//echo "</pre>";
		
		$status = $this->payment->process();
			
		if ($status === TRUE)
		{
			echo "sucess";
			 // Report successful transaction
		}
		else
		{
			echo "error: " . $status;
			
		}
		
		$subscription = $this->payment->subscription();
		echo "<pre>TEST";
		print_r($subscription);
		echo "</pre>";
		
    }
}
?>