<div class="tab-pane" id="tab_14">
    <form role="form" id="ccavenue" action="<?php echo site_url('admin/paymentsettings/ccavenue') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $ccavenue_result = check_in_array('ccavenue', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('merchant_id'); ?><small class="req">
                                    *</small>
                            </label>
                            <input type="text" class="form-control" name="ccavenue_secret" value="<?php echo $ccavenue_result->api_secret_key ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('working_key'); ?><small class="req">
                                    *</small>
                            </label>
                            <input type="text" class="form-control" name="ccavenue_salt" value="<?php echo $ccavenue_result->salt ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('access_code'); ?><small class="req">
                                    *</small>
                            </label>
                            <input type="text" class="form-control" name="ccavenue_api_publishable_key" value="<?php echo $ccavenue_result->api_publishable_key ?>">
                        </div>

                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.ccavenue.com" target="_blank">
                            <h5><?php echo trans('payment_gateway_for_india'); ?></h5>
                            <img src="<?php echo base_url('public/images/payment/ccavenue.png') ?>" width="200">
                            <p>https://www.ccavenue.com</p>
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