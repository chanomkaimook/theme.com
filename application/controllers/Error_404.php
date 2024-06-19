<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error_404 extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
	}

    public function index()
	{
        $this->output->set_status_header('404');
        $this->load->view('error_404');
       /*  $this->template->set_layout('lay_main');
        $this->template->title('404');	
        $this->template->build('error_404'); */
    }
}