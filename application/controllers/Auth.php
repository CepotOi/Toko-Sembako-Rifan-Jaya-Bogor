<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // * method construct for this controller
    public function __construct()
    {
        parent::__construct();

        // * include form validation from CI Library to this controller
        $this->load->library('form_validation');
    }

    // * method index (login)
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // * set rules for form login 
        // * first parameter for set_rules is taken from input name
        // * example = <input type="text" class="form-control form-control-user" id="email" *from this-> name="email" ...>

        // * rules for field Email = valid_email: must be email format __ @ __ . __ , must required and trim: cannot using empty space
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        // * rules for field password 
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // * if login failed
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');

            // * login success
        } else {
            // * run private method _login
            $this->_login();
        }
    }

    private function _login()
    {
        // * catch input email and password from login
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        // * match from input above to data in DB just one row
        // * SELECT * FROM user WHERE email = $email
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // * if user exist
        if ($user) {

            // * if user account is active. *note: you can activate and unactivate user account
            if ($user['is_active'] == 1) {

                // * verify the password from the input with the password in the DB
                // * if password match
                if (password_verify($pass, $user['password'])) {

                    // * catch some data from data user input in form login
                    // * role id to display according to its role
                    // * only 2 role, 1 = Admin, 2 = User
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];

                    // * set session userdata from data above to enter website
                    $this->session->set_userdata($data);

                    // * check if the user who logged in role id is equal to 1, it's admin and redirect according to its authority
                    if ($user['role_id'] == 1) {
                        redirect('admin');

                        // * if role id more than 1, it's normal user. 
                        // * Note: in this case, i just have 2 role_id. role_id [1] =  (Admin), role_id [2] = (User)
                    } else {
                        redirect('home');
                    }

                    // * if password doesn't match
                } else {
                    // * show alert and redirect back to login
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Email or Password Wrong!</div>');
                    redirect('auth');
                }

                // * if user account is't active
            } else {
                // * show alert and redirect back to login
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">This account hasn\'t been actived</div>');
                redirect('auth');
            }

            // * if user doesn't exist
        } else {
            // * show alert and redirect back to login
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">This account doesn\'t exist</div>');
            redirect('auth');
        }
    }

    // * method register user
    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // * set rules for form register 

        // * rules for field Full Name
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // * rules for field Email = valid_email: is_unique: this email mustbe unique from table user field email in DB
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email is already registered!'
        ]);

        // * rules for field password1 = min_length[3]: 3 char minimum , matches[password2]: this fiel must be same as field password2
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password isn\'t match!',
            'min_length' => 'Password to short!'
        ]);

        // * rules for field password2 is basically same as password1 
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // * if register failed
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration Page';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');

            // * register success
        } else {
            // * catch all data from user input in form registration
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            // * insert data above into table "user"
            // * INSERT INTO user VALUE $data
            $this->db->insert('user', $data);

            // * create flashdata after you register
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
            Your account has been registered, Please login!</div>');

            // * after finish register, redirect to login page
            redirect('auth');
        }
    }

    public function logout()
    {
        // * unset userdata form session in method _login()
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        // * create flashdata after you logout and redirect to home page
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
        Logout success!</div>');
        redirect('home');
    }

    public function blocked()
    {
        $data['title'] = 'Access Forbidden!';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
    }
}
