<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebookapi extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';//spanish : es
		}
		
		//SET LANGUAGE
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

        $this->load->model('usermodel', 'muser');
        $this->load->model('profilemodel', 'mprofile');
        $this->load->model('newslettermodel', 'mnewsletter');
		
		//$this->load->helper('facebook');
		//NEW FRONT-END LAYOUT
		get_layout()->set_layout("layout/front");

		get_layout()->add_stylesheets('jquery-ui-1.8.16/jquery.ui.all');
//		get_layout()->add_stylesheets('jquery-ui-1.8.16/jquery.ui.datetimepicker');
//		get_layout()->add_stylesheets('jquery-ui-1.8.16/jquery.ui.datepicker');
		get_layout()->add_stylesheets('front');
		get_layout()->add_stylesheets('tables');
		get_layout()->add_stylesheets('forms');
		get_layout()->add_stylesheets('validate1.8');
		get_layout()->add_stylesheets('jquery-ui');

//		get_layout()->add_stylesheets('ui/jquery.ui.datetimepicker');
		get_layout()->add_stylesheets('jquery.toastmessage');
		get_layout()->add_stylesheets('demo_table_jui');
		
		get_layout()->add_javascripts('jquery/jquery-1.7.1');
		get_layout()->add_javascripts('jquery/jquery-ui-1.8.11.custom');
		get_layout()->add_javascripts('jquery/jquery.innerfade');
		get_layout()->add_javascripts('date.format');
		get_layout()->add_javascripts('jquery/jquery.ui.datetimepicker.min');
		get_layout()->add_javascripts('jquery/jquery.dataTables');
		
		$clanguage = $this->session->userdata('language');
		if(isset($clanguage) && $clanguage=="spanish") get_layout()->add_javascripts('jquery/jquery.validate.1.8.es');
		else get_layout()->add_javascripts('jquery/jquery.validate.1.8');

		//PATCH CKEDITOR IN JQUERY.DIALOG
		get_layout()->add_javascripts('jquery/patch.dialog.ckeditor');	
		
		//VALIDATE
		get_layout()->add_javascripts('jquery/jquery.metadata');
		get_layout()->add_javascripts('jquery/jquery.validate');
		get_layout()->add_stylesheets('validate');

		//HINTS
		get_layout()->add_javascripts('jquery/jquery.inputhints');

		//JQUERY.STYLETABLE	
		get_layout()->add_javascripts('styletable.jquery.plugin');	
	}

    function index()
    {
//		get_layout()->enabled(false);
//		get_layout()->set_layout("layout/flysocial");
//		get_layout()->set("showmenumember",false);
//		$this->load->view('home'/*, $data*/);
		//$uid2 = $this->msystem->uid();
		get_layout()->set("showmenumember",false);
		$this->load->view('testfacebook');
    }

	
	function publish()
	{
		get_layout()->enabled(false);
		
		$message = "Example3 of posts from FlySocial to facebook";
		$link = "http://flysocial.synapse.com.bo";
		$picture = "http://flysocial.synapse.com.bo/images/logos/logo.png";
		$name = "This is Name";
		$desc = "This is a medium description.This is a medium description.This is a medium description.This is a medium description.This is a medium description.This is a medium description.This is a medium description.This is a medium description.";
		
		$facebook = fb_publish($message, $link, $picture, $name, $desc);
		
		if (is_object($facebook) || is_array($facebook)){
			$success = true;
			$message = "Success: Post sent successfully.";
		} else {
			$success = false;
			$message = "Error: Something went wrong on the send process. {$facebook} Please contact support center.";
		}
		
		$json = array(
			'success' 	=> $success,
			'message' 	=> $message
		);
		
	echo "<pre>json";
	print_r($json);
	echo "</pre>";
		echo json_encode($json);
		  
    }
	
	function message()
	{
		get_layout()->enabled(false);
		
		$message = "Example4 of messages from FlySocial to facebook";
		
		$facebook = fb_message($message);
		
		if (is_object($facebook) || is_array($facebook)){
			$success = true;
			$message = "Success: Message sent successfully.";
		} else {
			$success = false;
			$message = "Error: Something went wrong on the send process. {$facebook} Please contact support center.";
		}

		$json = array(
			'success' 	=> $success,
			'message' 	=> $message
		);

		echo json_encode($json);

    }
}

/* End of file mailing.php */
/* Location: ./application/controllers/mailing.php */