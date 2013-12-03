<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Destinationmodel extends Basemodel{

protected $_table_name = "destination";
	
	public function delete_addresses($uid) {
		$id = (int)$id;
		$this->db->where('uid', $uid);
		$this->db->delete('address');
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function update_addresses($uid, $addresses) {
		
		$this->delete_addresses($uid);
		foreach($addresses as $cat) {
			$this->save_relation($uid, $cat['id'], $cat['primary']);
		}
		return ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	public function getDestinationList($uid = 0, $limit = 10, $offset = 0, $city = "", $search = array(), $order = array())
	{
		$this->db->select('destination.*');
		$this->db->select('city.name');
		$this->db->from('destination');
		$this->db->join('city','city.id = destination.idcity', 'left');
		
		//filter by user ID
		$this->db->where('destination.uid', $uid);
		
		//for pagination
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		
		//echo "<pre>";
		//print_r($search);
		//echo "</pre>";
		
		//filter by keywords here
		if(isset($search['keywords']) && !empty($search['keywords'])){
			$this->db->like('destination.address1', $search['keywords']);
			$this->db->or_like('destination.address2', $search['keywords']);
			$this->db->or_like('destination.state', $search['keywords']);
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