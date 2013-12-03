<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
		$this->load->helper('array');
		$this->load->helper('layout');
        $this->load->library('session');
        $this->load->helper('cookie');
		$this->load->helper('phpmailer');
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';
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

        $this->load->model('Usermodel', 'user');
		$this->load->model('Systemmodel', 'msystem');
		$this->load->model('countrymodel','mcountry');

        $this->load->model('profilemodel', 'mprofile');
		$this->load->model('badgeearnedmodel','mbadgeearned');
		$this->load->model('friendmodel', 'mfriend');
		$this->load->model('eventmodel','mevent');
		
		//NEW FRONT-END LAYOUT
		get_layout()->set_layout("layout/flysocial");

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

    function view($fid = 0)
    {
//		get_layout()->enabled(false);
//		get_layout()->set_layout("layout/flysocial");
//		get_layout()->set("showmenumember",false);
//		$this->load->view('home'/*, $data*/);
		//$uid2 = $this->msystem->uid();
		if($this->msystem->uid())
			$uid = $this->msystem->uid();
		else
			$uid = 0;
			
		$own = true;
		
		if((int)$fid > 0) {
			$uid = (int)$fid;
			$own = false;
		}
		
		$profile = $this->mprofile->getByField($uid,'uid');
		
		if(isset($profile))
		{
			$country = $this->mcountry->getById($profile->idcountry);
			
			$badgeearned = $this->mbadgeearned->getBadgeEarnedListforUser($uid);
			$friends = $this->mfriend->getFriendListforUser($uid);
			$age = $this->mprofile->getAge($uid);
			$events = $this->mevent->getEventListAttending($uid);
			
			$checkin->airport = "Perth Airport";// cambiar por la recuperacion de checkins
			
			$data['checkin'] = $checkin;
			$data['uid'] = $uid;
			$data['profile'] = $profile;
			$data['country'] = $country;
			$data['badgeearned'] = $badgeearned;
			$data['friends'] = $friends;
			$data['age'] = $age->age;//VERIFICAR LA ZONA HORARIA
			$data['events'] = $events;
			$data['own'] = $own;// si es propietario del profile
			$data['count'] = $this->mfriend->getCountFriend($uid)->count;

			//SET MENU MEMBER
			$this->session->set_userdata('optionmember','0');
			
			//get_layout()->enabled(false);
			get_layout()->set("showmenumember",true);
			$this->load->view('front/profile/view',$data);
/*		}else{
			//SET MENU MEMBER
			$this->session->set_userdata('optionmember','0');
			
			//get_layout()->enabled(false);
			get_layout()->set("showmenumember",true);
			$this->load->view('front/profile/view');*/
		}
    }

}
