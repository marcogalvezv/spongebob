<?php
class MY_Form_validation extends CI_Form_validation{
	var $_error_prefix      = '<span class="error">';
	var $_error_suffix      = '</span>';

	private function normalize_str_param($str){
		$str = str_replace(array("\{","\}","{","}"), array("{","}","[","]"), $str);
		return preg_replace("#\s*&\s*#", "&", $str);
	}

	private function get_post_group($params = array()){
		if(!is_array($params)){
			$params = array("group"=>$params);
		}
		if(isset($params['group']) && $params['group']){
			return $this->get_post_data($params['group'], null, array());
		}else{
			return $_POST;
		}
	}

	private function get_post_data($field, $data = null, $default = null){
		if($data === null){
			$data = $_POST;
		}

		if(isset($this->_field_data[$field]['postdata'])){
			return $this->_field_data[$field]['postdata'];
		}

		if(preg_match('#^([^\[]+)#', $field, $matches)){
			if (!isset($data[$matches[1]]))
			{
				return $default;
			}else{
				$data = $data[$matches[1]];
			}
		}

		if(preg_match_all('#\[(.*?)\]#', $field, $matches)){
			foreach($matches[1] as $index){
				if (!isset($data[$index]))
				{
					return $default;
				}else{
					$data = $data[$index];
				}
			}
		}
		return $data;
	}

