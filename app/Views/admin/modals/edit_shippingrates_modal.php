<div class="modal center-modal fade" id="mdl_edit_shippingrates">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil"></i> <?php echo trans('edit_shipping_rates') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" id="frm-edit-shipping-rates" autocomplete="off" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" name='shipping-rates-id' id='edit-shipping-rates-id'>
                    <div class="mx-5">
                        <div class="form-group">
                            <label for="username" class="control-label"><?php echo trans('shipping_rates') ?> <span class="required"> *</span></label>
                            <div class="controls">
                                <textarea type="text" name="shippingrates" class="form-control" id="edit-shippingrates" placeholder="Entern your shipping rates" rows='10'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="submit" value="1" />
                            <button type="submit" class="btn btn-dark pull-right" id="btn-shipping-rates">
                                <?php echo trans('update') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>