<?php
$session = service('session')
?>
<header class="top-bar">
    <div class="topbar position-fixed">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-4 col-12 d-md-block d-none">
                    <div class="topbar-social text-center text-md-start topbar-left">
                        <ul class="list-inline d-md-flex d-inline-block">
                            <li class="ms-10 pe-10">
                                <a href="<?php echo base_url("/faqs") ?>"><i
                                        class="text-white fa fa-question-circle"></i> Ask a
                                    Question</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="topbar-social text-center text-md-right">
                        <ul class="list-inline d-md-flex justify-content-end">
                            <li class="ms-10 pe-10">
                                <a href="#"><i class="text-white fa fa-envelope"></i>
                                    <?php echo OFFICIAL_EMAIL; ?></a>
                            </li>
                            <li class="ms-10 pe-10">
                                <a href="#"><i class="text-white fa fa-phone"></i> <?php echo OFFICIAL_CONTACT; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav id="main-menu" hidden class="nav-white bg-white">
        <div class="nav-header">
            <a href="<?php echo base_url(); ?>" class="brand">
                <img src="<?php echo base_url("public/images/ks-logo.png"); ?>" class="img-fluid" alt="" />
            </a>
            <button class="toggle-bar">
                <span class="ti-menu"></span>
            </button>
        </div>
        <ul class="menu">
            <li class="dropdown">
                <a href="<?php echo base_url("what-we-do") ?>">What we do</a>
                <ul class="dropdown-menu">
                    <li class="dropdown">
                        <a href="#">Life Enrichment</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("skills"); ?>">Skills</a></li>
                            <li><a href="<?php echo base_url("khadi"); ?>">Khadi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Learn beyond walls</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url("distance-eklavya"); ?>">Distance/Eklavya</a></li>
                            <li><a href="<?php echo base_url("Virtual"); ?>">Virtual</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">E-Hub</a>
                    </li>
                    <li>
                        <a href="#">E-Pub</a>
                    </li>
                    <li>
                        <a href="#">Bachpan</a>
                    </li>
                    <li>
                        <a href="#">Tarunai</a>
                    </li>
                    <li>
                        <a href="#">Mamritat</a>
                    </li>
                </ul>
            </li>
            <li><a href="<?php echo base_url("products") ?>">Collection</a></li>
            <li><a href="<?php echo base_url("get-involve") ?>">Get Involve</a></li>
            <li class="megamenu">
                <a href="#">About</a>
                <div class="megamenu-content">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <a href="<?php echo base_url("/about-ktdc") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>About MyKtdc</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/our-mission-vision") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Our Vision, Mission & Objectives</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/our-history") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Our History</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <a href="<?php echo base_url("/annual-report") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Annual Reports</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/trade-fair") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Trade Fair/Exhibitions</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/our-partners") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Our Partners</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <a href="<?php echo base_url("/founder") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Founder</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/facilities") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Facilities</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/awards") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Awards</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <a href="<?php echo base_url("/compliance") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Compliance</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/annual-events") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Annual Events</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/production-process") ?>"><i
                                            class="ti-arrow-circle-right me-10"></i>Production Process</a>
                                </li>
                            </ul>
                        </div>
                        <!--div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <?php echo anchor('<img src="' . base_url("public/images/partner-img7.png") . '">', "#", ["class" => "p-0 text-center"]); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <?php echo anchor('<img src="' . base_url("public/images/partner-img8.png") . '">', "#", ["class" => "p-0 text-center"]); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-12">
                            <ul class="list-group">
                                <li>
                                    <?php echo anchor('<img src="' . base_url("public/images/partner-img9.png") . '">', "#", ["class" => "p-0 text-center"]); ?>
                                </li>
                            </ul>
                        </div-->
                    </div>
                </div>
            </li>
            <li>
                <a class="btn btn-warning btn-round btn-nav btn-donate" href="<?php echo base_url("/donate") ?>">
                    DONATE
                </a>
            </li>
        </ul>
        <ul class="attributes">
            <li class="megamenu" data-width="270">
                <a href="#"><i data-feather="shopping-cart"></i></a>
                <div class="megamenu-content megamenu-cart">
                    <!-- Start Shopping Cart -->
                    <div class="cart-header">
                        <div class="total-price">
                            Total: <span>$2,432.93</span>
                        </div>
                        <i data-feather="shopping-cart"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="cart-body">
                        <ul>
                            <li>
                                <img src="http://via.placeholder.com/50x50">
                                <h6 class="title">Lorem ipsum dolor</h6>
                                <span class="qty">Quantity: 02</span>
                                <span class="price">$843,12</span>
                                <a href="#" class="link"></a>
                            </li>
                            <li>
                                <img src="http://via.placeholder.com/50x50">
                                <h6 class="title">Lorem ipsum dolor</h6>
                                <span class="qty">Quantity: 03</span>
                                <span class="price">$342,12</span>
                                <a href="#" class="link"></a>
                            </li>
                            <li>
                                <img src="http://via.placeholder.com/50x50">
                                <h6 class="title">Lorem ipsum dolor</h6>
                                <span class="qty">Quantity: 01</span>
                                <span class="price">$221,12</span>
                                <a href="#" class="link"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="cart-footer">
                        <a href="#">Checkout</a>
                    </div>
                    <!-- End Shopping Cart -->
                </div>
            </li>
            <li>
                <a href="#" class="toggle-search-fullscreen"><span class="ti-search"></span></a>
            </li>
            <li class="megamenu" data-width="250">
                <a href="" class="waves-effect waves-light" title="Notification" id="notification">
                    <span class="ti-bell"></span>
                </a>
                <div class="megamenu-content">
                    <ul class="list-group p-3 notifications">
                    </ul>
                </div>
            </li>
            </li>
            <li>
                <a href="<?php echo base_url("/products?wishlist=1") ?>" class=""><span class="ti-heart"></span></a>
            </li>
            <li class="megamenu" data-width="250">
                <a href="#" class="waves-effect waves-light" title="Profile">
                    <span class="ti-user"></span>
                </a>
                <div class="megamenu-content" style="left: -150px;">
                    <ul class="list-group p-3">
                        <li>
                            <h6 class="">Welcome</h6>
                            <?php if (!$session) {?>
                            <span>To access account and manage
                                orders</span>
                            <div class="mt-1">
                                <button id="login-btn" class="btn btn-warning btn-round btn-nav"
                                    onclick="redirect()">LOGIN /
                                    SIGNUP
                                </button>
                            </div>
                            <?php }?>
                            <hr>
                        </li>
                        <li>
                            <a class="py-1 px-0" href="<?php echo base_url("/customer/myorders") ?>">My
                                Orders</a>
                        </li>
                        <li>
                            <a class="py-1 px-0" href="<?php echo base_url("/customer/mywishlist") ?>">My
                                Wishlist</a>
                        </li>
                        <li>
                            <a class="py-1 px-0"
                                href="<?php echo base_url("/customer/notifications") ?>">Notifications</a>
                        </li>
                        <li>
                            <a class="py-1 px-0" href="<?php echo base_url("/customer/reviewAndRating") ?>">Review
                                &amp; Ratings</a>
                        </li>
                        <li>
                            <a class="py-1 px-0" href="<?php echo base_url("/customer/profile") ?>">Profile</a>
                        </li>
                        <?php if ($session->get('customer_info')) {?>
                        <li>
                            <hr>
                            <a class="py-1 px-0" href="<?php echo base_url("/customer/auth/logout") ?>">Logout</a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </li>
            <li>
                <?php if ($session->get('customer_info') && $session->get('customer_info')['cart_count']): ?>
                <i class="badge badge-danger badge-cart pulsate"
                    id='hdr-icn-crt-cnt'><?php echo $session->get('customer_info')['cart_count'] ?></i>
                <?php endif;?>
                <a class="btn btn-round btn-warning btn-cart text-white" id="cart_btn"
                    status="<?php echo isset($session) ? 1 : 0 ?>">
                    <span class="ti-shopping-cart"></span>
                </a>
            </li>
        </ul>
        <div class="wrap-search-fullscreen">
            <div class="container">
                <button class="close-search"><span class="ti-close"></span></button>
                <input type="text" placeholder="Search..." />
            </div>
        </div>
    </nav>
</header>