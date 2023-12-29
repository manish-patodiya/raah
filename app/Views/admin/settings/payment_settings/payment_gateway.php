<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    .req {
        color: #fb5ea8;
    }

    .justify-content-center>a>p {
        text-align: center;
    }

    label.error {
        font-weight: 400 !important;
        color: #fb5ea8;
    }
</style>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i> <?php echo trans('payment_gateway') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row m-0">
                <div class='col-md-9 ps-0'>
                    <div class='nav-tabs-custom m-0'>
                        <?php $payment_types = ['razorpay', 'paytm']; ?>
                        <ul class="nav nav-tabs">
                            <li><a href="#tab_7" class="active" data-bs-toggle="tab"><?php echo trans('razorpay') ?></a></li>
                            <li><a href="#tab_8" data-bs-toggle="tab"><?php echo trans('paytm') ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <?php
                            echo view('admin/settings/payment_settings/tab_paytm');
                            echo view('admin/settings/payment_settings/tab_razorpay');
                            ?>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="card p-0 card rounded-0">
                        <div class="card-header p-3">
                            <h4 class='m-0'>Select Payment Gateway</h4>
                        </div>
                        <form id='frm-update-gateway'>
                            <div class='card-body px-3 py-2'>

                                <?php foreach ($payment_types as $v) : ?>
                                    <div>
                                        <input name="payment_type" type="radio" id="radio_<?php echo $v ?>" <?php echo $v == $active_payment ? 'checked' : '' ?> value='<?php echo $v ?>' />
                                        <label for="radio_<?php echo $v ?>"><?php echo trans($v) ?></label>
                                    </div>
                                <?php endforeach ?>
                                <div>
                                    <input name="payment_type" type="radio" id="radio_none" value='none' <?php echo $active_payment ? '' : 'checked' ?> />
                                    <label for="radio_none"><?php echo trans('none') ?></label>
                                </div>
                            </div>
                            <div class="card-footer px-3 py-2">
                                <button class='btn btn-sm btn-success pull-right' id='btn-update-geteway'><?php echo trans('save') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
<?php
echo view('admin/include/footer.php');
?>
<script src='<?php echo base_url('public/custom/js/payment_setting.js') ?>'></script>