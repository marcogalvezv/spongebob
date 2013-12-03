<?php
class Membership extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel', 'user');
		$this->load->model('Systemmodel', 'system');
   		//SESSION CHECK LOGGED IN
    	if (!$this->session->userdata('uid'))
	    {
			if(	$this->uri->segment(1) == "radiotaxi"){
				redirect('radiotaxi/user/login');
			} else {
				redirect('user/login');
			}
			
	    }
	    
	    $user = $this->system->user(TRUE);
		if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
		$user = $this->user->usercomplete($user);
		/*
		echo "<pre>";
		print_r($user);
		echo "</pre>";
		*/

		if (!$this->validUserURI($user))
		{
			//echo "HELLO";
			redirect($user['group']['homepage']);
		}
	}
  
	function validUserURI($user)
	{
		$res = false;
		if(	ucfirst($this->uri->segment(1)) == $user['group']['name'] || 
			$this->uri->segment(1) == "user" ||
			$this->uri->segment(1) == "member" || 
			$this->uri->segment(1) == "farmacorp" || 
			$this->uri->segment(1) == "radiotaxi" ||
			$user['group']['name'] == "Admin") {
			$res = TRUE;
		}
		return $res;
	}	
}
 
?>