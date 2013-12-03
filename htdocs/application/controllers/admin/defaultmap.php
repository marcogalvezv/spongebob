<?php 
class Defaultmap extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("layout");

        //DATATABLE
        //get_layout()->add_stylesheets('demo_table_jui');
        get_layout()->add_stylesheets('admin/mws-style.min');
        get_layout()->add_javascripts('jquery/jquery.dataTables');
        //JQUERY.STYLETABLE
        get_layout()->add_javascripts('styletable.jquery.plugin');

    }


    function index()
    {
        get_layout()->enabled(false);
        $this->load->view('map/defaultmap');
    }
}