<div class="modal center-modal fade" id="add_order_setting_mdl">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil"></i> <?php echo trans('add_cancel_reason') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" id="frm-add-order-setting" autocomplete="off" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" name='order_id' id='order_id' value="">
                    <input type="hidden" name='product_id' id='product_id' value="">
                    <div class="mx-5">
                        <div class="form-group">
                            <label for="username" class="control-label"><?php echo trans('cancel_reason') ?></label>
                            <div class="controls">
                                <textarea type="text" name="cancel_reason" class="form-control" id="add-cancel-reason" placeholder="Entern your Cancel Reason" rows='10'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="submit" value="1" />
                            <button type="submit" class="btn btn-dark pull-right" id="add-order-setting">
                                <?php echo trans('update') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>