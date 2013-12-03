<?php

//class System_model extends Model 
class Systemmodel extends CI_Model
{
	public $me;
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
        $this->load->helper('cookie');
		$this->load->model('Persistencemodel', 'persistence');
    }
	
    function checkLoginFB()
    {
		/*CHECK FACEBOOK USER*/
		$ci =& get_instance();
		$ci->load->model('Usermodel', 'muser');

        $ci->load->library('fb_ignited');
		$this->me = $ci->fb_ignited->fb_get_me(false);

//echo "<pre>";
//print_r($this->me);
//echo "</pre>";
		
		if(isset($this->me) && !empty($this->me)){
            $userFB = $ci->muser->getByField($this->me['id'],'idfacebook');
			
//echo "<pre>";
//print_r($userFB);
//print_r($userFB->id);
//print_r($userFB->idfacebook);
//echo "</pre>";
			if((isset($userFB)) && (!empty($userFB))){
				//$this->loginById($userFB->id);
				$this->set_idfacebook($userFB->idfacebook);
				return true;
			}
		}
        return false;
    }
	
    function profileFB() 
    {
		if(isset($this->me) && !empty($this->me))
			return $this->me;
		else return null;
    }
	
    function logoutFB() {
/*		$this->fb_me = $this->fb_ignited->fb_get_me(false);
		$me = $this->fb_me;*/
		if(!empty($me)){
			echo $this->fb_ignited->fb_logout_url();
		}
    }
	
    function generatebreadcrumbs($breadcrumbs = array()) 
    {			
		$breads = array();
		if(is_array($breadcrumbs) && count($breadcrumbs) > 0) {
			foreach($breadcrumbs as $bread) {
				if(isset($bread['url']))
					$breads[] = "<a href='{$bread['url']}'>{$bread['name']}</a>";
				else
					$breads[] = "<b>{$bread['name']}</b>";
			}	
		}
		return $breads;
    }

    function uid() 
    {
        return $this->session->userdata('uid');
    }
	
    function gid()
    {
        if ($this->uid()) {
			$user = $this->user();
			return $user->gid;
		}
		return 0;
    }
	
/*    function profile() 
    {
//        return $this->session->userdata('profileid');
        static $result;
        /*if ($force_new) { unset($result); }*

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('Profilemodel');
			
	        $profileid = $this->session->userdata('profileid');

            if ($profileid) {
                $result = $ci->Profilemodel->getById($profileid);
            }
            else 
            {
                $result = FALSE;
            }
        }		
        return $result;
    }
*/
    function optionmember() 
    {
		$opt = $this->session->userdata('optionmember');
		if(!empty($opt))
			return $opt;
		else
			return '0';
    }
	
    function freeuser() 
    {
		$ci =& get_instance();
		$ci->load->model('Usermodel');
		return $ci->Usermodel->freeuser()->id;
    }	

    function user($force_new = FALSE) 
    {
        static $result;
        if ($force_new) { unset($result); }

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('Usermodel');
            if ($this->uid()) {
                $result = $ci->Usermodel->getById($this->uid());
            }
            else 
            {
                $result = FALSE;
            }
        }		
        return $result;
    }
	
    function profile($force_new = FALSE) 
    {
        static $result;
        if ($force_new) { unset($result); }

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('Profilemodel');
            if ($this->uid()) {
                $result = $ci->Profilemodel->getByField($this->uid(),'uid');
            }
            else 
            {
                $result = FALSE;
            }
        }		
        return $result;
    }

    function company($force_new = FALSE) 
    {
        static $result;
        if ($force_new) { unset($result); }

        if (!isset($result)) 
        { 
            $user = $this->user();
            if ($this->uid()) {
				if ($user->gid == 4) {
					$ci =& get_instance();
					$ci->load->model('Dealermodel');
				
					$result = $ci->Dealermodel->getByField($user->id,'uid');
				}elseif ($user->gid == 3) {
					$ci =& get_instance();
					$ci->load->model('Restaurantmodel');
				
					$result = $ci->Restaurantmodel->getFromBranchUserUid($user->id);
				}
            }
            else 
            {
                $result = FALSE;
            }
        }		
        return $result;
    }
	
    function get_user($data) 
    {
        static $result;

        if (!isset($result)) 
        {
            $ci =& get_instance();
            $ci->load->model('Usermodel', 'muser');
            if ($this->uid()) {
                $result = $this->uid();
            }
            else
            {
                $result = $ci->muser->getByField($data,'username');
				
				if($result){
					return $result->id;
				}else{
					$cp =& get_instance();
					$cp->load->model('Profilemodel', 'mprofile');
					$result = $cp->mprofile->getByField($data,'email');
					
					if($result){
						return $result->uid;
					}else{
						return null;
					}
				}
            }
        }
        return $result;
    }
	
