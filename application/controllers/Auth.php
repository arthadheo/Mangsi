<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load google oauth library 
        $this->load->library('google');
        $this->load->model('System_model');
    }

    public function index()
    {
        // Redirect to profile page if the user already logged in 
        if($this->session->userdata('loggedIn') == true){ 
            redirect('pelanggan'); 
        } 
         
        if(isset($_GET['code'])){ 
             
            // Authenticate user with google 
            //if($this->google->getAuthenticate()){ 
             
                // Get user info from google 
                $this->google->setAccessToken();

                $gpInfo = $this->google->getUserInfo(); 
                 
                // Preparing data for database insertion 
                $userData['oauth_provider'] = 'google'; 
                $userData['oauth_uid']      = $gpInfo['id']; 
                $userData['first_name']     = $gpInfo['given_name']; 
                $userData['last_name']      = $gpInfo['family_name']; 
                $userData['email']          = $gpInfo['email']; 
                $userData['point']          = 10;
                //$userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
                //$userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
                //$userData['picture']         = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
                 
                // Insert or update user data to the database 
                $userID = $this->System_model->checkUser($userData); 
                // Store the status and user profile info into session 
                $this->session->set_userdata('loggedIn', true); 
                $this->session->set_userdata('userData', $userData); 
                 
                // Redirect to profile page 
                redirect('pelanggan');
            //} 
        }  
         
        // Google authentication url 
        $data['loginURL'] = $this->google->getLoginURL(); 
         
        // Load google login view 

        $this->load->view('layout/auth_header');
        $this->load->view('auth/login', $data);
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
            
            $userData = array(
                'id'=> $temp->id_pelanggan,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'point' => $point,
                'loggedIn' => true
              );
            
            $this->session->set_userdata($userData);

            redirect(base_url());
        } else{
            
            $this->session->set_flashdata('message','Please input registered email and password');
            redirect('auth');
        }
    }

    function signing_out()
    {
        if ($_SESSION['userData']['oauth_provider'] == "google")
        {
            $this->google->logout();
        }

        $this->session->unset_userdata('loggedIn'); 
        $this->session->unset_userdata('userData'); 
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
            $where['point'] = 10;
            //$where['id_pelanggan'] =
            $this->System_model->add($where, 'user');
            $data['message'] = "Account has successfully been made";
            redirect(base_url("login"));
        }
        }
        else
        {
            $data['message'] = "Password confirmation doesn't match";
        }

    }
}
