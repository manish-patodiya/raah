<?php echo view('customer/auth/header'); ?>
<script>
let redirect_url = '<?php echo $redirect_url ?: $redirect_url ?>';
</script>

<body class="hold-transition theme-primary bg-img"
    style="background-image: url(<?php echo base_url('public/images/auth-bg/bg-6.jpg'); ?>)">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-left g-0">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="bg-white rounded10 shadow-lg position-relative">
                            <div class="content-top-agile pt-80 pb-0">
                                <a class="text-primary" href="<?php echo base_url(); ?>">
                                    <img class="position-absolute l-0 r-0 mx-auto w-120" style="top:-45px"
                                        src="<?php echo base_url('public/images/ks-logo.png'); ?>" alt="My KTDC" />
                                </a>
                                <h2 class="text-primary"><?php echo trans('login'); ?></h2>
                                <p class="mb-0"><?php echo trans('sign_in_to') ?> <?php echo SITE_NAME; ?>.</p>
                            </div>
                            <div class="p-40">
                                <form method="post" autocomplete="off" id="frm-login" onsubmit="return false"
                                    novalidate="novalidate">
                                    <?php echo csrf_field(); ?>
                                    <div class='controls mb-3'>
                                        <div class="form-floating">
                                            <input name="phone" autocomplete='off' type="number" class="form-control"
                                                id='inpt-phone' placeholder="Phone no."
                                                onkeypress="return this.value.length==10 || isNaN(this.value)? false:true" />
                                            <label for="inpt-phone">Phone no<span class='required'>*</span></label>
                                        </div>
                                        <div id='phone-err' class='err'></div>
                                    </div>
                                    <div class='controls mb-3'>
                                        <div class="form-floating">
                                            <input name="password" autocomplete='off' type="password"
                                                class="form-control" id="inpt-password" placeholder="Enter Password" />
                                            <label for="inpt-password">Password<span class='required'>*</span></label>

                                            <button type='button' data-show="0"
                                                onclick="show_hide_pass(this,'inpt-password')"
                                                class='position-absolute no-border bg-none' id="btn-view-pass"
                                                style="top:0;right:0;height:100%;">
                                                <i class="mdi mdi-eye"></i> Show
                                            </button>
                                        </div>
                                        <div id='password-err' class='err'></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_1">
                                                <label for="basic_checkbox_1">Remember Me</label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="fog-pwd text-end">
                                                <a href="<?php echo base_url("customer/auth/forgot_password"); ?>"
                                                    class="hover-warning"><i class="ion ion-locked"></i> Forgot
                                                    pwd?</a><br>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="form-group text-center pt-10">
                                        <button type="submit" class="btn btn-warning btn-block" id="btn-login">SIGN
                                            IN</button>

                                        <!-- /.col -->
                                    </div>

                                    <div class="alert text-danger p-0" id="login-err" style="visibility: hidden;"></div>
                                </form>
                                <div class="row text-center mt-100">
                                    <p class=" mb-0">Don't have account?</p>
                                    <a href="http://localhost/myktdc/customer/auth/signup"
                                        class="text-warning ms-10">Sign Up</a>
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