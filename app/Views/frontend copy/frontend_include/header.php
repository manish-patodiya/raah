<?php
$uri = service('uri');
$uri_arr = $uri->getSegments();
$final_uri = implode('/', $uri_arr);
$url = base_url($final_uri);

$what_we_do_url = base_url('whatwedo');
$is_what_we_do = $url == $what_we_do_url;

$about_url = base_url('about');
$is_about = $url == $about_url;

$blogs_url = base_url('blog');
$is_blog = $url == $blogs_url;

$news_url = base_url('news');
$is_news = $url == $news_url;

$shopping_url = base_url('products');
$is_shop = $url == $shopping_url;

?>
<header>
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <span class="free_shiping_text">Free Shipping for Orders <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                            <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z" />
                        </svg>999</span>
                </div>
                <div class="col-sm-6">

                    <ul class="header-top-info">
                        <li><i class="fa fa-paper-plane"></i> <a href="mailto:info@myktdc.com"><i class="bi bi-cursor"></i> info@myktdc.com</a></li>
                        <li><i class="fa fa-mobile"></i><a href="tel:+91-87924 8880"><i class="bi bi-phone"></i>
                                +91-87924 8880</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <a class="logo" href="<?php echo  base_url() ?>"><img src="<?php echo base_url("public/images/ks-logo.png") ?>" alt="">
                </a>
                <nav class="navbar main-nav navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <i class="bi bi-text-left"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link <?php echo  $is_about ? 'active' : '' ?>" href="<?php echo  $about_url ?>">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo  $is_what_we_do ? 'active' : '' ?>" href="<?php echo  $what_we_do_url ?>">
                                    What we do</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo  $is_shop ? 'active' : '' ?>" href="<?php echo  $shopping_url ?>">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo  $is_blog ? 'active' : '' ?>" href="<?php echo  $blogs_url ?>">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo  $is_news ? 'active' : '' ?>" href="<?php echo  $news_url ?>">News</a>
                            </li>
                        </ul>

                    </div>
                </nav>


                <div class="user-right">

                    <a href="#"><i class="bi bi-search"></i></a>

                    <a href="#"><i class="bi bi-bell"></i></a>

                    <a href="#"><i class="bi bi-person"></i></a>

                    <a href="#"><i class="bi bi-heart"></i></a>

                    <a class="cart" href="#"><i class="bi bi-cart"></i> <span>2</span></a>

                </div>

            </div>

        </div>
    </div>
</header>
<!--Header Section End Here-->