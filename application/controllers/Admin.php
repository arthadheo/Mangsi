<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('loggedIn') != true && !empty($this->session->userdata('userData'))) {
			redirect(base_url("login"));
		}

		$this->load->model('System_model');
	}

	public function index()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/adm_dashboard');
		$this->load->view('layout/adm_footer');
	}

	public function user()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/adm_user');
		$this->load->view('layout/adm_footer');
	}

	public function user_detail()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/adm_user_detail');
		$this->load->view('layout/adm_footer');
	}

	// public function coupon()
	// {
	// 	$this->load->view('layout/adm_header');
	// 	$this->load->view('admin/adm_coupon');
	// 	$this->load->view('layout/adm_footer');
	// }

}
