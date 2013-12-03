<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fblogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		
		// The fb_ignited library is already auto-loaded so call the user and app.
		$this->fb_me = $this->fb_ignited->fb_get_me(false);		
		$this->fb_app = $this->fb_ignited->fb_get_app();
		
		// This is a Request System I made to be used to work with Facebook Ignited.
		// NOTE: This is not mandatory for the system to work.
		if ($this->input->get('request_ids'))
		{
			$requests = $this->input->get('request_ids');
			$this->request_result = $this->fb_ignited->fb_accept_requests($requests);
		}
	}

	function index()
	{	
		$this->fb_me = $this->fb_ignited->fb_get_me(false);
		$data['me'] = $this->fb_me;
		
		$data['login_login'] = $this->fb_ignited->fb_login_url(false, 'email', false);
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
		$this->load->view('fblogin', $data);
	}

	function login()
	{
		$this->fb_me = $this->fb_ignited->fb_get_me(false);
		$data['me'] = $this->fb_me;
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		
		$this->load->view('fblogin', $data);

	}
	
	function logged()
	{	
		$this->fb_me = $this->fb_ignited->fb_get_me(false);
		if ($this->fb_me) {
			echo "Welcome back, {$this->fb_me['first_name']}!";
		}
		
		$data['me'] = $this->fb_me;
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	function test($type="")
	{	
		if (isset($this->request_result))
		{
			$content_data['error'] = $this->request_result;
		}
		if ($this->fb_me)
		{
			$content_data['me'] = $this->fb_me;
		}
		$content_data['last_status'] = $this->fb_ignited->api('/me/feed?limit=5');
		$content_data['fb_app'] = $this->fb_app;
		$content_data['login_login'] = $this->fb_ignited->fb_login_url(false, 'email', false);
		
		echo "<pre>";
		print_r($content_data);
		echo "</pre>";
		
		
		$this->load->view('welcome_facebook', $content_data);
	}
	/*
	function login($type="")
	{	
		if (isset($this->request_result))
		{
			$content_data['error'] = $this->request_result;
		}
		if ($this->fb_me)
		{
			$content_data['me'] = $this->fb_me;
		}
		$content_data['last_status'] = $this->fb_ignited->api('/me/feed?limit=5');
		$content_data['fb_app'] = $this->fb_app;
		$content_data['login_login'] = $this->fb_ignited->fb_login_url(false, 'email', false);
		
		echo "<pre>";
		print_r($content_data);
		echo "</pre>";
		
		
		$this->load->view('welcome_facebook', $content_data);
	}
	*/
	function view_feed() {
		
	}
	
	function callback()
	{
		// This method will include the facebook credits system.
		$content_data['message'] = $this->fb_ignited->fb_process_credits();
		$this->load->view('fb_credits_view', $content_data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */