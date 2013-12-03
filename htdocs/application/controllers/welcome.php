<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		//FRONT LAYOUT REQUIRED
		///////////////////////////////////
		get_layout()->set_layout("layout/front");
		
		//CSS
		get_layout()->add_stylesheets('base');
		get_layout()->add_stylesheets('dark');
		get_layout()->add_stylesheets('media.queries');
		get_layout()->add_stylesheets('tipsy');

		//JS
		get_layout()->add_javascripts('jquery/jquery-1.7.1.min');
		get_layout()->add_javascripts('html5shiv');
		get_layout()->add_javascripts('jquery.tipsy');
		get_layout()->add_javascripts('fancybox/jquery.fancybox-1.3.4.pack');
		get_layout()->add_javascripts('fancybox/jquery.easing-1.3.pack');
		get_layout()->add_javascripts('jquery.touchSwipe');
		get_layout()->add_javascripts('jquery.mobilemenu');
		get_layout()->add_javascripts('jquery.infieldlabel');
		get_layout()->add_javascripts('jquery.echoslider');
		get_layout()->add_javascripts('fluidapp');
		////////////////////////////////////
		//FRONT LAYOUT REQUIRED
		///////////////////////////////////
		
	}

	function index()
	{
		$this->load->view('welcome');
	}
}
	