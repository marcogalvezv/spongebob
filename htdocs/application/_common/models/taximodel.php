<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Taximodel extends Basemodel
{	
protected $_table_name = "taxi";	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}

	public function getTaxiDrivers($limit = 10, $offset = 0, $city = "", $search = array(), $order = array())
	{
		$this->db->select('taxi.*');
		$this->db->select('profile.uid, profile.firstname, profile.lastname, profile.gender, profile.document, profile.typedoc, profile.email, profile.company, profile.mobile, profile.avatar, profile.idcountry, profile.idcity');
		$this->db->select('city.name');
		$this->db->from('taxi');
		$this->db->join('user','user.id = taxi.uid', 'left');
		$this->db->join('profile','profile.uid = user.id', 'left');
		$this->db->join('city','city.id = taxi.idcity', 'left');
		
		//for pagination
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		
		//echo "<pre>";
		//print_r($search);
		//echo "</pre>";
		
		//filter by keywords here
		if(isset($search['keywords']) && !empty($search['keywords'])){
			$this->db->like('taxi.plate', $search['keywords']);
		}

		//filter logic by search () array
		//$this->db->where('user.gid', 2);
		
		//default order by rating 
		$this->db->order_by('rating', 'DESC');
		
		//FILTER BY CITY CODE (CB, SC, LP)
		if($city != ""){
			$this->db->where('city.code', $city);
		}
		
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
				$row['taxiphoto'] = base_url() . $row['taxiphoto'];
				$row['avatar'] = base_url() . $row['avatar'];
				$res[] = $row;
			}
		}
		return $res;
	}

	public function getTaxiCompanies($limit = 10, $offset = 0, $city = "", $search = array(), $order = array())
	{
		$this->db->select('company.*');
		$this->db->select('city.name');
		$this->db->select('profile.uid, profile.firstname, profile.lastname, profile.gender, profile.document, profile.typedoc, profile.email, profile.company, profile.mobile, profile.avatar, profile.idcountry, profile.idcity');
		$this->db->from('company');
		$this->db->join('user','user.id = company.uid', 'left');
		$this->db->join('profile','profile.uid = user.id', 'left');
		$this->db->join('city','city.id = company.idcity', 'left');
		
		//for pagination
		if($limit > 0){
			$this->db->limit($limit, $offset);
		}
		
		//filter by keywords here
		if(isset($search['keywords']) && !empty($search['keywords'])){
			//update logic
			$this->db->like('company.name', $search['keywords']);
		}

		$this->db->order_by('rating', 'DESC');
		
		//FILTER BY CITY CODE (CB, SC, LP)
		if($city != ""){
			$this->db->where('city.code', $city);
		}
		
		//order by 
		if(!empty($order)){
			//order by ORDER items
		}

		$query = $this->db->get();

		$sql = $this->db->last_query();
		

		
		$res = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$res = array();
			foreach($result as $row) {
				$row['logo'] = base_url() . $row['logo'];
				$res[] = $row;
			}
		}
		return $res;
	}

    function getLocationList()
    {
        $this->db->select('id,number,lat,lng');
        $this->db->from('taxi');
        $this->db->where('status',0);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

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

    function getActiveTaxiLocations()
    {
        $query = $this->db->query("select lat, lng, number, status from v_taxi where status=0");
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
    }

    function getTaxiWithDriver()
    {
        $query = $this->db->query("select id, number, plate, taxicolor, taxiphoto, status, fullname, avatar  from v_addresstaxi");
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
    }

    function getTaxiWithDriverService($id)
    {
        $query = $this->db->query("select id, number, plate, taxicolor, taxiphoto, status, fullname as driverfullname, avatar as driverphoto  from v_addresstaxi where uid='".$id."'");
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
    }



}
