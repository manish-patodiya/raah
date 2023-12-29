<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .err {
            color: #fb5ea8;
        }

        .required {
            color: #fb5ea8;
        }

        label.error {
            color: #fb5ea8;
            font-weight: 400 !important;
        }
    </style>
    <title><?php echo trans('project_title') ?></title>
    <link rel="icon" href="<?php echo base_url('public/favicon/favicon-16x16.png') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/icons/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";
    </script>
</head>