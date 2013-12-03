<?php
abstract class Basemodel extends Model{

	protected $_table_name = "";
	private $_fields = array();

	protected function _singleRow($query){
		if(is_string($query)){
			return $this->_singleRow($this->db->query($query));
		}
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	
	public function deleteByID($id) {
		$id = (int)$id;
		$this->db->where('id', $id);
		$this->db->delete($this->_table_name);
		return ($this->db->affected_rows() > 0) ? true : false;
  	}	
	
	public function getByID($id) {
		$query = $this->db->query("SELECT * FROM $this->_table_name WHERE id = ?", $id);
		return (object)$this->_singleRow($query);
	}	
	
	public function getByField($value, $field = 'id')
	{
		$query = "SELECT * FROM {$this->_table_name} WHERE {$field} = ?";
		$row = $this->db->query($query, array($value))->result();
		if($row)
		{
			$row = current($row);
			return $row;
		}
		else
		{
			return NULL;
		}
	}
	
	public function getList()
	{
		$this->db->from($this->_table_name);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get();
	}	

	protected function combine_str($s1, $s2, $sep = ", "){
		if($s1 && $s2){
			return "{$s1}{$sep}{$s2}";
		}elseif($s1){
			return $s1;
		}else{
			return $s2;
		}
	}

	protected function array_to_where_clause(array $filters, $combine = "AND", $prefix = ""){
		$where = "";
		$combine = (strtolower($combine)=="or")?"OR":"AND";
		foreach($filters as $key => $f){
			if(is_string($key)){
				$where = $this->combine_str($where, "{$prefix}$key = {$this->db->escape($f)}", " $combine ");
			}elseif(is_array($f)){	
				$sub_where = $this->array_to_where_clause($f, ($combine == "AND")?"OR":"AND");
				$where = $this->combine_str($where, $sub_where, " $combine ");								
			}
		}
		return $where;
	}
	
	protected function array_to_orderby_clause(array $fields, $default, $table = false, $prefix = ""){
		if(!$fields){
			$fields = array($default);
		}
		
		$table_fields = $this->db_fields($table);
		
		$sql = "";			
		foreach($fields as $field){		
			if(preg_match("#__desc$#", $field)){
				$order_type = "DESC";
				$field = preg_replace("#__desc$#", "", $field);
			}else{
				$order_type = "ASC";
			}
			if(array_search($field, $table_fields) !== FALSE){
				$sql = $this->combine_str($sql, "{$prefix}{$field} $order_type");
			}
		}
		return $sql;
	}	

	protected function collection($query, $options = null){
		if(is_string($query)){
			return $this->_collection($this->db->query($query), $options);
		}
		return $query->result_array();
	}

	
	/**
	 * 
	 * @return SQLPagination
	 */
	protected function paging($sql, $page_idx, $item_per_page = 20){
		$this->load->library("SQLPagination", array(null, null));
		return new SQLPagination($this->db, $sql, $curent_page, $item_per_page);
	}

	protected function single_row($query){
		if(is_string($query)){
			$query = $this->db->query($query);
		}
		return $query->first_row('array');
	}

	public function db_fields($table=false){
		if(!$table){
				$table = $this->_table_name;
		}
		return $this->db->list_fields($table);
	}

	public function clean_up_data(array &$data, $keep_mine = true){
		if(!$this->_fields){
			$this->_fields = $this->db->list_fields($this->_table_name);
		}
		foreach(array_keys($data) as $key){
			$strange_field = (array_search($key, $this->_fields) === FALSE);
			if($keep_mine && ($strange_field && $key != "#id#") ){
				unset($data[$key]);
			}if(!$keep_mine && !$strange_field && $key != "id"){
				unset($data[$key]);
			}
		}
	}


	/**
	 * insert if new, update if existing, then return id of row 
	 */
	public function save(array $data, $check_fields = false, $ext_where = array()){
		if($check_fields){
			$this->clean_up_data($data);
		}

		if(isset($data['id']) && (int)$data['id']){
			unset($data['#id#']);
			if($ext_where){
				$this->db->where($this->array_to_where_clause($ext_where), NULL, FALSE);
			}						
			$this->db->where("id", $data['id'])->update($this->_table_name, $data);

			if($ext_where){
				$this->db->where($this->array_to_where_clause($ext_where), NULL, FALSE);
			}					
			if($this->db->where("id", $data['id'])->get($this->_table_name)->num_rows()>0){

				return $data['id'];
			}else{
				return 0;
			}			
		}else{
			unset($data['id']);
			if(isset($data['#id#'])){
				$data['id'] = (int)$data['#id#'];
				unset($data['#id#']);
			}
			if(!isset($data['created'])){
				$data['created'] = date('Y-m-d H:i:s');
			}
			$this->db->insert($this->_table_name, $data);

			//echo $this->db->last_query();
			
			return $this->db->insert_id();
		}
	}

	protected static $_emails = array();
	protected static $_email_trans_key = false;
	protected function _begin_mails(){
		if(!self::$_email_trans_key){
			self::$_email_trans_key = rand();
		  self::$_emails = array();
		  return self::$_email_trans_key;
		}
		return false;
	}
	
	/**
	 * 
	 * @param $name
	 * @return MY_Email
	 */
	protected function _get_email_object($name){
    $this->load->library("Email", null, $name);
    self::$_emails[$name] =  get_instance()->$name; 
    return  self::$_emails[$name];
	}
	
  protected function _commit_emails($key){
  	if($key === self::$_email_trans_key){
	    foreach(self::$_emails as $email){
	    	$email->send();
	    }
	    self::$_emails = array();
	    self::$_email_trans_key = null;
	    return true;
  	}
  	return false;
  }  
  


	private static $php_codes = array();
	private static $php_codes_trans_key = null;
	protected function begin_php_codes_trans(){
		if(!self::$php_codes_trans_key){
			self::$php_codes_trans_key = rand();
			self::$php_codes = array();
			return self::$php_codes_trans_key;
		}
		return false;
	}

	protected function php_code_trans($code_str){
		self::$php_codes[] = $code_str;
	}

	protected function commit_php_codes_trans($key){
		if($key === self::$php_codes_trans_key){
			foreach(self::$php_codes as $code_str){
				eval($code_str);
			}
			self::$php_codes = array();
			self::$php_codes_trans_key = null;
			return true;
		}
		return false;
	}

	public function begin_db_preview(){
		trans_start(TRUE);
		$this->begin_php_codes_trans();
		$this->previewing = true;
		return $this->begin_mails();
	}

	public function end_db_preview($key){
		$this->db->trans_complete();
		if($key == self::$email_trans_key){			
			self::$php_codes = array();
			self::$php_codes_trans_key = null;
			self::$emails = array();
			self::$email_trans_key = false;			
		}
	}
	
	protected function trans_start(){
		trans_start(TRUE);
		$php_key = $this->begin_php_codes_trans();
		return "{$php_key}_{$this->begin_mails()}";		
	}
	
	protected function trans_complete($key){
		$this->db->trans_complete();
		if($key == self::$php_codes_trans_key."_".$email_trans_key){
			list($php_key, $email_key) = explode("_", $key);
			$this->commit_php_codes_trans($php_key);
			$this->commit_emails($email_key);
		}
	}
}
