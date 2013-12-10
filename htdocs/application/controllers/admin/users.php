<?php 
class Users extends Membership {

	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('America/La_Paz');
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'es';//spanish
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);
		
		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
			$this->lang->load('admin',$language);
		}else{
			$this->lang->load('admin','es');
		}
		
        $this->load->model('systemmodel', 'msystem');
        $this->load->model('usermodel', 'muser');
        $this->load->model('usersocialmodel', 'musersocial');
        $this->load->model('profilemodel', 'mprofile');
		$this->load->model("countrymodel","mcountry");
		$this->load->model("citymodel","mcities");
        $this->load->model("addressmodel","maddress");
		//$this->load->helper("phpmailer");

        //DATATABLE
        //get_layout()->add_stylesheets('demo_table_jui');
        get_layout()->add_stylesheets('admin/mws-style.min');
        get_layout()->add_javascripts('jquery/jquery.dataTables');
        //JQUERY.STYLETABLE
        get_layout()->add_javascripts('styletable.jquery.plugin');
	}
	

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/users/view');
	}	
	
    function viewClient()
    {
        get_layout()->enabled(false);
        $this->load->view('admin/users/viewclient');
    }

    function viewCorporativo()
    {
        get_layout()->enabled(false);
        $this->load->view('admin/users/viewcorporativo');
    }

    function viewCompany()
    {
        get_layout()->enabled(false);
        $this->load->view('admin/users/viewcompany');
    }

	function listener() 
	{
        $table = 'v_userprofile';
        $columns = array('selected','uid','name','email','company','country','activated','status','signupdate','id');
        $index = 'id';
		get_layout()->enabled(false);
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);
        echo $data['result'];
    }
    
    function listenerClient ()
    {
        $options['custom_filter'] = "gid = '2'";
        $table = 'v_userprofile';
        $columns = array('selected','uid','name','email','company','country','activated','status','signupdate','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index, $options);
        //replacing in order to call the respective methods.
        $str = str_replace("v_userprofile_edit","v_userprofile_editclient",$data['result']);
        echo $str;
    }

    function listenerCorporativo ()
    {
        $options['custom_filter'] = "gid = '3'";
        $table = 'v_userprofile';
        $columns = array('selected','uid','name','email','company','country','activated','status','signupdate','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index, $options);
        //replacing in order to call the respective methods.
        $str = str_replace("v_userprofile_edit","v_userprofile_editcorporativo",$data['result']);
        echo $str;
    }

    function listenerCompany ()
    {
        $options['custom_filter'] = "gid = '3'";
        $table = 'v_company';
        $columns = array('selected','uid','name','rating','email','numtaxis','lat','lng','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);
        echo $data['result'];
    }

    function listenerClientEdit ($uid)
    {
       // $uid = $this->input->post('id');
        $options['custom_filter'] = "uid = '$uid'";
        $table = 'address';
        $columns = array('id','uid','lat','lng','address1','address2','phone','extension','idcity','state','zip','main','status');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index, $options);
        echo $data['result'];
    }

    function ajaxaddress()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');
        $data['cities'] = $this->mcities->getCityList()->result();
        if (isset($id))
        {
            // edit only
            if($id > 0){

                $address= $this->maddress->getById($id);
                //$profile = $this->mprofile->getByField($id,'uid');
                $data['address'] = $address;
                //$data['profile'] = $profile;
            }
        }
        $this->load->view('admin/users/address',$data);
    }

    function ajaxedit()
	{
		get_layout()->enabled(false);
		$id = $this->input->post('id');
		
		$data['countries'] = $this->mcountry->getCountryList()->result();
		$data['cities'] = $this->mcities->getCityList()->result();
		
		//echo "<pre>";
		//print_r($data['countries']);
		//echo "</pre>";
		
		$data['typedocs'] = array(
			'ID card',
			'Passport',
			'DNI',
			'Other'
		);
		
		// edit only
		if($id > 0){

			$user = $this->muser->getById($id);
			$profile = $this->mprofile->getByField($id,'uid');
			//echo "<pre>";
			//print_r($profile);
			//echo "</pre>";
			//$usersocial = $this->musersocial->getUserSocial($id);
			$data['user'] = $user;
			$data['profile'] = $profile;
			//$data['usersocial'] = $usersocial;
		}

		$this->load->view('admin/users/edit', $data);
	}

    function ajaxeditclient()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');

        $data['countries'] = $this->mcountry->getCountryList()->result();
        $data['cities'] = $this->mcities->getCityList()->result();

        $data['typedocs'] = array(
            'ID card',
            'Passport',
            'DNI',
            'Other'
        );

        // edit only
        if($id > 0){

            $user = $this->muser->getById($id);
            $profile = $this->mprofile->getByField($id,'uid');
            $data['user'] = $user;
            $data['profile'] = $profile;
        }
        $this->load->view('admin/users/editclient', $data);
    }

    function ajaxeditcorporativo()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');

        $data['countries'] = $this->mcountry->getCountryList()->result();
        $data['cities'] = $this->mcities->getCityList()->result();

        $data['typedocs'] = array(
            'ID card',
            'Passport',
            'DNI',
            'Other'
        );

        // edit only
        if($id > 0){

            $user = $this->muser->getById($id);
            $profile = $this->mprofile->getByField($id,'uid');
            $data['user'] = $user;
            $data['profile'] = $profile;
        }
        $this->load->view('admin/users/editcorporativo', $data);
    }

	function ajaxprofile()
	{
		get_layout()->enabled(false);
		$id = $this->input->post('id');
		
		$data['countries'] = $this->mcountry->getCountryList()->result();
		//$data['levels'] = $this->mlevels->getLevelsList()->result();
		
		// edit only
		if($id > 0){

			$user = $this->muser->getById($id);
			$profile = $this->mprofile->getById($id);
			$usersocial = $this->musersocial->getUserSocial($id);
			$data['user'] = $user;
			$data['profile'] = $profile;
			$data['usersocial'] = $usersocial;
		}

		$this->load->view('admin/users/profile', $data);
	}
	
	function login($uid)
	{
		get_layout()->enabled(false);
		
		$this->msystem->remove_persistence_data();
    	$this->msystem->logout();
		$this->session->sess_destroy();
		
		$user = $this->muser->getById($uid);
		$this->msystem->login($user);
		/*
		echo "<pre>";
		print_r($user);
		echo "</pre>";
		*/
		redirect('member/dashboard');
	}
	
	function ajaxstats()
	{
		get_layout()->enabled(false);
		$id = $this->input->post('id');
		$user = $this->muser->getById($id);
		$profile = $this->mprofile->getById($id);
		$usersocial = $this->musersocial->getUserSocial($id);
		
		$login = $this->muser->getlastLoginById($id);
		
		$user_stats = array();
		$user_stats['profile_views'] = $this->muser->getTotalViewsbyId($id);
		$user_stats['total_friends'] = $this->muser->getTotalFriendsbyId($id);
		$user_stats['last_update'] = $user->updated;
		$user_stats['joined'] = $user->created;
		$user_stats['joined_ip'] = $user->ipnumber;
		$user_stats['last_login'] = $login->lastlogin;
		$user_stats['last_login_ip'] = $login->lastlogin_ip;
		
		$user_stats['total_flights'] = $this->muser->getTotalFlightsbyId($id);
		$user_stats['current_flights'] = $this->muser->getTotalFlightsbyId($id, true);
		$user_stats['social_networks'] = $this->muser->getTotalSocialNetworksbyId($id); //implode(', ', $this->muser->getSocialNamesById($id));
		$user_stats['joined_events'] = $this->muser->getTotalEventsbyId($id);
		$user_stats['total_checkins'] = $this->muser->getTotalCheckinsbyId($id);
		$user_stats['total_badges'] = $this->muser->getTotalBadgesbyId($id);
		$user_stats['total_miles'] = $this->muser->getTotalMilesbyId($id);
		$user_stats['total_pm'] = $this->muser->getTotalPMbyId($id);
		$user_stats['total_wall_posts'] = $this->muser->getTotalWallPostsbyId($id);
		$user_stats['total_event_posts'] = $this->muser->getTotalEventPostsbyId($id);
		$user_stats['total_tickets'] = $this->muser->getTotalTicketsbyId($id);
		$user_stats['total_hotel_bookings'] = $this->muser->getTotalBookingsbyId($id);
		$user_stats['total_car_rentals'] = $this->muser->getTotalRentalsbyId($id);
		$user_stats['profile_describes_you'] = $profile->selfdesc;
		
		$data['user'] = $user;
		$data['usersocial'] = $usersocial;
		$data['user_stats'] = $user_stats;
		$data['profile'] = $profile;
		
		$this->load->view('admin/users/stats', $data);
	}

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$activate = FALSE;
			$error = FALSE;
			$updated = FALSE;
			$message = "";
			$user = $this->input->post("user", true);
			$profile = $this->input->post("profile", true);

            log_message("debug", "*********Data:" . print_r($user, true));
            log_message("debug", "*********Data:" . print_r($profile, true));
            //EDIT ONLY
			if(isset($profile['address1'])) {
				if ( get_magic_quotes_gpc() )
					$profile['address1'] = htmlspecialchars( stripslashes( $profile['address1'] ) ) ;
				else
					$profile['address1'] = htmlspecialchars( $profile['address1'] );
			}
            //Adding a check for user status, if it is not set the value should be 0
            if(isset($user['status']))
            {
                $user['status'] = $user['status']=="on" ? 1 : 0;
            }
            else
            {
                 $user['status'] = 0;
            }

			//NEW
			if (!isset($user['id'])){
				//$user = $this->muser->register($user, 'member');
				$uid = $this->muser->save($user);
				//UPDATE PASSWORD AND SAVE
				$user['id'] = $uid;

				$user = $this->muser->updatepassword($user);

				if($user) {				
					$profile['uid'] = $uid;
					$activate = TRUE;
				}


			} else {
				$uid = $this->muser->save($user);
				if(isset($user['password']) && !empty($user['password'])){
					$req = $this->muser->updatepassword($user);
					$mailstatus = $this->muser->change_password_email($user, $profile);
					if($mailstatus !== TRUE) {
						$error = "Error: {$mailstatus}";
						$message = "Something went wrong on the change password email: {$error}. Please contact support.";
					}
				}
			}
			
			//SOCIAL NETWORKS
			//$socialstate = $this->musersocial->update($uid, $usersocial);
			
			//NEW
			if (!isset($profile['id'])){
				$profile['created'] = date("Y-m-d H:i:s");
				$updated = TRUE;
			}
			
			
			$pid = $this->mprofile->save($profile);
			
			if($pid && !$error){
				//NEW
				if($activate){
					$mailstatus = $this->muser->member_activation_email($user, $profile);
					if($mailstatus === TRUE) {
						$error = FALSE;
						$message = "Success: member created successfully.";
						
					} else {
						$error = TRUE;
						$errormsg = "Error: {$mailstatus}";
						$message = "{$errormsg}. Please try again or contact support.";
					}
				} else {
					$error = FALSE;
					$message = "Success: member updated successfully.";
                    $mailstatus = $this->muser->change_field_email($user,$profile);
                    if($mailstatus !== TRUE) {
                        $error = "Error: {$mailstatus}";
                        $message = "Something went wrong on the change information email: {$error}. Please contact support.";
                    }
				}
			} else {
				$error = TRUE;
				$errormsg = "Error: Error on save member profile record";
				$message = "{$errormsg}. Please try again or contact support.";
			}
			
			if(!$error){
				$success = TRUE;
			} else {
				$success = FALSE;
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );

            log_message("debug","*****".print_r($json,true));
			echo json_encode($json);
		}
    }

    function ajaxsaveaddress()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $activate = FALSE;
            $error = FALSE;
            $updated = FALSE;
            $message = "";
            $address = $this->input->post("address", true);
            //NEW
            if (!isset($address['id'])){

                $id = $this->maddress->save($address);

            } else {
                $uid = $this->maddress->save($address);

            }




            if(!$error){
                $success = TRUE;
            } else {
                $success = FALSE;
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }
		
	
	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST)
		{
			$id = $this->input->post('id');
			$req = $this->muser->deleteById($id);

			if ($req){
				$success = TRUE;
				$message = "Success: user record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }

    function ajaxblock()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $id = $this->input->post('id');
            //setting to block status
            $status = 0;
            $req = $res = $this->muser->changeStatus($id,$status);

            if ($req){
                $success = TRUE;
                $message = "Success: user record delete successfully.";
            } else {
                $success = FALSE;
                $message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }
    function ajaxunblock()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $id = $this->input->post('id');
            //setting to unblock status
            $status = 1;
            $req = $res = $this->muser->changeStatus($id,$status);

            if ($req){
                $success = TRUE;
                $message = "Success: user record delete successfully.";
            } else {
                $success = FALSE;
                $message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }

	function ajaxdeletebulk()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$error = FALSE;
			$users = $this->input->post('users');
			
			if(!empty($users)) {
				foreach($users as $id) {
					$res = $this->muser->deleteById($id);
					if(!$res) {
						$error = TRUE;
						break;
					}
				}
			}
			
			if (!$error){
				$success = TRUE;
				
				if(!empty($users)) {
					$message = "members deleted successfully.";
				} else {
					$message = "Please select at least one record to delete.";
				}
			} else {
				$success = FALSE;
				$message = "Something went wrong on the members delete operation. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	
	function ajaxstatusbulk()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$error = FALSE;
			$warning = FALSE;
			$users = $this->input->post('users');
			$status = $this->input->post('status');
			$statustext = 'blocked';
			$statusop = 'block';
			
			if($status) {
				$statustext = 'approved';
				$statusop = 'approve';
			}
			
			if(!empty($users)) {
				foreach($users as $id) {
					$user = array();
					$user['id'] = $id;
					$user['status'] = (int)$status;
					$res = $this->muser->save($user);
					if(!$res) {
						$error = TRUE;
						break;
					}
				}
			} else {
				$warning = TRUE;
				$error = TRUE;
			}
			
			if (!$error){
				$success = TRUE;
				$message = "members {$statustext} successfully.";
			} else {
				$success = FALSE;
				$message = "Something went wrong on the members {$statustext} operation. Please contact support center.";
				if($warning)
					$message = "Please select at least one record to {$statusop}.";
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */