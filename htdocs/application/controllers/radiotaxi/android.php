<?php
class Android extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("addressmodel","maddress");
        $this->load->model("bookingmodel","mbooking");
        $this->load->model("taximodel","mtaxi");
    }


    function index()
    {

    }

    function androidpostclient()
    {
        get_layout()->enabled(false);
        log_message("debug","*********Data:".print_r("androidpost",true));
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $uid = $this->input->post('uid');
        $phone = $this->input->post('mobile');
        log_message("debug","*********Data:".print_r($lat,true));

        $address['lat']= $lat;
        $address['lng']= $lng;
        $address['phone']= $phone;
        $address['uid']= $uid;
        // $profile = $this->input->post("profile", true);
        log_message("debug","*****address".print_r($address,true));

        $address['status'] = 1;
        $address['idcity'] = 2;
        //$taxi['uid'] = 2;
        log_message("debug","*****".print_r($address,true));
        //  log_message("debug","*****".print_r($profile,true));
        //NEW

        //$addressFromDatabase = $this->maddress->getByField($address['phone'],'phone');
        //$address['id']=$addressFromDatabase['id'];
        log_message("debug","*****".print_r($address,true));
        $id = $this->maddress->save($address);
        $booking['idadd']=$id;
        $booking['status']=1;
        $idb = $this->mbooking->save($booking);
$booking['id']=$idb;
        log_message("debug","*****".print_r(json_encode($booking),true));
        header("HTTP/1.0 200 OK");
        echo json_encode($booking);
    }

    function androidposttaxi()
    {
        get_layout()->enabled(false);
        log_message("debug","*********Data:".print_r("androidpost",true));
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $id = $this->input->post('id');

        log_message("debug","*********Data:".print_r($lat,true));

        $taxi['lat']= $lat;
        $taxi['lng']= $lng;
        $taxi['id']= $id;
        // $profile = $this->input->post("profile", true);
        log_message("debug","*****address".print_r($taxi,true));




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



        $returnObject['lat']=555555;
        $returnObject['lng']=555555;
        $returnObject['arrived']=false;
        echo json_encode($returnObject);
    }



}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */