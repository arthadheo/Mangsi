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
        if($this->session->userdata('loggedIn') == 'pelanggan'){ 
            redirect(base_url());
        } 
        else
        {
            if($this->session->userdata('loggedIn') == 'admin')
            {
                redirect(base_url('admin'));
            }
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
                redirect(base_url());
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
        // Redirect to profile page if the user already logged in 
        if($this->session->userdata('loggedIn') == 'pelanggan'){ 
            redirect(base_url());
        } 
        else
        {
            if($this->session->userdata('loggedIn') == 'admin')
            {
                redirect(base_url('admin'));
            }
        }
        
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

        $result = $this->System_model->get_by_atr('pelanggan', $where);

        if($result->num_rows() > 0)
        {
            $temp = $result->row();

            if($temp->is_active == 1)
            {
                $firstname = $temp->first_name;
                $lastname = $temp->last_name;
                $point = $temp->point;
            
                $userData = array(
                    'id'=> $temp->id_pelanggan,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'email' => $email,
                    'point' => $point,
                );
                $this->session->set_userdata('loggedIn', 'pelanggan');
                $this->session->set_userdata('userData', $userData);

                redirect(base_url());
            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please activate your account.</div>');
                redirect(base_url('login'));
            }
            
        } else{
            // non pelanggan
            $where = array('email_pegawai' => $email, 
                        'password_pegawai' => md5($password));
            
            $result = $this->System_model->get_by_atr('pegawai', $where);
            if($result->num_rows() > 0)
            {
                $result = $result->row();
                if($result->grup == "admin")
                {   //jika admin
                    $this->session->set_userdata('loggedIn', 'admin');
                    redirect('admin');
                }
            }
            else
            {   // invalid input
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please input registered email and password.</div>');
                redirect(base_url('login'));
            }
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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Please input a valid email.
            </div>');
            redirect(base_url('registration'));
        }
        else
        {
            $email = $this->input->post('email');
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
            $username = $this->input->post('full_name');

        if($password1 == $password2)
        {
            $where = array(
            'email' => $email,
            'password_pelanggan' => md5($password1),
            'first_name' => $username
            );

        $result = $this->System_model->get_by_atr('pelanggan', array('email'=>$email))->num_rows();

        if($result > 0)
        {
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Account already exist.
            </div>');
        }
        else
        {
            $where['point'] = 10;
            $where['is_active'] = 0;

            // prepare token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'created_date' => date("Y-m-d")
            ];

            $this->System_model->add($where, 'pelanggan');
            $this->System_model->add($user_token, 'user_token');

            $this->sendEmail($token, 'verify');


            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Account has successfully been made. Please check your email for account activation.
            </div>');
            redirect(base_url("login"));
        }
        }
        else
        {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
            Password confirmation does not match.
            </div>');
        }
        }

    }

    private function sendEmail($token, $type)
    {
        
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'mangsi.membership@gmail.com',
            'smtp_pass' => 'Mangsi@2013',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('mangsi.membership@gmail.com', 'Mangsi Grill & Coffee');
        $this->email->to($this->input->post('email'));

        if($type == 'verify')
        {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account: <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        }
        else
        {
            if($type == 'forgot')
            {
                $this->email->subject('Reset Password');
                $this->email->message('Click this link to create a new password: <a href="' . base_url() . 'auth/changePassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>');
            }
        }

        if($this->email->send())
        {
            return true;
        }
        else
        {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $pelanggan = $this->System_model->get_by_atr('pelanggan', array('email'=>$email))->row_array();

        if($pelanggan)
        {
            $token_pelanggan = $this->System_model->get_by_atr('pelanggan', array('email'=>$email))->row_array();

            if($token_pelanggan)
            {
                $this->System_model->update(array('email'=>$email), array('is_active' => 1), 'pelanggan');
                $this->System_model->delete('user_token', array('token'=>$token));
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'.$email.' has been activated. You may login to your account.</div>');
                redirect(base_url("login"));

            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed. Please click the link in the activation email.
            </div>');
                redirect(base_url("login"));
            }
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account activation failed. Please click the link in the activation email.
            </div>');
            redirect(base_url("login"));
        }
    }

    public function forgotPassword()
    {   
        $this->load->view('layout/auth_header');
        $this->load->view('auth/forgot_password');
        $this->load->view('layout/auth_footer');
    }

    public function resetPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Please input a valid email format.
            </div>');
            redirect(base_url('forgot_password'));
        }
        else
        {
            $email = $this->input->post('email');
            $result = $this->System_model->get_by_atr('pelanggan', array('email'=>$email));
            if($result->num_rows() > 0)
            {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'created_date' => date('Y-m-d')
                ];

                $this->System_model->add($user_token, 'user_token');
                $this->sendEmail($token, 'forgot');

                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Please check your email to create a new password.</div>');
                redirect(base_url('forgot_password'));
            }
            else
            {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Please input registered email.</div>');
                redirect(base_url('forgot_password'));
            }
        }

    }

    public function changePassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $pelanggan = $this->System_model->get_by_atr('pelanggan', array('email'=>$email))->row_array();

        if($pelanggan)
        {
            $token_pelanggan = $this->System_model->get_by_atr('pelanggan', array('email'=>$email))->row_array();

            if($token_pelanggan)
            {
                $this->session->set_userdata('reset_email', $email);
                $this->changingPassword();
            }
            else
            {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed. Please check your email to reset your password.
            </div>');
                redirect(base_url("login"));
            }
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password failed. Please check your email to reset your password.
            </div>');
            redirect(base_url("login"));
        }
    }

    public function changingPassword()
    {
        if(!$this->session->userdata('reset_email'))
        {
            redirect('login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[3]|matches[password2]');

        if($this->form_validation->run() == false)
        {
            $this->load->view('layout/auth_header');
            $this->load->view('auth/change_password');
            $this->load->view('layout/auth_footer');
        }
        else
        {
            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');

            $this->System_model->update(array('email'=>$email), array('password_pelanggan'=>$password), 'pelanggan');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password has been changed. You may login to your account.</div>');
            redirect(base_url("login"));
        }
    }
}