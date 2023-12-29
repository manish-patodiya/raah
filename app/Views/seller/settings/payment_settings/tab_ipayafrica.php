<div class="tab-pane " id="tab_11">
    <form role="form" id="ipayafrica" action="<?php echo site_url('admin/paymentsettings/ipayafrica') ?>">
        <div class="box-body p-0">
            <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-7">
                        <?php $ipayafrica_result = check_in_array('ipayafrica', $paymentlist); ?>

                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('vendor_id'); ?>
                                <small class="req"> *</small></label>
                            <input name="ipayafrica_vendorid" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $ipayafrica_result->api_publishable_key ?>" />
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 col-sm-12 col-xs-12">
                                <?php echo trans('hashkey'); ?>
                                <small class="req"> *</small></label>
                            <input name="ipayafrica_hashkey" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $ipayafrica_result->api_secret_key ?>" />
                        </div>
                    </div>
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <a href="https://ipayafrica.com/" target="_blank"><img src="<?php echo base_url('public/images/payment/ipayafrica.png'); ?>" width="200">
                            <p>https://ipayafrica.com//</p>
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