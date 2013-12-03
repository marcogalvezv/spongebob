<?php 
class Language extends Membership {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");
		//$this->load->helper("image");

		$language = $this->session->userdata('language');
		if(empty($language)){
			$language = 'en';//spanish:es
		}
		
		//SET LANGUAGE
		$this->session->set_userdata('language',$language);

		//SET LANGUAGES
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
			$this->lang->load('admin',$language);
		}else{
			$this->lang->load('admin','en');
		}
		
		$this->load->model("languagemodel","mlanguage");
		$this->load->model("pagesmodel","mpages");
		
	}
	
	function index()
	{		
		get_layout()->enabled(false);
		$this->load->view('admin/language/view');
	}	

    function listener() {
        $table = 'language_view';
        $columns = array('short','name','id','idlan');

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
		
		$languages_iso = $this->mlanguage->getLanguageListISO();
		$data['languages_iso'] = $languages_iso;
		
		if($id>0){
			$reglanguage = $this->mlanguage->getById($id);
			$data['language'] = $reglanguage;
		}
		
		$this->load->view('admin/cms/language/edit', $data);
	}
	
	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$reglanguage = $this->input->post("language", true);
			
			$id = $this->mlanguage->save($reglanguage);
			
				
			//VALID RECORD
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
	
	function ajaxgetnumpag()
	{
		get_layout()->enabled(false);
		$countPages = 0;
		if ($_POST) 
		{
			$id = $this->input->post('id');
			$countPages = $this->mpages->getCountPagByIdLan($id);
			
		}
			$json = array(
				'countPages' => $countPages
			  );
			echo json_encode($json);
	}
	
	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$id = $this->input->post('id');
			
			//AQUI TENEMOS QUE VALIDAR QUE NO EXISTAN DEPENDIENTES EN BDs
			$req = $this->mlanguage->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "Success: request record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on request delete. Please contact support center.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	function ajaxdeleteall()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$id = $this->input->post('id');
			
			//ELIMINO TODOS LOS REGISTROS DEPENDIENTES
			$pages = $this->mpages->getPagByIdLan($id);
			
			foreach($pages as $page) $req = $this->mpages->deleteById($page['id']);
			
			//ELIMINO EL PADRE
			$req = $this->mlanguage->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "Success: request record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on request delete. Please contact support center.";    
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