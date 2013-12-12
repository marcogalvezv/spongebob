<?php
class Booking extends Membership
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/La_Paz');
        $this->load->helper("layout");

        $language = $this->session->userdata('language');
        if (empty($language)) {
            $language = 'es'; //spanish
        }

        //SET LANGUAGE
        $this->session->set_userdata('language', $language);

        //SET LANGUAGES
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/application/language/$language/admin_lang.php")) {
            $this->lang->load('admin', $language);
        } else {
            $this->lang->load('admin', 'es');
        }

//        $this->load->model('systemmodel', 'msystem');
//        $this->load->model('usermodel', 'muser');
//        $this->load->model('usersocialmodel', 'musersocial');
        $this->load->model('profilemodel', 'mprofile');
//        $this->load->model("countrymodel","mcountry");
//        $this->load->model("citymodel","mcities");
        $this->load->model("addressmodel", "maddress");
        $this->load->model("destinationmodel", "mdestination");
        $this->load->model("taximodel", "mtaxi");
        $this->load->model("bookingmodel", "mbooking");
        //$this->load->helper("phpmailer");

        //DATATABLE
        //get_layout()->add_stylesheets('demo_table_jui');
        get_layout()->add_javascripts('jquery/jquery-1.8.0.min');
        get_layout()->add_stylesheets('admin/mws-style.min');
        get_layout()->add_javascripts('jquery/jquery.dataTables');
        //JQUERY.STYLETABLE
        get_layout()->add_javascripts('styletable.jquery.plugin');
    }


    function index()
    {
        //get_layout()->enabled(false);
        //$this->load->view('admin/users/view');
    }

    function androidpost()
    {

        log_message("debug", "*********Data:" . print_r("androidpost", true));
        $lat = $this->input->post('lat');
        log_message("debug", "*********Data:" . print_r($lat, true));
    }


    function listener()
    {
        $table = 'v_booking';
        $columns = array('selected', 'fullname', 'fulladdress', 'status', 'number', 'id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel', 'mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);
        echo $data['result'];
    }

    function getFirtsFiveAdress()
    {
        get_layout()->enabled(false);
        $this->load->model('bookingmodel', 'mbooking');
        $data = $this->mbooking->getAddressList();
        echo json_encode($data);
    }

    function getActiveBookingClients()
    {
        get_layout()->enabled(false);
        $this->load->model('bookingmodel', 'mbooking');
        $data = $this->mbooking->getActiveBookingClientPositions();
        echo json_encode($data);
    }

    function ajaxedit()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');
        $data['clientlist'] = $this->mprofile->getClients();
        $data['taxilist'] = $this->mtaxi->getTaxiDrivers();
        $data['driverlist'] = $this->mprofile->getDrivers();
        //$data['addresslist'] = $this->maddress->getClientAddress();

        // edit only
        if ($id > 0) {

            $booking = $this->mbooking->getById($id);
            $address = $this->maddress->getByField($booking->idadd, 'id');
            $addressdest = $this->mdestination->getByField($booking->iddest, 'id');
            $profileclient = $this->mprofile->getByField($address->uid, 'uid');


            $taxi = $this->mtaxi->getByField($booking->idtaxi, 'id');
            if (isset($taxi)) {
                $profiledriver = $this->mprofile->getByField($taxi->uid, 'uid');
                $data['taxi'] = $taxi;
                $data['profiledriver'] = $profiledriver;
            }
            $data['booking'] = $booking;
            $data['profileclient'] = $profileclient;
            $data['addressdest'] = $addressdest;
            $data['address'] = $address;
            //$data['usersocial'] = $usersocial;
            log_message("debug", "*********ajaxedit:" . print_r("booking", true));
            log_message("debug", "*********Data:" . print_r($data, true));
        }

        $this->load->view('radiotaxi/editbooking', $data);

    }

    function getAssignedTaxiLocation($id)
    {

        get_layout()->enabled(false);
        log_message("debug", "*********taxilocation:" . print_r($id, true));
        $booking = $this->mbooking->getById($id);
        $taxi = $this->mtaxi->getByField($booking->idtaxi, 'id');
        log_message("debug", "*********taxilocation:" . print_r($taxi, true));
        echo json_encode($taxi);

    }

    function ajaxsave()
    {
        get_layout()->enabled(false);
        if ($_POST) {
            $activate = FALSE;
            $error = FALSE;
            $updated = FALSE;
            $message = "";
            $taxi = $this->input->post("taxi", true);
            $address = $this->input->post("address", true);
            $addressdest = $this->input->post("addressdest", true);
            $booking = $this->input->post("booking", true);
            $client= $this->input->post("client", true);

            if ($address['id']=='')
            {
               // $address['uid'] = $booking['uid'];
                $address['id'] = $this->maddress->save($address);
            }

            if ($addressdest['id']=='')
            {
                $addressdest['uid'] = $client['id'];
                $addressdest['phone'] = $address['phone'];
                $addressdest['idcity'] = '1';
                $addressdest['id'] = $this->mdestination->save($addressdest);

            }

            $booking['idadd'] = $address['id'];

            if (isset($addressdest['id']))
                $booking['iddest'] = $addressdest['id'];

            $booking['idtaxi'] = $taxi['id'];
            if ($booking['status'] == 5 || $booking['status'] == 1 ||$booking['status'] == 6 )
                $taxi['status'] =  0;
            else
                $taxi['status'] =  1;
//            log_message("debug", "*****taxi" . print_r($taxi, true));
//            log_message("debug", "*****booking" . print_r($booking, true));
            $idbooking = $this->mbooking->save($booking);
            $idtaxi = $this->mtaxi->save($taxi);
            if (!$error) {
                $success = TRUE;
            } else {
                $success = FALSE;
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );

            log_message("debug", "*****" . print_r($json, true));
            echo json_encode($json);
        }
    }

}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */