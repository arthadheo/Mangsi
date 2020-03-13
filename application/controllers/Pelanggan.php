<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	function __construct() {
		parent::__construct();
		/*if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }*/
        $this->load->model('System_model');
	}

	public function index()
	{
		$data["fetch_data"] = $this->System_model->fetch_data();
		$this->load->view("page/profile", $data);
	}

	public function coupon()
	{
		//get data from db
		$data['coupon'] = $this->System_model->select_all('coupon');
		//load coupon view
		//$this->load->view('coupon', $data);
	}

	public function coupon_details()
	{
		//get id from coupon view
		$id_coupon = $this->input->get('id');
		//get data by id
		$data['coupon_details'] = $this->System_model->get_by_atr('coupon', 'id_coupon');
		//load coupon details view
		//$this->load->view('coupon_details', $data);

	}	
}
