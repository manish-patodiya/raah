<?php echo view('seller/auth/header'); ?>
<style>
    .text-theme {
        color: #cc4d39 !important;
    }

    .btn-theme {
        background-color: #cc4d39 !important;
        border-color: #cc4d39 !important;
        color: white !important;
    }
</style>

<body class="hold-transition theme-primary bg-img position-relative" style="background-color:#fdfdfd">
    <a href="<?php echo base_url('seller') ?>" class='btn btn-theme position-absolute' style='top:20px;right:20px;'>Login</a>

    <div class='d-flex container py-40'>
        <div class='col-md-6 p-0 d-flex justify-content-center align-items-center'>
            <?php echo view('seller/auth/register-form') ?>
        </div>
        <div class='col-md-6 mt-4' style="background-color:#fdfdfd">
            <h1 class='text-theme'>Welcome to KTDC</h1>
            <h4>Grow your business faster by selling on KTDC</h4>
            <div class='pb-40'>
                <div class='d-flex mb-4'>
                    <div class="col-md-4 d-flex align-items-center mt-2">
                        <span class="fa fa-heart text-theme fs-30 pe-20"></span>
                        <div>
                            <h4 class='m-0'>6 lakh+</h4>
                            <span>Suppliers are selling commission-free</span>
                        </div>
                    </div>
                    <div class='col-md-1'></div>
                    <div class="col-md-4 d-flex align-items-center mt-2">
                        <span class="fa-solid fa-location-dot text-theme fs-30 pe-20"></span>
                        <div>
                            <h4 class='m-0'>28,000 +</h4>
                            <span>Pincodes supported for delivery</span>
                        </div>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class="col-md-4 d-flex align-items-center mt-2">
                        <span class="fa fa-users text-theme fs-30 pe-20"></span>
                        <div>
                            <h4 class='m-0'>10 Crore+</h4>
                            <span>Customers buy across India</span>
                        </div>
                    </div>
                    <div class='col-md-1'></div>
                    <div class="col-md-4 d-flex align-items-center mt-2">
                        <span class="fa fa-heart text-theme fs-30 pe-20"></span>
                        <div>
                            <h4 class='m-0'>700 +</h4>
                            <span>Categories to sell</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class='pt-30'>
                <h4 class='mb-4'>All you need to sell on KTDC is</h4>
                <div class='d-flex align-items-center mb-2'>
                    <i class="fa-solid fa-circle-check fa-lg text-success"></i>
                    <span class='ps-2'>GSTIN</span>
                </div>
                <div class='d-flex align-items-center'>
                    <i class="fa-solid fa-circle-check fa-lg text-success"></i>
                    <span class='ps-2'>Bank Account</span>
                </div>
            </div>
        </div>
    </div>
    <?php echo view('seller/auth/footer'); ?>
</body>

</html>