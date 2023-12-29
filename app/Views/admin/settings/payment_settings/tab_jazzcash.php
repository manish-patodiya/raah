<div class="tab-pane " id="tab_13">
    <form role="form" id="jazzcash" action="<?php echo site_url('admin/paymentsettings/jazzcash') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $jazzcash_result = check_in_array('jazzcash', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('pp_merchantid'); ?>
                                <small class="req"> *</small></label>
                            <input name="jazzcash_pp_MerchantID" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $jazzcash_result->api_secret_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('pp_password'); ?>
                                <small class="req"> *</small></label>
                            <input name="jazzcash_pp_Password" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $jazzcash_result->api_password ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.jazzcash.com.pk/" target="_blank">
                            <h5><?php echo trans('payment_gateway_for_pakistan'); ?></h5>
                            <img src="<?php echo base_url('public/images/payment/jazzcash.jpg'); ?>" width="200">
                            <p>https://www.jazzcash.com.pk/</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-check-circle"></i>
                <?php echo trans('save'); ?></button>

        </div>
    </form>
</div>