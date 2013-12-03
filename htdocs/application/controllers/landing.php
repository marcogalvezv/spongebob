<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		
		get_layout()->set_layout("layout/landing");
		
	}

	function index()
	{
		$this->load->view('landing');
	}
}

/* End of file landing.php */
/* Location: ./application/controllers/landing.php */