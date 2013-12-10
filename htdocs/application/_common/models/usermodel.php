<?php
require_once(@realpath(dirname(__FILE__)).'/basemodel'.EXT);
class Usermodel extends Basemodel
{

    protected $_table_name = "user";

    const SALT_LENGTH         	= 10;
    const ACTIVATION_INTERVAL 	= 3600; // 1 hour
    const ADMIN_GID           	= 1;
    const CLIENT_GID      		= 2;
    const COMPANY_GID     		= 3;
    const TAXI_GID    	  		= 4;
    const RADIOTAXI_GID    	  	= 5;
    protected $activation_code = null;
    protected $disabled = null;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getCount($option = 0) {
        $command = "SELECT COUNT(id) AS qty";
        $command .= " FROM $this->_table_name";

        if($option == 1 )
            $command .= " WHERE DATE_FORMAT(created,'%Y-%m-%d') = DATE_FORMAT(CURDATE(),'%Y-%m-%d')";

        $query = $this->db->query($command);

        return (object)$this->_singleRow($query);
    }

    public function getTotalViewsbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('profileviews');
        $this->db->where('uid', $uid);
        //if($filter)$this->db->where('current', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalFriendsbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('friend');
        $this->db->where('uid', $uid);
        //if($filter)$this->db->where('current', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }


