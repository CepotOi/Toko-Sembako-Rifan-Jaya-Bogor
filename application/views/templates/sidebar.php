<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fab fa-steam"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko rifan jaya</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QUERY MENU SIDEBAR -->
    <!-- This for seperate User and Admin -->
    <!-- if user login as Admin view admin features -->
    <!-- if user login as User view user features -->
    <!-- if user isn't login view home only -->

    <?php
    // $role_id = $this->session->userdata('role_id');

    // $this->db->select('user_menu.id, menu');
    // $this->db->from('user_menu');
    // $this->db->join('user_access_menu', 'user_menu.id = user_access_menu. menu_id');
    // $this->db->where('user_access_menu.role_id', $role_id);
    // $this->db->order_by('user_access_menu.menu_id', 'ASC');
    // $query = $this->db->get()->result_array();

    // * catch role_id in seesion userdata from _login
    $role_id = $this->session->userdata('role_id');

    // * SELECT  'id' and 'menu' in table 'user_menu'
    $queryMenu = $this->db->select('user_menu.id, menu')

        // * FROM table user menu
        ->from('user_menu')

        // * JOIN table 'user_access_menu' ON 'id' in table 'user_menu' = 'menu_id' in table 'user_access_menu'
        ->join('user_access_menu', 'user_menu.id = user_access_menu. menu_id')

        // * WHERE 'role_id' in table 'user_access_menu' equal to role_id in session userdata
        ->where('user_access_menu.role_id', $role_id)

        // * ORDER BY 'menu_id' in table 'user_access_menu' ASCENDING
        ->order_by('user_access_menu.menu_id', 'ASC')

        // * get result all data above
        ->get();

    // * make result query data above to array
    $menu = $queryMenu->result_array();
    ?>

    <!-- Nav Item - Home -->
    <?php if ($title == 'Home') : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link" href="<?= base_url('home'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
        </li>

        <!-- LOOPING HEADER MENU -->
        <!-- in this case i only have 2 header menu: Admin and User -->
        <!-- loop and view all HEADER MENU that we have -->
        <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- SIAPKAN SUB-MENU SESUAI MENU -->
            <?php

            // * SELECT ALL
            $querySubMenu = $this->db->select('*')

                // * FROM table 'user_sub_menu'
                ->from('user_sub_menu')

                // * WHERE 'menu_id' in table 'user_sub_menu' = 'id' from data query above
                ->where('menu_id', $m['id'])

                // * AND 'is_active' in table 'user_sub_menu' = 1
                // * if SUB MENU = 1 meaning the SUB MENU is active
                // * if SUB MENU = 0 meaning the SUB MENI isn't active, and it can't be used
                ->where('is_active', 1)

                // * get result all data above
                ->get();

            // * make result query data above to array
            $subMenu = $querySubMenu->result_array();
            ?>

            <!-- LOOPING SUB MENU -->
            <!-- loop and view all SUB MENU that we have -->
            <?php foreach ($subMenu as $sm) : ?>

                <!-- Nav Item - SUB MENU -->
                <?php if ($title == $sm['title']) : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span>
                    </a>
                    </li>

                <?php endforeach; ?>

                <!-- Divider -->
                <hr class="sidebar-divider mt-3">


            <?php endforeach; ?>

            <!-- Nav Item - Login / Logout -->
            <!-- if user isn't login yet view Login button, if user is login view Logout -->
            <?php if ($this->session->userdata('email') == null) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth'); ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

</ul>
<!-- End of Sidebar -->