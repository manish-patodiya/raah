<div class="tab-pane" id="tab_2">
    <form role="form" id="stripe" id="stripe" action="<?php echo site_url('admin/paymentsettings/stripe') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $stripe_result = check_in_array('stripe', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('stripe_api_secret_key'); ?>
                                <small class="req"> *</small></label>
                            <input type="text" class="form-control" name="api_secret_key" value="<?php echo $stripe_result->api_secret_key ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5">
                                <?php echo trans('stripe_publishable_key'); ?>
                                <small class="req"> *</small></label>
                            <input type="text" class="form-control" name="api_publishable_key" value="<?php echo $stripe_result->api_publishable_key ?>">
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://stripe.com/" target="_blank"><img src="<?php echo base_url('public/images/payment/stripe.png') ?>">
                            <p>https://stripe.com</p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.box-body p-0 -->

        <div class="">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-check-circle"></i>
                <?php echo trans('save'); ?></button>
        </div>
    </form>
</div>