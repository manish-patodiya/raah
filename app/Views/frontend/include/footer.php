<footer class="footer_three">
    <div class="footer-top bg-dark3 pt-80" style="
          background: url(<?php echo base_url("public/images/footer_bg.jpg"); ?>) 0 0 no-repeat;
          background-size: 100% 100%;
        ">
        <div class="container-fluid px-150">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title text-warning fw-600">About My KTDC</h4>
                        <p class="text-capitalize mb-20">
                            शेखावाटी क्षेत्र की पहचान का प्रतीक, बूंदी-बंधेज कार्य हुनरबाजो के आय-अर्जन स्रोत के साथ ही
                            समृद्ध सांस्कृतिक धरोहर एवं सम्मान का परिचायक है. रंग-बिरंगी सौभाग्य एवं सुहाग की निशानी
                            चुनरी से लेकर आन-बान-शान व स्वाभिमान को प्रकट करती पगड़ी तक यह कारोबार कालान्तर से
                            पीढ़ी-दर-पीढ़ी प्रगतिपथ पर रहा. जिसकी अधिसंख्य कारीगर महिला वर्ग है.
                        </p>
                        <div class="">
                            <a href="<?php base_url("radio"); ?>">
                                <img src="<?php echo base_url("public/images/partner-img6.png"); ?>" alt="KTDC Radio"
                                    style="width: 150px; box-shadow: inset 0 0 13px 8px #ccc; border-radius: 10px;" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title text-warning fw-600">Policies</h4>
                        <ul class="list list-arrow mb-30">
                            <li><a href="privacy-policy.html"><?php anchor("Privacy Policy", "privacy-policy"); ?></a>
                            </li>
                            <li><a href="#"><?php anchor("Terms &amp; Conditions", "terms-conditions"); ?></a>
                            </li>
                            <li><a href="#"><?php anchor("Cancellation Policy", "cancellation-policy"); ?></a>
                            </li>
                            <li><a
                                    href="#"><?php anchor("Returns, Refunds And Replacement Policy", "returns-refunds-replacement-policy"); ?></a>
                            </li>
                            <li><a
                                    href="#"><?php anchor("Responsible Disclosure Policy", "responsible-disclosure-policy"); ?></a>
                            </li>
                            <li><a
                                    href="#"><?php anchor("Intellectual Property Policy", "intellectual-property-policy"); ?></a>
                            </li>
                            <li><a href="#"><?php anchor("Anti Plishing Alert", "anti-plishing-alert"); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title text-warning fw-600">Quick Link</h4>
                        <ul class="list list-unstyled list-arrow mb-30">
                            <li><?php anchor("About Us", "about-ktdc"); ?></li>
                            <li><?php anchor("Blog", "blog"); ?></li>
                            <li><?php anchor("Contact Us", "contact-us"); ?></li>
                            <li><?php anchor("FAQs", "faqs"); ?></li>
                        </ul>
                    </div>
                    <div class="widget">
                        <h4 class="footer-title text-warning fw-600">Popular</h4>
                        <ul class="list list-unstyled list-arrow mb-30">
                            <li><?php anchor("Login/Signup", "customer"); ?></li>
                            <li><?php anchor("My account", "customer"); ?></li>
                            <li><?php anchor("My Order", "customer/myOrders"); ?></li>
                            <li><?php anchor("Wishlist", "customer/myWishlist"); ?></li>
                            <li><?php anchor("Seller Login", "seller"); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title text-warning fw-600">Contact Info</h4>
                        <ul class="list list-unstyled mb-30">
                            <li> <i class="fa fa-map-marker"></i> <?php echo OFFICIAL_ADDRESS ?></li>
                            <li> <i class="fa fa-phone"></i> <span class="me-5"><?php echo OFFICIAL_CONTACT ?></span>
                            <li> <i class="fa fa-envelope"></i> <span class="me-5"><?php echo OFFICIAL_EMAIL ?></span>
                            </li>
                        </ul>
                        <div class="social-icons mt-30">
                            <ul class="list-unstyled d-flex gap-items-1">
                                <li>
                                    <a target="_blank" href="<?php echo URL_FACEBOOK; ?>"
                                        class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i
                                            class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?php echo URL_TWITTER; ?>"
                                        class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i
                                            class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?php echo URL_LINKEDIN; ?>"
                                        class="waves-effect waves-circle btn btn-social-icon btn-circle btn-linkedin"><i
                                            class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?php echo URL_YOUTUBE; ?>"
                                        class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i
                                            class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                            <div style="width:190px;" class="pt-20">
                                <?php
                                $img = '<img src="' . base_url('public/images/logo/playstore.png') . '" max-height="100%" style="margin-left:-10px; max-width:100%; cursor:pointer;">';
                                anchor($img, APP_ANDROID, [
                                    "target" => "_blank"
                                ]); ?>
                            </div>
                            <!--div style="width:190px;" class="pt-20">
                                <button class="btn btn-warning btn-lg">Donate</button>
                            </div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-dark3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-md-start text-center">
                    ©
                    <script>
                    document.write(new Date().getFullYear());
                    </script>
                    <span class="text-white">Myktdc</span> All Rights Reserved.
                </div>
                <div class="col-lg-6 col-md-6 mt-md-0 mt-20">
                    <ul
                        class="payment-icon list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
                        <li class="ps-0">
                            <a href="javascript:;"><i class="fa fa-cc-amex" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-visa" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>