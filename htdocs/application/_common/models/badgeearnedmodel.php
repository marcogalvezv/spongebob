<?php
//require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Badgeearnedmodel extends Basemodel
{	
protected $_table_name = "badge_earned";

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
	}
	function getBadgeEarnedList($idbadge = 0,$dateini=null,$dateend=null)
	{
		$sql = "SELECT be.*";
		$sql .= " FROM `badge_earned` be";
		$sql .= " WHERE be.idbadge = ".$idbadge;
		if((isset($dateini))&&(isset($dateend))){
			$sql .= " WHERE be.date_earned BETWEEN '$dateini' AND '$dateend'";
		}
		$sql .= " ORDER BY be.id";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}
	function getBadgeEarnedListforUser($userid)
	{
		$sql = "SELECT ba.*, be.id as idbadge, ba.filename as image, be.date_earned";
		$sql .= " FROM `badge_earned` be";
		$sql .= " LEFT JOIN `badge` ba ON be.idbadge=ba.id";
		$sql .= " WHERE be.uid = ".$userid;
		$sql .= " ORDER BY be.created DESC";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		return null;
	}
	function getBadgeEarnedCount($idbadge = 0,$dateini=null,$dateend=null,$by = 1)
	{
		if((isset($dateini))&&(isset($dateend))){
			$sql = "SELECT count(*) AS cant";
			$sql .= " FROM badge_earned be";
			$sql .= " WHERE be.idbadge = ".$idbadge;
			
			if($by == 1){
				$sql .= " AND DATE_FORMAT(be.date_earned,'%Y-%m-%d') = STR_TO_DATE('{$dateini}','%Y-%m-%d')";
			}else{
				$sql .= " AND be.date_earned BETWEEN '{$dateini}' AND '{$dateend}'";
			}
			
			$sql .= " ORDER BY be.id";
//echo $sql;			
			$query = $this->db->query($sql);

			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
		}
		return null;
	}
	function getVBadgeEarnedList($dateini=null,$dateend=null)
	{
		$sql = "SELECT b.id, b.cod, b.name, b.rating, b.filename, be.date_earned, COUNT(be.id) AS badge_earned";
		$sql .= " FROM `badge` b";
		$sql .= " LEFT JOIN `badge_earned` be ON b.id = be.idbadge";
		if((isset($dateini))&&(isset($dateend))){
			$sql .= " WHERE be.date_earned BETWEEN '$dateini' AND '$dateend'";
		}
		$sql .= " GROUP BY b.id, b.cod, b.name, b.filename";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}

/*	function getCartDetailList($idpro)
	{
		$this->db->from($this->_table_name);
		$this->db->where($this->_table_name.'.idpro', $idpro);
		$this->db->order_by($this->_table_name.'.id');
		return $this->db->get()->result_array();
	}
	
	function getCartDetailProjectViewList($value,$status = '0', $field = 'idcus')
	{
		$this->db->from('cart_detail_project_view');
		$this->db->where("cart_detail_project_view.{$field}", $value);
		$this->db->where("cart_detail_project_view.status", $status);
		$this->db->order_by('cart_detail_project_view.id');
		return $this->db->get()->result_array();
	}
	function getnumInCartProjView($value,$status = '0', $field = 'uid')
	{
		$this->db->select('Count(cart_detail_project_view.id) AS quantity');
		$this->db->from('cart_detail_project_view');
		$this->db->where("cart_detail_project_view.{$field}", $value);
		$this->db->where("cart_detail_project_view.status", $status);
		$this->db->order_by('cart_detail_project_view.id');
		return $this->db->get()->result_array();
	}

	function getCartDetailProjectDonatesList($value,$status = '1', $field = 'idproj')
	{
		$sql = "SELECT cp.id, c.id AS idcus, CONCAT(c.firstname,' ',c.lastname) AS customer";
		$sql .= " FROM `cart_project` cp";
		$sql .= " LEFT JOIN user u ON u.id = cp.uid";
		$sql .= " LEFT JOIN customer c ON c.uid = u.id";
		$sql .= " WHERE cp.status = ".$status;
		$sql .= " AND cp.{$field} = ".$value;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}
	
	function getByIDView($id)
	{
		$this->db->from('cart_detail_view');
		$this->db->where('cart_detail_view.id', $id);
//		return $this->db->get()->result_array();
		$row = $this->db->get()->result_array();
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
	public function getByID($id) {
		$query = $this->db->query("SELECT * FROM $this->_table_name WHERE id = ?", $id);
		return (array)$this->_singleRow($query);
	}	
	public function updateCart(array $cart,$field = 'quantity'){
		$data = array(
               "$field" => $cart["$field"]
            );

		$this->db->where('id', $cart['id']);
		return $this->db->update('cart_detail', $data); 
	}
	public function getByIDandUser($id, $uid) {
		$query = $this->db->query("SELECT * FROM $this->_table_name WHERE idprod = {$id} AND uid = {$uid} AND status = 0");
		return (array)$this->_singleRow($query);
	}	
	public function getCountryByCart($uid) {
		$query = $this->db->query("SELECT DISTINCT(country) AS country, currency FROM cart_detail_project_view WHERE uid = ? AND id > 0", $uid);
		return (array)$this->_singleRow($query);
	}
	
	function getCartDetailViewTotalsList($value, $field = 'uid')
	{
		$sql = "SELECT cd.idshop, cd.servicefee, cd.commission, SUM(cd.unitprice*cd.quantity) AS subtotalcost, SUM(cd.shipcost*cd.quantity) AS shipcost,SUM(cd.subtotal) AS subtotallocal, e.crate, (SUM(cd.subtotal)/e.crate) AS subtotalaud, (((SUM(cd.subtotal)/e.crate) * cd.commission)/100) AS commission, (cd.servicefee + (((SUM(cd.subtotal)/e.crate) * cd.commission)/100)) AS tax";
		$sql .= " FROM `cart_detail_project_view` cd";
		$sql .= " LEFT JOIN (SELECT MAX(e1.id) as id, e1.crate, e1.csymbol FROM exchange e1 GROUP BY e1.csymbol) AS e ON e.csymbol = cd.currency";
		$sql .= " WHERE cd.{$field} = ".$value;
		$sql .= " AND cd.id > 0";
		$sql .= " GROUP BY cd.idshop";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}
	function getCartDetailViewTotalsDonations($value, $field = 'uid')
	{
		$sql = "SELECT IFNULL(SUM(cd.subtotalaud),0) AS subtotalaud";
		$sql .= " FROM `cart_detail_project_view` cd";
		$sql .= " WHERE cd.{$field} = ".$value;
		$sql .= " AND cd.id < 0";
		
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		return null;
	}
*/
}
