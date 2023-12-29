<div class="tab-pane " id="tab_8">
    <form role="form" id="frm-paytm">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php echo csrf_field() ?>
                        <?php $paytm_result = check_in_array('paytm', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('merchant_id'); ?><small class="req">
                                    *</small>
                            </label>
                            <input name="paytm_merchantid" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $paytm_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('merchant_key'); ?><small class="req">
                                    *</small>
                            </label>
                            <input name="paytm_merchantkey" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $paytm_result->api_secret_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('website'); ?><small class="req">
                                    *</small>
                            </label>
                            <input name="paytm_website" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $paytm_result->paytm_website ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('industry_type'); ?><small class="req">
                                    *</small>
                            </label>
                            <input name="paytm_industrytype" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $paytm_result->paytm_industrytype ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://paytm.com/" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/paytm.jpg'); ?>" width="200">
                            <p>https://paytm.com/</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary btn-sm" id='btn-save-paytm'>
                <i class="fa fa-check-circle"></i>
                <?php echo trans('save'); ?></button>
            <button type="button" class="btn btn-danger btn-sm" onclick='removeDetails("paytm")'>
                <i class="fa fa-check-circle"></i>
                <?php echo trans('remove_details'); ?></button>
        </div>
    </form>
</div>