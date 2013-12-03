<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

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
		
		//MODELS
		$this->load->model('Subscriptionmodel','subscription');
		
		////////////////////////////////////
		//NEW FRONT LAYOUT
		///////////////////////////////////
		get_layout()->set_layout("layout/download");
		
		//CSS
		get_layout()->add_stylesheets('jquery-ui/flick/jquery-ui-1.9.2.custom.min');
		get_layout()->add_stylesheets('landing/bootstrap.min');
		get_layout()->add_stylesheets('landing/bootstrap-responsive.min');
		get_layout()->add_stylesheets('landing/styles');
		get_layout()->add_stylesheets('landing/styles-layout2');
		get_layout()->add_stylesheets('landing/lightbox');

		//JS
		//get_layout()->add_javascripts('landing/jquery-ui-1.9.2.custom.min');
		get_layout()->add_javascripts("landing/jquery.validate.min");
				
		get_layout()->add_javascripts('landing/jquery.backstretch.min');
		get_layout()->add_javascripts('landing/slides.min.jquery');
		get_layout()->add_javascripts('landing/jquery.tipTip.minified');
		get_layout()->add_javascripts('landing/main');
		get_layout()->add_javascripts('landing/main2');
		get_layout()->add_javascripts('landing/organictabs.jquery');
		get_layout()->add_javascripts('landing/lightbox');

		
		////////////////////////////////////
		//NEW FRONT LAYOUT
		///////////////////////////////////
		
	}

	function index()
	{
		$this->load->view('download');
	}
	
	/**
	 * subscription
	 */
	function ajax_subscribe() {
        
		get_layout()->enabled(FALSE);
		$error = FALSE;
		
		if($_POST){
			//GET POST DATA
			$subscription = $this->input->post("subscription", true);
			$email = $subscription['email'];
			//UPDATE PASSWORD AND SAVE
			$existe = $this->subscription->getByField($email, 'email');
			
			if($existe) {
				$error = TRUE;
				$errortxt = "El email $email ya esta registrado, favor intentar con otro.";
			} else {
				$sent = $this->subscription->sendemail($subscription);
				if ($sent === TRUE){
					$error = FALSE;
					$result = $this->subscription->save($subscription);
				} else {
					$error = TRUE;
					$errortxt = $sent;
				}
			}
			
	        if (!$error){
	            $success = TRUE;
				$message = "Se ha suscrito exitosamente, pronto le enviaremos mas informacion.";
	        } else {
	            $success = FALSE;
			    $message = "Error : {$errortxt}";
	        }
			$json = array(
		        'success' => $success,
		        'message' => $message
			);
			echo json_encode($json);
		}
    }
}