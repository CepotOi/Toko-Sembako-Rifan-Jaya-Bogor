<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function find($id)
    {
        // * SELECT table `products` WHERE `id` = $id LIMIT 1
        $query = $this->db->where('id', $id)
            ->limit(1)
            ->get('products');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }
}
