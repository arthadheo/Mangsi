<?php define('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Coupon_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["coupon"] = $this->coupon_model->getAll();
        $this->load->view("admin/coupon/list", $data);
    }

    public function add()
    {
        $coupon = $this->coupon_model; //objek model
        $validation = $this->form_validation; //objek form validation
        $validation->set_rules($coupon->rules()); //terapkan rules

        if ($validation->run()) { //melakukan validasi
            $coupon->save(); //simpan data ke database
            $this->session->set_flashdata('success', 'Berhasil disimpan'); // tampilkan pesan berhasil
        }

        $this->load->view("admin/coupon/new_form"); //tampilkan form add
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/coupon'); //redirect ke route jika $id bernilai null

        $coupon = $this->coupon_model; //objek model
        $validation = $this->form_validation; //objek validasi
        $validation->set_rules($coupon->rules()); //menerapkan rules

        if($validation->run()) { //melakukan validasi
            $coupon->update(); // menyimpan data
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["coupon"] = $coupon->getById($id); // mengambil data untuk ditampilkan pada form
        if (!$data["coupon"]) show_404(); // jika tidak ada data, tampilkan error 404

        $this->load->view("admin/coupon/edit_form", $data) // menampilkan form data
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        if ($this->coupon_model->delete($id)) {
            redirect(site_url('admin/coupon'));
        }
    }
}