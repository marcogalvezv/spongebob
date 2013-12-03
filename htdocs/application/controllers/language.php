<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");
		$this->load->model('Usermodel', 'user');
		$this->load->model('Systemmodel', 'system');
	}
	
	function set($language)
	{
		get_layout()->enabled(false);
		if(empty($language)){
			$language = 'es';//spanish:es
		}
/*echo "<pre>";
echo $language;
echo "</pre>";
*/
		$this->session->set_userdata('language',$language);
		
		$return = $_SERVER['HTTP_REFERER'];
		/*
		echo "<pre>";
		print_r($return);
		echo "</pre>";
		*/
		redirect($return);
		
		//FIXED REDIRECT TO THE USER HOMEPAGE
	    /*
		$user = $this->system->user();
		if($user){
			if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
			$user = $this->user->usercomplete($user);
			redirect($user['group']['homepage']);
		} else {
			redirect('/home');
		}
		*/
	}
	function ajaxsetlanguage()
	{
		get_layout()->enabled(false);

		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';
		}
		
		//setcookie ("giftlanguage", $language, time () + 31536000);//1 year
		
/*		$cookie = array(
			'name'   => 'countryFilter',
			'value'  => $city,
			'expire' => '86500',
			'domain' => 'gitabroad.synapse.com.bo',
			'path'   => '/',
			'prefix' => 'gift_',
			'secure' => TRUE
		);

		return $this->input->set_cookie($cookie);
*/
		$this->session->set_userdata('cityFilter',$country);		
	}
}

/* End of file language.php */
/* Location: ./application/controllers/language.php */