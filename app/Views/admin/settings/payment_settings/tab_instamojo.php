<div class="tab-pane" id="tab_5">
    <form role="form" id="instamojo" action="<?php echo site_url('admin/paymentsettings/instamojo') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $instamojo_result = check_in_array('instamojo', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-sm-5">
                                <?php echo trans('private_api_key'); ?>
                                <small class="req"> *</small>
                            </label>
                            <input type="text" class="form-control" name="instamojo_apikey" value="<?php echo $instamojo_result->api_secret_key ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5">
                                <?php echo trans('private_auth_token'); ?>
                                <small class="req"> *</small>
                            </label>
                            <input type="text" class="form-control" name="instamojo_authtoken" value="<?php echo $instamojo_result->api_publishable_key ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5">
                                <?php echo trans('private_salt'); ?>

                                <small class="req"> *</small>
                            </label>
                            <input type="text" class="form-control" name="instamojo_salt" value="<?php echo $instamojo_result->salt ?>">
                        </div>

                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.instamojo.com/" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/instamojo.png') ?>" width="200">
                            <p>https://www.instamojo.com/</p>
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