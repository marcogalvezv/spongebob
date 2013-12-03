<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class foursquare extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		$this->load->helper('foursquare');
		get_layout()->set_layout("layout/base");
		$this->load->model('Foursquaremodel', 'mfoursquare');
		$this->load->model('Restaurantmodel', 'mrestaurant');
		$this->load->model('Branchmodel', 'mbranch');
		$this->load->model('Categorymodel', 'mcategory');
		
		date_default_timezone_set('America/Los_Angeles');
	}

	function index() 
	{
		get_layout()->enabled(FALSE);
		
		$foursquare = Foursquare();

		echo "<pre>FOURSQUARE: ";
		print_r($foursquare);
		echo "</pre>";
		
		//Generate a latitude/longitude pair using Google Maps API
		list($lat,$lng) = $foursquare->GeoLocate('Cochabamba');
		echo "<pre>LAT: ";
		print_r($lat);
		echo "<pre>LONG: ";
		print_r($lng);
		echo "</pre>";
    }
	
	function getRestaurantes($ciudad = 'Cochabamba') 
	{
		$ciudad = "Nataniel Aguirre 927 Our Lady of Peace, Bolivia";
		get_layout()->enabled(FALSE);
		
		$foursquare = Foursquare();

		//echo "<pre>FOURSQUARE: ";
		//print_r($foursquare);
		//echo "</pre>";
		
		//Generate a latitude/longitude pair using Google Maps API
		list($lat,$lng) = $foursquare->GeoLocate($ciudad);
		
		//Santa Cruz de la Sierra
		//list($lat,$lng) = array(-17.781913,-63.182809); //$foursquare->GeoLocate($ciudad);
		
		echo "<pre>LAT: ";
		echo "<pre>LONG: ";
		echo $lat . "," .$lng;
		echo "</pre>";
		
		$venues = array();
		$categories = array();
		
		// Prepare parameters
		$params = array("ll"=>"$lat,$lng");
		
		//// Perform a request to a public resource
		//$response = $foursquare->GetPublic("venues/categories",$params);
		//$result = json_decode($response);
		//
		//foreach($result->response->categories as $cat){
		//	$row = array();
		//	$row['categoria'] = $cat->name;
		//	$row['id'] = $cat->id;
		//	$categories[$cat->id] = $row;
		//}
		
		$categories[] = array("id" => "4d4b7105d754a06374d81259", "name" => "Comida");
		$categories[] = array("id" => "4bf58dd8d48988d14e941735", "name" => "Restaurante americano");
		$categories[] = array("id" => "4bf58dd8d48988d107941735", "name" => "Restaurante argentino");
		$categories[] = array("id" => "4bf58dd8d48988d142941735", "name" => "Restaurante asiático");
		$categories[] = array("id" => "4bf58dd8d48988d1df931735", "name" => "Parrilla");
		$categories[] = array("id" => "4bf58dd8d48988d16b941735", "name" => "Restaurante brasileño");
		$categories[] = array("id" => "4bf58dd8d48988d143941735", "name" => "Café");
		$categories[] = array("id" => "4bf58dd8d48988d16d941735", "name" => "Café");
		$categories[] = array("id" => "4bf58dd8d48988d16c941735", "name" => "Hamburguesería");
		$categories[] = array("id" => "4bf58dd8d48988d153941735", "name" => "Local de burritos");
		$categories[] = array("id" => "4bf58dd8d48988d145941735", "name" => "Restaurante chino");
		$categories[] = array("id" => "4bf58dd8d48988d1e0931735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d1d0941735", "name" => "Confitería");
		$categories[] = array("id" => "4bf58dd8d48988d147941735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d148941735", "name" => "Tienda de donuts");
		$categories[] = array("id" => "4bf58dd8d48988d16e941735", "name" => "Restaurante de comida rápida");
		$categories[] = array("id" => "4bf58dd8d48988d1cb941735", "name" => "Carrito de comida");
		$categories[] = array("id" => "4d4ae6fc7a7b7dea34424761", "name" => "Local de pollo frito");
		$categories[] = array("id" => "4bf58dd8d48988d16f941735", "name" => "Local de Hot Dogs");
		$categories[] = array("id" => "4bf58dd8d48988d1c9941735", "name" => "Heladería");
		$categories[] = array("id" => "4bf58dd8d48988d110941735", "name" => "Restaurante italiano");
		$categories[] = array("id" => "4bf58dd8d48988d111941735", "name" => "Restaurante japonés");
		$categories[] = array("id" => "4bf58dd8d48988d113941735", "name" => "Restaurante coreano");
		$categories[] = array("id" => "4bf58dd8d48988d1be941735", "name" => "Restaurante latinoamericano");
		$categories[] = array("id" => "4bf58dd8d48988d1c1941735", "name" => "Restaurante mexicano");
		$categories[] = array("id" => "4bf58dd8d48988d157941735", "name" => "Restaurante de nueva cocina americana");
		$categories[] = array("id" => "4eb1bfa43b7b52c0e1adc2e8", "name" => "Restaurante peruano");
		$categories[] = array("id" => "4bf58dd8d48988d1ca941735", "name" => "Pizzería");
		$categories[] = array("id" => "4bf58dd8d48988d1c4941735", "name" => "Restaurante");
		$categories[] = array("id" => "4bf58dd8d48988d1bd941735", "name" => "Local de ensaladas");
		$categories[] = array("id" => "4bf58dd8d48988d1c5941735", "name" => "Local de sándwiches");
		$categories[] = array("id" => "4bf58dd8d48988d1ce941735", "name" => "Marisquería");
		$categories[] = array("id" => "4bf58dd8d48988d1c7941735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d1cd941735", "name" => "Restaurante de América del Sur");
		$categories[] = array("id" => "4bf58dd8d48988d14d941735", "name" => "Restaurante de paella");
		$categories[] = array("id" => "4bf58dd8d48988d1cc941735", "name" => "Steakhouse");
		$categories[] = array("id" => "4bf58dd8d48988d1d2941735", "name" => "Restaurante de sushi");
		$categories[] = array("id" => "4bf58dd8d48988d151941735", "name" => "Local de tacos");
		$categories[] = array("id" => "4bf58dd8d48988d1d3941735", "name" => "Restaurante vegetariano/vegano");
		$categories[] = array("id" => "4bf58dd8d48988d14c941735", "name" => "Local de alitas");
		
		//echo "<pre>";
		//print_r($categories);
		//echo "</pre>";
		
		foreach($categories as $cat){
			$id = $cat['id'];
			$category = $cat['name'];
			
			// Prepare parameters
			$params = array("ll"=>"$lat,$lng", "categoryId"=>$id, "limit"=>"50");
			
			// Perform a request to a public resource
			$response = $foursquare->GetPublic("venues/search",$params);
			$result = json_decode($response, true);
			
			//echo "<pre>";
			//print_r($result);
			//echo "</pre>";
			

			foreach($result['response']['venues'] as $row){
				//echo "<pre>";
				//print_r($row);
				//echo "</pre>";
				//exit;
				
				$venue = array();
				
				$venue['foursquare_id'] = $row['id'];
				$venue['name'] = $row['name'];
				
				foreach($row['contact'] as $key => $value){
					$venue['contact_'.$key] = $value; 
				}
				
				foreach($row['location'] as $key => $location){
					$venue['location_'.$key] = $location; 
				}
				$categoryId = NULL;
				$idcat = NULL;
				foreach($row['categories'] as $catdata){
					$category = array(); 
					//only save primary category
					if((int)$catdata['primary'] == 1) {
						foreach($catdata as $key => $value){
							if($key == "icon") continue;
							$categoryId = $catdata['id'];
							$category[$key] = $value; 
						}
						
						echo "<pre>";
						print_r($category);
						echo "</pre>";
						
						$venue['categoryId'] = $categoryId;
						$this->mfoursquare->save_category($category);
						
						$categorydata = array();
						$categorydata['code'] 	= $category['name'];
						$categorydata['name'] 	= $category['name'];
						$categorydata['plural'] = $category['pluralName'];
						$categorydata['short'] 	= $category['shortName'];
						$categorydata['idcat'] 	= 1;
						
						$idcat = $this->mcategory->save($categorydata);
					}
				}
				
				$restaurant['uid'] 		= 1;
				$restaurant['name']		= $venue['name'];
				$restaurant['status']	= 0;
				
				//save the restaurant
				$idrest = $this->mrestaurant->venuesave($restaurant);

				
				//if($venue['location_city'] == "Cochabamba") {
				//	$idcity = 1;
				//}elseif($venue['location_city'] == "Santa Cruz de la Sierra") {
				//	$idcity = 2;
				//}elseif($venue['location_city'] == "La Paz") {
				//	$idcity = 3;
				//} else {
				//	$idcity = 1;
				//}
				
				$idcity = 3;
				
				$branch['name'] 			= $venue['name'];
				$branch['description'] 		= $venue['name'];
				$branch['foursquare_id'] 	= $venue['foursquare_id'];
				$branch['phone'] 			= $venue['contact_phone'];
				$branch['formattedphone'] 	= $venue['contact_formattedPhone'];
				$branch['twitter'] 			= $venue['contact_twitter'];
				$branch['facebook'] 		= $venue['contact_facebook'];
				$branch['lat'] 				= $venue['location_lat'];
				$branch['lng'] 				= $venue['location_lng'];
				$branch['distance'] 		= $venue['location_distance'];
				$branch['address1'] 		= $venue['location_address'];
				$branch['address2'] 		= $venue['location_crossStreet'];
				$branch['idcity'] 			= $idcity;
				$branch['state'] 			= $venue['location_state'];
				$branch['zip'] 				= $venue['location_postalCode'];
				$branch['status'] 			= 0;
				
				echo "<pre>";
				print_r($branch);
				echo "</pre>";
				
				//save the branch
				$idbranch = $this->mbranch->venuesave($branch);
                
				//save the restaurant-branch relation
				$this->mrestaurant->save_relation($idrest, $idbranch, 1);
				
				//save the branch-category relation
				$this->mbranch->save_relation($idbranch, $idcat, 1);
				
				//save the venue
				$this->mfoursquare->save($venue);
				
				echo "<pre>";
				print_r($venue);
				echo "</pre>";
				
				$venues[$venue['foursquare_id']] = $venue;
			}
		}
		echo "<pre>TOTAL: <br />";
		print_r(count($venues));	
		//echo "<pre>";
		//print_r($venues);
		echo "</pre>";
    }
	
	function getCategories($ciudad = 'Cochabamba') 
	{
		get_layout()->enabled(FALSE);
		
		$foursquare = Foursquare();

		//echo "<pre>FOURSQUARE: ";
		//print_r($foursquare);
		//echo "</pre>";
		
		//Generate a latitude/longitude pair using Google Maps API
		list($lat,$lng) = $foursquare->GeoLocate($ciudad);
		//echo "<pre>LAT: ";
		//print_r($lat);
		//echo "<pre>LONG: ";
		//print_r($lng);
		//echo "</pre>";
		
		$venues = array();
		$categories = array();
		
		// Prepare parameters
		$params = array("ll"=>"$lat,$lng");
		
		//// Perform a request to a public resource
		//$response = $foursquare->GetPublic("venues/categories",$params);
		//$result = json_decode($response);
		//
		//foreach($result->response->categories as $cat){
		//	$row = array();
		//	$row['categoria'] = $cat->name;
		//	$row['id'] = $cat->id;
		//	$categories[$cat->id] = $row;
		//}
		
		$categories[] = array("id" => "4d4b7105d754a06374d81259", "name" => "Comida");
		$categories[] = array("id" => "4bf58dd8d48988d14e941735", "name" => "Restaurante americano");
		$categories[] = array("id" => "4bf58dd8d48988d107941735", "name" => "Restaurante argentino");
		$categories[] = array("id" => "4bf58dd8d48988d142941735", "name" => "Restaurante asiático");
		$categories[] = array("id" => "4bf58dd8d48988d1df931735", "name" => "Parrilla");
		$categories[] = array("id" => "4bf58dd8d48988d16b941735", "name" => "Restaurante brasileño");
		$categories[] = array("id" => "4bf58dd8d48988d143941735", "name" => "Café");
		$categories[] = array("id" => "4bf58dd8d48988d16d941735", "name" => "Café");
		$categories[] = array("id" => "4bf58dd8d48988d16c941735", "name" => "Hamburguesería");
		$categories[] = array("id" => "4bf58dd8d48988d153941735", "name" => "Local de burritos");
		$categories[] = array("id" => "4bf58dd8d48988d145941735", "name" => "Restaurante chino");
		$categories[] = array("id" => "4bf58dd8d48988d1e0931735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d1d0941735", "name" => "Confitería");
		$categories[] = array("id" => "4bf58dd8d48988d147941735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d148941735", "name" => "Tienda de donuts");
		$categories[] = array("id" => "4bf58dd8d48988d16e941735", "name" => "Restaurante de comida rápida");
		$categories[] = array("id" => "4bf58dd8d48988d1cb941735", "name" => "Carrito de comida");
		$categories[] = array("id" => "4d4ae6fc7a7b7dea34424761", "name" => "Local de pollo frito");
		$categories[] = array("id" => "4bf58dd8d48988d16f941735", "name" => "Local de Hot Dogs");
		$categories[] = array("id" => "4bf58dd8d48988d1c9941735", "name" => "Heladería");
		$categories[] = array("id" => "4bf58dd8d48988d110941735", "name" => "Restaurante italiano");
		$categories[] = array("id" => "4bf58dd8d48988d111941735", "name" => "Restaurante japonés");
		$categories[] = array("id" => "4bf58dd8d48988d113941735", "name" => "Restaurante coreano");
		$categories[] = array("id" => "4bf58dd8d48988d1be941735", "name" => "Restaurante latinoamericano");
		$categories[] = array("id" => "4bf58dd8d48988d1c1941735", "name" => "Restaurante mexicano");
		$categories[] = array("id" => "4bf58dd8d48988d157941735", "name" => "Restaurante de nueva cocina americana");
		$categories[] = array("id" => "4eb1bfa43b7b52c0e1adc2e8", "name" => "Restaurante peruano");
		$categories[] = array("id" => "4bf58dd8d48988d1ca941735", "name" => "Pizzería");
		$categories[] = array("id" => "4bf58dd8d48988d1c4941735", "name" => "Restaurante");
		$categories[] = array("id" => "4bf58dd8d48988d1bd941735", "name" => "Local de ensaladas");
		$categories[] = array("id" => "4bf58dd8d48988d1c5941735", "name" => "Local de sándwiches");
		$categories[] = array("id" => "4bf58dd8d48988d1ce941735", "name" => "Marisquería");
		$categories[] = array("id" => "4bf58dd8d48988d1c7941735", "name" => "Cafetería");
		$categories[] = array("id" => "4bf58dd8d48988d1cd941735", "name" => "Restaurante de América del Sur");
		$categories[] = array("id" => "4bf58dd8d48988d14d941735", "name" => "Restaurante de paella");
		$categories[] = array("id" => "4bf58dd8d48988d1cc941735", "name" => "Steakhouse");
		$categories[] = array("id" => "4bf58dd8d48988d1d2941735", "name" => "Restaurante de sushi");
		$categories[] = array("id" => "4bf58dd8d48988d151941735", "name" => "Local de tacos");
		$categories[] = array("id" => "4bf58dd8d48988d1d3941735", "name" => "Restaurante vegetariano/vegano");
		$categories[] = array("id" => "4bf58dd8d48988d14c941735", "name" => "Local de alitas");
		
		//echo "<pre>";
		//print_r($categories);
		//echo "</pre>";
		
		foreach($categories as $cat){
			$id = $cat['id'];
			$category = $cat['name'];
			
			// Prepare parameters
			$params = array("ll"=>"$lat,$lng", "categoryId"=>$id, "limit"=>"50");
			
			// Perform a request to a public resource
			$response = $foursquare->GetPublic("venues/search",$params);
			$result = json_decode($response, true);
			
			//echo "<pre>";
			//print_r($result);
			//echo "</pre>";
			

			foreach($result['response']['venues'] as $row){
				//echo "<pre>";
				//print_r($row);
				//echo "</pre>";
				//exit;
				
				$venue = array();
				
				$venue['foursquare_id'] = $row['id'];
				$venue['name'] = $row['name'];
				
				foreach($row['contact'] as $key => $value){
					$venue['contact_'.$key] = $value; 
				}
				
				foreach($row['location'] as $key => $location){
					$venue['location_'.$key] = $location; 
				}
				$categoryId = NULL;
				$idcat = NULL;
				foreach($row['categories'] as $catdata){
					$category = array(); 
					//only save primary category
					if((int)$catdata['primary'] == 1) {
						foreach($catdata as $key => $value){
							if($key == "icon") continue;
							$categoryId = $catdata['id'];
							$category[$key] = $value; 
						}
						echo "<pre>";
						print_r($category);
						echo "</pre>";
						
						$venue['categoryId'] = $categoryId;
						$this->mfoursquare->save_category($category);
						
						$categorydata = array();
						$categorydata['code'] 	= $category['name'];
						$categorydata['name'] 	= $category['name'];
						$categorydata['plural'] = $category['pluralName'];
						$categorydata['short'] 	= $category['shortName'];
						$categorydata['idcat'] 	= 1;
						
						$idcat = $this->mcategory->save($categorydata);
					}
				}
				
				//save the branch
				//$idbranch = $this->mbranch->venuesave($branch);
				$branch = $this->mbranch->getByField($venue['foursquare_id'], 'foursquare_id');

				echo "<pre>";
				print_r($branch);
				echo "</pre>";
				
				//save the restaurant-branch relation
				//$this->mrestaurant->save_relation($idrest, $idbranch, 1);
				//
				if(isset($branch->id)){
					$idbranch = $branch->id;
					////save the branch-category relation
					$this->mbranch->save_relation($idbranch, $idcat, 1);
				}
				//
				////save the venue
				//$this->mfoursquare->save($venue);
				
				//echo "<pre>";
				//print_r($venue);
				//echo "</pre>";
				
				//$venues[$venue['foursquare_id']] = $venue;

			}
		}
		echo "<pre>TOTAL: <br />";
		print_r(count($categories));	
		//echo "<pre>";
		//print_r($venues);
		echo "</pre>";
    }
}