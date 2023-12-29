<div class="tab-pane " id="tab_15">
    <form role="form" id="flutterwave" action="<?php echo site_url('admin/paymentsettings/flutterwave') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $flutterwave_result = check_in_array('flutterwave', $paymentlist); ?>

                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('public_key'); ?>
                                <small class="req"> *</small></label>
                            <input name="public_key" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $flutterwave_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('secret_key'); ?>
                                <small class="req"> *</small></label>
                            <input name="secret_key" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $flutterwave_result->api_secret_key ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://flutterwave.com/us/" target="_blank">
                            <h5><?php echo trans('multinational_payment_gateway'); ?></h5>
                            <img src="<?php echo base_url('public/images/payment/flutterwave.png'); ?>" width="200">
                            <p>https://flutterwave.com/us</p>
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