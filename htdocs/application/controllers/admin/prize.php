<?php 
class Prize extends Membership {

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
		
        $this->load->model('usermodel', 'muser');
        $this->load->model('settingsmodel', 'msettings');
/*        $this->load->model('faqmodel', 'mfaq');
        $this->load->model('newsmodel', 'mnews');
        $this->load->model('systemmodel', 'msystem');*/
        $this->load->model('prizemodel', 'mprize');
	
	}

	function index()
	{
		get_layout()->enabled(false);

		$this->load->view('admin/prize/view');
	}

	function listener() 
	{
        $table = 'prize';
        $columns = array('name','description','status','quantity','id');
        $index = 'id';
		get_layout()->enabled(false);
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);

        echo $data['result'];
    }

	function ajaxedit()
	{
		get_layout()->enabled(false);
		$id = $this->input->post('id');
		
		$prize = $this->mprize->getById($id);
/*		if(isset($news->date_time)){
			$news->date_time = date('Y-m-d',strtotime($news->date_time));
		}*/
		
		if($id < 1)
			$this->load->view('admin/prize/edit');
		else
			$this->load->view('admin/prize/edit', compact('prize'));
	}

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$prize = $this->input->post("prize", true);

			$saved = $this->mprize->save($prize);

			if ($saved){
				$success = TRUE;
				$message = "Success: Prize record saved successfully.";
			} else {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record prize save process. Please contact support center.";    
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
			
			$req = $this->mprize->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "Success: Prize record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on prize record delete. Please contact support center.";    
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
/* Location: ./application/controllers/admin/site.php */