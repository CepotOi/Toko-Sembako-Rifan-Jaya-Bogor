<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // * call function is_logged_in() in helper 
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT all FROM table 'user_menu' and make them to array
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');

            // * if form validation true
        } else {
            // * insert input form to field 'menu' in table 'user_menu'
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);

            // * create flashdata after you success add menu and redirect to menu page
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New menu added</div>');
            redirect('menu');
        }
    }


    public function subMenu()
    {
        $data['title'] = 'Submenu Management';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * load model 'Menu_model' alias 'menu'
        $this->load->model('Menu_model', 'menu');

        // * get method getSubMenu in model 'Menu_model' as 'menu'
        $data['subMenu'] = $this->menu->getSubMenu();

        // * SELECT table 'user_menu' and make it to array
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // * Set Rules for input Submenu Management
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');

            // * if form validation true
        } else {
            // * get all value from input submenu
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            // * insert all data above to table 'user_sub_menu'
            $this->db->insert('user_sub_menu', $data);

            // * create flashdata after you success add menu and redirect to submenu page
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New submenu added</div>');
            redirect('menu/submenu');
        }
    }


    // ************** UPDATE & DELET DATA MENU ************** //


    // * get menu name you want to delete
    public function deleteMenu($id)
    {
        // * load Menu_model alias menu and method deleteMenu
        $this->load->model('Menu_model', 'menu');
        $this->menu->deleteDataMenu($id);

        // * create flashdata after you success delete menu and redirect to menu page
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
        redirect('menu');
    }


    public function editMenu($id)
    {
        $data['title'] = 'Edit Menu';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT all FROM table 'user_menu' and make them to array
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');

            // * if form validation true
        } else {

            $data = [
                'menu' => $this->input->post('menu')
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_menu', $data);

            // * create flashdata after you success add menu and redirect to menu page
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New menu updated</div>');
            redirect('menu');
        }
    }


    // ************** UPDATE & DELET DATA SUBMENU ************** //


    public function deleteSubMenu($id)
    {
        // * load Menu_model alias menu and method deleteMenu
        $this->load->model('Menu_model', 'menu');
        $this->menu->deleteDataSubMenu($id);

        // * create flashdata after you success delete sub menu and redirect to submenu page
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
        redirect('menu/submenu');
    }


    public function editSubMenu($id)
    {
        $data['title'] = 'Edit Submenu';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * load model 'Menu_model' alias 'menu'
        $this->load->model('Menu_model', 'menu');

        // * get method getSubMenu in model 'Menu_model' as 'menu'
        $data['subMenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

        // * SELECT table 'user_menu' and make it to array
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // * Set Rules for input Edit Submenu Management
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        // * if form validation false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_sub_menu', $data);
            $this->load->view('templates/footer');

            // * if form validation true
        } else {

            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon')
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_sub_menu', $data);

            // * create flashdata after you success add menu and redirect to menu page
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New Submenu updated</div>');
            redirect('menu/subMenu');
        }
    }
}
