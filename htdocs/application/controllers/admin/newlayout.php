<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newlayout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper("layout");


//adding layout
        get_layout()->set_layout("layout/newadmin");

    }

    function index()
    {
        $this->load->view('admin/main');
    }
}
