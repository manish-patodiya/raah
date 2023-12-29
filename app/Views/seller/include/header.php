<div class="wrapper">
    <div id="loader"></div>

    <header class="main-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <!-- Logo -->
            <a href="<?php echo base_url() ?>" class="logo d-flex align-items-center">
                <!-- logo-->
                <div class="logo-mini w-70">
                    <span class="light-logo"><img src="<?php echo $session->site_info->logo ?>" alt="logo"></span>
                </div>
                <h1 class='logo-lg m-0 text-white'>My KTDC</h1>
                <!-- <div class="logo-lg">
                    <span class="light-logo"><img src="<?php echo base_url('public/images/logo-light-text.png') ?>"
                            alt="logo"></span>
                    <span class="dark-logo"><img src="<?php echo base_url('public/images/logo-light-text.png') ?>"
                            alt="logo"></span>
                </div> -->
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group nav-item">
                        <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light"
                            data-toggle="push-menu" role="button">
                            <i data-feather="align-left"></i>
                        </a>
                    </li>
                    <li class="btn-group d-lg-inline-flex d-none  align-items-center">
                        <span class='badge badge-danger badge-lg px-4'>Seller</span>
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <style>
                    .my-4 {
                        margin-top: 2rem !important;
                        margin-bottom: 1.5rem !important;
                    }
                    </style>
                    <!-- Notifications -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle btn-info-light"
                            data-bs-toggle="dropdown" title="Notifications">
                            <i data-feather="bell"></i>
                        </a>
                        <ul class="dropdown-menu animated bounceIn">
                            <li class="header">
                                <div class="p-20">
                                    <div class="flexbox">
                                        <div>
                                            <h4 class="mb-0 mt-0"><?php echo trans('notification') ?></h4>
                                        </div>
                                        <div>
                                            <a href="#" class="text-danger"><?php echo trans('clear_all') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <ul class="menu sm-scrol">
                                    <?php foreach ($session->seller_info['notifications'] as $k => $v) {
    ?>
                                    <li>
                                        <a href="<?php echo base_url("/seller/notifications/notification") ?>">
                                            <i class="fa fa-users text-info"></i><?php echo $v->text ?>
                                        </a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </li>
                            <li class="footer">
                                <a
                                    href="<?php echo base_url("/seller/notifications/notification") ?>"><?php echo trans('view_all') ?></a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#"
                            class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow"
                            data-bs-toggle="dropdown" title="User">
                            <img src="<?php
echo $session->seller_info['profile_photo']; ?>" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li class="user-body">
                                <a class="dropdown-item" href="<?php echo base_url('seller/profile') ?>"><i
                                        class="ti-user text-muted me-2"></i>
                                    <?php echo trans('profile') ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('seller/auth/logout') ?>"><i
                                        class="ti-lock text-muted me-2"></i>
                                    <?php echo trans('logout') ?></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>