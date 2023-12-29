<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="<?php echo isset($seo_title) ? $seo_title : '' ?>"
        content="<?php echo isset($seo_description) ? $seo_description : '' ?>">

    <link rel="icon" href="<?php echo base_url('public/favicon/favicon-16x16.png') ?>">

    <title><?php echo isset($title) ? $title : OFFICIAL_TITLE ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/vendors_css.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('public/theme1/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/settings.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/layers.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/navigation.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/skin_color.css') ?>">
    <script>
    const BASE_URL = "<?php echo base_url(); ?>";

    function base_url(uri) {
        return BASE_URL + uri;
    }
    </script>

</head>

<body class="theme-primary">
    <?php
echo view("frontend/include/header_bottom.php");
?>
    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div>
                        <img src="<?php echo base_url("public/images/auth-bg/404.png"); ?>" class="max-w-650 w-p100"
                            alt="" />
                        <h1>Page Not Found !</h1>
                        <h3>looks like, page doesn't exist</h3>
                        <div class="my-30"><a href="<?php echo base_url(); ?>" class="btn btn-danger">Back to Home</a>
                        </div>

                        <form class="search-form mx-auto mt-30 w-p75">
                            <div class="input-group rounded5 overflow-h">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <!-- /.input-group -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php echo view('frontend/include/footer.php'); ?>
    <!-- Vendor JS -->
    <script src="<?php echo base_url("public/theme1/js/vendors.min.js"); ?>"></script>
    <!-- Corenav Master JavaScript -->
    <script src="<?php echo base_url("public/theme1/corenav-master/coreNavigation-1.1.3.js"); ?>"></script>
    <script src="<?php echo base_url("public/theme1/js/nav.js"); ?>"></script>

    <!-- Warehouse front end -->
    <script src="<?php echo base_url("public/theme1/js/template.js"); ?>"></script>



</body>

</html>