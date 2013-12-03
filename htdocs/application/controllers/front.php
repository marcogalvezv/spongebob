<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';//spanish = es
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);

		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/front_lang.php")){
			$this->lang->load('front',$language);
		}else{
			$this->lang->load('front','en');
		}
		
		////////////////////////////////////
		//NEW FRONT LAYOUT
		///////////////////////////////////
		get_layout()->set_layout("layout/newfront");
		
		//CSS
		get_layout()->add_stylesheets('front/bootstrap');
		get_layout()->add_stylesheets('front/bootstrap-responsive');
		get_layout()->add_stylesheets('front/theme');		

		//JS
		get_layout()->add_javascripts('front/theme');
		get_layout()->add_javascripts('front/jquery.onebyone.min');
				
		////////////////////////////////////
		//NEW FRONT LAYOUT
		///////////////////////////////////
		
	}

	function index()
	{
		$this->load->view('front');
	}
}