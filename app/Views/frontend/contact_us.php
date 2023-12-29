    <section class="py-170">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-12">
                    <form class="contact-form" method="post" autocomplete="off" id="frm-contact-us">
                        <?php echo csrf_field() ?>
                        <div class="text-start mb-30">
                            <h2>Get In Touch</h2>
                            <p>Please get in touch and our expert support team will answer all your questions.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="First Name"
                                            name="first_name" data-validation-required-message="This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="email" class="form-control" placeholder="Your Email" name="email"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="tel" class="form-control" placeholder="Phone" name="phone"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="text" class="form-control" placeholder="Subject" name="subject"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="controls">
                                        <textarea name="message" rows="5" class="form-control" placeholder="Message"
                                            data-validation-required-message="This field is required"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="submit" type="submit" value="Submit"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 col-12 mt-30 mt-md-0">
                    <div class="box box-body p-40 bg-dark mb-0">
                        <h2 class="box-title text-white">Contact Info</h2>
                        <p>For all enquiries, Please contact us on below...</p>
                        <div class="widget fs-18 my-20 py-20 by-1 border-light">
                            <ul class="list list-unstyled text-white-80">
                                <li class="ps-40"><i class="ti-location-pin"></i><?php echo OFFICIAL_ADDRESS ?>
                                </li>
                                <li class="ps-40 my-20"><i class="ti-mobile"></i><?php echo OFFICIAL_CONTACT ?></li>
                                <li class="ps-40"><i class="ti-email"></i><?php echo OFFICIAL_EMAIL ?></li>
                            </ul>
                        </div>
                        <h4 class="mb-20">Follow Us</h4>
                        <ul class="list-unstyled d-flex gap-items-1">
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-linkedin"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section>
        <div class="row">
            <div class="col-12">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596552044!2d-74.25986763304465!3d40.69714941412697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1537364999769"
                    class="map" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </section> -->