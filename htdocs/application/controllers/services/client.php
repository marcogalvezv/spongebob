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
        $this->load->model("destinationmodel", "mdestination");
        $this->load->model("bookingmodel", "mbooking");
        $this->load->model("taximodel", "mtaxi");
        $this->load->model("profilemodel", "mprofile");
        $this->load->model("usermodel", "muser");
    }


    function index()
    {

    }

    function  request()
    {

        get_layout()->enabled(false);
        log_message("debug", "*********method:" . print_r("request", true));
        log_message("debug", "*********method input:" . print_r($_POST, true));
        //ClientData
        $clientid=$this->input->post('clientid');
        $clientphone=$this->input->post('clientphone');

        $clientaddresslat = $this->input->post('clientaddresslat');
        $clientaddresslng = $this->input->post('clientaddresslng');
        $clientaddressdescripcionn = $this->input->post('clientaddressdescripcion');

        $clientaddressdestlat = $this->input->post('clientaddressdestlat');
        $clientaddressdestlng = $this->input->post('clientaddressdestlng');
        $clientaddressdestdescripcionn = $this->input->post('clientaddressdestdescripcion');

        $bookingId = $this->input->post('bookingid');
        if ($bookingId)
        {
            log_message("debug", "***** user bookingid:" . print_r(json_encode($bookingId), true));
            $booking = $this->mbooking->getById($bookingId);
            log_message("debug", "***** get booking data:" . print_r(json_encode($booking), true));
            $idTaxi = $booking->idtaxi;
            log_message("debug", "***** get taxi data idTAci:" . print_r(json_encode($idTaxi), true));
            $taxi = $this->mtaxi->getById($idTaxi);
            log_message("debug", "***** get taxi data:" . print_r(json_encode($taxi), true));
            $address = $this->maddress->getById($booking->idadd);
            log_message("debug", "***** get address data:" . print_r(json_encode($address), true));
            $client= $this->muser->getUserWithProfile($address->uid);
            log_message("debug", "***** get client data:" . print_r(json_encode($client), true));
            $bookingDto['id']= $booking->id;

            $bookingDto['status']= $booking->status;
            //$bookingDto['client']= $clientDto;
            $bookingDto['taxi']=$taxi;

            $driver = $this->mprofile->getByField($taxi->uid, 'uid');
            $bookingDto['driver']=$driver;
            log_message("debug", "***** bookingDto for client:" . print_r(json_encode($bookingDto), true));
            header("HTTP/1.0 200 OK");
            echo json_encode($bookingDto);
        }else//New
        {
            $address['lat'] = $clientaddresslat;
            $address['lng'] = $clientaddresslng;
            $address['phone'] = $clientphone;
            $address['uid'] = $clientid;
            $address['address1'] = $clientaddressdescripcionn;
            $address['status'] = 1;
            $address['idcity'] = 1;
            //log_message("debug", "***** address" . print_r($address, true));

            $id = $this->maddress->save($address);
            $booking['idadd'] = $id;
            $destination['lat'] = $clientaddressdestlat;
            $destination['lng'] = $clientaddressdestlng;
            $destination['phone'] = $clientphone;
            $destination['uid'] = $clientid;
            $destination['address1'] = $clientaddressdestdescripcionn;
            $destination['status'] = 1;
            $destination['idcity'] = 1;
            //log_message("debug", "***** destination" . print_r($destination, true));

            $iddest = $this->mdestination->save($destination);

            $booking['iddest'] = $iddest;
            $booking['status'] = 1;
            $idb = $this->mbooking->save($booking);
            $booking['id'] = $idb;
           // log_message("debug", "*****booking data:" . print_r(json_encode($booking), true));


            $client= $this->muser->getUserWithProfile($clientid);

            $clientDto['id'] = $client['user']->id;
            //log_message("debug", "*********Client dto Data:" . print_r($clientDto, true));
            $clientDto['firstname'] = $client['profile']->firstname;
            $clientDto['lastname'] = $client['profile']->lastname;
            $clientDto['login'] = $client['user']->username;
            $clientDto['password'] = $client['user']->password;
            $clientDto['phone'] = $client['profile']->mobile;


            $bookingDto['id']= $booking['id'];
            $status = "notAssigned";
            $bookingDto['status']= $status;
            $bookingDto['client']= $clientDto;
            $bookingDto['taxi']=null;
            $bookingDto['driver']=null;
            log_message("debug", "***** bookingDto for client:" . print_r(json_encode($bookingDto), true));


            header("HTTP/1.0 200 OK");
            echo json_encode($bookingDto);
        }
    }

    function clientToClientDTO($client)
    {
        $clientDto['id'] = $client['user']->id;
        //log_message("debug", "*********Client dto Data:" . print_r($clientDto, true));
        $clientDto['firstname'] = $client['profile']->firstname;
        $clientDto['lastname'] = $client['profile']->lastname;
        $clientDto['login'] = $client['user']->username;
        $clientDto['password'] = $client['user']->password;
        $clientDto['phone'] = $client['profile']->mobile;
        //log_message("debug", "*********Client dto Data:" . print_r($clientDto, true));
        return $clientDto;
    }
    function signin()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Method:" . print_r("signin", true));
        $login = $this->input->post('login');
        $password = $this->input->post('password');

        log_message("debug", "*********Data:" . print_r($login, true));
        log_message("debug", "*********Data:" . print_r($password, true));

        $user = $this->muser->getByField($login, 'username');
        if ($user){
            $userId = $user->id;
            log_message("debug", "*********Data:" . print_r($userId, true));
            $client = $this->muser->getUserWithProfile($userId);
            log_message("debug", "*********Data Client: " . print_r($client, true));
            if ($client)
            {
                $clientDto= $this->clientToClientDTO($client);
                log_message("debug", "*********Client dto Data:" . print_r($clientDto, true));
                header("HTTP/1.0 200 OK");
                echo json_encode($clientDto);
            }
        } else
        {
            $error['message']='Not a valid User';
            header("HTTP/1.0 401 OK");
            echo json_encode($error);
        }

    }

    function signup()
    {
        get_layout()->enabled(false);
        log_message("debug", "*********Data:" . print_r("signup", true));

        $user['username'] = $this->input->post('login');
        $user['password'] = $this->input->post('password');
        $user['status'] = 1;
        $user['gid'] = 2;
        $profile['firstname'] = $this->input->post('firstName');
        $profile['lastname'] =  $this->input->post('lastName');
        $profile['gender'] =  'male';
        $profile['idcountry'] = 1;
        $profile['idcity'] = 1;
        $profile['typedoc'] = 'Carnet de Identidad';
        $profile['document'] = '00000';
        $profile['mobile'] = $this->input->post('phone');
        $profile['created'] = date("Y-m-d H:i:s");
        log_message("debug", "*********Data:" . print_r($user, true));
        log_message("debug", "*********Data:" . print_r($profile, true));


        $uid = $this->muser->save($user);
        $user['id'] = $uid;
        log_message("debug", "*********Data:" . print_r($user, true));
        $user = $this->muser->updatepassword($user);

        if($user) {
            $profile['uid'] = $uid;
            $activate = TRUE;
        }
        $pid = $this->mprofile->save($profile);
        if ($uid)
        {
            header("HTTP/1.0 200 OK");

            log_message("debug", "*********Data:" . print_r($user, true));
            echo json_encode($user);
        }else
        {
            $error['message']='Not a valid Request';
            header("HTTP/1.0 401 OK");
            echo json_encode($error);
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