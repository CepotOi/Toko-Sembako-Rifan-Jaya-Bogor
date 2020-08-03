<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <?php if ($this->session->userdata('role_id') == null) : ?>
                    <div class="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item mx-1">
                                <a class="nav-link" href="#" role="button">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                    <div class="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item mx-1">
                                <a class="nav-link" href="<?= base_url('home/detailCart'); ?>" role="button">
                                    <i class="fas fa-shopping-cart"></i>
                                    <?php $cart = $this->cart->total_items(); ?>
                                    <?php if ($cart) : ?>
                                        <span class="badge badge-counter badge-danger">
                                            <?= $cart; ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow mt-2">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?= $user['name'] ?>
                        </span>
                        <?php if ($this->session->userdata('role_id') == null) : ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/default.png'); ?>">
                        <?php elseif ($this->session->userdata('role_id') == 1) : ?>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                        <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                            <?php $order = $this->db->get_where('transactions', ['email' => $user['email']]); ?>
                            <?php if ($order) : ?>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                                <span class="badge badge-counter badge-danger">
                                    <?= $order->num_rows(); ?>
                                </span>
                            <?php else : ?>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>

                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                        <!-- if user isn't login yet view Login button, if user is login view Logout -->
                        <?php if ($this->session->userdata('role_id') == null) : ?>
                            <a class="dropdown-item" href="<?= base_url('auth'); ?>">
                                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Login
                            </a>
                        <?php elseif ($this->session->userdata('role_id') == 1) : ?>
                            <a class="dropdown-item" href="<?= base_url('user'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        <?php elseif ($this->session->userdata('role_id') == 2) : ?>
                            <a class="dropdown-item" href="<?= base_url('user'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('order'); ?>">
                                <i class="fas fa-money-check-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                My Order
                                <?php $order = $this->db->get_where('transactions', ['email' => $user['email']]); ?>
                                <?php if ($order) : ?>
                                    <span class="badge badge-counter badge-danger">
                                        <?= $order->num_rows(); ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        <?php endif; ?>

                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->