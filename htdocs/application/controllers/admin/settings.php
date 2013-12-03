<?php 
class Settings extends Membership {

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
		
		$this->load->model("settingsmodel","msettings");
	
	}
	
	function index()
	{		
		get_layout()->enabled(false);
		//$this->load->view('admin/shops/view');
	}	
	
	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$settings = $this->input->post("settings", true);
			
			$id = $this->msettings->save($settings);
			
				
			//VALID INVENTORY RECORD
			if ($id){
				$success = TRUE;
				$message = "Success: request record saved successfully.";
			} else {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record request save process. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/shop/inventory.php */