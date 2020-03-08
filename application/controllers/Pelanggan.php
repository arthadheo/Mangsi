<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	public function index()
	{
		$this->load->model("System_model");
		$data["fetch_data"] = $this->System_model->fetch_data();
		$this->load->view("page/profile", $data);
	}
}
