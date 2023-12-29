<html>

<head>
    <title><?php echo trans('project_title') ?></title>
    <link rel="icon" href="<?php echo base_url('public/favicon/favicon-16x16.png') ?>">
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

<body class="hold-transition theme-primary bg-img" style="background-image: url(<?php echo base_url('public/images/auth-bg/bg-6.jpg'); ?>)">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary"><?php echo trans('admin_login') ?></h2>
                                <p class="mb-0"><?php echo trans('sign_in_to') ?> <?php echo SITE_NAME; ?>.</p>
                            </div>
                            <div class="p-40">
                                <div class="alert alert-danger" id="login-err" style="display: none;"></div>
                                <form method="post" autocomplete="off" id="frm-login" onsubmit="return false">
                                    <?php echo csrf_field() ?>
                                    <div class="form-group controls">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ti-mobile"></i></span>
                                            <input name="phone" type="text" class="form-control" placeholder="Phone no." />
                                        </div>
                                    </div>
                                    <div class="form-group controls">
                                        <div class="input-group">
                                            <span class="input-group-text "><i class="ti-lock"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Password" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_1">
                                                <label for="basic_checkbox_1"><?php echo trans('remember_me') ?></label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-danger mt-10" id="btn-login"><?php echo trans('SIGN_IN') ?></button>
                                        </div>
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> -->

    <script src="<?php echo base_url("public/assets/vendor_components/PACE/pace.min.js") ?>"></script>
    <script src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js") ?>">
    </script>
    <script src="<?php echo base_url('public/custom/js/auth/admin_auth.js') ?>"></script>
    <script src="<?php echo base_url('public/custom/js/validation_functions.js') ?>"></script>
</body>

</html>