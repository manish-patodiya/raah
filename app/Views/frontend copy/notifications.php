<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo trans('project_title') ?></title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        label.error {
            color: #fb5ea8;
            font-weight: 400 !important;
        }

        .btn-danger {
            color: white;
        }
    </style>
</head>

<body>
    <section class="h-100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <!-- <div class="col-lg-5 col-md-5 col-12"> -->
                    <!-- <div class="bg-white rounded10 shadow-lg"> -->
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-primary">Unsubscribe</h2>
                        <!-- <p class="mb-0">Sign in to continue to e-commerce.</p> -->
                    </div>
                    <div class="p-40">
                        <h4>You no longer get email.
                        </h4>
                        <h4>If you have a moment, please let us know why you want to unsubscribed.
                        </h4>
                        <div class="alert alert-danger" id="login-err" style="display: none;"></div>
                        <form method="post" autocomplete="off" id="frm-unsubscription" onsubmit="return false" novalidate="novalidate">
                            <?php echo csrf_field() ?>
                            <div class="form-group controls d-none">
                                <!-- <label for="logo" class="control-label">
                                    </label> -->
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                    <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $user_email ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group controls">
                                    <label for="logo" class="control-label">
                                        Select Reason</label>
                                    <div class="input-group" id="reason-fld">

                                        <!-- <span class="input-group-text "><i class="ti-arrow-right"></i></span> -->
                                        <select class="form-select bg-white" name="reason" id="reasons" data-validation-required-message="This field is required" aria-invalid="false">
                                            <option value="">Reason to unsubscribe</option>
                                            <?php
                                            foreach ($reasons as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value->reason ?>"><?php echo $value->reason ?></option>
                                            <?php
                                            }
                                            ?>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group controls" id="other-reason" style="opacity:0">
                                    <div class="input-group">
                                        <!-- <span class="input-group-text "><i class="ti-arrow-right"></i></span> -->
                                        <textarea name="other" id="rsn-txtarea" rows="4" class="form-control" placeholder="Type your reason"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger mt-10" id="btn-unsubscription">Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <?php
    // echo view('admin/include/footer');
    ?>
    <script src="<?php echo base_url("public/js/pages/validation.js") ?>"></script>
    <script src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js") ?>">
    </script>
    <script src="<?php echo base_url("public/assets/vendor_components/jquery-validation-1.17.0/dist/additional-methods.min.js") ?>">
    </script>
    <!-- <script src="<?php echo base_url('public/custom/js/validation_functions.js') ?>"></script> -->
    <script src="<?php echo base_url('public/custom/js/notification/notification_dnd.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/vendor_components/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?php echo base_url('public/assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') ?>">
    </script>
</body>

</html>