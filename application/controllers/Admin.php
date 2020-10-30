<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('loggedIn') != true){
            redirect(base_url("login"));
        }
		$this->load->model('System_model');
	}
	
	public function index()
	{
		
	}
}
