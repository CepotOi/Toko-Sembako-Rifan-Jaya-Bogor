<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        // * SELECT table 'user_sub_menu' and field 'menu' in table 'user_menu'
        $query = $this->db->select('user_sub_menu.*, user_menu.menu')

            // * FROM table 'user_sub_menu'
            ->from('user_sub_menu')

            // * JOIN table 'user_menu' ON 'menu_id' in table 'user_sub_menu' = 'id' in table 'user_menu'
            ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')

            // * get result all data above
            ->get();

        // * return data above to array
        return $query->result_array();
    }



    // * get name the menu from method deleteMenu in controller Menu
    public function deleteDataMenu($id)
    {
        // * DELETE FROM table 'user_menu' WHERE 'menu' = $menu
        // $this->db->where('menu', $menu);
        $this->db->delete('user_menu', ['id' => $id]);
    }


    public function deleteDataSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }
}
