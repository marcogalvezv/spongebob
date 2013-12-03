<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php'); 

class Taxi extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		//to avoid issues with the last PHP version
		date_default_timezone_set('America/Los_Angeles');
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		
		//load models and helpers
        $this->load->model('Usermodel', 'user');
		$this->load->model("Profilemodel","profile");
		$this->load->model("Taximodel","taxi");
		$this->load->helper("layout");
		$this->load->helper('phpmailer');
		
		//load library
        $this->load->library('session');
		
		
		//layout disabled by default
		get_layout()->enabled(false);
	}
	

	function index()
	{  
		$this->response(NULL, 404);
	}
	
    function getTaxiDrivers_get($all = 1, $limit = 10, $offset = "", $city = "all", $search = "", $order = "") {
	
		//echo "\nALL: ";
		//print_r($all);
		//echo "\nLIMIT: ";
		//print_r($limit);
		//echo "\nOFFSET: ";
		//print_r($offset);
		//echo "\nCITY: ";
		//print_r($city);
		//echo "\nSEARCH: ";
		//print_r($search);
		//echo "\nORDER: ";
		//print_r($order);
		//echo "\n";
		
		if($all > 0){
			$all = TRUE;
		} else {
			$all = FALSE;
		} 
			
		if(!empty($order)){
			$order = array($order);
		} else {
			$order = array();
		}
		
		if(!empty($search)){
			$search = array('keywords' => $search);
		} else {
			$search = array();
		}
		
		if(!$limit > 0){
			$limit = NULL;
		}
		
		if(!$offset > 0){
			$offset = "";
		}
		
		if($city == "all"){
			$city = "";
		}
		
		$taxis = $this->taxi->getTaxiDrivers($limit, $offset, $city, $search, $order);
		
		$radiotaxis = array();
		if($all){
			$radiotaxis = $this->taxi->getTaxiCompanies($limit, $offset, $city, $search, $order);
		}
		
		if(!empty($taxis)){
			// Return unlock code, encoded with JSON
			$result = array(
				"message" => "Datos de Taxis Exitoso",
				"taxis" => $taxis,
				"radiotaxis" => $radiotaxis
			);
			$this->response($result, 200); // 200 being the HTTP response code
			return true;
		}
		else
		{
			$this->response(array('error' => 'No se encontraron registros.'), 404);
		}
		return false;
    }
	
    function getRadioTaxis_get($limit = 10, $offset = "", $city = "all", $search = "", $order = "") {
	
		//echo "\nLIMIT: ";
		//print_r($limit);
		//echo "\nOFFSET: ";
		//print_r($offset);
		//echo "\nCITY: ";
		//print_r($city);
		//echo "\nSEARCH: ";
		//print_r($search);
		//echo "\nORDER: ";
		//print_r($order);
		//echo "\n";
					
		if(!empty($order)){
			$order = array($order);
		} else {
			$order = array();
		}
		
		if(!empty($search)){
			$search = array('keywords' => $search);
		} else {
			$search = array();
		}
		
		if(!$limit > 0){
			$limit = NULL;
		}
		
		if(!$offset > 0){
			$offset = "";
		}
		
		if($city == "all"){
			$city = "";
		}
		
		$radiotaxis = array();
		$radiotaxis = $this->taxi->getTaxiCompanies($limit, $offset, $city, $search, $order);
		
		if(!empty($radiotaxis)){
			// Return unlock code, encoded with JSON
			$result = array(
				"message" => "Datos de Empresas de RadioTaxis Exitoso",
				"radiotaxis" => $radiotaxis
			);
			$this->response($result, 200); // 200 being the HTTP response code
			return true;
		}
		else
		{
			$this->response(array('error' => 'No se encontraron empresas de radiotaxi.'), 404);
		}
		return false;
    }
}

/* End of file taxi.php */
/* Location: ./application/controllers/api/taxi.php */