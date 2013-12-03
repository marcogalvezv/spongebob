<?php
class Booking extends Membership {

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/La_Paz');
        $this->load->helper("layout");

        $language = $this->session->userdata('language');
        if(empty($language)){
            $language = 'es';//spanish
        }

        //SET LANGUAGE
        $this->session->set_userdata('language',$language);

        //SET LANGUAGES
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
            $this->lang->load('admin',$language);
        }else{
            $this->lang->load('admin','es');
        }

//        $this->load->model('systemmodel', 'msystem');
//        $this->load->model('usermodel', 'muser');
//        $this->load->model('usersocialmodel', 'musersocial');
//        $this->load->model('profilemodel', 'mprofile');
//        $this->load->model("countrymodel","mcountry");
//        $this->load->model("citymodel","mcities");
//        $this->load->model("addressmodel","maddress");
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




    function listener()
    {
        $table = 'v_booking';
        $columns = array('selected','fullname','fulladdress','fulldestination','idtaxi','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);
        echo $data['result'];
    }

    function getFirtsFiveAdress()
    {
        get_layout()->enabled(false);
        $table = 'v_booking';
        $this->load->model('bookingmodel','mbooking');
        $data = $this->mbooking->getAddressList();
        echo json_encode($data);
    }

    function ajaxedit()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');

        //$data['countries'] = $this->mcountry->getCountryList()->result();
        //$data['cities'] = $this->mcities->getCityList()->result();

        $data['typedocs'] = array(
            'ID card',
            'Passport',
            'DNI',
            'Other'
        );

        // edit only
        if($id > 0){

            //$user = $this->muser->getById($id);
            //$profile = $this->mprofile->getByField($id,'uid');
            //$data['user'] = $user;
            //$data['profile'] = $profile;
        }
        $this->load->view('radiotaxi/editbooking', $data);
    }

}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */