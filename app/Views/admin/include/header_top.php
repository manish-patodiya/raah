<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php $session->site_info->favicon ?>">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .form-control {
            background-color: white !important;
        }

        .required {
            color: red;
        }

        label.error {
            color: #fb5ea8;
            font-weight: 400 !important;
        }
    </style>

    <title><?php echo trans('project_title') ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/assets/icons/font-awesome/css/font-awesome.min.css') ?>">

    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">

    <!-- Style-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/skin_color.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor_components/bootstrap-duallistbox/bootstrap-duallistbox.min.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";

        function base_url(uri) {
            return BASE_URL + uri;
        }
    </script>
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">