<style>
    #suggestions ul {
        padding: 0px;
    }

    #suggestions li {
        list-style: none;
        padding: 0.8rem !important;
    }

    .search-bx {
        overflow: inherit !important;
        max-width: 400px !important;
    }
</style>
<header class="main-header">
    <div class="inside-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <!-- Logo -->
            <a href="<?php echo base_url() ?>" class="logo d-flex align-items-center justify-content-center">
                <!-- logo-->
                <div class="logo-lg text-white">
                    <span class="light-logo">
                        <h1>KTDC</h1>
                    </span>
                    <span class="dark-logo">
                        <h1>KTDC</h1>
                    </span>
                </div>
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        <div class="app-menu">
                            <div class="search-bx mx-5" style='overflow:inherit;' id='searched-prod'>
                                <form class='position-relative' action="<?php echo base_url('products'); ?>" method='get' style='width:400px;'>
                                    <div class='input-group'>
                                        <input type="search" name='search' class="form-control text-white" placeholder="Search" aria-label="Search" aria-describedby="button-addon3" id='inpt-search-product' autocomplete='off' />
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" id="button-addon3"><i data-feather="search"></i></button>
                                        </div>
                                    </div>
                                    <div class='position-absolute start-0 end-0 bg-white d-none' id='suggestions' style='box-shadow:2px 3px 5px -1px rgb(0 0 0 / 50%);'>
                                        <ul class='border-top media-list media-list-hover media-list-divided'>
                                            <span class="p-2 text-faded">Enter 3 or More Charcters</span>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('privacy-policy') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            PP
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('terms-conditions') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            T&C
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('cancellation-policy') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            CP
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('returns-refunds-replacement-policy') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            RRR
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('responsible-disclosure-policy') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            RDP
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('intellectual-property-policy') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            IPP
                        </a>
                    </li>
                    <li class="btn-group nav-item d-xl-inline-flex d-none">
                        <a href="<?php echo base_url('anti-plishing-alert') ?>" class="waves-effect waves-light nav-link w-p100 full-screen btn-primary-light fs-18 l-h-26">
                            Alert
                        </a>
                    </li>

                    <li class="btn-group nav-item d-lg-inline-flex d-none">
                        <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen btn-warning-light" title="Full Screen">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>
                    <!-- Notifications -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle btn-info-light" data-bs-toggle="dropdown" title="Notifications">
                            <i data-feather="bell"></i>
                        </a>
                        <ul class="dropdown-menu animated bounceIn">

                            <li class="header">
                                <div class="p-20">
                                    <div class="flexbox">
                                        <div>
                                            <h4 class="mb-0 mt-0">Notifications</h4>
                                        </div>
                                        <div>
                                            <a href="#" class="text-danger">Clear All</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu sm-scrol">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc
                                            suscipit blandit.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu
                                            sapien elementum, in semper diam posuere.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-danger"></i> Donec at nisi sit amet
                                            tortor commodo porttitor pretium a erat.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-success"></i> In gravida mauris
                                            et nisi
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero
                                            dictum fermentum.
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-primary"></i> Nunc fringilla lorem
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam
                                            interdum, at scelerisque ipsum imperdiet.
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Control Sidebar Toggle Button -->
                    <li class="btn-group nav-item">
                        <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect full-screen waves-light btn-danger-light">
                            <i data-feather="settings"></i>
                        </a>
                    </li>

                    <!-- User Account-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow" data-bs-toggle="dropdown" title="User">
                            <img src="<?php echo base_url('public/images/avatar/avatar-1.png') ?>" class="avatar rounded-10 bg-primary-light h-40 w-40" alt="" />
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li class="user-body">
                                <a class="dropdown-item" href="extra_profile.html"><i class="ti-user text-muted me-2"></i>
                                    Profile</a>
                                <a class="dropdown-item" href="mailbox.html"><i class="ti-settings text-muted me-2"></i>
                                    Email</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('customer/auth/logout') ?>"><i class="ti-lock text-muted me-2"></i>
                                    Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>