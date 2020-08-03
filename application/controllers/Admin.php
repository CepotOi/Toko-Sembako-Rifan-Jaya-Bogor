<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // * call function is_logged_in() in helper
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Dashboard';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['order'] = $this->db->get('transactions')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT * FROM table 'user_role' make them to array
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');

            // * if form validation run
        } else {
            // * INSERT INTO table 'user_role' VALUES coloumn 'role' = role
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New role added</div>');
            redirect('admin/role');
        }
    }


    public function editRole($id)
    {
        $data['title'] = 'Edit Role';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT all FROM table 'user_menu' and make them to array
        $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templates/footer');

            // * if form validation true
        } else {

            $data = [
                'role' => $this->input->post('role')
            ];

            // * UPDATE table `user_role` SET field `role` = $data WHERE `id` = id
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_role', $data);

            // * create flashdata after you success add menu and redirect to menu page
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New role updated</div>');
            redirect('admin/role');
        }
    }


    public function deleteRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);

        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Role deleted!</div>');
        redirect('admin/role');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT * FROM table 'user_role' WHERE coloumn 'id' = $role_id make it to array
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // * SELECT * FROM table 'user_menu' make them to array
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        // * get value from input menuId
        $menu_id = $this->input->post('menuId');

        // * get value from input roleId
        $role_id = $this->input->post('roleId');

        // * get all data above place it to variable array
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        // * SELECT * FROM table 'user_access_menu' WHERE all coloumn in table 'user_access_menu' = $data
        $result = $this->db->get_where('user_access_menu', $data);

        // * if result above is < 1, insert to table, else delete
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }


    public function edit($id)
    {
        $data['title'] = 'Edit Order';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['order'] = $this->db->get_where('transactions', ['id' => $id])->row_array();

        $data['status'] = [0, 1];

        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_order', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'status' => $this->input->post('status')
            ];

            $id = $this->input->post('id', true);
            $this->db->where('id', $id);
            $this->db->update('transactions', $data);

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Order status updated</div>');
            redirect('admin');
        }
    }


    public function detail($id)
    {
        $data['title'] = 'Dashboard';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['trans'] = $this->db->get_where('transactions', ['id' => $id])->row_array();
        $data['order'] = $this->db->get_where('invoice', ['id_trans' => $id])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }


    public function delete($id)
    {
        $this->db->delete('transactions', ['id' => $id]);
        $this->db->delete('invoice', ['id_trans' => $id]);

        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Order deleted!</div>');
        redirect('admin');
    }
}
