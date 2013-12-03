<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		//load models and helpers
//		$this->load->model('Categorymodel', 'mcategory');		
		$this->load->helper('phpmailer');
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';//spanish = es
		}
		
		//SET LANGUAGE ON SESSION
		$this->session->set_userdata('language',$language);

		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/front_lang.php")){
			$this->lang->load('front',$language);
		} else {
			$this->lang->load('front','en');
		}
		
		//GET CITY ON SESSION
		$city = $this->session->userdata('city');
		if(empty($city)){
			$city = 'cochabamba';//santa-cruz o la-paz
		}		
		//SET CITY ON SESSION
		$this->session->set_userdata('city',$city);

		get_layout()->set_layout("layout/front");
		
		get_layout()->add_javascripts('jquery/jquery-ui-1.9.1.custom');
		get_layout()->add_stylesheets('jquery-ui/blitzer/jquery-ui-1.9.1.custom');
		
		//NEW SHOPPING CART STYLES
		get_layout()->add_stylesheets("bootstrap");
		get_layout()->add_stylesheets("bootstrap-responsive");
		get_layout()->add_stylesheets("docs");
		get_layout()->add_stylesheets("google-code-prettify/prettify");
		get_layout()->add_stylesheets("front");
		get_layout()->add_stylesheets("flexslider");
		get_layout()->add_stylesheets("jquery.fancybox-1.3.4");
		
		//NEW SHOPPING CART JAVASCRIPTS
		get_layout()->add_javascripts('google-code-prettify/prettify');
		get_layout()->add_javascripts('respond.min');
		get_layout()->add_javascripts('bootstrap-transition');
		get_layout()->add_javascripts('bootstrap-alert');
		get_layout()->add_javascripts('bootstrap-modal');
		get_layout()->add_javascripts('bootstrap-dropdown');
		get_layout()->add_javascripts('bootstrap-scrollspy');
		get_layout()->add_javascripts('bootstrap-tab');
		get_layout()->add_javascripts('bootstrap-tooltip');
		get_layout()->add_javascripts('bootstrap-popover');
		//get_layout()->add_javascripts('bootstrap-button');
		get_layout()->add_javascripts('bootstrap-collapse');
		get_layout()->add_javascripts('bootstrap-carousel');
		get_layout()->add_javascripts('bootstrap-typeahead');
		get_layout()->add_javascripts('application');
		get_layout()->add_javascripts('jquery.flexslider');
		get_layout()->add_javascripts('jquery.tweet');
		get_layout()->add_javascripts('jflickrfeed.min');
		get_layout()->add_javascripts('cloud-zoom.1.0.2');
		get_layout()->add_javascripts('jquery.fancybox-1.3.4.pack');
		get_layout()->add_javascripts('jquery.validate');
		get_layout()->add_javascripts('custom');

		//validate
		get_layout()->add_javascripts('jquery/jquery.validate');
		get_layout()->add_stylesheets("validate");
		get_layout()->add_javascripts('jquery/jquery.validate.password');
		get_layout()->add_stylesheets("jquery.validate.password");
		
		//maps
		//get_layout()->add_javascripts('markers');
		//get_layout()->add_javascripts('functions');

	}

	function index()
	{
//		$this->load->view('cart');
	}
	function privacidad()
	{
		$this->load->view('pages/privacy');
	}
	
	function terminos()
	{
		$this->load->view('pages/terms');
	}
	
	function acerca()
	{
		$this->load->view('pages/about');
	}
	
	function inversores()
	{
		$this->load->view('pages/investors');
	}
}