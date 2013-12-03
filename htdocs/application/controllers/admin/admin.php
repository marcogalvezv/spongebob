<?php 
class Admin extends Membership {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");
		
		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'en';//spanish
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);
		
		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
			$this->lang->load('admin',$language);
		}else{
			$this->lang->load('admin','en');
		}
		
        $this->load->model('systemmodel', 'msystem');
        $this->load->model('usermodel', 'muser');
/*        $this->load->model('usersocialmodel', 'musersocial');
        $this->load->model('profilemodel', 'mprofile');
		$this->load->model("countrymodel","mcountry");
		$this->load->model("levelsmodel","mlevels");
		$this->load->helper("phpmailer");*/
	}
	

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/admin/options');
	}	

	function ajaxoptions()
	{
		get_layout()->enabled(false);

		$this->load->view('admin/admin/options');
	}
	
	function ajaxsecurity()
	{
		get_layout()->enabled(false);

		$this->load->view('admin/admin/security');
	}

}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */