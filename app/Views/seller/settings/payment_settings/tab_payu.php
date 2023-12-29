<div class="tab-pane" id="tab_3">
    <form role="form" id="payu" id="custom" action="<?php echo site_url('admin/paymentsettings/payu') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $payu_result = check_in_array('payu', $paymentlist); ?>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('payu_money_key'); ?>
                                <small class="req"> *</small>
                            </label>
                            <input type="text" class="form-control" name="key" value="<?php echo $payu_result->api_secret_key ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5"><?php echo trans('payu_money_salt'); ?>
                                <small class="req"> *</small>
                            </label>
                            <input type="text" class="form-control" name="salt" value="<?php echo $payu_result->salt ?>">
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://www.payumoney.com" target="_blank">
                            <img src="<?php echo base_url('public/images/payment/paym.png') ?>">
                            <p>https://www.payumoney.com</p>
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