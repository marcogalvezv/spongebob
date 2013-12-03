<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testsecurimage extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		$this->load->helper('securimage');
		get_layout()->set_layout("layout/base");
	}

	function index()
	{
		if($_POST) {
			get_layout()->enabled(FALSE);
			validcode();
		} else {
			$this->load->view('securimage');
		}
	}
	
	function show($sid)
	{
		get_layout()->enabled(FALSE);
		return showimage();
	}
	
	function play($sid)
	{
		get_layout()->enabled(FALSE);
		return playsound();
	}
	
	function captchacheck() 
	{
		get_layout()->enabled(FALSE);
		$code = $this->input->post("code", true);
		$valid = validcode($code);
        if ($valid == FALSE) {
            $res = false;
		} else {
			$res = true;
		}
        echo json_encode($res);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */