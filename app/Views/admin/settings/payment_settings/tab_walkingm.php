<div class="tab-pane " id="tab_17">
    <form role="form" id="walkingm" action="<?php echo site_url('admin/paymentsettings/walkingm') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-7">
                    <?php $walkingm_result = check_in_array('walkingm', $paymentlist); ?>

                    <div class="form-group">
                        <label class="col-md-5 col-sm-12 col-xs-12">
                            <?php echo trans('client_id'); ?>
                            <small class="req"> *</small></label>
                        <input name="walkingm_client_id" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $walkingm_result->api_publishable_key ?>" />
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 col-sm-12 col-xs-12">
                            <?php echo trans('client_secret'); ?>
                            <small class="req"> *</small></label>
                        <input name="walkingm_client_secret" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $walkingm_result->api_secret_key ?>" />
                    </div>
                </div>
                <div class="col-md-5 d-flex justify-content-center align-items-center">
                    <a href="https://walkingm.com/" target="_blank">
                        <h5><?php echo trans('payment_gateway_for_liberia'); ?>
                        </h5><br>
                        <img src="<?php echo base_url('public/images/payment/walkingm.png'); ?>" width="200"><br><br>
                        <p>https://walkingm.com/</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-check-circle"></i>
                        <?php echo trans('save'); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>