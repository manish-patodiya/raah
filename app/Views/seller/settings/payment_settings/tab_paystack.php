<div class="tab-pane " id="tab_6">
    <form role="form" id="paystack" action="<?php echo site_url('admin/paymentsettings/paystack') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $paystack_result = check_in_array('paystack', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('paystack_secret_key'); ?>
                                <small class="req"> *</small>
                            </label>
                            <input name="paystack_secretkey" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $paystack_result->api_secret_key ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://paystack.com/" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/paystack.png'); ?>" width="200">
                            <p>https://paystack.com</p>
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