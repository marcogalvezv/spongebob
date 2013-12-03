<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Membership {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("layout");

        //to avoid issues with the last PHP version
        date_default_timezone_set('America/Los_Angeles');

        $language = $this->session->userdata('language');
        //TODO: we should add an if
        $language = 'es';

        //SET LANGUAGE ON SESSION
        $this->session->set_userdata('language',$language);

        //SET LANGUAGES
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/application/language/$language/admin_lang.php")){
            $this->lang->load('admin',$language);
        } else {
            $this->lang->load('admin','es');
        }

        //LAYOUT ADMIN HTML5
        get_layout()->set_layout("layout/newadmin");

        //<!-- Plugin Stylesheets first to ease overrides -->
        get_layout()->add_stylesheets('admin/plugins/colorpicker/colorpicker|SCREEN');
        get_layout()->add_stylesheets('admin/custom-plugins/wizard/wizard|screen');

        //<!-- Required Stylesheets -->
        get_layout()->add_stylesheets('admin/bootstrap.min|screen');
        get_layout()->add_stylesheets('admin/fonts/ptsans/stylesheet|screen');
        get_layout()->add_stylesheets('admin/fonts/icomoon/style|screen');
        get_layout()->add_stylesheets('admin/mws-style|screen');
        get_layout()->add_stylesheets('admin/icons/icol16|screen');
        get_layout()->add_stylesheets('admin/icons/icol32|screen');

        //<!-- Demo Stylesheet -->
        get_layout()->add_stylesheets('admin/demo|screen');

        //<!-- jQuery-UI Stylesheet -->
        get_layout()->add_stylesheets('admin/jui/jquery.ui.all|screen');
        get_layout()->add_stylesheets('admin/jui/jquery-ui.custom|screen');

        //<!-- Theme Stylesheet -->
        get_layout()->add_stylesheets('admin/mws-theme|screen');
        get_layout()->add_stylesheets('admin/themer|screen');

        //JQUERY-UI  -- THEME SMOOTHNESS
        //get_layout()->add_stylesheets('admin/libs/jquery-1.8.3.min.js');


//        <!-- JavaScript Plugins -->
        get_layout()->add_javascripts('jquery/jquery-1.8.0.min');
        get_layout()->add_stylesheets('admin/jquery.toastmessage');
        get_layout()->add_javascripts('admin/jquery.toastmessage');

        get_layout()->add_javascripts('admin/libs/jquery.mousewheel.min');
        get_layout()->add_javascripts('admin/libs/jquery.placeholder.min');
        get_layout()->add_javascripts('admin/custom-plugins/fileinput');

//         <!-- jQuery-UI Dependent Scripts -->
        get_layout()->add_javascripts('admin/jui/jquery-ui-1.9.2.min');
        get_layout()->add_javascripts('admin/jui/jquery-ui.custom.min');
        get_layout()->add_javascripts('admin/jui/jquery.ui.touch-punch');

//          <!-- Plugin Scripts -->
        get_layout()->add_javascripts('admin/plugins/datatables/jquery.dataTables.min');
        get_layout()->add_javascripts('admin/plugins/validate/jquery.validate-min');
        get_layout()->add_javascripts('admin/plugins/flot/jquery.flot.min');
        get_layout()->add_javascripts('admin/plugins/flot/plugins/jquery.flot.tooltip.min');
        get_layout()->add_javascripts('admin/plugins/flot/plugins/jquery.flot.pie.min');
        get_layout()->add_javascripts('admin/plugins/flot/plugins/jquery.flot.stack.min');
        get_layout()->add_javascripts('admin/plugins/flot/plugins/jquery.flot.resize.min');
        get_layout()->add_javascripts('admin/plugins/colorpicker/colorpicker-min');
        get_layout()->add_javascripts('admin/plugins/validate/jquery.validate-min');
        get_layout()->add_javascripts('admin/custom-plugins/wizard/wizard.min');

//<!-- Core Script -->
        get_layout()->add_javascripts('admin/bootstrap.min');
        get_layout()->add_javascripts('admin/core/mws');

//<!-- Themer Script (Remove if not needed) -->
        get_layout()->add_javascripts('admin/core/themer');

//<!-- Demo Scripts (remove if not needed) -->
        get_layout()->add_javascripts('admin/demo/demo.dashboard');



    }

    function index()
    {
        //$this->lang->load('shop');
        $this->load->view('admin/newlogin');
        //$this->load->view('admin/index');
    }
    function ajaxtabs($tabcurrent)
    {
        get_layout()->enabled(false);

        //seguimos usando esto ???
        $this->session->set_userdata('tabcurrent',$tabcurrent);
        //$tabcurrent = $this->session->userdata('tabcurrent');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/dashboard.php */