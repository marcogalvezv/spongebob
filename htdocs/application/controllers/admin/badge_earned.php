<?php 
class Badge_earned extends Membership {

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
        $this->load->model('faqmodel', 'mfaq');
        $this->load->model('newsmodel', 'mnews');
	
	}
	

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/badges/view');
	}	
	
	function listener() 
	{
        $table = 'v_badge_earned';
        $columns = array('username','fullname','email','name','date_earned','status','id');
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
		$news = $this->mnews->getById($id);
		if(isset($news->date_time)){
			$news->date_time = date('Y-m-d',strtotime($news->date_time));
		}
		$this->load->view('admin/news/edit', compact('news'));
	}
	

	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$news = $this->input->post("news", true);
			
			if(!isset($news['published'])) $news['published'] = 0;
			
			
			if ( get_magic_quotes_gpc() )
				$news['content'] = htmlspecialchars( stripslashes( $news['content'] ) ) ;
			else
				$news['content'] = htmlspecialchars( $news['content'] );		
			
			$saved = $this->mnews->save($news);			
			
			if ($saved){
				$success = TRUE;
				$message = "Success: news record saved successfully.";
			} else {
				$success = FALSE;
				$message = "ERR002: Something went wrong on the record news save process. Please contact support center.";    
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
			$req = $this->mnews->deleteById($id);
			
			if ($req){
				$success = TRUE;
				$message = "Success: news record delete successfully.";
			} else {
				$success = FALSE;
				$message = "ERR003: Something went wrong on news record delete. Please contact support center.";    
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