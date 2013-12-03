<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->add_package_path(BASEPATH.'application/_common/');
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		
		//echo DOMAINSPATH.'application/_common';
		
		$this->load->helper("array");
		$this->load->helper("layout");

	}

	function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */