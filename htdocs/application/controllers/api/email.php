<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		//load models and helpers
		$this->load->model('subscriptionmodel', 'subscription');
		$this->load->helper('phpmailer');
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';//spanish : es
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

		get_layout()->set_layout("layout/landing");
		get_layout()->add_stylesheets("landing");
		get_layout()->add_stylesheets("ielanding");
		
		//JQUERY-UI  -- THEME Darkness
		get_layout()->add_javascripts('jquery/jquery-ui-1.8.23.custom.min');
		get_layout()->add_stylesheets('jquery-ui/darkness/jquery-ui-1.8.23.custom');

		
		//get_layout()->add_javascripts("jquery/jquery.ui.dialog");
		get_layout()->add_javascripts("jquery/jquery.lwtCountdown-1.0");
		get_layout()->add_javascripts("misc");
		
		get_layout()->add_stylesheets('landing-ui');
		
	}
	
	/**
	 * Change the current password to a new one chossen by the user
	 */
	function send_christmas() {
        
		get_layout()->enabled(FALSE);
		$error = FALSE;
				
		//UPDATE PASSWORD AND SAVE
		$subscriptions = $this->subscription->getList()->result_array();
		
		if(!empty($subscriptions)) {
			foreach($subscriptions as $subscription){
				
				$data['email'] = $subscription['email'];
				$sent = $this->subscription->send_christmasemail($data);
				if ($sent === TRUE){
					$error = FALSE;
				} else {
					$error = TRUE;
					$errortxt = $sent;
				}
			}
		}
		
		if (!$error){
			$success = TRUE;
			$message = "Los emails se han enviado exitosamente.";
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

/* End of file landing.php */
/* Location: ./application/controllers/landing.php */