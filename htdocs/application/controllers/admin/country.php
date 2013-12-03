<?php 
class Country extends Membership {

	function __construct()
	{
		parent::__construct();
		$this->load->helper("layout");

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
		
		$this->load->model("countrymodel","mcountry");
	
	}
	
	function index()
	{		
		get_layout()->enabled(false);
		$this->load->view('admin/shops/view');
	}	

    function listener() {
        $table = 'country_view';
        $columns = array('name','fullname','prefix','currency','cant','id');

        $index = 'id';
		get_layout()->enabled(false);
		
		$this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);

        echo $data['result'];
    }
	
	function ajaxedit()
	{
		get_layout()->enabled(false);
		
		$name = $this->input->post('id');
		
		$currencies = $this->mcountry->getCurrenciesList();
		$countries_iso = $this->mcountry->getCountryListISO();
		$data['currencies'] = $currencies;
		$data['countries_iso'] = $countries_iso;
		
		if($name<>'-1'){
			$country = $this->mcountry->getByIDChr($name);
			$data['country'] = $country;
		}
		$this->load->view('admin/shops/country/edit', $data);
	}
	
	function ajaxsave()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$country = $this->input->post("country", true);

			$req = $this->mcountry->save($country);
				
			//VALID RECORD
			if ($req){
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
	
	function ajaxsavecountry()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			$country = $this->input->post("country", true);
			
			$option = $this->mcountry->getByField($country['name'],'name');
			
			if (isset($option)){
				$req = $this->mcountry->updateCountry($country);
			}else{
				$req = $this->mcountry->saveCountry($country);
			}
			
			//VALID RECORD
			if ($req){
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
	
	function ajaxdelete()
	{
		get_layout()->enabled(false);
		if ($_POST) 
		{
			//$name = $this->input->post('name', true);
			$name = $this->input->post('id', true);
			
			$req = $this->mcountry->deleteByIdCountry($name);
			
			if ($req){
				$success = TRUE;
				$message = "Success: request record delete successfully.";
			} else {
				$bderror = $this->db->_error_message();
				$success = FALSE;
				$message = "ERR003: The country has a child dependence error. Please delete ALL database dependences FIRST.";    
			}
			$json = array(
				'success' => $success,
				'message' => $message
			  );
			echo json_encode($json);
		}
    }
	function genCountryISOJson()
	{
		$json = array();
		$fields = array();
		$countries_iso = $this->mcountry->getCountryListISO();
		
		foreach ($countries_iso->result() as $country_iso)
		{
			$fields = array("name" => (string)"$country_iso->name", "fullname"=>(string)"$country_iso->fullname", "prefix"=>(string)"$country_iso->prefix", "currency"=>(string)"$country_iso->currency");
			
			$json["$country_iso->name"] = $fields;
		}
		echo json_encode($json);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/shop/inventory.php */