<?php

function is_logged_in()
{
    // * get_instance() for calling library CI in this function
    // * because this function is unrecognized by CI
    $ci = get_instance();

    // * if the user has not logged in and forced entry into a feature that requires the user to log in, kick it! to login page
    if (!$ci->session->userdata('email')) {
        redirect('auth');

        // * if user has logged in, check it's role_id from session
    } else {
        $role_id = $ci->session->userdata('role_id');

        // * check menu by segment
        // * ex: http:example.com/index.php/hello/world/update/application
        // * index.php is ignored
        // * 1. hello = first segment
        // * 2. world = second segment
        // * 3. update = first segment
        // * 4. application = first segment

        // * in this case: https:localhost/web-gua/user
        // * user is the first segment
        $menu = $ci->uri->segment(1);

        // * SELECT * FROM table 'user_menu' WHERE 'menu' = $menu
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        // * SELCET * FROM table 'user_access_menu' WHERE field 'role_id' = $role_id AND field 'menu_id' = $menu_id
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    // * SELECT table 'user_access_menu' WHERE coloumn 'role_id' = $role_id AND coloumn 'menu_id' = $menu_id 
    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    // * check query above if > 0, return string 'checked'
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
