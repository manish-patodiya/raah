<footer class="footer-section" id="footer-section" data-aos="fade-up" data-aos-duration="800">
    <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-widget-outer">
                    <div class="row">
                        <div class="footer-column footer-1 col-lg-4 col-md-6 col-sm-6 col-12" data-aos="fade-right" data-aos-duration="200">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">About My KTDC</h4>
                                <div class="menu-about-container">
                                    <p>We improve the health of children and families so children no longer die
                                        of preventable illnesses and live past their fifth birthday Lorem ipsum
                                        dolor sit amet We improve the health of children and families so
                                        children no longer die of preventable illnesses and live past their
                                        fifth birthday Lorem ipsum dolor sit amet</p>
                                    <ul class="footer-social-icon">
                                        <li class="facebook"><a target="_blank" href="#"><i class="bi bi-facebook"></i></a></li>
                                        <li class="instagram"><a target="_blank" href="#"><i class="bi bi-twitter"></i></a></li>
                                        <li class="pinterest"><a target="_blank" href="#"><i class="bi bi-linkedin"></i></a></li>
                                        <li class="twitter"><a target="_blank" href="#"><i class="bi bi-youtube"></i></a></li>
                                        <li class="youtube"><a target="_blank" href="#"><i class="bi bi-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column footer-2 col-lg-3 col-md-6 col-sm-6 col-12" data-aos="fade-right" data-aos-duration="400">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Company</h4>
                                <div class="menu-about-container">
                                    <ul id="menu-about" class="">
                                        <li><a href="privacy-policy.html"><?php anchor("Privacy Policy", "privacy-policy"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Terms &amp; Conditions", "terms-conditions"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Cancellation Policy", "cancellation-policy"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Returns, Refunds And Replacement Policy", "returns-refunds-replacement-policy"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Responsible Disclosure Policy", "responsible-disclosure-policy"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Intellectual Property Policy", "intellectual-property-policy"); ?></a>
                                        </li>
                                        <li><a href="#"><?php anchor("Anti Plishing Alert", "anti-plishing-alert"); ?></a>
                                        </li>
                                        <li><a href="#">Shipping Policy</a></li>
                                        <li><a href="#">Payment Policy</a></li>
                                        <li><a href="#">Dispute Resolution</a></li>
                                        <li><a href="#">Genuine Quality product</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column footer-1 col-lg-2 col-md-6 col-sm-6 col-12" data-aos="fade-right" data-aos-duration="800">
                            <div class="footer-widget">
                                <h4 class="footer-widget-title">Suport</h4>
                                <div class="menu-about-container">
                                    <ul id="menu-about" class="">
                                        <li><a href="about.html"><?php anchor("About Us", "about"); ?></a></li>
                                        <li><a href="blog.html"><?php anchor("Blog", "blog"); ?></a></li>
                                        <li><a href="contact-us.html">Contact Us</a></li>
                                        <li><a href="faqs.html">FAQ</a></li>
                                        <li><a href="#">Stock Clearance Sale</a></li>
                                        <li><a href="#">The Green Store</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-column footer-2  col-lg-3 col-md-6 col-sm-6 col-12" data-aos="fade-right" data-aos-duration="600">
                            <div class="footer-widget widget_nav_menu">
                                <h4 class="footer-widget-title">Popular Categories</h4>
                                <div class="menu-my-account-container">
                                    <ul id="menu-my-account" class="">
                                        <li><?php anchor("Login/Signup", "customer"); ?></li>
                                        <li><?php anchor("My account", "customer"); ?></li>
                                        <li><?php anchor("My Order", "customer/myOrders"); ?>
                                        <li><?php anchor("Wishlist", "customer/myWishlist"); ?>
                                        </li>
                                        <!-- <li><a href="#">Reward Program</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright">
                        <p>© <?php echo date('Y'); ?> <a href="#">myktdc</a>. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Footer Section End Start Here-->
</div>


<script src='https://code.jquery.com/jquery-latest.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js'></script>
<script src="<?php echo base_url("public/handmade/js/script.js") ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $('.partners-owl').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        items: 5,

        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 5
            },
            1000: {
                items: 5
            }
        }
    })

    $('.client-owl').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    })

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dot: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    })
</script>
</body>

</html>