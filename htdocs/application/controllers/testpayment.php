<?php
class Testpayment extends Controller {

    function Testpayment() {
        parent::Controller();
    }
    
    function index() {
        $this->load->library('payment');
		$this->payment->card_num = '1234567890123456';
		$this->payment->exp_date = '0510';
		/*
		echo "<pre>";
		print_r($this->payment);
		echo "</pre>";
		*/

		if ($status = $this->payment->process() === TRUE)
		{
			echo "sucess";
			 // Report successful transaction
		}
		else
		{
			echo "error";
			// $status has the error message, so display an error page based on it
		}
    }
}
?>