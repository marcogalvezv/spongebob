<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php'); 

class Test extends REST_Controller {

	function __construct()
	{
		parent::__construct();
		
		//load helpers
		$this->load->helper("layout");
		//$this->load->helper("api");
		
		//load library
        $this->load->library('session');
		
		//layout disabled by default
		get_layout()->enabled(false);
	}
	

	function index()
	{  
		$this->response(NULL, 404);
	}

	function helloworld_post() {
		// Check for required parameters
		if ($_POST) {
		
			$name = $this->input->post('name');
			
			if(!$name) {
				$this->response(array('error' => 'Name cannot be found'), 404);
				return false;
			}
						
			// Return unlock code, encoded with JSON
			$result = array(
				"result" => "Hello $name!",
			);

			$this->response($result, 200); // 200 being the HTTP response code			
			
			//sendResponse(200, json_encode($result));
			return true;
		} else {
			$this->response(NULL, 404);
		}
		return false;
	}
	
	function helloworld_get($name = "Carlos") {
		// Check for required parameters			
		if(!$name) {
			$this->response(array('error' => 'Name cannot be found'), 404);
			return false;
		}
					
		// Return unlock code, encoded with JSON
		$result = array(
			"result" => "Hello $name!",
		);

		$this->response($result, 200); // 200 being the HTTP response code			
		
		//sendResponse(200, json_encode($result));
		return true;
	}
	
}

/* End of file test.php */
/* Location: ./application/controllers/api/test.php */