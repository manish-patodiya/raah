<html>

<head>
    <title><?php echo trans('project_title') ?></title>
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
                                <h2 class="text-primary"><?php echo trans('forgot_pass') ?></h2>
                                <p class="mb-0"><?php echo trans('we_send_email') ?></p>
                            </div>
                            <div class="p-40">
                                <div class="alert alert-danger" id="forgot-err" style="display: none;"></div>
                                <form method="post" autocomplete="off" id="forgot-password" onsubmit="return false">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group controls">
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent">
                                                <i class="fa fa-envelope" aria-hidden="true"></i></span>
                                            <input type="text" name="text" class="form-control" placeholder="Your phone or registered email" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="fog-pwd text-end">
                                            <a href="<?php echo $login_url ?>" class="hover-warning"><i class="ion ion-locked"></i><?php echo trans('login') ?></a><br>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger mt-10" id="btn-forgot"><?php echo trans('SEND') ?></button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p class="mt-15 mb-0"><?php echo trans('dont_have_acc') ?> <a href="<?php echo $sign_up_url ?>" class="text-warning ms-5"><?php echo trans('sign_up') ?></a></p>
                                </div>
                                <div class="alert hidden text-center mb-1 text-success" role="alert" id="msg"></div>
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
</body>

</html>