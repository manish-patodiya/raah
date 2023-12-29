<html>

<head>
    <style>
        label.error {
            color: #fb5ea8;
            font-weight: 400 !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";
    </script>

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(<?php echo base_url('public/images/auth-bg/bg-4.jpg'); ?>)">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary"><?php echo trans('chng_pass') ?></h2>
                                <p class="mb-0"><?php echo trans('pass_must_diff') ?></p>
                            </div>
                            <div class="p-40">
                                <div class="alert alert-danger" id="change-pass-err" style="display: none;"></div>
                                <form method="post" autocomplete="off" id="change-password" onsubmit="return false">
                                    <?php echo csrf_field() ?>
                                    <div class="form-group controls">
                                        <div class="input-group">
                                            <span class="input-group-text "><i class="ti-lock"></i></span>
                                            <input type="text" name="password" id='password' class="form-control" placeholder="New password" />
                                        </div>
                                        <div class="form-control-feedback"><small><?php echo trans('must_grtr_than_4') ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group controls">
                                        <div class="input-group">
                                            <span class="input-group-text "><i class="ti-lock"></i></span>
                                            <input type="text" name="cpassword" class="form-control" placeholder="Confirm Password">
                                        </div>
                                        <input type="text" class="d-none" value="<?php echo $token ?>" name="token">
                                        <input type="text" class="d-none" value="<?php echo $role ?>" name="role">
                                    </div>

                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger mt-10" id="btn-change-pass"><?php echo trans('chng_pass') ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS -->
    <script src="<?php echo base_url('public/js/vendors.min.js') ?>"></script>
    <script src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js") ?>">
    </script>
    <script src="<?php echo base_url("public/assets/vendor_components/PACE/pace.min.js") ?>"></script>
    <script src="<?php echo base_url('public/custom/js/auth/common_auth.js') ?>"></script>
    <!-- sweet alert plugin -->
    <script src="<?php echo base_url('public/assets/vendor_components/sweetalert/sweetalert.min.js') ?>"></script>
</body>

</html>