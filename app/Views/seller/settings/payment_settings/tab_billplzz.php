<div class="tab-pane " id="tab_12">
    <form role="form" id="billplz" action="<?php echo site_url('admin/paymentsettings/billplz') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $billplz_result = check_in_array('billplz', $paymentlist); ?>

                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('api_key'); ?>
                                <small class="req"> *</small></label>
                            <input name="billplz_api_key" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $billplz_result->api_secret_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('customer_service_email'); ?>
                                <small class="req"> *</small></label>
                            <input name="billplz_customer_service_email" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $billplz_result->api_email ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.billplz.com/" target="_blank">
                            <h5><?php echo trans('payment_gateway_for_malaysia'); ?></h5>
                            <img src="<?php echo base_url('public/images/payment/billplz.jpg'); ?>" width="200">
                            <p>https://www.billplz.com/</p>
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