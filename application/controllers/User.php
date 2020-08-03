<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // * call method is_logged_in() in helper
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'My Profile';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Fullname', 'required');

        // * form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');

            // * form validation true
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // * check if there is an image that want to upload
            // * get value from input name 'image'
            $upload_image = $_FILES['image']['name'];

            // * rules for upload image
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']     = '2000';   // * 2mb
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);

                // * if upload success
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];

                    // * check if current image NOT default.png, delete it
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    // * get file upload name and SET `image` = $new_image
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);

                    // * upload failed
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // * UPDATE table `user` SET `name` = $name WHERE `email` = $email
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">
            Your account has been Updated!</div>');
            redirect('user');
        }
    }
}
