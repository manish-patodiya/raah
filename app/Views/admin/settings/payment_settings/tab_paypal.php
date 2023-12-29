<div class="tab-pane" id="tab_1">
    <form role="form" id="paypal" action="<?php echo site_url('admin/paymentsettings/paypal') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $paypal_result = check_in_array('paypal', $paymentlist);?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('paypal_username'); ?> <small class="req">
                                    *</small>
                            </label>
                            <input name="paypal_username" type="text" class="form-control col-md-7 col-xs-12"
                                value="<?php echo isset($paypal_result->api_username) ? $paypal_result->api_username : ""; ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('paypal_password'); ?> <small class="req">
                                    *</small>
                            </label>
                            <input name="paypal_password" type="password" class="form-control col-md-7 col-xs-12"
                                value="<?php echo isset($paypal_result->api_password) ? $paypal_result->api_password : ""; ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('paypal_signature'); ?> <small class="req">
                                    *</small>
                            </label>
                            <input name="paypal_signature" type="text" class="form-control col-md-7 col-xs-12"
                                value="<?php echo isset($paypal_result->api_signature) ? $paypal_result->api_signature : ""; ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.paypal.com/in/home" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/paypal.png') ?>" width="200">
                            <p>https://www.paypal.com</p>
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