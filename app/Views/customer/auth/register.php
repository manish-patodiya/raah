<?php echo view('customer/auth/header'); ?>


<body class="hold-transition theme-primary bg-img position-relative " style="background-image: url(<?php echo base_url('public/images/auth-bg/bg-6.jpg'); ?>)">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12 p-40">
                        <div class="row h-p100 shadow bg-white rounded10">
                            <div>
                                <div class="px-20 pt-40 pb-0 d-flex flex-column align-items-center position-relative">
                                    <img src="<?php echo base_url('public/images/logo/ks-logo.png') ?>" alt="" width='80' class='position-absolute' style='top:-50%;' />
                                    <h4 class='text-theme mt-2' style='color:#7d7777'>Create your account</h4>
                                </div>
                                <div class="px-20 py-20">
                                    <form id='frm-register' method="post">
                                        <?php echo csrf_field() ?>
                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input name="phone" autocomplete='off' type="number" class="form-control" id='inpt-phone' placeholder="Phone no." onkeypress="return this.value.length==10 || isNaN(this.value)? false:true" />
                                                <label for="inpt-phone">Mobile no<span class='required'>*</span></label>
                                                <button type='button' class='position-absolute btn' id='btn-send-otp' onclick="request_otp(this)" disabled style="top:0;right:0;height:100%;border-top-left-radius:0;border-bottom-left-radius:0;">Send
                                                    OTP</button>
                                            </div>
                                            <div id='mobile-err' class='err'></div>
                                        </div>

                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input name="otp" type="number" onkeypress="return this.value.length==6 ? false:true" placehlder="" id='inpt-otp' class="form-control" placeholder='Enter otp' />

                                                <label for="inpt-otp">OTP<span class='required'>*</span></label>
                                            </div>
                                            <span id='otp-send-msg'></span>
                                            <div id='verification-err' class='err'></div>
                                        </div>

                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input type="text" name='full_name' id='inpt-name' class="form-control" placeholder="Full Name">
                                                <label>Full Name<span class='required'>*</span></label>
                                            </div>
                                            <div id='name-err' class='err'></div>
                                        </div>

                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input type="email" autocomplete='email' id='inpt-email' name='email' class="form-control" placeholder="Email">
                                                <label>Email<span class='required'>*</span></label>
                                            </div>
                                            <div id='email-err' class='err'></div>
                                        </div>

                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input type="password" autocomplete='new-password' name='password' id='inpt-password' class="form-control" placeholder="Password">
                                                <label>Password<span class='required'>*</span></label>
                                                <div class='position-absolute d-flex align-items-center justify-content-center' style='top:0; right: 0px; height:100%;'>
                                                    <a onclick='show_hide_pass(this,"inpt-password")' class="text-theme mdi mdi-eye me-3" id='btn-view-pass' style='cursor:pointer'>
                                                        Show</a>
                                                </div>
                                            </div>
                                            <div id='pass-err' class='err'></div>
                                        </div>

                                        <div class='controls mb-3'>
                                            <div class="form-floating">
                                                <input type="password" name='cpassword' autocomplete='new-password' id='inpt-cpassword' class="form-control" placeholder="Retype password">
                                                <label>Retype Password<span class='required'>*</span></label>
                                                <div class='position-absolute d-flex align-items-center justify-content-center' style='top:0; right: 0px; height:100%;'>
                                                    <a onclick='show_hide_pass(this,"inpt-cpassword")' class="text-theme mdi mdi-eye me-3" id='btn-view-pass' style='cursor:pointer'>
                                                        Show</a>
                                                </div>
                                            </div>
                                            <div id='cpass-err' class='err'></div>
                                        </div>

                                        <div style='font-size:12px'>
                                            Make your password strong by adding:
                                            <ul style='color:#6d6d71;font-size:11px'>
                                                <li>Minimum 8 characters (letters & numbers)</li>
                                                <li>Minimum one capital letter (A-Z)</li>
                                                <li>Minimum special character (@ $ ! # % * ? & )</li>
                                                <li>Minimum one number (0-9)</li>
                                            </ul>
                                        </div>

                                        <input type="hidden" name='row_id' id='inpt-row-id' value='' />

                                        <button type="submit" id='btn-register' disabled class="btn btn-secondary margin-top-10 mb-2" style='width:100%'>Register</button>

                                        <div class='text-center'>
                                            <p class="mt-15 mb-0 text-center">Already have a account? <a href="<?php echo $login_url ?>" class='text-danger'> Sign In</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('customer/auth/footer'); ?>
</body>

</html>