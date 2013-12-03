<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Countrymodel extends Basemodel{

protected $_table_name = "country";
	
	public function getByIDChr($id) {
		$query = $this->db->query("SELECT * FROM $this->_table_name WHERE name = ?", $id);
		return (object)$this->_singleRow($query);
	}
	
	public function saveChr(array $data, $check_fields = false, $ext_where = array()){
		if(isset($data['name'])){
			$this->db->where("id", $data['id'])->update($this->_table_name, $data);
		}else{
			$this->db->insert($this->_table_name, $data);
		}
			//echo $this->db->last_query();
			
		return $this->db->insert_id();
	}
	public function saveCountry(array $country){
			/*$data = array(
			   'name' => $country['name'] ,
			   'fullname' => $country['fullname'] ,
			   'prefix' => $country['prefix'] ,
			   'currency' => $country['currency'] 
			);*/

		return $this->db->insert('country', $country);
	}
	public function updateCountry(array $country){
		$data = array(
               'name' => $country['name'],
               'prefix' => $country['prefix'],
               'currency' => $country['currency']
            );

		$this->db->where('name', $country['name']);
		return $this->db->update('country', $data); 

		//return $this->db->update('country', $country);
	}
	
	function getCountryList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.name');
		return $this->db->get();
	}
	function getCountryListISO()
	{
		$this->db->from('country_iso');
		$this->db->order_by('country_iso.fullname');
		return $this->db->get();
	}
	function getCurrenciesList()
	{
		$this->db->select($this->_table_name.'.currency');
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.currency');
		return $this->db->get();
	}
	function getCurrencyByIdinv($idinv)
	{
		$idinv = (int)$idinv;
		$this->db->select('country.currency');
		$this->db->select('shop.country');
		$this->db->select('inventory.id');
		$this->db->from('country');
		$this->db->join('shop', 'country.name = shop.country', 'left');
		$this->db->join('inventory', 'shop.id = inventory.idshop', 'left');
		$this->db->where('inventory.id', $idinv);
		$this->db->order_by('inventory.id');
		$query = $this->db->get();
	
		$result = $query->row();
		
		$res = array();
	    if ($query->num_rows() > 0){
			
			$array = $query->result();
			foreach($array as $row)
			{
				$res[] = $row->currency;
			}
		}
		return $res[0];
	}
	function getCurrencyByIdord($idord)
	{
		$idord = (int)$idord;
		$this->db->select('country.currency');
		$this->db->select('shop.country');
		$this->db->select('inventory.id');
		$this->db->select('order_detail.idord');
		$this->db->from('country');
		$this->db->join('shop', 'country.name = shop.country', 'left');
		$this->db->join('inventory', 'shop.id = inventory.idshop', 'left');
		$this->db->join('order_detail', 'inventory.id = order_detail.idord', 'left');
		$this->db->where('order_detail.idord', $idord);
		$this->db->order_by('order_detail.id');
		$query = $this->db->get();
	
		$result = $query->row();
		
		$res = array();
	    if ($query->num_rows() > 0){
			
			$array = $query->result();
			foreach($array as $row)
			{
				$res[] = $row->currency;
			}
		}
		return $res[0];
	}
	function getCurrencyByUid($uid)
	{
		$uid = (int)$uid;
		$this->db->select('country.currency');
		$this->db->select('shop.country');
		$this->db->from('country');
		$this->db->join('shop', 'country.name = shop.country', 'left');
		$this->db->where('shop.uid', $uid);
	
		$this->db->order_by('country.currency');
		$query = $this->db->get();
		$result = $query->row();
		
		$res = array();
	    if ($query->num_rows() > 0){
			
			$array = $query->result();
			foreach($array as $row)
			{
				$res[] = $row->currency;
			}
		}
		return $res[0];
	}

	function getCountriesList(){
		$sql = "select * from country";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result();
		}
		return null;	
	}	

	function deleteByIdCountry($name) {
		//$id = (string)$id;
		$this->db->delete('country', array('name' => "$name"));

		//$this->db->where('name', $id);
		//$this->db->delete($this->_table_name);
		//$sql = $this->db->last_query();
		//echo $sql;
			
		$message = $this->db->_error_message();
		if(!$message) {
			return true;
		}	
		return false;
  	}	
}