/*    function getUserByField($data='',$field='id') 
    {
        static $result;

        if (!isset($result)) 
        {
            $ci =& get_instance();
            $ci->load->model('Usermodel', 'muser');
            if ($this->uid()) {
                $result = $this->uid();
            }else{
                $result = $ci->muser->getByField($data,$field);
				
				if($result){
					return $result;
				}else{
					return null;
				}
            }
        }
        return $result;
    }
*/
    function subscription() 
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('Subscriptionmodel', 'subs');
            if ($this->uid()) {
                $result = $ci->subs->getSubscriptionByUserId($this->uid());
            }
            else 
            {
                $result = FALSE;
            }
        }
        return $result;
    }	
	
    function customer() 
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('Customermodel', 'custom');
            if ($this->uid()) {
                $result = $ci->custom->getCustomerByUserId($this->uid());
            }
            else 
            {
                $result = FALSE;
            }
        }
        return $result;
    }	
    function countries()
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('countrymodel', 'mcountry');

			$result = $ci->mcountry->getCountryList()->result();
        }
        return $result;
    }	
    function mywishlist()
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('wishlistitemsmodel', 'mwishlistitems');

			$result = $ci->mwishlistitems->getWishlistitemsViewByUserList($this->uid());
        }
        return $result;
    }	
    function countrybyuser() 
    {
        static $result;

        if (!isset($result)) 
        { 
			if($this->uid()){
				$user = $this->user();
				if($user->gid == 3){
					$ci =& get_instance();
					$ci->load->model('customermodel', 'mcustomer');
	                $resultcountry = $ci->mcustomer->getByField($user->id,'uid');
					$result = $resultcountry->country_origin;
				}else if($user->gid == 4){
					$ci =& get_instance();
					$ci->load->model('organizationmodel', 'morganization');
	                $resultcountry = $ci->morganization->getByField($user->id,'uid');
					$result = $resultcountry->country;
				}
			}

        }
        return $result;
    }	
    function categories() 
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('categoriesmodel', 'mcategories');

			$result_array = $ci->mcategories->getTreeView();		
			$result = $this->getListUL($result_array);
        }
        return $result;
    }	
	function getListUL($tree,$level = 0)
    {
		$list = "";
		if(isset($tree)){
			foreach($tree as $val)
			{
				if(isset($val['son'])&&(!empty($val['son']))){
					$list .= "<li><a href='javascript:void(0)' onclick='filterCategory(".$val['id'].")'>".$val['name']."</a>";

					$list .= "<ul>";
					$list .= $this->getListUL($val['son'],($level + 1));
					$list .= "</ul>";
				}else{
					if($level == 0){
						$list .= "<li><a href='javascript:void(0)' onclick='filterCategory(".$val['id'].")'>".$val['name']."</a>";
					}else{
						$list .= "<li><a href='javascript:void(0)' onclick='filterCategory(".$val['id'].")'>".$val['name']."</a>";
					}
				}
			}
			return $list;
		}else{ return NULL;}
	}

    function recently($country = '%') 
    {
        static $result;

        if (!isset($result)) 
        {
            $ci =& get_instance();
            $ci->load->model('inventorymodel', 'minventory');
			
			$filter = array();
			if($this->session->userdata('uid')){
				$filter['uid'] = $this->session->userdata('uid');}
			
			$filter['country'] = $country;
//			$filter['recently'] = true;

			$result = $ci->minventory->getRecentlyOffers($filter);
        }
        return $result;
    }	
    function languages()
    {
        static $result;

        if (!isset($result)) 
        { 
            $ci =& get_instance();
            $ci->load->model('languagemodel', 'mlanguage');

			$result = $ci->mlanguage->getLanguageListArray('desc');
        }
        return $result;
    }
	
    function getcookiecountry()
    {
//        return $this->input->cookie('countryFilter');
        //return $this->session->userdata('giftcountry');
		if (isset($_COOKIE['giftcountry']))
			return $_COOKIE['giftcountry'];
		else
			return false;
    }
	
    function getcookielanguage()
    {
        return $this->input->cookie('giftlanguage');
        //return $this->session->userdata('giftcountry');
/*		if (isset($_COOKIE['giftcountry']))
			return $_COOKIE['giftcountry'];
		else
			return false;
*/    }
	
    function getcart()
    {
        static $result;

        if (!isset($result))
        {
            $ci =& get_instance();
            $ci->load->model('cartmodel', 'mcart');

			if($this->uid()){
				$uid = $this->uid();
				$city = $this->session->userdata('city');
				$restaurantscarts = $ci->mcart->getCartGroupByRestaurantByFieldAndUriCityList($uid, 'uid', $city);
				
				$restaurants = array();
				if((isset($restaurantscarts))&&(!empty($restaurantscarts))){
					foreach($restaurantscarts as $key => $restaurantcart){
						$restid = $restaurantcart['restid'];
						
						$restaurants[$restid]['restname'] = $restaurantcart['restname'];
						$restaurants[$restid]['restlogo'] = $restaurantcart['restlogo'];
						$restaurants[$restid]['resturi'] = $restaurantcart['resturi'];

						unset($restaurantcart['restid']);
						unset($restaurantcart['restname']);
						unset($restaurantcart['restlogo']);
						unset($restaurantcart['resturi']);

						$restaurants[$restid]['carts'][] = $restaurantcart;
					}
				}
				/*status for any restaurant*/
				foreach($restaurants as $key => $restaurant){
					$cartstatus = $ci->mcart->getStatusCartByidRestByUid($key, $uid);

					$status = 0;
					if((isset($cartstatus))&&(!empty($cartstatus)))
						$status = $cartstatus[0]['status'];

					$restaurants[$key]['status'] = $status;
				}

				$result = $restaurants;
			}
        }
        return $result;
    }

    function qtyincart()
    {
        static $result;

        if (!isset($result))
        {
            $ci =& get_instance();
            $ci->load->model('cartmodel', 'mcart');

			if($this->uid()){
				$uid = $this->uid();
				$result = $ci->mcart->getQtyCartByField($uid, 'uid');
			}else{
				$session_id = $this->session->userdata('ip_address');
				$result = $ci->mcart->getQtyCartByField($session_id, 'session');
			}			
        }
        return $result;
    }
	
    function totalincart()
    {
        static $result;

        if (!isset($result))
        {
            $ci =& get_instance();
            $ci->load->model('cartmodel', 'mcart');

			if($this->uid()){
				$uid = $this->uid();
				$carts = $ci->mcart->getCartByFieldList($uid, 'uid');
				$result = 0;
				if((isset($carts)) && (!empty($carts))){
					foreach($carts as $cart){
						$result += $cart['price']*$cart['quantity'];
					}
				}
			}			
        }
        return $result;
    }

    function getcartstatus($idrest = 0)
    {
        static $result;

        if (!isset($result))
        {
            $ci =& get_instance();
            $ci->load->model('cartmodel', 'mcart');

			if($this->uid()){
				$uid = $this->uid();
				$carts = $ci->mcart->getStatusCartByidRestByUid($idrest, $uid);
/*echo "rest:".$idrest;
echo "<pre>";
print_r($carts);
echo "</pre>";*/
				$result = 0;
				if((isset($carts))&&(!empty($carts)))
					$result = $carts[0]['status'];
			}
        }
        return $result;
    }

    function countryincart()
    {
        static $result;

        if (!isset($result))
        {
			if($this->uid()){
				$ci =& get_instance();
				$ci->load->model('cartdetailmodel', 'mcartdetail');

				$result = $ci->mcartdetail->getCountryByCart($this->uid());
			}
        }
        return $result;
    }

    function set_idfacebook($id) 
    {
        return $this->session->set_userdata('idfacebook', $id);
    }
	
    function set_uid($id) 
    {
        return $this->session->set_userdata('uid', $id);
    }
    function unset_uid() 
    {
        return $this->session->unset_userdata('uid');
    }
    
    function set_profile($id) 
    {
        return $this->session->set_userdata('profileid', $id);
    }
    function unset_profile() 
    {
        return $this->session->unset_userdata('profileid');
    }

    function login($user)
    {
		$query_profile = $this->db->get_where('profile', array('uid' => $user->id));
		$cant_profiles = $query_profile->num_rows();
		if ($cant_profiles > 0){
			$p = $query_profile->row();
			$profile_id = $p->id;
		}else{
			$profile_id = NULL;
		}
		$this->set_profile($profile_id);
        return $this->set_uid($user->id);
    }
	
    function loginById($uid)
    {
		$query_profile = $this->db->get_where('profile', array('uid' => $uid));
		$cant_profiles = $query_profile->num_rows();
		if ($cant_profiles > 0){
			$p = $query_profile->row();
			//echo "<pre>LOGIN PROFILE<br />";
			//print_r($p);
			//echo "</pre>";
			$profile_id = $p->id;
		}else{
			$profile_id = NULL;
		}
		$this->set_profile($profile_id);
        return $this->set_uid($uid);
    }
	
 /**
   * Created the cookie with the persistence data
   * @param Array $data containing the profile_id, ip and unique_id keys
   */
  function _create_persistence_cookie($data) {
  	if(!$data['uid'] || !$data['ip'] || !$data['unique_id'] || !$data['time'])
		  return 0;
		$expire = (int)$data['time'] + 259200; 
		$value = $data['uid'] . ':' . $data['ip'] . '|' . $data['unique_id'] . '|' . $data['time'];
		/**$cookie = array('name'   => 'flysocial', 
		                'value'  => $value,
		                'expire' => $expire
		               );  
		set_cookie($cookie);*/
		setcookie('flysocial', $value, $expire, '/');
		return;
	}
	
	/**
	 * Removes the current persistence key for the current user on logout
	 */
	function remove_persistence_data () {
		//$ci =& get_instance();
		//$ci->load->model('Persistencemodel');
	
	
	
		if ($this->session->userdata('key_id')) {
		  // expire cookie
		  setcookie ("flysocial", false, time() - 3600, '/');
		  // remove persistence data from db
		  $this->persistence->remove_persistence_key($this->session->userdata('key_id'));
		}
		if ($this->session->userdata('tabshop')) {
		  // expire cookie
		  //setcookie ("flysocial", false, time() - 3600, '/');
		  // remove persistence data from db
		  $this->persistence->remove_persistence_key($this->session->userdata('tabshop'));
		}
		
	}	
	
    function logout() { 
    	$this->unset_uid(); 
    	$this->unset_profile();
    }
	
	function getstates($postoffice = false, $mode = 'ARRAY')
	{
		$states = array();
		$basicstates = array('AL'=>'Alabama', 'AK'=>'Alaska', 'AZ'=>'Arizona', 'AR'=>'Arkansas', 'CA'=>'California', 'CO'=>'Colorado', 'CT'=>'Connecticut', 'DE'=>'Delaware', 'DC'=>'District Of Columbia', 'FL'=>'Florida', 'GA'=>'Georgia', 'HI'=>'Hawaii', 'ID'=>'Idaho', 'IL'=>'Illinois', 'IN'=>'Indiana', 'IA'=>'Iowa', 'KS'=>'Kansas', 'KY'=>'Kentucky', 'LA'=>'Louisiana', 'ME'=>'Maine', 'MD'=>'Maryland', 'MA'=>'Massachusetts', 'MI'=>'Michigan', 'MN'=>'Minnesota', 'MS'=>'Mississippi', 'MO'=>'Missouri', 'MT'=>'Montana', 'NE'=>'Nebraska', 'NV'=>'Nevada', 'NH'=>'New Hampshire', 'NJ'=>'New Jersey', 'NM'=>'New Mexico', 'NY'=>'New York', 'NC'=>'North Carolina', 'ND'=>'North Dakota', 'OH'=>'Ohio', 'OK'=>'Oklahoma', 'OR'=>'Oregon', 'PA'=>'Pennsylvania', 'RI'=>'Rhode Island', 'SC'=>'South Carolina', 'SD'=>'South Dakota', 'TN'=>'Tennessee', 'TX'=>'Texas','UT'=>'Utah', 'VT'=>'Vermont','VA'=>'Virginia', 'WA'=>'Washington','WV'=>'West Virginia', 'WI'=>'Wisconsin','WY'=>'Wyoming', 'NA' => 'Other');
		
		if($postoffice == false)
		{
			$newstates = $basicstates;
		}
		elseif($postoffice)
		{
			$newstates = array();
			foreach($basicstates as $item => $value)
			{
				$newstates[$item] = $item;	
			}
		}
		
		switch($mode)
		{
			case 'JSON':
				echo json_encode($newstates);
				break;
			case 'ECHO':
				echo $newstates;	
				break;
			case 'ARRAY':
				return $newstates;	
				break;	
		}
		return false;	
	}
		
	function getcountrylist($mode = 'ARRAY')
	{
		//$countrylist = array();
		$countrylist = array("Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros","Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepa","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");

		switch($mode)
		{
			case 'JSON':
				echo json_encode($countrylist);
				break;
			case 'ECHO':
				echo $countrylist;	
				break;
			case 'ARRAY':
				return $countrylist;	
				break;	
		}
		return false;	
	}
	
	function getRangeOfDates()
	{
		$command = "SELECT DATE_FORMAT(CURDATE(),'%Y-%m-%d') AS now,DATE_FORMAT(CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY,'%Y-%m-%d') AS dateiniweek,";
		$command .= " DATE_ADD(DATE_FORMAT(CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY,'%Y-%m-%d'),INTERVAL 6 DAY) AS dateendweek,";
		$command .= " (LAST_DAY(LAST_DAY(CURDATE())-INTERVAL 1 MONTH)+INTERVAL 1 DAY) AS datainimonth,";
		$command .= " STR_TO_DATE(CONCAT(YEAR(CURDATE()),'-',MONTH(CURDATE()),'-01'),'%Y-%m-%d') AS datainimonth2,";
		$command .= " LAST_DAY(CURDATE()) AS dataendmonth,";
		$command .= " STR_TO_DATE(CONCAT(YEAR(CURDATE()),'-01-01'),'%Y-%m-%d') AS dateiniyear,";
		$command .= " STR_TO_DATE(CONCAT(YEAR(CURDATE()),'-12-31'),'%Y-%m-%d') AS dateendyear;";
		//echo $command;
		$query = $this->db->query($command);

		return $query->result_array();
	
	}
}

/* End of file systemmodel.php */
/* Location: ./system/application/models/systemmodel.php */
