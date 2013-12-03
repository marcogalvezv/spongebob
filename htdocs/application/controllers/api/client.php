<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php'); 

class Client extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		//to avoid issues with the last PHP version
		date_default_timezone_set('America/Los_Angeles');
		
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		
		//load models and helpers
        $this->load->model('Usermodel', 'user');
		$this->load->model("Profilemodel","profile");
		$this->load->model("Addressmodel","address");
		$this->load->model("Destinationmodel","destination");
		$this->load->model("Citymodel","city");
		$this->load->model("Favoritestaximodel","favoritestaxi");
		$this->load->model("Favoritescompanymodel","favoritescompany");

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
	
    function getLocations_get($uid = 0, $limit = 10, $offset = "", $city = "all", $search = "", $order = "") {
	
		//echo "\nUID: ";
		//print_r($uid);
		//echo "\nLIMIT:";
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
		
		$locations = array();
		$locations = $this->address->getAddressList($uid, $limit, $offset, $city, $search, $order);
				
		if(!empty($locations)){
			// Return unlock code, encoded with JSON
			$result = array(
				"message" => "Datos de Direcciones Exitoso",
				"locations" => $locations
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
	
    function getDestinations_get($uid = 0, $limit = 10, $offset = "", $city = "all", $search = "", $order = "") {
	
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
		
		if(!$uid > 0){
			$uid = NULL;
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
		
		$destinations = $this->destination->getDestinationList($uid, $limit, $offset, $city, $search, $order);
				
		if(!empty($destinations)){
			// Return unlock code, encoded with JSON
			$result = array(
				"message" => "Datos de Destinos Exitoso",
				"destinations" => $destinations
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
	
	//add/edit location functions
	function saveLocation_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			$uid = $this->input->post("uid", true);
			$address1 = $this->input->post("address1", true);
			$address2 = $this->input->post("address2", true);
			$city = $this->input->post("city", true);
			$state = $this->input->post("state", true);
			$zip = $this->input->post("zip", true);
			$phone = $this->input->post("phone", true);
			$lat = $this->input->post("lat", true);
			$lng = $this->input->post("lng", true);
			
			
			//get idcity by code CB/SC/LP
			$citydata = $this->city->getByfield($city,'code');
			$idcity = $citydata->id;
			
			$address['uid'] = $uid;
			$address['address1'] = $address1;
			$address['address2'] = $address2;
			$address['idcity'] = $idcity;
			$address['state'] = $state;
			$address['zip'] = $zip;
			$address['lat'] = $lat;
			$address['lng'] = $lng;
			$address['status'] = 1;//valid status for new
			
			
			//UPDATE LOCATION
			if($id > 0){
			
				$checkaddress = $this->address->getById($id);
				
				if(!$checkaddress)
				{
					$this->response(array('error' => 'La direccion no existe, intentar con otra.'), 404);
					return false;
				}
				
				//get idcity by code CB/SC/LP
				$citydata = $this->city->getByfield($city,'code');
				$idcitydata = $citydata->id;
				
				//for update this record
				$address['id'] = $id;
					
				$id = $this->address->save($address);
				
				//ROLLBACK/COMMIT
				if(!$id) {
					$this->response(array('error' => 'Error en registro de Direccion.'), 404);
					return false;
				} else {
					$address['id'] = $id;
					// Return encoded with JSON
					$result = array(
						"message" => "Direccion actualizada Exitosamente",
						"location" => $address
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //NEW LOCATION
				$checkaddress = $this->address->getByfield($address1,'address1');
				
				//possible duplicated?
				if(isset($checkaddress->address1)){
					if($checkaddress->address2 == $address2 && $checkaddress->lat == $lat && $checkaddress->lng == $lng)
					{
						$this->response(array('error' => 'La direccion ya existe, intentar con otro.'), 404);
						return false;
					}
				}
				
				$id = $this->address->save($address);
				
				//error save location
				if(!$id) {
					$this->response(array('error' => 'Error en registro de Direccion.'), 404);
					return false;
				} else {
					$address['id'] = $id;
					// Return encoded with JSON
					$result = array(
						"message" => "Direccion registrada Exitosamente",
						"location" => $address
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			}
		} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }
	
	//delete location functions
	function deleteLocation_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			
			//UPDATE LOCATION
			if($id > 0){
			
				$checkaddress = $this->address->getById($id);
				
				if(!$checkaddress)
				{
					$this->response(array('error' => 'La direccion no existe, intentar con otra.'), 404);
					return false;
				}
					
				$id = $this->address->deleteById($id);
				
				//error check
				if(!$id) {
					$this->response(array('error' => 'Error al eliminar Direccion.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Direccion eliminada Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //error en ID
					$this->response(array('error' => 'La direccion no es valida, intentar nuevamente.'), 404);
					return false;
			}
		} else {
			$this->response(array('error' => 'Error en la solicitud de eliminacion.'), 404);
		}
		return false;
    }
	

	//add/edit destination functions
	function saveDestination_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			$uid = $this->input->post("uid", true);
			$address1 = $this->input->post("address1", true);
			$address2 = $this->input->post("address2", true);
			$city = $this->input->post("city", true);
			$state = $this->input->post("state", true);
			$zip = $this->input->post("zip", true);
			$phone = $this->input->post("phone", true);
			$lat = $this->input->post("lat", true);
			$lng = $this->input->post("lng", true);
			
			
			//get idcity by code CB/SC/LP
			$citydata = $this->city->getByfield($city,'code');
			$idcity = $citydata->id;
			
			$destination['uid'] = $uid;
			$destination['address1'] = $address1;
			$destination['address2'] = $address2;
			$destination['idcity'] = $idcity;
			$destination['state'] = $state;
			$destination['zip'] = $zip;
			$destination['lat'] = $lat;
			$destination['lng'] = $lng;
			$destination['status'] = 1;//valid status for new
			
			//UPDATE LOCATION
			if($id > 0){
			
				$checkdestination = $this->destination->getById($id);
				
				if(!$checkdestination)
				{
					$this->response(array('error' => 'La direccion destino no existe, intentar con otra.'), 404);
					return false;
				}
				
				//get idcity by code CB/SC/LP
				$citydata = $this->city->getByfield($city,'code');
				$idcitydata = $citydata->id;
				
				//for update this record
				$destination['id'] = $id;
					
				$id = $this->destination->save($destination);
				
				//ROLLBACK/COMMIT
				if(!$id) {
					$this->response(array('error' => 'Error en registro de Destino.'), 404);
					return false;
				} else {
					$destination['id'] = $id;
					// Return encoded with JSON
					$result = array(
						"message" => "Direccion destino actualizada exitosamente",
						"destination" => $destination
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //NEW LOCATION
				$checkdestination = $this->destination->getByfield($address1,'address1');
				
				//possible duplicated?
				if(isset($checkdestination->address1)){
					if($checkdestination->address2 == $address2 && $checkdestination->lat == $lat && $checkdestination->lng == $lng)
					{
						$this->response(array('error' => 'La direccion destino ya existe, intentar con otra.'), 404);
						return false;
					}
				}
				
				$id = $this->destination->save($destination);
				
				//ROLLBACK/COMMIT
				if(!$id) {
					$this->response(array('error' => 'Error en registro de Direccion.'), 404);
					return false;
				} else {
					$destination['id'] = $id;
					// Return encoded with JSON
					$result = array(
						"message" => "Direccion destino registrada Exitosamente",
						"destination" => $destination
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			}
		} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		return false;
    }
	
	//delete destination functions
	function deleteDestination_post() 
    {
		$commit = TRUE;
		
		if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			
			//UPDATE DESTINATION
			if($id > 0){
			
				$checkdestination = $this->destination->getById($id);
				
				if(!$checkdestination)
				{
					$this->response(array('error' => 'La direccion destino no existe, intentar con otra.'), 404);
					return false;
				}
					
				$id = $this->destination->deleteById($id);
				
				//error check
				if(!$id) {
					$this->response(array('error' => 'Error al eliminar Destino.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Destino eliminado Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //error en ID
					$this->response(array('error' => 'La direccion destino no existe, intentar con otra.'), 404);
					return false;				//get idcity by code CB/SC/LP
			}
		} else {
			$this->response(array('error' => 'Error en la solicitud de eliminacion.'), 404);
		}
		return false;
    }
	
	//add/edit favorites functions
	function saveFavoritesTaxi_get($uid, $idtaxi) 
    {
		$commit = TRUE;
		
		//if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			$uid = $this->input->post("uid", true);
			$idtaxi = $this->input->post("idtaxi", true);
						
			//get idcity by code CB/SC/LP
			$favorite = $this->favoritestaxi->checkFavorite($uid, $idtaxi);
			
			//DELETE FAVORITE IF EXISTS
			if(isset($favorite->id)){
					
				//$id = $this->favoritestaxi->deleteById($favorite->id);
				
				//error check
				if(!$id) {
					$this->response(array('error' => 'Error al eliminar Taxi Favorito.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Favorito eliminado Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //NEW FAVORITE
			
				$data['uid'] = $uid;
				$data['idtaxi'] = $idtaxi;
				
				$id = $this->favoritestaxi->save($data);
				
				//error save location
				if(!$id) {
					$this->response(array('error' => 'Error al registrar Taxi Favorito.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Favorito registrado Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			}
		/*} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		*/
		return false;
    }
	
	//add/edit favorites functions
	function saveFavoritesCompany_get($uid, $idcompany) 
    {
		$commit = TRUE;
		
		//if($_POST){
			
			//GET USER DATA
			$id = $this->input->post("id", true);
			$uid = $this->input->post("uid", true);
			$idcompany = $this->input->post("idcompany", true);
						
			//get idcity by code CB/SC/LP
			$favorite = $this->favoritescompany->checkFavorite($uid, $idcompany);
			
			//DELETE FAVORITE IF EXISTS
			if(isset($favorite->id)){
					
				//$id = $this->favoritestaxi->deleteById($favorite->id);
				
				//error check
				if(!$id) {
					$this->response(array('error' => 'Error al eliminar Taxi Favorito.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Favorito eliminado Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			} else { //NEW FAVORITE
			
				$data['uid'] = $uid;
				$data['idtaxi'] = $idtaxi;
				
				$id = $this->favoritestaxi->save($data);
				
				//error save location
				if(!$id) {
					$this->response(array('error' => 'Error al registrar Taxi Favorito.'), 404);
					return false;
				} else {
					// Return encoded with JSON
					$result = array(
						"message" => "Favorito registrado Exitosamente"
					);
					$this->response($result, 200); // 200 being the HTTP response code
					return true;
				}
			}
		/*} else {
			$this->response(array('error' => 'Error en la solicitud de datos.'), 404);
		}
		*/
		return false;
    }
}

/* End of file client.php */
/* Location: ./application/controllers/api/client.php */