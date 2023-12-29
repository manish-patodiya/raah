<div class="tab-pane active" id="tab_7">
    <form role="form" id="frm-razorpay">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php echo csrf_field() ?>
                        <?php $razorpay_result = check_in_array('razorpay', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('razorpay_key_id'); ?><small class="req">
                                    *</small>
                            </label>
                            <input name="razorpay_keyid" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $razorpay_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('razorpay_secret_key'); ?><small class="req"> *</small>
                            </label>
                            <input name="razorpay_secretkey" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $razorpay_result->api_secret_key ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://razorpay.com/" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/razorpay.jpg'); ?>" width="200">
                            <p>https://razorpay.com/</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <button type="submit" id='btn-save-razorpay' class="btn btn-primary btn-sm">
                <i class="fa fa-check-circle"></i>
                <?php echo trans('save'); ?></button>
            <button type="button" class="btn btn-danger btn-sm" onclick='removeDetails("razorpay")'>
                <i class="fa fa-check-circle"></i>
                <?php echo trans('remove_details'); ?></button>
        </div>
    </form>
</div>