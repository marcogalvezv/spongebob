<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //to avoid issues with the last PHP version
//		date_default_timezone_set('America/Los_Angeles');
//
//		$this->load->add_package_path(DOMAINSPATH.'application/_common/');
//		$this->load->helper("array");
//		$this->load->helper("layout");
//
        $this->load->model('Usermodel', 'user');
//
        $this->load->model('Systemmodel', 'system');
//        $this->load->model('Persistencemodel', 'persistence');
//        $this->load->model("Profilemodel","profile");
//		$this->load->model("Membermodel","member");
//		$this->load->model("Addressmodel","address");
//		$this->load->model("Citymodel","mcity");
//
//        $this->load->library('session');
//        $this->load->helper('cookie');
//		$this->load->helper('phpmailer');
//
        ////////////////////////////////////
        //FRONT LAYOUT REQUIRED
        ///////////////////////////////////

        //LAYOUT ADMIN HTML5
        get_layout()->set_layout("layout/newadmin");
//
//		//CSS ADMIN HTML5
//		get_layout()->add_stylesheets('css3/admin');
//
//		//CSS LOGIN
//		get_layout()->add_stylesheets('login');
//
//		//JQUERY-UI  -- THEME SMOOTHNESS
//		get_layout()->add_stylesheets('jquery-ui/smoothness/jquery-ui-1.8.23.custom');
//
//		get_layout()->add_stylesheets('jquery.toastmessage');
//		get_layout()->add_javascripts('jquery/jquery.toastmessage');
//
//		//DATATABLE
//		get_layout()->add_stylesheets('demo_table_jui');
//		get_layout()->add_javascripts('jquery/jquery.dataTables');
//		//JQUERY.STYLETABLE
//		get_layout()->add_javascripts('styletable.jquery.plugin');
//
//		//get_layout()->add_javascripts('hideshow');
//		get_layout()->add_javascripts('jquery/jquery.tablesorter.min');
//		get_layout()->add_javascripts('jquery/jquery.equalHeight');
//		get_layout()->add_javascripts('jquery/jquery.metadata');
//
//		//validate
//		get_layout()->add_javascripts('jquery/jquery.validate');
//		get_layout()->add_stylesheets("validate");
//		//get_layout()->add_javascripts('jquery/jquery.validate.password');
//		//get_layout()->add_stylesheets("jquery.validate.password");
    }

    function index()
    {
        redirect('radiotaxi/user/login');
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


        $this->load->view('radiotaxi/user/login');
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

        redirect('/radiotaxi/user/login');
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
            $this->load->view('admin/user/forgot');
        }
    }

    /**
     * Change the current password to a new one chossen by the user
     */




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
        get_layout()->enabled(FALSE);
        $success = FALSE;
        $message = "";
        $redirectTo ="";

        if($_POST)
        {
            //GET USER ARRAY

            $user = $this->input->post("user");
           // $remember = (int)$this->input->post('remember');
           // unset($_POST['remember']);

            $exist = $this->user->getByfield($user['username'],'username');
            if(!$exist)
            {
                //TODO: change message to spanish
                $success = FALSE;
                $message = "The username does not exist, please try again.";
                $json = array(
                    'success' => $success,
                    'message' => $message,
                    'redirectTo' => $redirectTo
                );
                echo json_encode($json);
                exit(0);

            }

            $tempuser = $this->user->getByfield($user['username'],'username');

            if(isset($tempuser->activation_code) && $tempuser->activation_code != "")
            {
                $success = FALSE;
                $message = "The user is INACTIVE please activate the user account first and try again..";
                $json = array(
                    'success' => $success,
                    'message' => $message,
                    'redirectTo' => $redirectTo
                );
                echo json_encode($json);
                exit(0);
            }

            $userlogged = $this->user->login_check($user, TRUE);
            if($userlogged)
            {
                $this->system->login($userlogged);
                // remove all expired persistence keys for this user
                $this->persistence->remove_expired_keys($this->session->userdata('uid'));
                // create persistence cookie if necessary
//                if ($remember === 1) {
//                    $current_time = time();
//                    $data = array(	'uid' => $this->session->userdata('uid'),
//                        'ip'        => sha1($_SERVER['REMOTE_ADDR']),
//                        'unique_id' => uniqid('rrx', true),
//                        'time'      => $current_time
//                    );
//                    $persistence_data_id = $this->persistence->insert_persistence_key($data);
//                    if($persistence_data_id > 0){
//                        $this->session->set_userdata('key_id', $persistence_data_id);
//                        $this->system->_create_persistence_cookie($data);
//                    }
//                }
                $success = TRUE;
                $redirectTo = empty($userlogged->group->homepage) ? base_url() + "radiotaxi/dashboard" : $userlogged->group->homepage  ;

                $json = array(
                    'success' => $success,
                    'redirectTo' => $redirectTo
                );
                echo json_encode($json);
                exit(0);
            }
            else
            {
                $success = FALSE;
                $message = "Wrong Password";
                $json = array(
                    'success' => $success,
                    'message' => $message,
                );
                echo json_encode($json);
                exit(0);

            }
        }else
        {
            echo "NO POST DATA";
            exit(0);
        }
    }







    function profile()
    {
        //JQUERY-UI-ADDRESS
        get_layout()->add_javascripts('jquery/jquery.ui.addresspicker');
        get_layout()->add_stylesheets('jquery.ui.addresspicker');

        $uid = $this->session->userdata('uid');
        $profile = $this->profile->getByField($uid,'uid');
        $address = $this->address->getByField($uid,'uid');
        //echo "<pre>";
        //print_r($uid);
        //print_r($profile);
        //echo "</pre>";
        $data['profile'] = $profile;
        $data['address'] = $address;
        $this->load->view('user/profile', $data);
    }

    function ajaxupdateprofile() {
        get_layout()->enabled(false);
        $uid = $this->session->userdata('uid');
        $existprofile = $this->profile->getByField($uid,'uid');

        if($_POST){

            //GET POST DATA
            $profile = $this->input->post("profile", true);
            $profile['id'] = $existprofile->id;
            $profile['uid'] = $uid;

            /*
            echo "<pre>";
            print_r($profile);
            echo "</pre>";
            */
            $result = $this->profile->save($profile);

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

    function ajaxupdateaddress() {
        get_layout()->enabled(false);

        $uid = $this->session->userdata('uid');

        if($_POST){

            //GET POST DATA
            $address = $this->input->post("address", true);
            $address['uid'] = $uid;

            /*
            echo "<pre>";
            print_r($profile);
            echo "</pre>";
            */
            $result = $this->address->save($address);

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

    function ajaxupdatepassword() {
        get_layout()->enabled(false);

        if($_POST){
            //GET FACEBOOK DATA
            $password = $this->input->post("password", true);

            $uid = $this->session->userdata('uid');
            $user = $this->user->getById($uid);

            if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
            //GET USER PASSWORD
            $user['password'] = $password;

            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */

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

    function dashboard()
    {
        $this->load->view('user/dashboard');
    }
}

