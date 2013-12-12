<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MarcoHP
 * Date: 11/29/13
 * Time: 8:05 PM
 * To change this template use File | Settings | File Templates.
 */

class Taxi extends CI_Controller
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


    function saveAddressTaxi($lat,$lng,$idTaxi)
    {
        $taxi = $this->mtaxi->getByField($idTaxi, 'id');
        log_message("debug", "*********retrieving taxo:" . print_r($taxi, true));
        $taxiToSave['id']=$taxi->id;
        $taxiToSave['idcity']=2;
        $taxiToSave['lat'] = $lat;
        $taxiToSave['lng'] = $lng;
        log_message("debug", "*********saveAddressTaxi:" . print_r('triying to save', true));
        $this->mtaxi->save($taxiToSave);
    }

    function getassignedbooking()
    {
        get_layout()->enabled(false);
//        log_message("debug", "*********MEthod:" . print_r('getassignedbooking', true));
//        log_message("debug", "*********method input:" . print_r($_POST, true));
        $bookingDto=false;
        $uid = $this->input->post('driverid');
        $bookingId = $this->input->post('bookingid');
        $bookingStatus = $this->input->post('bookingstatus');
        $taxiLat= $this->input->post('driveraddresslat');
        $taxiLng= $this->input->post('driveraddresslng');

        if ($bookingId)
        {
            $booking = $this->mbooking->getByField($bookingId,'id');
            $booking->status=$bookingStatus;
            $bookingToSave['id']=$booking->id;
            $bookingToSave['idadd']=$booking->idadd;
            $bookingToSave['idtaxi']=$booking->idtaxi;
            $bookingToSave['type']=$booking->type;
            $bookingToSave['status']=$bookingStatus;

            $this->mbooking->save($bookingToSave);

            $booking = $this->mbooking->getByField($bookingId,'id');
            $taxi = $this->mtaxi->getByField($booking->idtaxi, 'id');
            $driver = $this->mprofile->getByField($taxi->uid, 'uid');


            if  ($bookingStatus == '5')
            {
                $taxiToSave['id'] = $taxi->id;
                $taxiToSave['status'] = '0';
                $this->mtaxi->save($taxiToSave);
            }
            //log_message("debug", "*********Booking  Data:" . print_r($booking, true));
            if($bookingStatus!='5')
            {
                $bookingDto = $this->getBookingDto($booking,$taxi, $driver);
            }

        }elseif($uid)
        {
            $taxi = $this->mtaxi->getByField($uid, 'uid');
            $driver = $this->mprofile->getByField($taxi->uid, 'uid');
           // log_message("debug", "*********TAxi  Data:" . print_r($taxi, true));
            $booking = $this->mbooking->getAssignedBookingByTaxi($taxi->id);
            //log_message("debug", "*********Booking  Data:" . print_r($booking, true));
            if ($booking)
                $bookingDto = $this->getBookingDto($booking,$taxi,$driver);
        }

        $this->saveAddressTaxi($taxiLat,$taxiLng, $taxi->id);

        //log_message("debug", "*********Booking  Data:" . print_r($bookingDto, true));
        if ($bookingDto)
        {
            log_message("debug", "***** bookingDto:" . print_r(json_encode($bookingDto), true));
            header("HTTP/1.0 200 OK");
            echo json_encode($bookingDto);
        }else
        {
            header("HTTP/1.0 200 OK");
            $object['id']=NULL;
            log_message("debug", "***** object:" . print_r(json_encode($object), true));
            echo json_encode($object);
        }
    }


    function getBookingDto($booking,$taxi,$driver)
    {
        $address = $this->maddress->getByField($booking->idadd,'id');
        $destination = $this->mdestination->getByField($booking->iddest,'id');
        //log_message("debug", "*********Address  Data:" . print_r($address, true));
        $client = $this->muser->getUserWithProfile($address->uid);
        //log_message("debug", "*********Client  Data:" . print_r($client, true));
        $bookingDto['id']= $booking->id;
        //log_message("debug", "***** bookingDto:" . print_r(json_encode($bookingDto), true));
        $bookingDto['status']= $booking->status;
        //log_message("debug", "***** bookingDto:" . print_r(json_encode($bookingDto), true));
        $clientDto= $this->clientToClientDTO($client);
        $clientDto['lat'] = $address->lat;
        $clientDto['lng'] = $address->lng;
        $clientDto['destlat'] = $destination->lat;
        $clientDto['destlng'] = $destination->lng;
        $bookingDto['client']= $clientDto;
        //log_message("debug", "***** bookingDto:" . print_r(json_encode($bookingDto), true));
        $bookingDto['taxi']=$taxi;

        $bookingDto['driver']=$driver;
        return $bookingDto;
    }


    function clientToClientDTO($client)
    {

        $clientDto['id'] = $client['user']->id;
        log_message("debug", "*********Client dto Data:" . print_r($clientDto, true));
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
        log_message("debug", "*********Method:" . print_r("signin taxi", true));
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
        $user['gid'] = 4;
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








}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */