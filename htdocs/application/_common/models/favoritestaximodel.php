<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Favoritestaximodel extends Basemodel{

protected $_table_name = "favorites_taxi";
	
	public function delete_favorites($uid) {
		$id = (int)$id;
		$this->db->where('uid', $uid);
		$this->db->delete('favorites_taxi');
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function update_favorites($uid, $addresses) {
		
		$this->delete_addresses($uid);
		foreach($addresses as $cat) {
			$this->save_relation($uid, $cat['id'], $cat['primary']);
		}
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function checkFavorite($uid = 0, $idtaxi = 0)
	{
		$this->db->select('favorites_taxi.*');
		$this->db->from('favorites_taxi');
		
		
		//filter by user ID
		$this->db->where('favorites_taxi.uid', $uid);
		
		//filter by user ID
		$this->db->where('favorites_taxi.idtaxi', $idtaxi);
		
		$query = $this->db->get();
		
		//$sql = $this->db->last_query();
		//echo "\n";
		//print_r($sql);
		//echo "\n";

		$res = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$res = array();
			foreach($result as $row) {
				$res[] = $row;
			}
		}
		return $res;
	}
	
	public function getFavoritesTaxiList($uid = 0, $limit = 10, $offset = 0, $city = "", $search = array(), $order = array())
	{
		$this->db->select('favorites_taxi.*');
		$this->db->select('taxi.*');
		$this->db->select('city.name');
		$this->db->from('favorites_taxi');
		$this->db->join('taxi','taxi.id = favorites_taxi.idtaxi', 'left');
		$this->db->join('city','city.id = taxi.idcity', 'left');
		
		//filter by user ID
		$this->db->where('favorites_taxi.uid', $uid);
		
		//for pagination
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		
		//echo "<pre>";
		//print_r($search);
		//echo "</pre>";
		
		//filter by keywords here
		if(isset($search['keywords']) && !empty($search['keywords'])){
			$this->db->like('favorites_taxi.address1', $search['keywords']);
			$this->db->or_like('favorites_taxi.address2', $search['keywords']);
			$this->db->or_like('favorites_taxi.state', $search['keywords']);
		}
		
		//FILTER BY CITY CODE (CB, SC, LP)
		if($city != ""){
			$this->db->where('city.code', $city);
		}
		
		
		//default order by rating 
		$this->db->order_by('id', 'DESC');		
		
		//order by 
		if(!empty($order)){
			foreach($order as $field){
				//order by ORDER items
				$this->db->order_by($field, "DESC"); 
			}
		}

		$query = $this->db->get();
		
		$sql = $this->db->last_query();
		//echo "\n";
		//print_r($sql);
		//echo "\n";

		$res = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$res = array();
			foreach($result as $row) {
				$res[] = $row;
			}
		}
		return $res;
	}

}