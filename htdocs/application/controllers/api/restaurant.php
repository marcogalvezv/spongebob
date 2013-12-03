<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class restaurant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->add_package_path(DOMAINSPATH.'application/_common/');		
		$this->load->helper('seo');
		get_layout()->set_layout("layout/base");
		$this->load->model('Restaurantmodel', 'mrestaurant');
		$this->load->model('Branchmodel', 'mbranch');
		$this->load->model('Categorymodel', 'mcategory');
		
		date_default_timezone_set('America/Los_Angeles');
	}
	
	function fixRestaurantes()
	{
		get_layout()->enabled(FALSE);
		
		$restaurants = $this->mrestaurant->getList()->result_array();
		
		foreach($restaurants as $restaurant){
			$restaurant['uri'] = seo_url(utf8_decode($restaurant['name']));
			echo "<pre>RESTAURANT: ";
			print_r($restaurant);
			echo "</pre>";
			//save the restaurant
			$res = $this->mrestaurant->save($restaurant);
			echo "<pre>SAVED: <br />";
			print_r($res);
			echo "</pre>";
		}
		
		
		$branches = $this->mbranch->getList()->result_array();
		
		foreach($branches as $branch){
			$branch['uri'] 	= seo_url(utf8_decode($branch['name']));
			echo "<pre>BRANCH: ";
			print_r($branch);
			echo "</pre>";
			//save the branch
			$res = $this->mbranch->save($branch);
			echo "<pre>SAVED: <br />";
			print_r($res);
			echo "</pre>";
		}
		
    }
	
	function fixURI()
	{
		get_layout()->enabled(FALSE);
		
		$restaurants = $this->mrestaurant->getList()->result_array();
		
		foreach($restaurants as $restaurant){
			$restaurant['uri'] = str_replace('ntilde','n', $restaurant['uri']);
			$restaurant['uri'] = str_replace('aacute','a', $restaurant['uri']);
			$restaurant['uri'] = str_replace('eacute','e', $restaurant['uri']);
			$restaurant['uri'] = str_replace('iacute','i', $restaurant['uri']);
			$restaurant['uri'] = str_replace('oacute','o', $restaurant['uri']);
			$restaurant['uri'] = str_replace('uacute','u', $restaurant['uri']);
			echo "<pre>RESTAURANT: ";
			print_r($restaurant);
			echo "</pre>";
			//save the restaurant
			$res = $this->mrestaurant->save($restaurant);
			echo "<pre>SAVED: <br />";
			print_r($res);
			echo "</pre>";
		}
		
		
		$branches = $this->mbranch->getList()->result_array();
		
		foreach($branches as $branch){
			$branch['uri'] = str_replace('ntilde','n', $branch['uri']);
			$branch['uri'] = str_replace('aacute','a', $branch['uri']);
			$branch['uri'] = str_replace('eacute','e', $branch['uri']);
			$branch['uri'] = str_replace('iacute','i', $branch['uri']);
			$branch['uri'] = str_replace('oacute','o', $branch['uri']);
			$branch['uri'] = str_replace('uacute','u', $branch['uri']);

			echo "<pre>BRANCH: ";
			print_r($branch);
			echo "</pre>";
			//save the branch
			$res = $this->mbranch->save($branch);
			echo "<pre>SAVED: <br />";
			print_r($res);
			echo "</pre>";
		}
		
    }
}