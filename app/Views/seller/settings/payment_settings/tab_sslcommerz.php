<div class="tab-pane " id="tab_16">
    <form role="form" id="sslcommerz" action="<?php echo site_url('admin/paymentsettings/sslcommerz') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $sslcommerz_result = check_in_array('sslcommerz', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('store_id'); ?>
                                <small class="req"> *</small></label>
                            <input name="sslcommerz_api_key" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $sslcommerz_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('store_password'); ?>
                                <small class="req"> *</small></label>
                            <input name="sslcommerz_store_password" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $sslcommerz_result->api_password ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.sslcommerz.com/" target="_blank">
                            <h5><?php echo trans('payment_gateway_for_bangladesh'); ?> </h5>
                            <img src="<?php echo base_url('public/images/payment/sslcommerz.png'); ?>" width="200">
                            <p>https://www.sslcommerz.com/</p>
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