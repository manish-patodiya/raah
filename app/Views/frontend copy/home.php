<?php
echo view('frontend/frontend_include/header_top');
echo view('frontend/frontend_include/header');
$img_arr = ['banner1.jpg', 'banner2.jpg', 'banner3.jpg'];
?>
<!--Banner Section Start Here-->
<div id="minimal-bootstrap-carousel" class="carousel slide carousel-fade slider-content-style slider-home-one">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php $i = -0;
        foreach ($img_arr as $path) : ?>
            <div class="carousel-item <?php echo $i ? '' : 'active' ?> slide-<?php echo ++$i ?>" style="background-image: url(<?php echo base_url("public/handmade/images/$path") ?>)">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="box valign-middle">
                            <div class="content text-left">
                                <h3 data-animation="animated fadeInUp">Exclusive <span>Hand made</span> items
                                    Created With <span>Love</span></h3>
                                <a data-animation="animated fadeInDown" href="<?php echo base_url('products') ?>" class="thm-btn ">Shop Now
                                    <i class="bi bi-arrow-right-circle-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Controls-->
    <!-- <a class="carousel-control-prev" href="#minimal-bootstrap-carousel" role="button" data-slide="prev">
        <i class="fa fa-long-arrow-left"></i>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#minimal-bootstrap-carousel" role="button" data-slide="next">
        <i class="fa fa-long-arrow-right"></i>
        <span class="sr-only">Next</span>
    </a> -->

</div>
<!--Banner Section End Here-->

<!--Online Support Section Start Here-->
<div class="online-support">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="row align-items-center">
                    <div class="col-sm-3"><img src="<?php echo base_url("public/handmade/images/online-support-icon1.png") ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <label>Online Support 24/7</label>
                        <p>Receive 24/7 online support available</p>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="row align-items-center">
                    <div class="col-sm-3"><img src="<?php echo base_url("public/handmade/images/online-support-icon2.png") ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <label>Free Delivery</label>
                        <p>For all order over <i class="bi bi-currency-rupee"></i>999</p>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="row align-items-center">
                    <div class="col-sm-3"><img src="<?php echo base_url("public/handmade/images/online-support-icon3.png") ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <label>30 Days return</label>
                        <p>If goods have any problem</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Online Support Section End Here-->

<!--About Section Start Here-->
<div class="about-section">
    <div class="title-section text-right">About</div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6"><img src="<?php echo base_url("public/handmade/images/about-img.png") ?>" alt=""></div>
            <div class="col-md-6">
                <h1><span>About</span> Hand Made Items <span>50+ years of Experience</span></h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sagittis semper tortor.
                    Quisque non felis elementum augue ullamcorper laoreet. Nam... Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Phasellus sagittis semper tortor. Quisque non felis elementum
                    augue ullamcorper laoreet. Nam... Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Phasellus sagittis semper tortor. Quisque non felis elementum augue ullamcorper laoreet.
                    Nam...</p>
                <p>Dolor sit amet, consectetur adipiscing elit. Phasellus sagittis semper tortor. Quisque non
                    felis elementum augue ullamcorper laoreet. Nam... </p>
            </div>

        </div>
    </div>
</div>
<!--About Section End Here-->

<!--Collection Section Start Here-->
<div class="collection-section">
    <div class="title-section text-center">Collections</div>
    <h2 class="main-title">Collections <br> <span>Our New Arrivals</span> </h2>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-3">
                <a href="#" class="collection-block">
                    <img src="<?php echo base_url("public/handmade/images/collection-img1.jpg") ?>" alt="">
                    <h3>Ceremic Products</h3>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="collection-block">
                    <img src="<?php echo base_url("public/handmade/images/collection-img2.jpg") ?>" alt="">
                    <h3>Handicrafts Products</h3>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="collection-block">
                    <img src="<?php echo base_url("public/handmade/images/collection-img3.jpg") ?>" alt="">
                    <h3>Wooden Products</h3>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="collection-block">
                    <img src="<?php echo base_url("public/handmade/images/collection-img4.jpg") ?>" alt="">
                    <h3>Stitching Products</h3>
                </a>
            </div>
        </div>
    </div>
</div>
<!--Collection Section End Here-->

<!--info Section Start Here-->
<div class="info-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2>WHAT IS OUR Hand Made COLLECTION?</h2>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                    mollit anim id est laborum</p>
                <p>Individual Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-sm-6">
                <div class="info-img">
                    <img src="<?php echo base_url("public/handmade/images/info-img1.jpg") ?>" alt="">
                </div>
            </div>
        </div>
        <div class="row flex-row-reverse align-items-center">
            <div class="col-sm-6">
                <h2>WHAT IS OUR Hand Made COLLECTION?</h2>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                    mollit anim id est laborum</p>
                <p>Individual Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum Duis aute irure dolor in reprehenderit in
                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-sm-6">
                <div class="info-img info-img1">
                    <img src="<?php echo base_url("public/handmade/images/info-img2.jpg") ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--info Section End Here-->

