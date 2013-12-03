<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailing extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'en';//spanish : es
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);
		
		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/socialflying_lang.php")){
			$this->lang->load('socialflying',$language);
		}else{
			$this->lang->load('socialflying','en');
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
		
		$this->load->helper('phpmailer');
	}

	
	function send()
	{
		get_layout()->enabled(false);
		$error = FALSE;
		$warning = FALSE;
		$sentemails = array();
		$errortext = '';
		
		//GET A MAX OF 5000 EMAILS TO SEND 
		$limit = 5000;
		$members = $this->mnewsletter->get_newsletter_members($limit);
		/*
		echo "<pre>";
		print_r($members);
		echo "</pre>";
		*/
		if(isset($members) && is_array($members) && count($members) > 0) {
			foreach($members as $row){
				
				$idnewsletter = $row['idnewsletter'];
				$uid = $row['uid'];
				$email = $row['email'];
				
				$newsletter = $this->mnewsletter->getById($idnewsletter);
				if (!is_array($newsletter) && is_object($newsletter)) { $newsletter = get_object_vars($newsletter); }
				
				$sent = $this->mnewsletter->send_newsletter_email($newsletter, $email);
				if($sent === TRUE){
					$this->mnewsletter->update_newsletter_sent_by_user($idnewsletter, $uid);
					$sentemails[] = $email;
				} else {
					$errortext = $sent;
					$error = TRUE;
					break;
				}
			}
		} else {
			$warning = TRUE;
		}
		
		if (!$error && !$warning){
			$success = TRUE;
			$message = "Success: newsletter sent successfully.";
		} elseif($warning) {
			$success = FALSE;
			$message = "Warning: There is NOT emails found on the system to send.";
		} else {
			$success = FALSE;
			$message = "Error: Something went wrong on the send newsletter process. {$errortext} Please review SMTP email settings or contact support center.";
		}
		$json = array(
			'success' 	=> $success,
			'message' 	=> $message,
			'sentemails'  	=> $sentemails
		  );
		
		echo "<pre>";
		print_r($json);
		echo "</pre>";
    }
}

/* End of file mailing.php */
/* Location: ./application/controllers/mailing.php */