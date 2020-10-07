<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/dashboard');
		$this->load->view('layout/adm_footer');
	}

	public function user()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/user');
		$this->load->view('layout/adm_footer');
	}

	public function user_detail()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/user_detail');
		$this->load->view('layout/adm_footer');
	}

	public function coupon()
	{
		$this->load->view('layout/adm_header');
		$this->load->view('admin/coupon');
		$this->load->view('layout/adm_footer');
	}
}
