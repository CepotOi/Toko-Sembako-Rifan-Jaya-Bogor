<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data['title'] = 'Home';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->db->get('products')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('qnty', 'Quantity', 'required|numeric');

        // * if user isn't login, view as Guest
        if ($data['user'] == null) {
            $data['user']['name'] = 'Guest';

            // * if user is login view as user name
        } else {
            $data['user']['name'];
        }

        // * form validation FALSE
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');

            // * form validation TRUE
        } else {
            $dataset = [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('desc'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('qnty')
            ];
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $this->load->library('upload', [
                    'upload_path' => './assets/img/barang/',
                    'allowed_types' => 'jpg|jpeg|png',
                    'max_size' => '2000'
                ]);

                if ($this->upload->do_upload('image')) {
                    $res = $this->upload->data();
                    $dataset['image'] = $res['file_name'];
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->insert('products', $dataset);

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">New product added!</div>');
            redirect('home');
        }
    }


    // ******************************
    // * Method edit products (Admin)
    // ******************************
    public function edit($id)
    {
        $data['title'] = 'Edit Product';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // * SELECT all FROM table 'user_menu' and make them to array
        $data['barang'] = $this->db->get_where('products', ['id' => $id])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('qnty', 'Quantity', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/edit_product', $data);
            $this->load->view('templates/footer');
        } else {
            $dataset = [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('desc'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('qnty')
            ];
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $this->load->library('upload', [
                    'upload_path' => './assets/img/barang/',
                    'allowed_types' => 'jpg|jpeg|png',
                    'max_size' => '2000'
                ]);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['barang']['image'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set($dataset);
            $this->db->where('id', $id);
            $this->db->update('products');

            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Product is updated!</div>');
            redirect('home');
        }
    }


    // ********************************
    // * Method delete products (Admin)
    // ********************************
    public function delete($id)
    {
        $this->db->delete('products', ['id' => $id]);

        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Product deleted!</div>');
        redirect('home');
    }


    // ********************************************
    // * Method add products to shoppingcart (User)
    // ********************************************s
    public function addToCart($id)
    {
        // * load Barang_model as barang
        $this->load->model('Barang_model', 'barang');

        // * use method find() in Barang_model
        $var = $this->barang->find($id);

        // * catch id, quantity, price and name of product
        $data = [
            'id' => $var['id'],
            'qty' => 1,
            'price' => $var['price'],
            'name' => $var['name']
        ];

        // * insert data above into shoppingcart and redirect to home
        $this->cart->insert($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert"><b> ' . $var['name'] . ' </b> has added into Shoppingcart</div>');
        redirect('home');
    }


    public function detailCart()
    {
        $data['title'] = 'Detail Cart';

        // * get userdata from session login and match data in DB
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/detail_cart', $data);
        $this->load->view('templates/footer');
    }


    function removeItem($rowid, $qty)
    {
        $data = [
            'rowid' => $rowid,
            'qty' => $qty - 1
        ];

        $this->cart->update($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Items remove</div>');
        redirect('home/detailCart');
    }


    public function addItem($rowid, $qty)
    {
        $data = [
            'rowid' => $rowid,
            'qty' => $qty + 1
        ];

        $this->cart->update($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Items added</div>');
        redirect('home/detailCart');
    }


    function removeItem2($rowid, $qty)
    {
        $data = [
            'rowid' => $rowid,
            'qty' => $qty - 1
        ];

        $this->cart->update($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Items remove</div>');
        redirect('home/checkOut');
    }


    public function addItem2($rowid, $qty)
    {
        $data = [
            'rowid' => $rowid,
            'qty' => $qty + 1
        ];

        $this->cart->update($data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Items added</div>');
        redirect('home/checkOut');
    }


    public function checkOut()
    {
        $data['title'] = 'Checkout';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('bank', 'Bank', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/checkout', $data);
            $this->load->view('templates/footer');
        } else {

            date_default_timezone_set('Asia/Jakarta');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $bank = $this->input->post('bank');
            $total = $this->input->post('total');

            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'date_order' => date('Y-m-d H:i:s'),
                'payment_deadline' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
                'payment_method' => $bank,
                'total' => $total,
                'status' => 0
            ];

            $this->db->insert('transactions', $data);
            $id_trans = $this->db->insert_id();

            foreach ($this->cart->contents() as $item) {
                $data2 = [
                    'id_trans' => $id_trans,
                    'id_product' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['qty'],
                    'price' => $item['price']
                ];

                $this->db->insert('invoice', $data2);
            }

            $this->cart->destroy();
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Your order is being process, please make payment before 1x24 hours</div>');
            redirect('home');
        }
    }
}
