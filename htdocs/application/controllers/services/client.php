<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MarcoHP
 * Date: 11/29/13
 * Time: 8:05 PM
 * To change this template use File | Settings | File Templates.
 */

class Client extends CI_Controller
{

    const SALT_LENGTH = 10;

    function __construct()
    {
        parent::__construct();
        $this->load->model("addressmodel", "maddress");
        $this->load->model("bookingmodel", "mbooking");
        $this->load->model("taximodel", "mtaxi");
        $this->load->model("usermodel", "muser");
    }


    function index()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("androidpost", true));
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $uid = $this->input->post('uid');
        $phone = $this->input->post('mobile');
        log_message("debug", "*********Data:" . print_r($lat, true));

        $address['lat'] = $lat;
        $address['lng'] = $lng;
        $address['phone'] = $phone;
        $address['uid'] = $uid;
        // $profile = $this->input->post("profile", true);
        log_message("debug", "*****address" . print_r($address, true));

        $address['status'] = 1;
        $address['idcity'] = 2;
        //$taxi['uid'] = 2;
        log_message("debug", "*****" . print_r($address, true));
        //  log_message("debug","*****".print_r($profile,true));
        //NEW

        //$addressFromDatabase = $this->maddress->getByField($address['phone'],'phone');
        //$address['id']=$addressFromDatabase['id'];
        log_message("debug", "*****" . print_r($address, true));
        $id = $this->maddress->save($address);
        $booking['idadd'] = $id;
        $booking['status'] = 1;
        $idb = $this->mbooking->save($booking);
        $booking['id'] = $idb;
        log_message("debug", "*****" . print_r(json_encode($booking), true));
        header("HTTP/1.0 200 OK");
        echo json_encode($booking);
    }

    function hash($str)
    {
        return sha1($str);
    }

    function extract_salt($hashed_password)
    {
        return substr($hashed_password, 0, self::SALT_LENGTH);
    }

    function password_match_hash($password, $hashed_password)
    {
        return $hashed_password == $this->hash_password($password, $this->extract_salt($hashed_password));
    }

    function hash_password($password, $salt = NULL)
    {
        if ($salt === NULL) {
            $salt = $this->salt();
        }
        return $salt . $this->hash($salt . $password);
    }

    function signin()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("signin", true));
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $client = $this->muser->getByField($login, 'username');
//        if ($client && $this->password_match_hash($password, $client->password)) {
//            header("HTTP/1.0 200 OK");
//            echo json_encode($client);
//        } else {
//            echo "false";
//        }

        if ($client)
            echo "true";
        //log_message("debug","*****".print_r(json_encode($booking),true));
    }

    function signup()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("signup", true));

        $user['login'] = $this->input->post('login');
        $user['password'] = $this->input->post('password');
        $user['firstName'] = $this->input->post('firstName');
        $user['lastName'] =  $this->input->post('lastName');
        $id = $this->muser->save($user);
        if ($id)
        {
            header("HTTP/1.0 200 OK");
            echo json_encode($user);
        }
    }




    function clientpostclient()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("androidpost", true));
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $uid = $this->input->post('uid');
        $phone = $this->input->post('mobile');
        log_message("debug", "*********Data:" . print_r($lat, true));

        $address['lat'] = $lat;
        $address['lng'] = $lng;
        $address['phone'] = $phone;
        $address['uid'] = $uid;
        // $profile = $this->input->post("profile", true);
        log_message("debug", "*****address" . print_r($address, true));

        $address['status'] = 1;
        $address['idcity'] = 2;
        //$taxi['uid'] = 2;
        log_message("debug", "*****" . print_r($address, true));
        //  log_message("debug","*****".print_r($profile,true));
        //NEW

        //$addressFromDatabase = $this->maddress->getByField($address['phone'],'phone');
        //$address['id']=$addressFromDatabase['id'];
        log_message("debug", "*****" . print_r($address, true));
        $id = $this->maddress->save($address);
        $booking['idadd'] = $id;
        $booking['status'] = 1;
        $idb = $this->mbooking->save($booking);
        $booking['id'] = $idb;
        log_message("debug", "*****" . print_r(json_encode($booking), true));
        header("HTTP/1.0 200 OK");
        echo json_encode($booking);
    }

    function androidposttaxi()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("androidpost", true));
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $id = $this->input->post('id');

        log_message("debug", "*********Data:" . print_r($lat, true));

        $taxi['lat'] = $lat;
        $taxi['lng'] = $lng;
        $taxi['id'] = $id;
        // $profile = $this->input->post("profile", true);
        log_message("debug", "*****address" . print_r($taxi, true));


        $id = $this->mtaxi->save($taxi);

        header("HTTP/1.0 200 OK");
        echo json_encode($taxi);
    }

    function getAssignedDriverLocation($email)
    {
        get_layout()->enabled(false);
//        log_message("debug","*********Data:".print_r("getAssignedDriverLocation".$bookingid,true));
//
//
//
//        log_message("debug","*********Data:".print_r("AfterLoadingModelstaxi",true));
//
//        log_message("debug","*********Data:".print_r("AfterLoadingModelsbooking",true));
//        $booking = $this->mbooking->getById($bookingid);
//        log_message("debug","*****".print_r($booking,true));
//        $idTaxi=$booking->idtaxi;
//        log_message("debug","*****taxiid".print_r($idTaxi,true));
//        $taxi = $this->mtaxi->getById($idTaxi);
//        log_message("debug","*****".print_r($taxi,true));
//        header("HTTP/1.0 200 OK");
//
//        echo json_encode($taxi);


        $returnObject['lat'] = 555555;
        $returnObject['lng'] = 555555;
        $returnObject['arrived'] = false;
        echo json_encode($returnObject);
    }


}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */