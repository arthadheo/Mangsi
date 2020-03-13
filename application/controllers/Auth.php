<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
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

    public function signing_up()
    {
        $this->load->model('System_model');
        $email = $this->input->post('email');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $username = $this->input->post('name');

        if($password1 == $password2)
        {
            $where = array(
            'user_email' => $email,
            'user_password' => md5($password1),
            'user_name' => $username
        );

        $result = $this->System_model->get_by_atr('user', $where)->num_rows();

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
