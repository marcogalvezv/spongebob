<?php
class Taxi extends Membership {

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


        $this->load->model("taximodel","mtaxi");
        $this->load->model("profilemodel", "mprofile");
        //$this->load->helper("phpmailer");

        //DATATABLE
        //get_layout()->add_stylesheets('demo_table_jui');
        get_layout()->add_stylesheets('admin/mws-style.min');
        get_layout()->add_javascripts('jquery/jquery.dataTables');
        //JQUERY.STYLETABLE
        get_layout()->add_javascripts('styletable.jquery.plugin');
    }


    function index()
    {
//        get_layout()->enabled(false);
//        $this->load->view('admin/users/view');
        get_layout()->enabled(false);
        $this->load->view('radiotaxi/taxi/view');
    }



    function listener()
    {
        $table = 'v_taxi';
        $columns = array('selected','number','plate','taxicolor','status','`desc`','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index);
        echo $data['result'];
    }

    function listenereditbooking()
    {
        $options['custom_filter'] = "status = '0'";
        $table = 'v_addresstaxi';
        $columns = array('selected','number','plate','taxicolor','status','description','fullname','id');
        $index = 'id';
        get_layout()->enabled(false);
        $this->load->model('datatablemodel','mdatatable');
        $data['result'] = $this->mdatatable->generate($table, $columns, $index, $options);
        echo $data['result'];
    }


    function ajaxedit()
    {
        get_layout()->enabled(false);
        $id = $this->input->post('id');
        $data['drivers'] = $this->mprofile->getDrivers();



        // edit only
        if($id > 0){

            $taxi = $this->mtaxi->getById($id);
            $profile = $this->mprofile->getByField($taxi->uid,'uid');

            $data['taxi'] = $taxi;
            $data['profile'] = $profile;
            //$data['usersocial'] = $usersocial;
            log_message("debug","*********Data:".print_r("TEST",true));
            log_message("debug","*********Data:".print_r($data,true));
            $this->load->view('radiotaxi/taxi/edit', $data);
        }else
        {
            $this->load->view('radiotaxi/taxi/edit', $data);
        }
    }


    function ajaxsave()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $activate = FALSE;
            $error = FALSE;
            $updated = FALSE;
            $message = "";
            $taxi = $this->input->post("taxi", true);
            $profile = $this->input->post("profile", true);

            if ($taxi['status'] == "Libre")
            {
                $taxi['status'] = 0;
            }
            else
            {
                $taxi['status'] = 1;
            }

            $taxi['uri'] = $taxi['plate'];
            $taxi['idcity'] = 2;
            //$taxi['uid'] = 2;
            log_message("debug","*****datos taxi".print_r($taxi,true));
            log_message("debug","*****".print_r($profile,true));
            //NEW
                $id = $this->mtaxi->save($taxi);

            if(!$error){
                $success = TRUE;
            } else {
                $success = FALSE;
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );

            log_message("debug","*****".print_r($json,true));
            echo json_encode($json);
        }
    }

    function ajaxdelete()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $id = $this->input->post('id');
            $req = $this->mtaxi->deleteById($id);

            if ($req){
                $success = TRUE;
                $message = "Success: user record delete successfully.";
            } else {
                $success = FALSE;
                $message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }

    function ajaxblock()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $id = $this->input->post('id');
            //setting to block status
            $status = 0;
            $req = $res = $this->muser->changeStatus($id,$status);

            if ($req){
                $success = TRUE;
                $message = "Success: user record delete successfully.";
            } else {
                $success = FALSE;
                $message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }
    function ajaxunblock()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $id = $this->input->post('id');
            //setting to unblock status
            $status = 1;
            $req = $res = $this->muser->changeStatus($id,$status);

            if ($req){
                $success = TRUE;
                $message = "Success: user record delete successfully.";
            } else {
                $success = FALSE;
                $message = "ERR003: Something went wrong on the user record delete. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }

    function ajaxdeletebulk()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $error = FALSE;
            $users = $this->input->post('users');

            if(!empty($users)) {
                foreach($users as $id) {
                    $res = $this->muser->deleteById($id);
                    if(!$res) {
                        $error = TRUE;
                        break;
                    }
                }
            }

            if (!$error){
                $success = TRUE;

                if(!empty($users)) {
                    $message = "members deleted successfully.";
                } else {
                    $message = "Please select at least one record to delete.";
                }
            } else {
                $success = FALSE;
                $message = "Something went wrong on the members delete operation. Please contact support center.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }

    function ajaxstatusbulk()
    {
        get_layout()->enabled(false);
        if ($_POST)
        {
            $error = FALSE;
            $warning = FALSE;
            $users = $this->input->post('users');
            $status = $this->input->post('status');
            $statustext = 'blocked';
            $statusop = 'block';

            if($status) {
                $statustext = 'approved';
                $statusop = 'approve';
            }

            if(!empty($users)) {
                foreach($users as $id) {
                    $user = array();
                    $user['id'] = $id;
                    $user['status'] = (int)$status;
                    $res = $this->muser->save($user);
                    if(!$res) {
                        $error = TRUE;
                        break;
                    }
                }
            } else {
                $warning = TRUE;
                $error = TRUE;
            }

            if (!$error){
                $success = TRUE;
                $message = "members {$statustext} successfully.";
            } else {
                $success = FALSE;
                $message = "Something went wrong on the members {$statustext} operation. Please contact support center.";
                if($warning)
                    $message = "Please select at least one record to {$statusop}.";
            }
            $json = array(
                'success' => $success,
                'message' => $message
            );
            echo json_encode($json);
        }
    }

    function getLocationList()
    {
        get_layout()->enabled(false);


        $data = $this->mtaxi->getLocationList();
        echo json_encode($data);
    }

    function getActiveTaxis()
    {
        get_layout()->enabled(false);
        $data = $this->mtaxi->getActiveTaxiLocations();
        echo json_encode($data);
    }
    function getTaxi($id)
    {
        get_layout()->enabled(false);
        $taxi = $this->mtaxi->getByField($id, 'id');
        echo json_encode($taxi);
    }


    function getTaxiWithDriver($id)
    {
        get_layout()->enabled(false);
        $taxi = $this->mtaxi->getTaxiWithDriver($id, 'id');
        echo json_encode($taxi);
    }
}

/* End of file site.php */
/* Location: ./application/controllers/admin/users.php */