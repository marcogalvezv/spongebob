<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		//to avoid issues with the last PHP version
		date_default_timezone_set('America/Los_Angeles');
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		$this->load->helper("array");
		$this->load->helper("layout");
		
        $this->load->model('Usermodel', 'user');
		
		$this->load->model('Systemmodel', 'system');
        $this->load->model('Persistencemodel', 'persistence');
        $this->load->model("Profilemodel","profile");
		$this->load->model("Membermodel","member");
		$this->load->model("Addressmodel","address");
		$this->load->model("Citymodel","mcity");
		//$this->load->model("Creditmodel","mcredit");
		//$this->load->model("Debitmodel","mdebit");
		
        $this->load->library('session');
        $this->load->helper('cookie');
		$this->load->helper('phpmailer');


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

		//GET CITY ON SESSION
		$user = $this->session->userdata('city');
		if(empty($city)){
			$city = 'cochabamba';//santa-cruz o la-paz
		}		
		//SET CITY ON SESSION
		$this->session->set_userdata('city',$city);
		
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
        redirect('admin/user/login');
    }
	
    function register() 
    {
        $this->load->helper(array('form'));
		get_layout()->set("showbg",true);
		
		$data = false;
		
		//NEW FRONT-END LAYOUT
		get_layout()->add_javascripts('user');
		
		$commit = TRUE;
		
		if($_POST){
			//GET USER ARRAY
			$user = $this->input->post("user", true);
			//GET PROFILE ARRAY
			$profile = $this->input->post("profile", true);
			
			$existsuser = $this->user->getByfield($user['username'],'username');
			
			if($existsuser)
            {
				$this->session->set_flashdata('message', lang('front.page.user.register.error1'));
                redirect('user/register');
			}
			
			$existsprofile = $this->profile->getByfield($user['username'],'email');
			
			if($existsprofile)
            {
				$this->session->set_flashdata('message', lang('front.page.user.register.error2'));
                redirect('user/register');
			}
			
			$user['gid'] = "2";
			$profile['type'] ="member";

			$city = $this->session->userdata('city');

			//echo "<pre>"; 
			//print_r($city); 
			//echo "</pre>";
			
			$citydata = $this->mcity->getByField($city , 'uri');
			
			//echo "<pre>"; 
			//print_r($citydata); 
			//echo "</pre>";
			//exit;
			
			//Bolivia by default
			$profile['idcountry'] = 1;
			
			//fix this by the current city
			$profile['idcity'] = $citydata->id;
			
			//COMPLETE DATAS IN PROFILE
			if(!isset($profile['email']))
				$profile['email'] = $user['username'];

			//BEGIN TRANSACTION
			$this->db->trans_begin();
			
			$expires = date("Y-m-d H:i:s",strtotime("+1 year"));
			$user['expiration'] = $expires;
			
			//REGISTER USER WITH TYPE
			$user = $this->user->register($user, $profile['type'], false);
			if (!$user) {
				$commit = FALSE;
			}	
			//SET UP THE USER REQUIRED FIELDS INTO PROFILE AND SUBSCRIPTION
			$profile['uid'] = $user['id'];
			
			/*
			echo "<pre>";
			print_r($profile);
			echo "</pre>";
			*/
			$pid = $this->profile->save($profile);
			if(!$pid){
				$commit = FALSE;
			}

			//ROLLBACK/COMMIT
			if(($this->db->trans_status()=== FALSE) || !$commit) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('message', lang('front.page.user.register.error3'));
                redirect('user/register');
				return false;
			} else {
				$this->db->trans_commit();
				$this->user->start_activation($user, $profile);
				$this->load->view('user/registration_success');
				return true;
			}
		} else {
			$this->load->view('user/register');
		}
    }    
	
    function signup() 
    {
        $this->load->helper(array('form'));
		get_layout()->set("showbg",true);
		//$this->load->config("survey");
		
		$data = false;
		
		get_layout()->add_javascripts('user');
		
		$commit = TRUE;
		
		//$states = $this->system->getstates();
		//$countrylist = $this->system->getcountrylist();
		//$types = array("member" => "Member", "vendor" => "Vendor");
		$types = array("member" => "Member");
		
		if($_POST){
			//GET USER ARRAY
			$user = $this->input->post("user", true);
			//GET PROFILE ARRAY
			$profile = $this->input->post("profile", true);
			
			//BEGIN TRANSACTION
			$this->db->trans_begin();
			
			$expires = date("Y-m-d H:i:s",strtotime("+1 year"));
			$user['expiration'] = $expires;
			
			//GET USER PASSWORD
			if(!isset($user['created'])){
				$created = date("Y-m-d H:i:s");
				$user['created'] = $created;
				$profile['created'] = $created;
			}
			//GET USER PASSWORD
			if(!isset($user['password'])){
				$user['password'] = $this->user->get_password($user);
				//SET PASSWORD
				$this->session->set_userdata('usernewdata',$user['password']);
			}
				
			//REGISTER USER WITH TYPE
			$user = $this->user->register($user, $profile['type'], false);
			if (!$user) {
				$commit = FALSE;
			}	
			//SET UP THE USER REQUIRED FIELDS INTO PROFILE AND SUBSCRIPTION
			$profile['uid'] = $user['id'];
			
			/*
			echo "<pre>";
			print_r($profile);
			echo "</pre>";
			*/
			$pid = $this->profile->save($profile);
			if(!$pid){
				$commit = FALSE;
			}
			
			//ROLLBACK/COMMIT
			if(($this->db->trans_status()=== FALSE) || !$commit) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('message', '<p class="error">Error on user register transaction, please try again or contact the helpdesk.</p><br /><br />');
				redirect('user/register');
				return false;
			} else {
				$this->db->trans_commit();
				$this->user->start_activation($user, $profile);
				$this->load->view('user/registration_success');
				return true;
			}
		}
		else
		{
//			get_layout()->enabled(false);

//			$this->load->view('user/signup',compact('countrylist', 'states' ,'types' ,'terms'));
			$this->load->view('user/signup');
		}
    }    
	
    function ajaxloginFB() {
		get_layout()->enabled(false);
		$commit = TRUE;
		
		//remove the FB ignited 
		//$fb_user = $this->fb_ignited->fb_get_me(false);
		
		if($_POST){
			//GET FACEBOOK DATA
			$idfacebook = $this->input->post("uid", true);
			$username = $this->input->post("username", true);
			$first_name = $this->input->post("first_name", true);
			$last_name = $this->input->post("last_name", true);
			$email = $this->input->post("email", true);
			
			//user facebook already exists ?
			$userFB = $this->user->getByField($idfacebook,'idfacebook');
			
			//echo "<pre>";
			//print_r($userFB);
			//print_r($userFB->id);
			//print_r($userFB->idfacebook);
			//echo "</pre>";
			
			//already exists
			if((isset($userFB)) && (!empty($userFB))){
				
				//create the user ID session
				$this->system->loginById($userFB->id);
				
				//save the id facebook to session
				$this->system->set_idfacebook($idfacebook);

				
				$success = TRUE;
				$message = "Success: User already exists nothing to do.";
				$json = array(
					'redirect' => 'current',
					'success' => $success,
					'message' => $message
				);
				echo json_encode($json);
				return false;
				//redirect('/welcome');
			}
			
			//user facebook already exists by email
			$userexists = $this->user->getByField($email,'username');
			//already exists
			if((isset($userexists)) && (!empty($userexists))){


				$user['id'] = $userexists->id;
				$user['idfacebook'] = $idfacebook;
				
				$uid = $this->user->save($user);
				
				//get profile
				$profileexists = $this->profile->getByField($userexists->id,'uid');
				
				//SET PROFILE ARRAY
				$profile = array();
				$profile['id'] = $profileexists->id;
				$profile['firstname'] = $first_name;
				$profile['lastname'] = $last_name;
				$profile['avatar'] = "http://graph.facebook.com/{$username}/picture?width=20&height=20";
				
				$pid = $this->profile->save($profile);
				
				//create the user ID session
				$this->system->loginById($userexists->id);
				
				//save the id facebook to session
				$this->system->set_idfacebook($idfacebook);

				
				$success = TRUE;
				$message = "Success: User already exists updating idfacebook and login.";
				$json = array(
					'redirect' => 'current',
					'success' => $success,
					'message' => $message
				);
				echo json_encode($json);
				return false;
				//redirect('/welcome');
			}

			//////////////////////////////////
			//IN CASE OF A NEW USER
			//////////////////////////////////
			
			//SET USER ARRAY
			$user = array();
			$user['gid'] = 2;//MEMBER
			$user['username'] = $email;
			$user['idfacebook'] = $idfacebook;
			
			//SET PROFILE ARRAY
			$profile = array();
			$profile['type'] = 'member';
			$profile['firstname'] = $first_name;
			$profile['lastname'] = $last_name;
			$profile['email'] = $email;
			$profile['avatar'] = "http://graph.facebook.com/{$username}/picture?width=20&height=20";
			//$profile['avatar'] = "http://graph.facebook.com/{$username}/picture";
			$profile['idcountry'] = 1;//BOLIVIA
			
			$city = $this->session->userdata('city');
			
			$citydata = $this->mcity->getByField($city , 'uri');
			//fix this by the current city
			$profile['idcity'] = $citydata->id;

			
			//BEGIN TRANSACTION
			$this->db->trans_begin();
			
			$expires = date("Y-m-d H:i:s",strtotime("+1 year"));
			$user['expiration'] = $expires;
			
			//GET USER PASSWORD
			if(!isset($user['created'])){
				$created = date("Y-m-d H:i:s");
				$user['created'] = $created;
				$profile['created'] = $created;
			}
			//GET USER PASSWORD
			if(!isset($user['password'])){
				$user['password'] = $this->user->get_password($user);
				//SET PASSWORD
				$this->session->set_userdata('usernewdata',$user['password']);
			}
				
			//REGISTER USER WITH TYPE
			$user = $this->user->register($user, $profile['type'], false);
			if (!$user) {
				$commit = FALSE;
			}	
			//SET UP THE USER REQUIRED FIELDS INTO PROFILE AND SUBSCRIPTION
			$profile['uid'] = $user['id'];
			
			/*
			echo "<pre>";
			print_r($profile);
			echo "</pre>";
			*/
			$pid = $this->profile->save($profile);
			if(!$pid){
				$commit = FALSE;
			}

			if(($this->db->trans_status()=== FALSE) || !$commit) {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record user save process. Please contact support center.";
			} else {
				//create the login user ID session after create the user
				$this->system->loginById($user['id']);
				
				//save the id facebook to session
				$this->system->set_idfacebook($idfacebook);

				$this->db->trans_commit();
				$success = TRUE;
				$message = "Success: User record saved successfully.";
			}
			$json = array(
				'redirect' => 'current',
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
		else
		{
			$success = FALSE;
			$message = "ERR002: Something went wrong on the record user save process. Please contact support center.";
			
			$json = array(
				'redirect' => 'current',
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	
	function complete($mid = false) 
    {
		
        $this->load->helper(array('form'));
		get_layout()->set("showbg",true);
		$this->load->config("survey");
		
		$data = false;
		$terms = $this->load->view('static/terms', $data, TRUE);
		
		
		get_layout()->add_javascripts('jquery/jquery-ui-1.7.2');
		get_layout()->add_stylesheets('jquery-ui');
		
		//VALIDATE
		get_layout()->add_javascripts('jquery/jquery.metadata');
		get_layout()->add_javascripts('jquery/jquery.validate');
		get_layout()->add_stylesheets('validate');
		get_layout()->add_javascripts('user');
		
		$commit = TRUE;
		
		$states = $this->system->getstates();
		$countrylist = $this->system->getcountrylist();
		//$types = array("member" => "Member", "vendor" => "Vendor");
		$types = array("member" => "Member");
		
		if($_POST){
			//GET USER ARRAY
			$user = $this->input->post("user", true);
			//GET PROFILE ARRAY
			$profile = $this->input->post("profile", true);
			
			//BEGIN TRANSACTION
			$this->db->trans_begin();
			
			$expires = date("Y-m-d H:i:s",strtotime("+1 year"));
			$user['expiration'] = $expires;
			
			//REGISTER USER WITH TYPE
			$user = $this->user->register($user, $profile['type'], false);
			if (!$user) {
				$commit = FALSE;
			}	
			//SET UP THE USER REQUIRED FIELDS INTO PROFILE AND SUBSCRIPTION
			$profile['uid'] = $user['id'];
			
			/*
			echo "<pre>";
			print_r($profile);
			echo "</pre>";
			*/
			$pid = $this->profile->save($profile);
			if(!$pid){
				$commit = FALSE;
			}
			
			//ROLLBACK/COMMIT
			if(($this->db->trans_status()=== FALSE) || !$commit) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('message', 'Error on user register transaction, please try again or contact the helpdesk.');
				redirect('user/complete/'.$pid);
				return false;
			} else {
				$this->db->trans_commit();
				$this->user->start_activation($user, $profile);
				$this->load->view('user/registration_success');
				return true;
			}
		}
		else
		{
			if(!$mid) redirect('user/register');
			$profile = $this->member->getById($mid);
			$this->load->view('user/complete',compact('profile','countrylist', 'states' ,'types' ,'terms'));
		}
    }
		
    function login() {
		
		if($_POST)
        {
            //GET USER ARRAY
			$user = $this->input->post("user");
			$remember = (int)$this->input->post('remember');
            unset($_POST['remember']);
			
            $exist = $this->user->getByfield($user['username'],'username');
			
			
			if(!$exist)
            {
				$this->session->set_flashdata('message', lang('front.page.user.login.error1'));
                redirect('admin/user/login');
			}
			
			if($exist->gid == 1)
            {
				$this->session->set_flashdata('message', lang('front.page.user.login.error1'));
                redirect('admin/user/login');
			}
			
			$tempuser = $this->user->getByfield($user['username'],'username');
			
			if(isset($tempuser->activation_code) && $tempuser->activation_code != "")
            {
				$this->session->set_flashdata('message', lang('front.page.user.login.error2'));
                redirect('admin/user/login');
			}
			
			$userlogged = $this->user->login_check($user, false);
            if($userlogged)
            {
                $this->system->login($userlogged);
                // remove all expired persistence keys for this user
                $this->persistence->remove_expired_keys($this->session->userdata('uid'));
                // create persistence cookie if necessary
                if ($remember === 1) {
                	$current_time = time();
                	$data = array(	'uid' => $this->session->userdata('uid'),
									'ip'        => sha1($_SERVER['REMOTE_ADDR']),
									'unique_id' => uniqid('rrx', true),
									'time'      => $current_time 
									);
                	$persistence_data_id = $this->persistence->insert_persistence_key($data);              
                	if($persistence_data_id > 0){
                		$this->session->set_userdata('key_id', $persistence_data_id);
						$this->system->_create_persistence_cookie($data);
                	}           
                }
				
				$tempusercomplete = $this->user->complete($tempuser);
/*echo "<pre>";
print_r($tempusercomplete);
echo "</pre>";*/
//                redirect('/');
                redirect($tempusercomplete->group->homepage);
            }
            else
            {
				$this->session->set_flashdata('message', lang('front.page.user.login.error3'));
                redirect('admin/user/login');
            }
        } else {
			$this->load->view('admin/user/login');
		}
    }
    
    function terms()
    {
    	$this->load->view('static/terms');
    }

    function logout()
    {
        $this->system->remove_persistence_data();
    	$this->system->logout();
    	$this->system->logoutFB();
		$this->session->sess_destroy();
		
//////USER FB
//		fb_destroySession();
//        redirect('user/login');
        redirect('/');
    }

    function activate($uid, $activation_code)
    {
        $activated = $this->user->activate($uid, $activation_code);
        if ($activated) {
            $this->load->view('user/activation_success');
        } else {
			redirect('/');
			//redirect('home');
		}
    }
	
    function activatetest() 
    {
		$this->load->view('user/activation_success');
    }
	
    function registertest() 
    {
		$this->load->view('user/registration_success');
    }
	
    function forgottest() 
    {
		$this->load->view('user/forgot_success');
    }

    function forgot() 
    {	
		if($_POST){
			//GET USER ARRAY
			$profile = $this->input->post("profile", true);
			
			//RETRIEVE PROFILE DATA BY EMAIL
			$profile = $this->profile->getByField($profile['email'], 'email');
			
			if($profile){
				if (!is_array($profile) && is_object($profile)) { $profile = get_object_vars($profile); }
				$user = $this->user->getById($profile['uid']);
				if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
			} else {
				$this->session->set_flashdata('message', lang('front.page.user.forgot.error1'));
				redirect('user/forgot');
			}
			/*
			echo "<pre>";
			print_r($user);
			echo "</pre>";
			*/
			//RESET PASSWORD AND SAVE
			$user = $this->user->forgot_password($user, false);
			
			if ($user) 
			{
				$data = array();
				$data = array_merge($user, $profile);
				if(isset($user['activation_code']) && $user['activation_code'] != "")
				{
					unset($user['newpassword']);
					$this->user->start_activation($user, $profile);
				}
				
				$this->user->forgot_password_mail($data);
				$this->load->view('user/forgot_success');
			}
			else 
			{
				$this->session->set_flashdata('message', '<p class="error">Something went wrong on the user record, please try again or contact the helpdesk.</p><br /><br />');
			}
		}
		else
		{
			$this->load->view('user/forgot');
		}
    }
	
	/**
	 * Change the current password to a new one chossen by the user
	 */
	function loadnewpassword() {
		get_layout()->enabled(FALSE);
        $this->load->helper(array('form'));
		$uid = $this->session->userdata('uid');
		$user = $this->user->getById($uid);
//		echo $this->load->view('user/newpassword',compact('uid'), TRUE);
		echo $this->load->view('admin/user/view',compact('uid','user'), TRUE);
    }	
	
	function loadnewpasswordshop() {
		get_layout()->enabled(FALSE);
        $this->load->helper(array('form'));
		$uid = $this->session->userdata('uid');
		$user = $this->user->getById($uid);
//		echo $this->load->view('user/newpassword',compact('uid'), TRUE);
		echo $this->load->view('shop/user/view',compact('uid','user'), TRUE);
    }	
	
	/**
	 * Change the current password to a new one chossen by the user
	 */
	function savepassword() {
        get_layout()->enabled(FALSE);
		$uid = $this->session->userdata('uid');
		//$uid = $this->system->uid();
		
		if($_POST){
			//GET USER ARRAY
			$user = $this->input->post("user", true);
			$user['id'] = $uid;
			
			//UPDATE PASSWORD AND SAVE
			$result = $this->user->updatepassword($user, false);
	        if ($result){            
	            $success = TRUE;
				$message = "Success: Password updated successfully";
	        } else {
	            $success = FALSE;
			    $message = "Error: Something was wrong on update password.";    
	        }
			$json = array(
		        'success' => $success,
		        'message' => $message
			);
			echo json_encode($json);
		}
    }
		
	function password_check() 
    {
		get_layout()->enabled(FALSE);
		$password = $this->input->post("password", true);
		$uid = $this->session->userdata('uid');
		$user = $this->user->authenticate_user($uid, $password);

        if ($user) {
            $res = true; 
		} else {
			$res = false;
		}
        echo json_encode($res);
    }    
	
	function emailcheck() 
	{
		get_layout()->enabled(FALSE);
		$email = $this->input->post("email", true);
		$exists = $this->profile->getByField($email, 'email');

        if ($exists) {
            $res = true; 
		} else {
			$res = false;
		}
        echo json_encode($res);
    }	
	
	function usernamecheck() 
	{
		get_layout()->enabled(FALSE);
		$username = $this->input->post("username", true);
		$exists = $this->user->getByField($username, 'username');

        if ($exists) {
            $res = true; 
		} else {
			$res = false;
		}
        echo json_encode($res);
    }

    function ajaxlogin() {
//		get_layout()->set_layout("layout/front");
        $this->load->helper(array('form'));
//		get_layout()->add_stylesheets('login');
		//VALIDATE
		
/*		get_layout()->add_javascripts('jquery/jquery.metadata');
		get_layout()->add_javascripts('jquery/jquery.validate');
		get_layout()->add_stylesheets('validate');
*/		
		if($_POST)
        {
            //GET USER ARRAY
			$user = $this->input->post("user");
			$remember = (int)$this->input->post('remember');
            unset($_POST['remember']);

            $exist = $this->user->getByfield($user['username'],'username');
			
			if(!$exist)
            {
				$this->session->set_flashdata('message', 'The username does not exist, please try again.');
                redirect('admin/user/login');
			}
			
			$tempuser = $this->user->getByfield($user['username'],'username');
			
			if(isset($tempuser->activation_code) && $tempuser->activation_code != "")
            {
				$this->session->set_flashdata('message', 'The user is INACTIVE please activate the user account first and try again.');
                redirect('admin/user/login');
			}
			
			$userlogged = $this->user->login_check($user, false);
            if($userlogged)
            {
                $this->system->login($userlogged);
                // remove all expired persistence keys for this user
                $this->persistence->remove_expired_keys($this->session->userdata('uid'));
                // create persistence cookie if necessary
                if ($remember === 1) {
                	$current_time = time();
                	$data = array(	'uid' => $this->session->userdata('uid'),
									'ip'        => sha1($_SERVER['REMOTE_ADDR']),
									'unique_id' => uniqid('rrx', true),
									'time'      => $current_time 
									);
                	$persistence_data_id = $this->persistence->insert_persistence_key($data);              
                	if($persistence_data_id > 0){
                		$this->session->set_userdata('key_id', $persistence_data_id);
						$this->system->_create_persistence_cookie($data);
                	}           
                }

				//print_r($userlogged->group);
                //redirect($userlogged->group->homepage);
                redirect($userlogged->group->homepage);
				
/*				$success = TRUE;
				$json = array(
					'success' => $success
				  );
				echo json_encode($json);*/
            }
            else
            {
				$success = FALSE;
	            $this->session->set_flashdata('message', 'Wrong password, please try again.');
                redirect('admin/user/login');
            }
        } else {
			$this->load->view('admin/user/login');
		}
    }
}

