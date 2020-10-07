<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        /*if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }*/
        $this->load->model('System_model');
    }

    public function index()
    {
        $this->load->view('layout/auth_header');
        $this->load->view('auth/login');
        $this->load->view('layout/auth_footer');
    }


    public function registration()
    {
        $this->load->view('layout/auth_header');
        $this->load->view('auth/registration');
        $this->load->view('layout/auth_footer');
    }

    public function signing_in()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $where = array('email' => $email, 
                        'password_pelanggan' => md5($password)
        );

        $result = $this->System_model->get_by_atr('pelanggan', $where)->num_rows();

        if($result > 0)
        {
            $temp = $this->System_model->get_by_atr('pelanggan', $where)->row();
            $firstname = $temp->first_name;
            $lastname = $temp->last_name;
            $point = $temp->point;
            
            $data_session = array(
                'id'=> $temp->id_pelanggan,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'point' => $point,
                'status' => "login"
              );
            
            $this->session->set_userdata($data_session);

            redirect(base_url());
        } else{
            
            $data['invalid'] = "Invalid login credentials";
            $this->load->view("login", $data);
        }
    }

    function signing_out()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    public function signing_up()
    {
        $email = $this->input->post('email');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $username = $this->input->post('name');

        if($password1 == $password2)
        {
            $where = array(
            'email' => $email,
            'password_pelanggan' => md5($password1),
            'first_name' => $username
        );

        $result = $this->System_model->get_by_atr('pelanggan', $where)->num_rows();

        if($result > 0)
        {
            $data['message'] = "Account already exist";
            //redirect(base_url(""));
        }
        else
        {
            $this->System_model->add($where, 'user');
            $data['message'] = "Account has successfully been made";
            //redirect(base_url("login"));
        }
        }
        else
        {
            $data['message'] = "Password confirmation doesn't match";
        }

    }
}
