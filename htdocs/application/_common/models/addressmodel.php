<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Addressmodel extends Basemodel{

protected $_table_name = "address";
	
	public function save_relation($idbranch, $idcat, $primary = 0){
		
		$this->db->select('idbranch');
		$this->db->from('address');
		$this->db->where('idbranch', $idbranch);
		$this->db->where('idcat', $idcat);
		$query = $this->db->get();
		
		//Foursquare ID already exists ?
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else //else create a new branch
		{
			$data['idbranch'] = $idbranch;
			$data['idcat'] = $idcat;
			$data['primary'] = $primary;
			$relation = 'address';	    
			$this->db->insert($relation, $data);
		}
		return ($this->db->affected_rows() > 0) ? true : false;
	}
	
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

	function getAddressByFieldByUriCityList($data = '%', $field = 'id', $cityuri = '')
	{
		$this->db->select($this->_table_name.'.*');
		$this->db->join('city', 'city.id = '.$this->_table_name.'.idcity');
		$this->db->from($this->_table_name);
		$this->db->where($this->_table_name.'.'.$field, $data);
		$this->db->where('city.uri', $cityuri);
		$this->db->order_by($this->_table_name.'.main','DESC');
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get()->result_array();
	}
	
	
	public function getAddressList($uid = 0, $limit = 10, $offset = 0, $city = "", $search = array(), $order = array())
	{
		$this->db->select('address.*');
		$this->db->select('city.name');
		$this->db->from('address');
		$this->db->join('city','city.id = address.idcity', 'left');
		
		//filter by user ID
		$this->db->where('address.uid',$uid);
		
		//for pagination
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		
		//echo "<pre>";
		//print_r($search);
		//echo "</pre>";
		
		//filter by keywords here
		if(isset($search['keywords']) && !empty($search['keywords'])){
			$this->db->like('address.address1', $search['keywords']);
			$this->db->or_like('address.address2', $search['keywords']);
			$this->db->or_like('address.state', $search['keywords']);
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
		
		//$sql = $this->db->last_query();
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