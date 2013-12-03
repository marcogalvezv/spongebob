<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Foursquaremodel extends Basemodel{

protected $_table_name = "foursquare__venue";
	
	public function save_category($category){
	
		$this->db->select('id');
		$this->db->from('foursquare__category');
		$this->db->where('id', $category['id']);
		$query = $this->db->get();
		
		//category ID already exists ?
		if ($query->num_rows() > 0)
		{
			return $category['id'];
		}
		else //else create a new category
		{
			$relation = 'foursquare__category';	    
			$this->db->insert($relation, $category);
			return $category['id'];
		}
		
		//both fail return NULL
		return NULL;
	}
	
	public function save(array $venue){
	
		$this->db->select('id');
		$this->db->from('foursquare__venue');
		$this->db->where('foursquare_id', $venue['foursquare_id']);
		$query = $this->db->get();
		
		//Foursquare ID already exists ?
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0]['id'];
		}
		else //else create a new venue
		{
			return parent::save($venue);
		}
		
		//both fail return NULL
		return NULL;
	}
}