<!--Latest Collection Section Start Here-->
<div class="latestcollection-section">
    <div class="title-section lates-hand text-center">Handmade</div>
    <h2 class="main-title latest_main">Latest Collections <br> <span>Spring Handmade Products</span> </h2>
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="latestcollection-block">
                        <img src="<?php echo base_url("public/handmade/images/dry.png") ?>">
                        <div class="latestcollection-text">
                            <h3>Diy And Cluster</h3>
                            <p>₹500</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="latestcollection-block">
                        <img src="<?php echo base_url("public/handmade/images/hand_blog.png") ?>">
                        <div class="latestcollection-text">
                            <h3>Handmade collection</h3>
                            <p>₹500</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="latestcollection-block">
                        <img src="<?php echo base_url("public/handmade/images/latest_blog3.png") ?>">
                        <div class="latestcollection-text">
                            <h3>Diy And Cluster</h3>
                            <p>₹500</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="latestcollection-block">
                        <img src="<?php echo base_url("public/handmade/images/latest_blog4.png") ?>">
                        <div class="latestcollection-text">
                            <h3>Handmade collection</h3>
                            <p>₹500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Latest Collection Section End Start Here-->

<!-- client testimonial start here -->
<div class="client-section">
    <div class="title-section client_head  text-center">Clients</div>
    <h2 class="main-title">Testimonials <br> <span>We love our Clients</span> </h2>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-7">
                <div class="owl-carousel client-owl owl-theme">
                    <div class="item">
                        <div class="client_box">
                            <div class="client_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sagittis
                                    semper tortor. Quisque non felis elementum augue ullamcorper laoreet. Nam...
                                </p>
                                <h3>Seema Mishra <span class="client_loca">Jaipur</span></h3>
                                <div class="client_img">
                                    <img src="<?php echo base_url("public/handmade/images/client-img1.jpg") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="client_box">
                            <div class="client_text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sagittis
                                    semper tortor. Quisque non felis elementum augue ullamcorper laoreet. Nam...
                                </p>
                                <h3>Suresh Kumar <span class="client_loca">Jaipur</span></h3>
                                <div class="client_img">
                                    <img src="<?php echo base_url("public/handmade/images/client-img2.jpg") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- client testimonial end here -->

<!--Bkog Section Start Here-->
<div class="blog-section">
    <div class="title-section lates-hand text-center">Blog</div>
    <h2 class="main-title latest_main">What’s New <br> <span>Read Our Latest News</span> </h2>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="blog-block">
                    <div class="blog-block-img"><img src="<?php echo base_url("public/handmade/images/blog-img1.jpg") ?>" alt="">
                    </div>
                    <div class="blog-block-text">
                        <label>August 15, 2022</label>
                        <h3>We Asked. You Answered. Here is What We Heard</h3>
                        <a href="#">Read More...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-block">
                    <div class="blog-block-img"><img src="<?php echo base_url("public/handmade/images/blog-img2.jpg") ?>" alt="">
                    </div>
                    <div class="blog-block-text">
                        <label>August 15, 2022</label>
                        <h3>We Asked. You Answered. Here is What We Heard</h3>
                        <a href="#">Read More...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-block">
                    <div class="blog-block-img"><img src="<?php echo base_url("public/handmade/images/blog-img3.jpg") ?>" alt="">
                    </div>
                    <div class="blog-block-text">
                        <label>August 15, 2022</label>
                        <h3>We Asked. You Answered. Here is What We Heard</h3>
                        <a href="#">Read More...</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--Bkog Section End Start Here-->

<!--Newsletter Section Start Here-->
<div class="newsletter-section">
    <h2 class="main-title latest_main">Newsletter <br> <span>Join our global community</span> </h2>
    <div class="container">
        <div class="col-sm-12">
            <form class="form-subscribe" action="#">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" placeholder="Enter your e-mail address">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-lg" type="submit">Send</button>
                    </span>
                </div>
                <p class="info-msg">We hate spam, and we respect your privacy!</p>
            </form>
        </div>
        <div class="col-sm-12">
            <div class="owl-carousel partners-owl owl-theme">
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img1.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img2.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img3.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img4.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img5.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img1.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img2.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img3.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img4.png") ?>">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-block">
                        <img src="<?php echo base_url("public/handmade/images/partner-img5.png") ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Newsletter Section End Start Here-->

<!--Footer Section Start Start Here-->

<?php
echo view('frontend/frontend_include/footer');
?>