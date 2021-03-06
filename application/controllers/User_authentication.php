<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_authentication extends CI_Controller { 
     
    function __construct(){ 
        parent::__construct(); 
         
        // Load google oauth library 
        $this->load->library('google'); 
         
        // Load user model 
        $this->load->model('System_model'); 
    } 
     
    public function index(){ 
        // Redirect to profile page if the user already logged in 
        if($this->session->userdata('loggedIn') == true){ 
            redirect('welcome'); 
        } 
         
        if(isset($_GET['code'])){ 
             
            // Authenticate user with google 
            //if($this->google->getAuthenticate()){ 
             
                // Get user info from google 
                $this->google->setAccessToken();

                $gpInfo = $this->google->getUserInfo(); 
                 
                // Preparing data for database insertion 
                $userData['oauth_provider'] = 'google'; 
                $userData['oauth_uid']         = $gpInfo['id']; 
                $userData['first_name']     = $gpInfo['name']; 
                $userData['last_name']         = $gpInfo['name']; 
                $userData['email']             = $gpInfo['email']; 
                //$userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
                //$userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
                //$userData['picture']         = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
                 
                // Insert or update user data to the database 
                $userID = $this->System_model->checkUser($userData); 
                 
                // Store the status and user profile info into session 
                $this->session->set_userdata('loggedIn', true); 
                $this->session->set_userdata('userData', $userData); 
                 
                // Redirect to profile page 
                redirect('User_authentication/profile');
            //} 
        }  
         
        // Google authentication url 
        $data['loginURL'] = $this->google->getLoginURL(); 
         
        // Load google login view 
        $this->load->view('auth/login', $data);
    } 
     
    public function profile(){ 
        // Redirect to login page if the user not logged in 
        if(!$this->session->userdata('loggedIn')){ 
            redirect('/auth/'); 
        } 
         
        // Get user info from session 
        $data['userData'] = $this->session->userdata('userData'); 
        $data['oauth'] = TRUE;
         
        // Load user profile view 
        $this->load->view('page/home',$data); 
    } 
     
    public function logout(){ 
        // Reset OAuth access token 
        $this->google->logout(); 
         
        // Remove token and user data from the session 
        $this->session->unset_userdata('loggedIn'); 
        $this->session->unset_userdata('userData'); 
         
        // Destroy entire session data 
        $this->session->sess_destroy(); 
         
        // Redirect to login page 
        redirect('/auth/'); 
    } 
     
}