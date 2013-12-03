<?php 
class Manage extends Membership {

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
        $this->load->model('profilemodel', 'mprofile');
        $this->load->model('newslettermodel', 'mnewsletter');
	
	}
	

	function index()
	{
		get_layout()->enabled(false);
		$this->load->view('admin/manage/view');
	}	
	
	function listener() 
	{
        $table = 'airport';
        $columns = array('code','name','location','country','countrycode','areacode','id');
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
			$error = FALSE;
			$errortext = '';
			$send = FALSE;
			
			$customids = array();
			$customemails = array();
			$newsletter = $this->input->post("newsletter", true);
			
			$newsletter['ini_date'] = date('Y-m-d');
			$newsletter['end_date'] = date('Y-m-d');
			
			if ( get_magic_quotes_gpc() )
				$newsletter['content'] = htmlspecialchars( stripslashes( $newsletter['content'] ) ) ;
			else
				$newsletter['content'] = htmlspecialchars( $newsletter['content'] );
			
			$idnewsletter = $this->mnewsletter->save($newsletter);
			
			if($idnewsletter){
				
				$members = $saved = $this->mprofile->getMembers();
				/*
				echo "<pre>";	
				print_r($members);
				echo "</pre>";
				*/
				$saved = $this->mnewsletter->save_newsletter_by_members($idnewsletter, $members);
				//if(!$saved){ $error = TRUE; }
			} else {
				$error = TRUE;
			}
			
			if (!$error){
				$success = TRUE;
				$message = "Success: Emails successfully Queued on the mailbox.";
			} else {
				$success = FALSE;
				$message = "Error: Something went wrong on the send newsletter process. {$errortext} Please contact support center.";    
			}
			$json = array(
				'success' 	=> $success,
				'message' 	=> $message,
				'send' 		=> $send,
				'emails'  	=> $customemails
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