	function unique($post_data, $str_param){
		$this->CI->load->database();
		$params = array("table"=>"", "fields"=>"", "ids" => array("id"), "group"=>"");
		parse_str($this->normalize_str_param($str_param), $arr);
		foreach($arr as $key=>$value){
			if(isset($params[$key]) && $value){
				$params[$key] = $value;
			}
		}

		if(is_string($params['ids'])){
			$params['ids'] = array($params['ids']);
		}

		$data = $this->get_post_group($params);

		if(!$params["table"] || !$params["fields"] || !$params["ids"]){
			show_error("Invalid Uinque validate definition");
		}

		if(!is_array($params["fields"])){
			$params["fields"] = array($params["fields"]);
		}

		if(!is_array($params["ids"])){
			$params["ids"] = array($params["ids"]);
		}

		if($db = element("db", $params)){
			$db = $this->CI->load->database($db, true);
		}else{
			$this->CI->load->database();
			$db = $this->CI->db;
		}


		// failed if id_data != existing id && field_data == existing data
		$where_id = "";
		foreach($params["ids"] as $ref_field_data=>$dbf){
			if(is_int($ref_field_data)){
				$ref_field_data = $dbf;
			}
			$where_id .= ($where_id)?" OR ":"";
			$value = $this->get_post_data($ref_field_data, $data);
			if($value){
				$where_id .= "t.$dbf != {$db->escape($value)}";
			}else{
				$where_id .= "(t.$dbf IS NOT NULL AND t.$dbf != '')";
			}
		}

		$where_id = "($where_id)";
		$where_field = "";
		$count_fields = count($params["fields"]);
		foreach($params["fields"] as $ref_field_data => $dbf){
			if( is_int($ref_field_data)){
				$ref_field_data = $dbf;
			}
			$where_field .= ($where_field)?" AND ":"";
			$value = ($count_fields == 1)?$post_data:$this->get_post_data($ref_field_data, $data);
			if($value){
				$where_field .= "t.$dbf = {$db->escape($value)}";
			}else{
				$where_field .= "(t.$dbf IS NULL OR t.$dbf = '')";
			}
		}

		if(!empty($arr['where']) && is_array($arr['where'])){
			foreach($arr['where'] as $field => $value){
				if(is_string($field)){
					$where_field .= ($where_field)?" AND ":"";
					$where_field .= "t.$field = {$db->escape($value)}";
				}
			}
		}
			

		$where_field = "($where_field)";
		$query = $db->query("SELECT COUNT(*) as count FROM {$params["table"]} t
                      WHERE $where_id AND $where_field");
		return ($query->first_row()->count == 0);
	}

	function reference($post_data, &$str_param){
		parse_str($this->normalize_str_param($str_param), $params);

		$data = $this->get_post_group($params);

		if(!element("table",$params) || !element("fields",$params)){
			show_error("Invalid Uinque validate definition");
		}

		if(isset($params['title'])){
			$str_param = $params['title'];
		}else{
			$str_param = $params["table"];
		}

		$where_field = "";
		if(!is_array($params["fields"])){
			$params["fields"] = array($params["fields"]);
		}

		if($db = element("db", $params)){
			$db = $this->CI->load->database($db, true);
		}else{
			$this->CI->load->database();
			$db = $this->CI->db;
		}

		$count_fields = count($params["fields"]);
		foreach($params["fields"] as $ref_field_data => $db_field){
			if(is_int($ref_field_data)){
				$ref_field_data = $db_field;
			}
			$where_field .= ($where_field)?" AND ":"";
			$value = ($count_fields==1)?$post_data:$this->get_post_data($ref_field_data, $data);
			if($value){
				$where_field .= "t.$db_field = {$db->escape($value)}";
			}else{
				$where_field .= "(t.$db_field IS NULL OR t.$db_field = '')";
			}
		}
			

		$where_field = "($where_field)";
		if(!empty($params['where'])&&is_array($params['where'])){
			foreach($params['where'] as $field => $value){
				$where_field = "$where_field AND $field = {$db->escape($value)}";
			}
		}

		$query = $db->query("SELECT COUNT(*) as count FROM {$params["table"]} t
                      WHERE $where_field");
		return ($query->first_row()->count > 0);
	}


	/**
	 * check address fields base on Google service.
	 */
	function address($post_data, $str_param){
		$fields = array("address1"=>"address1",
                     "city"=>"city",
                     "county"=>"",
                     "state"=>"state",
                     "zip"=>"zip"
                     );

                     parse_str($this->normalize_str_param($str_param), $params);
                     foreach($params as $key=>$value){
                     	if(isset($fields[$key])){
                     		$fields[$key] = $params[$key];
                     	}
                     }

                     $data = $this->get_post_group($params);

                     $this->CI->load->helper("gmap");
                     $map = factory_gmap();
                     $address = "%%address1%%,%%city%%,%%county%%,%%state%%";
                     $hasvalue = false;
                     	
                     foreach($fields as $key=>$input){
                     	$value = $$key = $input?$this->get_post_data($input, $data):"";
                     	if($value=="undefined"){
                     		$value = "";
                     	}
                     	$address = str_replace("%%$key%%", $value, $address);
                     	if($value){
                     		$hasvalue = true;
                     	}
                     }

                     if($address && $hasvalue){
                     	$address = preg_replace(array("#^\s*,#","#\s*,\s*,#","#,\s*$#"), array("",",",""), $address);
                     	// check address by Google.
                     	if(!empty($address1)
                     	&& !empty($city)){
                     		$sc_address = "{$address1}, {$city}";
                     		$addres_details = $map->getAddressDetails($sc_address);
                     	}
                     		
                     	if(empty($addres_details) || $addres_details->Accuracy < 8){
                     		if(!empty($address1)){
                     			$sc_address = $address1;
                     			$addres_details = $map->getAddressDetails($sc_address);
                     		}
                     	}
                     		
                     	if(empty($addres_details) || $addres_details->Accuracy < 8){
                     		$addres_details = $map->getAddressDetails($address);
                     	}
                     		
                     	// set auto complete address details
                     	if($addres_details && $addres_details->Accuracy >= 2){
                     			
                     		if(isset($addres_details->Country->AdministrativeArea->Locality)){
                     			$locality = $addres_details->Country->AdministrativeArea->Locality;
                     		}elseif(isset($addres_details->Country->AdministrativeArea->SubAdministrativeArea->Locality)){
                     			$locality = $addres_details->Country->AdministrativeArea->SubAdministrativeArea->Locality;
                     		}elseif(isset($addres_details->Country->AdministrativeArea->SubAdministrativeArea)){
                     			$locality = $subAdmin = $addres_details->Country->AdministrativeArea->SubAdministrativeArea;
                     		}

                     		if(!isset($locality)&&!isset($subAdmin)){
                     			return FALSE;
                     		}

                     		if($fields['state']){
                     			$address_info[$fields['state']] = $addres_details->Country->AdministrativeArea->AdministrativeAreaName;
                     		}

                     		if($fields['city'] && $addres_details->Accuracy>=4){
                     			$address_info[$fields['city']] = !empty($subAdmin)?$subAdmin->SubAdministrativeAreaName:$locality->LocalityName;
                     		}

                     		if($fields['zip'] && $addres_details->Accuracy >= 5){
                     			$address_info[$fields['zip']] = $locality->PostalCode->PostalCodeNumber;
                     		}

                     		if($fields['address1'] && $addres_details->Accuracy >= 6){
                     			$address_info[$fields['address1']] = $locality->Thoroughfare->ThoroughfareName;
                     		}

                     		// set county base on relation from database
                     		if($fields['county']){
                     			if($addres_details->Accuracy >= 4){
                     				$coq = $this->CI->db->query("SELECT co.name FROM city_county cc INNER JOIN city ci ON cc.city_id = ci.id
						                                INNER JOIN county co ON cc.county_id = co.id
						                                INNER JOIN state s ON co.state_id = s.id
						                                WHERE s.code = '{$address_info[$fields["state"]]}' AND ci.name = '{$address_info[$fields["city"]]}'");

                     				if($row = $coq->first_row()){
                     					$address_info[$fields['county']] = $row->name;
                     				}
                     			}else{
                     				$address_info[$fields['county']] = "";
                     			}
                     		}


                     		// set post data
                     		if(isset($params['group'])){
                     			$group = $params['group'];
                     			$_POST[$group] = array_merge($_POST[$group], $address_info);
                     			foreach($fields as $key=>$input){
                     				if(isset($this->_field_data["{$group}[{$input}]"])&&isset($address_info[$input])){
                     					$this->_field_data["{$group}[{$input}]"]['postdata'] = $address_info[$input];
                     				}
                     			}
                     		}else{
                     			$_POST = array_merge($_POST, $address_info);
                     			foreach($fields as $key=>$input){
                     				if(isset($this->_field_data[$input])&&isset($address_info[$input])){
                     					$this->_field_data[$input]['postdata'] = $address_info[$input];
                     				}
                     			}
                     		}
                     		if($addres_details->Accuracy >= 8){
                     			return TRUE;
                     		}
                     	}
                     }
                     return FALSE;
	}

	// override Form_Validation to support group input
	function matches($post_data, &$str_param)
	{
		parse_str($this->normalize_str_param($str_param), $defs);
		if(isset($defs['field'])){
			$value = $this->get_post_data($defs['field']);
		}elseif(isset($defs['value'])){
			$value = $defs['value'];
		}else{
			show_error("Invalid match validate definition");
		}
			
		if(isset($defs['title'])){
			$str_param = $defs['title'];
		}else{
			$str_param = $value;
		}
			
		return $post_data == $value;
	}

	public function password_strength($post_data, $param){
		return !$post_data || strlen($post_data) >= 6;
	}

	/**
	 *
	 * @param unknown_type $group
	 * @param unknown_type $fields table name or array fields
	 * @param unknown_type $excludes
	 * @param unknown_type $extra
	 * @param unknown_type $redundant expression to clean redundant part in fields
	 * @return unknown_type
	 */
	public function filter_post($group = "", $fields, $excludes = array(), $extra = array(), $redundant = ""){
		if(is_string($fields)){
			$tables = explode("|",$fields);
			$fields = array();
			foreach($tables as $tb){
			 $fields = array_merge($fields, $this->CI->db->list_fields($tb));
			 $excludes[] = "updated"; $excludes[] = "created";
			}
		}

		if($group){
			if(isset($_POST[$group])){
				$data = &$_POST[$group];
			}else{
				return;
			}
		}else{
			$data = &$_POST;
		}

		if(is_array($data)){
			foreach(array_keys($data) as $key){
				if($redundant){
					$key = preg_replace($redundant, "", $key);
				}
				if((array_search($key,$fields) === false && array_search($key,$extra) === false)
				|| array_search($key, $excludes) !== false){
					unset($data[$key]);
				}
			}
		}
	}

	public function set_rules($field, $label = '', $rules = '', $ignore_js_validate = false){
		$rules = preg_replace(array("#[\\n\\r\\t]#","#\\s+#", "#\s*\|\s*#"), array("", " ","|"),$rules);

		$post_data = $this->get_post_data($field);
		if($post_data !== null && $post_data !== ""){
			parent::set_rules($field, $label, $rules);
		}else if(strstr($rules, "required") !== false){
			parent::set_rules($field, $label, "required");
		}else{
			parent::set_rules($field, $label, "trim"); // don't validata on empty un-required data;
		}
		if(!$ignore_js_validate){
			$this->_field_data[$field]['str_rules'] = $rules;
		}
	}

	public function set_multifields_rules($field, $label = '', $rules = '', $dependencies = array(), $dependencies_combine = "OR"){
		if(!isset($_POST[$field])){
			$_POST[$field] = $field;
		}
		$this->set_rules($field, $label, $rules, $dependencies, $dependencies_combine);
	}

	public function run($group=""){
		$this->CI->lang->load('MY_form_validation');
		return parent::run($group);
	}

	public function reset(){
		$this->_field_data = array();
		$this->_error_array = array();
		$this->_error_messages = array();
	}

	public function multi_required($post_data, $str_param){
		parse_str($this->normalize_str_param($str_param), $params);

		$data = $this->get_post_group($params);
		$count = 0;
		if(isset($params["fields"])){
			if(!is_array($params["fields"])){
				$params["fields"] = array($params["fields"]);
			}
			foreach($params["fields"] as $field){
				if($this->get_post_data($field, $data)){
					$count += 1;
				}
			}
			if(strtolower(element("combine", $params))=="and"){
				if(isset($params['strict'])){
					return $count == count($params["fields"]);
				}else{
					return $count == 0 || $count == count($params["fields"]);
				}
			}else{
				return $count > 0;
			}
		}else{
			show_error("Invalid multi required validation definition");
		}
	}

	public function model_function($post_data, &$str_param){
		parse_str($this->normalize_str_param($str_param), $params);

		if(empty($params['model']) || empty($params['method'])){
			show_error("Invalid model_function validation definition");
		}

		$data = $this->get_post_group($params);

		$args = array();
		if(isset($params["fields"])){
			if(!is_array($params["fields"])){
				$params["fields"] = array($params["fields"]);
			}
			foreach($params["fields"] as $key=>$value){
				if(is_int($key)){
					$key = $value;
				}
				$args[$key] = $this->get_post_data($value, $data);
			}
		}

		$this->CI->load->model($params["model"]);
		$model_name = array_pop(split("/", $params['model']));
		$res = $this->CI->$model_name->{$params['method']}($post_data, $args);
		if($res === TRUE){
			return true;
		}else{
			$str_param = $res;
			return false;
		}
	}

	public function valid_date(&$post_data, $param){
		$format = $this->CI->config->item("date_format");
		if(!$format){
			$format = "%m/%d/%Y";
		}

		if($value = strptime($post_data, $format)){
			if($value['tm_year'] < 0){
				$value['tm_year'] += 2000;
			}
			$format = str_replace("%","",$format);
			$post_data = date($format, mktime(0, 0, 0, $value['tm_mon'] + 1, $value['tm_mday'], $value['tm_year'] + 1900));
			return true;
		}else{
			return false;
		}
	}

	public function to_mysql_date(&$post_data, $param){
		$this->CI->load->helper('date');
		$post_data = dh_human_to_mysql($post_data, $param);
		return true;
	}

	public function combine_time(&$post_data, $str_param){
		parse_str($this->normalize_str_param($str_param), $params);
		if(isset($params['fields'])){
			$data = $this->get_post_group($params);
			if(!is_array($params['fields'])){
				$params['fields'] = array('time'=>$params['fields'], 'hour'=>"#no-field#", "min"=>"#no-field#","sec"=>"#no-field#");
			}else{
				$params['fields'] = array_merge(array('hour'=>"#no-field#", "min"=>"#no-field#","sec"=>"#no-field#"),
				$params['fields']);
			}
				
			if(isset($params['fields']['time'])){
				$post_data .= " ".$this->get_post_data($params['fields']['time'], $data, "00:00:00");
			}elseif(isset($params['fields']['hour'])
			&&isset($params['fields']['min'])
			&&isset($params['fields']['sec'])){
				$post_data .= " ".$this->get_post_data($params['fields']['hour'], $data, "00").":"
				.$this->get_post_data($params['fields']['min'], $data, "00").":"
				.$this->get_post_data($params['fields']['sec'], $data, "00");
			}else{
				show_error("Invalid combine time definition");
			}
		}
		return TRUE;
	}

	public function cc_expire($post_data, &$str_param){
		if(!preg_match("#^(\d{2})/?(\d{2})$#", $post_data, $matches)){
			$str_param = "Invalid Format";
			return FALSE;
		}
		if((int)$matches[1]<=0||(int)$matches[1]>12){
			$str_param = "Invalid Format";
			return FALSE;
		}
		$time = mktime(0, 0, 0, $matches[1] + 1, 1, $matches[2] + 2000);
		if($time <= time()){
			$str_param = "Have to be future";
			return FALSE;
		}
		return TRUE;
	}


	public function date_compare($post_data, &$str_param){
		$this->CI->load->helper('date');
		parse_str($this->normalize_str_param($str_param), $params);
		$value = date(MY_SQL_DATE_FORMAT);
		$operator = "after";
		if(isset($params['operator'])){
			$operator = $params['operator'];
		}
		$str_param = "";
		if(isset($params['title'])){
			$str_param = $params['title'];
		}

		if(isset($params['value'])){
			$value = $params['value'];
			if(!$str_param){
				$str_param = dh_mysql_to_human($value);
			}
			$str_param = "$operator $str_param";
		}elseif(isset($params['field'])){
			$value = $this->get_post_data($params['field']);
			if(!$str_param){
				$str_param = $params['field'];
			}
			$str_param = "$operator $str_param";
		}elseif($operator == "after"){
			$str_param = "In Future";
		}elseif($operator == "before"){
			$str_param = "In Past";
		}
			
		if($post_data && $value){
			if($operator == "after"){
				return $post_data > $value;
			}elseif($operator == "after or equal"){
				return $post_data >= $value;
			}elseif($operator == "before"){
				return $post_data < $value;
			}elseif($operator == "before or equal"){
				return $post_data <= $value;
			}elseif($operator == "equal"){
				return $post_data == $value;
			}else{
				return show_error("Invalid date compare operation");
			}
		}else{
			return true;
		}
	}

	public function captcha($post_data, $str_param){
		$this->CI->load->database();
		$this->CI->load->library("User_agent");
		$this->CI->load->config("captcha", true);
		$config = $this->CI->config->item("captcha");
			
		$sql = "DELETE FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ? AND agent = ?";
		$binds = array($post_data,
		$this->CI->input->ip_address(), time() - $config['expiration'],
		$this->CI->agent->agent_string());
		$query = $this->CI->db->query($sql, $binds);
		return $this->CI->db->affected_rows() > 0;
	}

	public function in_set($post_data, $param){
		if(isset($this->$param) && is_array($this->$param)){
			if(is_array($post_data)){
				foreach($post_data as $pitem){
					if(!$this->in_set($pitem, $param)){
						return FALSE;
					}
				}
				return TRUE;
			}else{
				return array_search($post_data, $this->$param) !== FALSE;
			}
		}
		return FALSE;
	}
	
	public function not_in_set($post_data, $param){
		return !$this->in_set($post_data, $param);
	}	

	public function pattern($post_data, &$str_param){
		parse_str($this->normalize_str_param($str_param), $params);
		if(!isset($params['pattern'])){
			show_error("Invalid pattern validation definition");
		}
		if(isset($params['title'])){
			$str_param = $params['title'];
		}else{
			$str_param = $params['pattern'];
		}
		if(!preg_match($params['pattern'], $post_data)){
			return FALSE;
		}
		return TRUE;
	}

	public function us_phone(&$post_data, $param){
		if($post_data){
			$this->CI->load->helper("text_format");
			$phone = format_phone($post_data);
			if($phone){
				$post_data = $phone;
				return TRUE;
			}else{
				return FALSE;
			}
		}
		return FALSE;
	}

	public function compare($post_data, &$str_param){
		parse_str($this->normalize_str_param($str_param), $params);
		$operator = "less than";
		if(isset($params['operator'])){
			$operator = $params['operator'];
		}

		$is_number = true;
		if(isset($params['is_number'])){
			$is_number = $params['is_number'];
		}

		$str_param = "";
		if(isset($params['title'])){
			$str_param = $params['title'];
		}

		if(isset($params['value'])){
			$value = $params['value'];
			if(!$str_param){
				$str_param = $value;
			}
		}elseif(isset($params['field'])){
			$value = $this->get_post_data($params['field']);
			if(!$str_param){
				$str_param = $params['field'];
			}
		}

		$str_param = "$operator $str_param";
		 
		if($post_data !== "" && $post_data !== null
		&& isset($value) && $value !== "" && $value !== null){
			if($is_number){
				$post_data=floatval($post_data);
				$value=floatval($value);
			}
			if($operator == "greater than"){
				return $post_data > $value;
			}elseif($operator == "less than"){
				return $post_data < $value;
			}elseif($operator == "equal"){
				return $post_data == $value;
			}elseif($operator == "less than or equal"){
				return $post_data <= $value;
			}elseif($operator == "greater than or equal"){
				return $post_data >= $value;
			}
			return false;
		}else{
			return true;
		}
	}

	public function cc_num(&$post_data, &$str_param){
		$post_data = preg_replace("#\D#","",$post_data);
		parse_str($this->normalize_str_param($str_param), $params);
		if(!isset($params['cc_type'])){
			$cc_type = $this->get_post_data('cc_type');
		}else{
			$cc_type = $this->get_post_data($params['cc_type']);
		}


		if($cc_type){
			$str_param = $cc_type;
		}else{
			$str_param = "Unknown Type";
		}

		$length = strlen($post_data);

		if ($length < 13 || $length > 19) {
			return false;
		}

		$sum    = 0;
		$weight = 2;

		for ($i = $length - 2; $i >= 0; $i--) {
			$digit = $weight * $post_data[$i];
			$sum += floor($digit / 10) + $digit % 10;
			$weight = $weight % 2 + 1;
		}

		if ((10 - $sum % 10) % 10 != $post_data[$length - 1]) {
			return false;
		}

		$this->CI->load->config("cc", TRUE);
		$cc_paterns = $this->CI->config->item("patterns", "cc");
		if(!$cc_paterns){
			$cc_paterns = array(
				  "AMEX" => "/^3[47][0-9]{13}$/",
				  "V" => "/^4[0-9]{12}([0-9]{3})?$/", 
				  "DISC"=>"/^6[0-9]{15}$/",
				  "MC" => "/^5[1-5][0-9]{14}$/",
			);
		}
		foreach($cc_paterns as $key => $pattern){
			if(($key == $cc_type && preg_match($pattern, $post_data))
			||(is_int($key) && $cc_type == $pattern)){
				return TRUE;
			}
		}

		return FALSE;
	}

	public function valid_url($posted_data, $str_param){
		return (bool)preg_match("|^s?https?:\/\/[-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+$|", $posted_data);
	}

	public function ajax_uploaded_file(&$file_field_name, &$upload_type){
		$this->CI->load->helper("resource");
		$file_field_name = $post_data = $this->get_post_data($file_field_name);
		if($post_data){
			if(is_string($post_data)
			&& ($file_name = get_temp_file_name($upload_type, $post_data))
			&& file_exists(get_resource_path("temp", $file_name))){
			 return TRUE;
			}else{
				if(isset($post_data['error'])){
					$upload_type = $post_data['error'];
				}
			}
		}
		if(empty($upload_type)){
			$upload_type = "Upload failed";
		}
		$file_field_name = ""; // clear value on error.
		return FALSE;
	}

	public function valid_resource($post_data, $str_param){
		$this->CI->load->helper("resource");
		return is_valid_resource($str_param, $post_data);
	}
}
?>