    public function getlastLoginById($uid) {

        $uid = (int)$uid;

        $this->db->select('date as lastlogin, ipnumber as lastlogin_ip');
        $this->db->from('userlogged');
        $this->db->where('uid', $uid);
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get();

        $res = new stdClass();
        $res->lastlogin = 'Never';
        $res->lastlogin_ip = 'None';
        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $res = $result[0];
            //$res['lastlogin'] = $result[0]->lastlogin;
            //$res['lastlogin_ip'] = $result[0]->lastlogin_ip;
        }
        return $res;
    }

    public function getTotalFlightsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('flight');
        $this->db->where('uid', $uid);
        if($filter)
            $this->db->where('current', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalSocialNetworksbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('usersocial');
        $this->db->where('uid', $uid);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getSocialNamesById($uid) {

        $uid = (int)$uid;

        $this->db->select('social_network.name, social_network.url');
        $this->db->from('social_network');
        $this->db->join('usersocial','usersocial.idsocial = social_network.id', 'left');
        $this->db->where('usersocial.uid', $uid);
        //$this->db->order_by('date', 'DESC');
        $query = $this->db->get();

        $res = array('None');
        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            $res = array();
            foreach($result as $row) {
                $res[] = "<a href='{$row->url}' target='_blank'>{$row->name}</a>";
            }
        }
        return $res;
    }


    public function getTotalEventsbyId($uid, $current = false, $public = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('event');
        $this->db->where('uid', $uid);
        if($current)
            $this->db->where('status', 1);

        if($public)
            $this->db->where('public', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalCheckinsbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('checkin');
        $this->db->where('uid', $uid);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalBadgesbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('badge_earned');
        $this->db->where('uid', $uid);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalMilesbyId($uid) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('SUM(miles) as total');
        $this->db->from('flight');
        $this->db->where('uid', $uid);
        $this->db->group_by('uid');

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }


    public function getTotalPMbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('private_message');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalWallPostsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('wall_post');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalEventPostsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('event_post');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalTicketsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('ticket');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalBookingsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('hotel_booking');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function getTotalRentalsbyId($uid, $filter = false) {

        $uid = (int)$uid;
        $total = 0;

        $this->db->select('COUNT(*) as total');
        $this->db->from('car_rental');
        $this->db->where('uid', $uid);

        if($filter)
            $this->db->where('status', 1);


        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            /*
            echo "<pre>";
            print_r($result);
            echo "</pre>";
            */
            $total = (int)$result[0]->total;
        }
        return $total;
    }

    public function deleteByID($id) {

        $id = (int)$id;

        ////DELETE USER LOGGED
        //$this->db->where('uid', $id);
        //$this->db->delete('userlogged');

        ////DELETE USER LOGIN
        //$this->db->where('uid', $id);
        //$this->db->delete('useronline');

        //DELETE USER PROFILE
        $this->db->where('uid', $id);
        $this->db->delete('profile');

        ////DELETE USER FRIEND
        //$this->db->where('uid', $id);
        //$this->db->delete('friend');

        //DELETE USER PERSISTENCE
        $this->db->where('uid', $id);
        $this->db->delete('userpersistence');

        //DELETE USER PERSISTENCE
        $this->db->where('uid', $id);
        $this->db->delete('badge_earned');

        //DELETE USER CHECKIN
        $this->db->where('uid', $id);
        $this->db->delete('checkin');

        $res = parent::deleteByID($id);

        return $res;
    }


    public function changeStatus($id,$status = 0)
    {
        $id = (int)$id;
        return $this->updatefield($id,'status', $status);
    }

    /**
     * generate hash results code
     *
     **/
    function hash_results_code()
    {
        return $this->hash_password($this->uniqseq());
    }

    /**
     * get Free User ID
     * @var
     **/
    function freeuser()
    {
        $query = $this->db->where('gid', 3)//FREE USER
            ->limit(1)
            ->get($this->_table_name);
        return ($query->num_rows() == 1)? $query->row() : false;
    }

    /**
     * Returns true if username is unused, false otherwise
     *
     **/
    function is_unused_username($username)
    {
        return $this->get($username) ? FALSE : TRUE;
    }


    function get($params)
    {
        if (!is_array($params)) { $params = array('username' => $params); }
        $u = $this->db->get_where('user', $params)->row();
        if ($u) { return $this->complete($u); }
        return FALSE;
    }

    /**
     * Authenticate user by password (or by activation_code, using third parameter)
     *
     **/
    function authenticate_user($user, $password, $password_field = 'password')
    {
        if (!is_object($user)) { $user = parent::getById($user); }


        //echo $user->$password_field;
        //echo "<pre>";
        //print_r("PASSWORD: " . $password);
        //echo "</pre>";
        //print_r("USER PASSWORD: " . $user->$password_field);
        //echo "</pre>";

        if ($user && $this->password_match_hash($password, $user->$password_field)) { return $user; }
        else { return FALSE; }
    }

    function authenticate_credit($credit, $code)
    {
        //echo "<pre>";
        //print_r("ACTIVATION CODE: " . $credit->activation_code);
        //echo "<pre>";
        //print_r("CODE: " . $code);
        //echo "</pre>";

        if ($credit && $this->password_match_hash($code, $credit->activation_code)) { return $credit; }
        else { return FALSE; }
    }

    /**
     * forgot password register new password for existing email
     *
     **/
    function forgot_password($user, $sha1 = true)
    {
        if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
        $newpassword = $this->uniqseq();

        if($sha1) {
            $user['password'] = $this->hash_password(sha1($newpassword));
        } else {
            $user['password'] = $this->hash_password($newpassword);
        }

        //echo "<pre>";
        //print_r("SHA1 PASSWORD: " . sha1($newpassword));
        //echo "<pre>";
        //print_r("PASSWORD: " . $newpassword);
        //echo "</pre>";
        //print_r("USER PASSWORD: " . $user['password']);
        //echo "</pre>";
        //$user['password'] = $this->hash_password(sha1($newpassword));

        $uid = parent::save($user);

        if ($uid)
        {
            $user['newpassword'] = $newpassword;
            return $user;
        }
        return false;
    }

    function get_password($user)
    {
        $newpassword = 'testing';
        if (!empty($newpassword))
        {
            return $newpassword;
        }
        return false;
    }

    function updatepassword($user, $sha1 = true)
    {
        $newpassword = $user['password'];

        //echo "<pre>";
        //print_r(sha1($user['password']));
        //echo "</pre>";

        if($sha1) {
            $user['password'] = $this->hash_password(sha1($user['password']));
        } else {
            $user['password'] = $this->hash_password($user['password']);
        }

        $uid = parent::save($user);
        log_message("debug","******passwordchanged:"+$uid);
        //echo $uid;

        if ($uid > 0)
        {
            return $user;
        }
        return false;
    }

    function register($user, $sha1 = true, $gid = self::CLIENT_GID)
    {
        if($sha1) {
            $user['password'] = $this->hash_password(sha1($user['password']));
        } else {
            $user['password'] = $this->hash_password($user['password']);
        }

        //solo mandar el usergroup ID como parametro al final por defecto es self::CLIENT_GID
        $user['gid'] = $gid;

        //codigo obsolete para el type de usuario reemplazado por usergroup ID
        /*
        if($type == 'client') {
            $user['gid'] = self::CLIENT_GID;
        } elseif($type == 'company') {
            $user['gid'] = self::COMPANY_GID;
        } elseif($type == 'taxi') {
            $user['gid'] = self::TAXI_GID;
        } else {
        }
        */

        $uid = parent::save($user);

        if ($uid)
        {
            $user['id'] = $uid;
            $this->deactivate($user);
            $user = $this->usercomplete($user);
            return $user;
        }
        return false;
    }

    function deactivate_credit($credit)
    {
        $activation_code = $this->salt();
        $credit['debit_note'] = "PA-".$credit['amount']."-".$activation_code;
        $credit['activation_code']  = $this->hash_password($credit['debit_note']);
        //$credit['activation_code']  = $activation_code;
        return $credit;
    }

    function deactivate($user)
    {
        $activation_code = $this->uniqseq();
        $user['activation_code']    = $this->hash_password($activation_code); // created user must be deactivated
        $user['activation_expires'] = time() + self::ACTIVATION_INTERVAL;
        //echo $activation_code;
        $this->activation_code = $activation_code;
        return parent::save($user);
    }

    function activate($uid, $activation_code)
    {
        $user = $this->authenticate_user($uid, $activation_code, 'activation_code');
        if ($user) {
            $user->activation_code = NULL;
            $user->activation_expires = NULL;
            $this->activation_code = NULL;
            if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
            if(isset($user['group'])){
                unset($user['group']);
            }
            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */
            $uid = parent::save($user);
        }
        return $user;
    }

    function activate_credit($credit, $code)
    {
        $credit = $this->authenticate_credit($credit, $code);

        //echo "<pre>";
        //print_r($credit);
        //echo "</pre>";

        if ($credit) {
            $credit->activation_code = NULL;
            if (! is_array($credit) && is_object($credit)) { $credit = get_object_vars($credit); }
            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */
            //$uid = parent::save($user);
        }
        return $credit;
    }

    function approved($uid)
    {
        $user = $this->getById($uid);
        if ($user) {
            $user->activation_code = NULL;
            $user->activation_expires = NULL;
            $this->activation_code = NULL;
            if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
            if(isset($user['group'])){
                unset($user['group']);
            }
            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */
            $uid = parent::save($user);
        }
        return $user;
    }

    function rejected($uid)
    {
        $user = $this->getById($uid);
        if ($user) {
            $user->activation_code = 'REJECTED';
            $user->activation_expires = date('Y-m-d');
            $this->activation_code = 'REJECTED';
            if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
            if(isset($user['group'])){
                unset($user['group']);
            }
            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */
            $uid = parent::save($user);
        }
        return $user;
    }

    function pending($uid)
    {
        $user = $this->getById($uid);
        if ($user) {
            $user->activation_code = 'PENDING';
            $user->activation_expires = date('Y-m-d');
            $this->activation_code = 'PENDING';
            if (! is_array($user) && is_object($user)) { $user = get_object_vars($user); }
            if(isset($user['group'])){
                unset($user['group']);
            }
            /*
            echo "<pre>";
            print_r($user);
            echo "</pre>";
            */
            $uid = parent::save($user);
        }
        return $user;
    }

    function usercomplete($user)
    {
        if (!isset($user['group']) || $user['gid'] !== $user['group']['id'])
        {
            $g = $this->db->get_where('usergroup', array('id' => $user['gid']))->row();
            $user['group'] = get_object_vars($g);
        }
        return $user;
    }

    function _remove_extra_keys($data, $form_name, $bad_keys = array())
    {
        $this->load->config('form_validation', TRUE);

        $vrules = $this->config->item($form_name, 'form_validation');

        foreach ($vrules as $rule)
        {
            $name = $rule['field'];
            if (isset($data[$name]) && !in_array($name, $bad_keys)) {
                $result[$name] = $data[$name];
            }
        }
        return $result;
    }

    /**
     * Complete the user object by loading group values if needed
     *
     **/
    function complete($user)
    {
        /*
         * turning on the output buffering for this process
         * for some reason it is getting error related to this
         * TODO: verify why it is getting buffering issues here
         */
        //ob_start();

        if (!isset($user->group) || $user->gid !== $user->group->id)
        {
            $g = $this->db->get_where('usergroup', array('id' => $user->gid))->row();
            $user->group = $g;
        }
        return $user;
    }

    //Fixed to use SHA1 by default
    function login_check($data, $sha1 = true)
    {
        $user = $this->get($data['username']);
        if ($user){
            if (($user->activation_code) || (isset($user->disabled) && $user->disabled==1)) { return FALSE; }
            if($sha1) {
                $authenticated = $this->authenticate_user($user, sha1($data['password']));
            } else {
                $authenticated = $this->authenticate_user($user, $data['password']);
            }

            //echo "<pre>";
            //print_r($authenticated);
            //echo "</pre>";
            //exit;

            return $authenticated;
        } else {
            return FALSE;
        }
    }

    /**
     * Check if password match hashed password
     *
     **/
    function password_match_hash($password, $hashed_password)
    {
        return $hashed_password == $this->hash_password($password, $this->extract_salt($hashed_password));
    }

    /**
     * Extract salt from the hashed password
     *
     **/
    function extract_salt($hashed_password)
    {
        return substr($hashed_password, 0, self::SALT_LENGTH);
    }

    /**
     * Hashes the password to be stored in the database.
     *
     **/
    function hash_password($password, $salt = NULL)
    {
        if ($salt === NULL) { $salt = $this->salt(); }
        return $salt . $this->hash($salt . $password);
    }

    /**
     * Checks whether given user is admin
     *
     **/
    function is_admin(Object $u)
    {
        return $u->gid == 1;
    }

    /**
     * Generates a random uniq sequence.
     *
     **/
    function uniqseq()
    {
        /*		$userdata = uniqid(rand(), true);
                $userdata = (int)$userdata;
                //SET PASSWORD
                $this->session->set_userdata('usernewdata',$userdata);

                return md5($userdata);
        */
        return md5(uniqid(rand(), true));
    }

    /**
     * Generates a random salt value.
     *
     **/
    function salt()
    {
        return substr($this->uniqseq(), 0, self::SALT_LENGTH);
    }

    /**
     * Hashing function
     *
     **/
    function hash($str)
    {
        return sha1($str);
    }

    function getAllWithProfiles()
    {
        $result = array();
        $query = $this->db->query("select id, username, disabled from user");
        if ($query->num_rows()>0){
            foreach ($query->result() as $row)
            {
                $userid = $row->id;
                $query = $this->db->query("select * from profile where user_id='".$userid."'");
                $result[$userid]['user']=$row;
                $result[$userid]['profiles']=$query;
            }
        }
        return $result;
    }

    function getUserWithProfile($uid)
    {
        $result = array();
        $query = $this->db->query("select id, username, password from user where id = '". $uid."'");
        if ($query->num_rows()>0){
            foreach ($query->result() as $row)
            {
                $userid = $row->id;
                $query = $this->db->query("select * from profile where uid='".$userid."'");
                $result['user']=$row;
                $result['profile'] = $query->row();
            }
        }
        return $result;
    }

    function getProfilesByKeywords($firstname, $lastname){
        $result = array();
        $q="";
        if ($firstname){
            $q = " firstname like '%".mysql_escape_string($firstname)."%' ";
        }
        if ($lastname){
            if ($q){
                $q.= " and ";
            }
            $q = " lastname like '%".mysql_escape_string($lastname)."%' ";
        }

        if ($q){
            $q = " where ".$q;
        }

        $users = array();
        $query = $this->db->query("select id, user_id from profile ".$q);
        if ($query->num_rows()>0){
            $profile_q = "";
            $first = 1;
            foreach ($query->result() as $row)
            {
                if ($first){
                    $profile_q= "( id='".$row->id."' ";
                    $first=0;
                }else{
                    $profile_q .= " or id='".$row->id."' ";
                }
                if (!in_array($row->user_id, $users)){
                    array_push($users,$row->user_id);
                }
            }
            $profile_q .= ")";

            foreach ($users as $userid){
                $query = $this->db->query("select id, username, disabled from user where id='".$userid."'");
                $user = $query->row();
                $query2 = $this->db->query("select * from profile where user_id='".$userid."' and ".$profile_q);
                $result[$userid]['user']=$user;
                $result[$userid]['profiles']=$query2;
            }
        }
        return $result;
    }

    function updatefield($userid, $field, $value)
    {
        return $this->db->where('id', $userid)->update('user', array($field => $value));
    }

    function delete_profile($id){
        $this->db->delete('profile_food_selection', array('profile_id'=>$id));
        $this->db->delete('profile_diet', array('profile_id'=>$id));
        $this->db->delete('profile_condition', array('profile_id'=>$id));
        $this->db->delete('profile', array('id'=>$id));
    }

    function delete_user($id){
        $query = $this->db->query("select id from profile where user_id='".$id."'");
        foreach ($query->result() as $row)
        {
            $profile_id = $row->id;
            $this->delete_profile($profile_id);
        }
        $this->db->delete('user', array('id'=>$id));
    }

    function getProfiles($userID)
    {
        $query = $this->db->get_where("profile",array("user_id"=>$userID));
        return $query;
    }

    public function getUsersList()
    {
        $this->db->from($this->_table_name);
        $query = $this->db->get();

        //$sql = $this->db->last_query();
        //echo $sql;

        $result = $query->row();
        if ($query->num_rows() > 0){
            $res = $query->result_array();
            return $res;
        }
        return false;
    }

    function start_activation($user, $profile)
    {
        if (!isset($this->activation_code)) { $this->deactivate($user); }
        $data = array();
        $data['uid'] = $user['id'];
        $data['activation_code'] = $this->activation_code;

        //GET USERNEWDATA
        $usernewdata = $this->session->userdata('usernewdata');
        if(!empty($usernewdata)){
            $data['usernewdata'] = $usernewdata;
        }

        $subject = "{$this->config->item('email_from_name')}: Active su cuenta";
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/activation', $data, true);

        $from = "{$this->config->item('email_from_name')} <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }

    function facebook_signup($user, $profile)
    {
        $data = array();
        $data['uid'] = $user['id'];
        $data['activation_code'] = $this->activation_code;

        $subject = "{$this->config->item('email_from_name')}: Inicio de Sesion con Facebook";
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/facebooksignup', $data, true);

        $from = "{$this->config->item('email_from_name')} <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }

    function forgot_password_mail($data)
    {
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.forgot');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/forgot', compact('data'), true);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $data['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        //$res = send_email($to, $from, $subject, $message);
        $res = send_email($to, $from, $subject, $message);
        /*
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        */
        return ($res)?true:false;
    }

    function credit_activate_mail($data)
    {
        $subject = $this->config->item('email_from_name') . ": Credito Activado";
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/member/credit', compact('data'), true);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $data['email'];

        //SEND COPY EMAILS
        $cc = "";
        $bcc = $this->config->item('email_from_address');
        //SEND EMAIL
        //$res = send_email($to, $from, $subject, $message);
        $res = send_email($to, $from, $subject, $message, $cc, $bcc);
        /*
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        */
        return ($res)?true:false;
    }

    function activation_code_mail($data)
    {
        $subject = $this->config->item('email_from_name') . ": Codigo de Activacion FarmaCorp";
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/member/farmacode', compact('data'), true);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $data['email'];

        //SEND COPY EMAILS
        $cc = "";
        $bcc = $this->config->item('email_from_address');
        //SEND EMAIL
        //$res = send_email($to, $from, $subject, $message);
        $res = send_email($to, $from, $subject, $message, $cc, $bcc);
        /*
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        */
        return ($res)?true:false;
    }

    function credit_revert_mail($data)
    {
        $subject = $this->config->item('email_from_name') . ": Credito Revertido";
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/member/creditrevert', compact('data'), true);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $data['email'];

        //SEND COPY EMAILS
        $cc = "";
        $bcc = $this->config->item('email_from_address');
        //SEND EMAIL
        //$res = send_email($to, $from, $subject, $message);
        $res = send_email($to, $from, $subject, $message, $cc, $bcc);
        /*
        echo "<pre>";
        print_r($res);
        echo "</pre>";
        */
        return ($res)?true:false;
    }

    function member_activation_email($user, $profile)
    {
        if (!isset($this->activation_code)) { $this->deactivate($user); }
        $data = $user;
        $data['uid'] = $user['id'];
        $data['activation_code'] = $this->activation_code;

        //$subject = "{$this->config->item('email_from_name')}: Active su cuenta";
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.activate');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/activation', $data, true);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }


    function profile_forgotpassword_email($forgot)
    {
        $data = array();
        $data['data'] = $forgot;
        /*
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        */
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.forgot');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/forgot', $data, TRUE);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $forgot['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }

    function profile_subscribe_email($profile)
    {
        $data = array();
        $data['email'] = $profile['email'];
        //$subject = "{$this->config->item('email_from_name')}: Suscripcion al Newsletter";
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.subscription');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/subscribe', $data, TRUE);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }

    function change_password_email($user, $profile)
    {
        $data = array();
        $data['email'] = $profile['email'];
        $data['username'] = $user['username'];
        $data['newpassword'] = $user['password'];
        //$subject = "{$this->config->item('email_from_name')}: Contrase�a Modificada";
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.pass.modified');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/newpassword', $data, TRUE);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $cc = "<{$this->config->item('email_from_address')}>";
        $bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message, $cc, $bcc);
        return $res;
    }

    function change_field_email($user, $profile)
    {
        $data = array();
        $data['email'] = $profile['email'];
        $data['username'] = $user['username'];
        $data['newpassword'] = $user['password'];
        $data['firstname'] = $profile['firstname'];
        $data['lastname'] = $profile['lastname'];

        //$subject = "{$this->config->item('email_from_name')}: Contrase�a Modificada";
        $subject = $this->config->item('email_from_name') . ": " . lang('user.email.profile.subject.pass.modified');
        //GET EMAIL CONTENT FROM DATABASE
        $message = $this->load->view('email/profile/fieldchange', $data, TRUE);

        $from = "<{$this->config->item('email_from_name')}> <{$this->config->item('email_from_address')}>";
        $to = $profile['email'];

        //SEND COPY EMAILS
        $Cc = "";
        $Bcc = "";
        //SEND EMAIL
        $res = send_email($to, $from, $subject, $message);
        return $res;
    }

    function getUserName($uid){
        $query = $this->db->query("select username from user where id = ".$uid);
        return $query->row()->username;
    }

}

/* End of file usermodel.php */
/* Location: ./system/application/models/usermodel.php */
