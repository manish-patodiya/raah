<div class="tab-pane " id="tab_10">
    <form role="form" id="pesapal" action="<?php echo site_url('admin/paymentsettings/pesapal') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $pesapal_result = check_in_array('pesapal', $paymentlist); ?>

                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('consumer_key'); ?>
                                <small class="req"> *</small></label>
                            <input name="pesapal_consumer_key" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $pesapal_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('consumer_secret'); ?>
                                <small class="req"> *</small></label>
                            <input name="pesapal_consumer_secret" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $pesapal_result->api_secret_key ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.pesapal.com/" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/pesapal.jpg'); ?>" width="200">
                            <p>https://www.pesapal.com/</p>
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