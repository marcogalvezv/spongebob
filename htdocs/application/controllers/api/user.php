<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php'); 

class User extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		//to avoid issues with the last PHP version
		date_default_timezone_set('America/Los_Angeles');
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		
		//load models and helpers
        $this->load->model('Usermodel', 'user');
		$this->load->model("Profilemodel","profile");
		$this->load->helper("layout");
		$this->load->helper('phpmailer');
		
		//load library
        $this->load->library('session');
		
		
		//layout disabled by default
		get_layout()->enabled(false);
	}
	

	function index()
	{  
		$this->response(NULL, 404);
	}

	function helloworld_post() {
		// Check for required parameters
		if ($_POST) {
		
			$name = $this->input->post('name');
			
			if(!$name) {
				$this->response(array('error' => 'Name cannot be found'), 404);
				return false;
			}
						
			// Return unlock code, encoded with JSON
			$result = array(
				"result" => "Hello $name!",
			);

			$this->response($result, 200); // 200 being the HTTP response code			
			
			//sendResponse(200, json_encode($result));
			return true;
		} else {
			$this->response(NULL, 404);
		}
		return false;
	}
	
			
    function login_post() {
		
		if($_POST)
        {
            //GET USER ARRAY
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			
			if($username == "admin")
            {
                $this->response(array('error' => 'El administrador no puede hacer login mediante el API por seguridad.'), 404);
				return false;
			}
			
            $checkuser = $this->user->getByfield($username,'username');
			
			if(!$checkuser)
            {
                $this->response(array('error' => 'El usuario no existe, favor registrarse.'), 404);
				return false;
			}
			
			if(isset($checkuser->activation_code) && $checkuser->activation_code != "")
            {
				$this->response(array('error' => 'El usuario esta inactivo, favor activar primero mediante el email de activacion.'), 404);
				return false;
			}
			
			$data['username'] = $username;
			$data['password'] = $password;
			
			$user = $this->user->login_check($data, false);
			
            if($user)
            {
				// Return unlock code, encoded with JSON
				$result = array(
					"response" => "Inicio de Session Exitoso!",
					"uid" => $user->id,
					"user" => $user
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
            }
            else
            {
	            $this->response(array('error' => 'El password es incorrecto, intente de nuevo.'), 404);
            }
        } else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }
	
	function signup_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			//GET USER DATA
			$username = $this->input->post("username", true);
			$password = $this->input->post("password", true);
			
			//GET PROFILE DATA
			$email = $this->input->post("email", true);
			$firstname = $this->input->post("firstname", true);
			$lastname = $this->input->post("lastname", true);
			
			//username = email
			if(empty($username)) $username = $email;
            			
            $checkuser = $this->user->getByfield($username,'username');
			
			if($checkuser)
            {
                $this->response(array('error' => 'El usuario ya existe, intentar con otro.'), 404);
				return false;
			}
			
			$checkprofile = $this->profile->getByfield($email,'email');
			
			if($checkprofile)
            {
                $this->response(array('error' => 'El email ya existe, intentar con otro.'), 404);
				return false;
			}
			
			$user['username'] = $username;
			$user['password'] = $password;
			
			$profile['email'] = $email;
			//$profile['type'] = 'client';
			$profile['firstname'] = $firstname;
			$profile['lastname'] = $lastname;
			
			//BEGIN TRANSACTION
			$this->db->trans_begin();
			
			//$expires = date("Y-m-d H:i:s",strtotime("+1 year"));
			//$user['expiration'] = $expires;
			
			//GET USER PASSWORD
			if(!isset($user['created'])){
				$created = date("Y-m-d H:i:s");
				$user['created'] = $created;
				$profile['created'] = $created;
			}
			
			$email = $profile['email'];
			$default = ""; // link to your default avatar
			$size = 20; // size in pixels squared
			//$gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size;
			$gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&default=" . urlencode($default);
			$avatar = $gravatar;
			
			$profile['avatar'] = $avatar;
			
			//SET COUNTRY TO BOLIVIA 
			if(!isset($profile['idcountry'])){
				$profile['idcountry'] = 1;
			}
			
			//Cochabamba by the first time
			$profile['idcity'] = 1;

				
			//REGISTER USER/PROFILE 
			$user = $this->user->register($user, false);
			if (!$user) {
				$commit = FALSE;
			} else {
				//SET UP THE USER REQUIRED FIELDS INTO PROFILE AND SUBSCRIPTION
				$profile['uid'] = $user['id'];
				$pid = $this->profile->save($profile);
				if(!$pid){
					$commit = FALSE;
				}
			}
			
			//ROLLBACK/COMMIT
			if(($this->db->trans_status()=== FALSE) || !$commit) {
				$this->db->trans_rollback();
				$this->response(array('error' => 'Error en transaccion de registro de usuario.'), 404);
				return false;
			} else {
				$this->db->trans_commit();
				$emailsent = $this->user->start_activation($user, $profile);
				// Return unlock code, encoded with JSON
				$result = array(
					"response" => "Registrado Exitosamente",
					"uid" => $user['id'],
					"user" => $user
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
				
			}
			
		} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }
	
	function signupfacebook_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			//GET FACEBOOK DATA
			$idfacebook = $this->input->post("idfacebook", true);
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
			
			//facebook user already exists
			if((isset($userFB)) && (!empty($userFB))){
				// Return  encoded with JSON
				$result = array(
					"response" => "Inicio de Sesion Exitoso!",
					"uid" => $userFB->id,
					"user" => $userFB
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
			}
			
			//user facebook already exists by email so just update the basic settings like the avatar, firstname, lastname
			$userexists = $this->user->getByField($email,'username');
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
				//$profile['avatar'] = "http://graph.facebook.com/{$username}/picture?width=20&height=20";
				$profile['avatar'] = "http://graph.facebook.com/{$username}/picture";
				
				$pid = $this->profile->save($profile);
				
				// Return  encoded with JSON
				$result = array(
					"response" => "Inicio de Session Exitoso!",
					"uid" => $uid,
					"user" => $user
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
			}
			
			//////////////////////////////////
			//IN CASE OF A NEW USER
			//////////////////////////////////
			
			//SET USER ARRAY
			$user = array();
			$user['gid'] = 2;//CLIENT
			$user['username'] = $email;
			$user['idfacebook'] = $idfacebook;
			
			//SET PROFILE ARRAY
			$profile = array();
			//$profile['type'] = 'client';
			$profile['firstname'] = $first_name;
			$profile['lastname'] = $last_name;
			$profile['email'] = $email;
			$profile['avatar'] = "http://graph.facebook.com/{$username}/picture";
			//$profile['avatar'] = "http://graph.facebook.com/{$username}/picture?width=20&height=20";
			$profile['idcountry'] = 1;//BOLIVIA
			$profile['idcity'] = 1;
			
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
				
			//REGISTER USER WITH TYPE BY DEFAULT
			$user = $this->user->register($user, false);
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
				$this->response(array('error' => 'Error en transaccion de registro de usuario.'), 404);
				return false;
			} else {
				$this->db->trans_commit();
				$emailsent = $this->user->facebook_signup($user, $profile);
				// Return unlock code, encoded with JSON
				$result = array(
					"response" => "Registrado Exitosamente",
					"uid" => $user['id'],
					"user" => $user
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
				
			}
			
		} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }

    function credit_post() {
		
		if($_POST)
        {
            //GET USER ARRAY
			$code = $this->input->post("code");
			

			$credit = $this->user->activate_credit($code);
			if (!$credit) {
				$this->response(array('error' => 'Cannot activate the credit code.'), 404);
				return false;
			}
			
						
			$date = date("Y-m-d H:i:s");
			$credit['activated_date'] = $date;			
			$credit['debit_note'] = $code;
			
			//echo "<pre>";
			//print_r($credit);
			//echo "</pre>";
			


			//UPDATE PASSWORD AND SAVE
			$result = $this->mcredit->save($credit);
			
            if($user)
            {
				// Return unlock code, encoded with JSON
				$result = array(
					"response" => "Inicio de Session Exitoso!",
					"uid" => $user->id,
					"user" => $user
				);
				$this->response($result, 200); // 200 being the HTTP response code
				return true;
            }
            else
            {
	            $this->response(array('error' => 'Wrong password cannot login, please try again.'), 404);
            }
        } else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }
}

/* End of file user.php */
/* Location: ./application/controllers/api/user.php */