<html>

<head>
    <title><?php echo trans('project_title') ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";
    </script>
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(<?php echo base_url('public/images/auth-bg/bg-5.jpg'); ?>)">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style='height:90vh'>
            <div class="col-xl-5 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Login as</h4>
                    </div>
                    <div class="box-body p-0">
                        <div class="media-list media-list-hover">
                            <?php foreach ($session['user_roles'] as $role) { ?>
                                <div class="media">
                                    <a class="align-self-center" href='<?php echo base_url("auth/loginAs/$role->role_id") ?>'>
                                        <img class="avatar avatar-lg bg-success-light rounded" src="<?php echo $session['profile_photo'] ?>" alt="...">
                                        <div class="media-body fw-500 pull-right px-3">
                                            <h4><strong><?php echo ucfirst($session['name']) ?></strong></h4>
                                            <h5 class="text-fade"><?php echo format_name($role->role) ?></h5>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="text-end mb-3 me-3">
                        <a href="<?php echo base_url('auth/logout') ?>" class="" style="font-size:12px"><?php echo trans('logout') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="<?php echo base_url('public/js/vendors.min.js') ?>"></script>

    <script src="<?php echo base_url("public/assets/vendor_components/PACE/pace.min.js") ?>"></script>

</body>

</html>