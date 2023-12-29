<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="<?php echo isset($seo_title) ? $seo_title : '' ?>"
        content="<?php echo isset($seo_description) ? $seo_description : '' ?>">
    <link rel="icon" href="<?php echo base_url('public/favicon/favicon-16x16.png') ?>">

    <title><?php echo isset($title) ? $title : 'myktdc' ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/vendors_css.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('public/theme1/revolution-slider/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/settings.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/layers.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('public/theme1/revolution-slider/revolution/css/navigation.css') ?>">
    <link rel="stylesheet"
        href="<?php echo base_url('public/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/theme1/css/skin_color.css') ?>">

    <?php
if (isset($assets["css"]) && is_array($assets["css"])):
    foreach ($assets["css"] as $k => $v) {
        $url = !filter_var($v, FILTER_VALIDATE_URL) ? base_url($v) : $v;
        echo '<link rel="stylesheet" href="' . $url . '"></link>';
    }
endif;
?>


    <script>
    const BASE_URL = "<?php echo base_url(); ?>";

    function base_url(uri) {
        return BASE_URL + uri;
    }
    </script>

</head>

<body class="theme-primary">
    <?php
if (!(isset($header) && $header)) {
    $header = "header_bottom";
}
echo view("frontend/include/" . $header);
?>

    <?php echo view("frontend/" . $content); ?>

    <?php echo view('frontend/include/footer.php'); ?>
    <!-- ./wrapper -->

    <script>
    var full_header = <?php echo isset($full_header) && $full_header ? "true" : "false" ?>
    </script>
    <!-- Vendor JS -->
    <script src="<?php echo base_url("public/theme1/js/vendors.min.js"); ?>"></script>
    <!-- Corenav Master JavaScript -->
    <script src="<?php echo base_url("public/theme1/corenav-master/coreNavigation-1.1.3.js"); ?>"></script>
    <script src="<?php echo base_url("public/theme1/js/nav.js"); ?>"></script>
    <script src="<?php echo base_url("public/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js"); ?>"></script>
    <script
        src="<?php echo base_url("public/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"); ?>">
    </script>

    <script src="<?php echo base_url("public/assets/vendor_components/PACE/pace.min.js") ?>"></script>

    <!-- REVOLUTION JS FILES -->
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/jquery.themepunch.tools.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/jquery.themepunch.revolution.min.js"); ?>">
    </script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.actions.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.carousel.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.kenburn.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.layeranimation.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.migration.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.navigation.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.parallax.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.slideanims.min.js"); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url("public/theme1/revolution-slider/revolution/js/extensions/revolution.extension.video.min.js"); ?>">
    </script>
    <script
        src="<?php echo base_url('public/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') ?>">
    </script>
    <script src="<?php echo base_url("public/theme1/js/revolution-slider.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("public/js/pages/validation.js") ?>"></script>
    <script src=" <?php echo base_url("public/js/pages/form-validation.js") ?>"></script>
    <script
        src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js") ?>">
    </script>
    <script
        src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/additional-methods.min.js") ?>">
    </script>
    <script src="<?php echo base_url('public/custom/js/validation_functions.js') ?>"></script>
    </script>

    <!-- Warehouse front end -->
    <script src="<?php echo base_url("public/theme1/js/template.js"); ?>"></script>
    <script src='<?php echo base_url('public/frontend/custom/js/common.js') ?>'></script>
    <?php
if (isset($assets["js"]) && is_array($assets["js"])):
    foreach ($assets["js"] as $k => $v) {
        $url = !filter_var($v, FILTER_VALIDATE_URL) ? base_url($v) : $v;
        echo '<script src="' . $url . '"></script>';
    }
endif;
?>
</body>

</html>