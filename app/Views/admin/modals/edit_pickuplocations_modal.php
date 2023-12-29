<div class="modal center-modal fade" id="mdl_edit_pickuplocations">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil"></i> <?php echo trans('edit_pickup_locations') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" id="frm-edit-pickuplocations" autocomplete="off" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" name='pl_id' id='edit-pickuplocations-id'>
                    <div class="mx-5">
                        <div class="form-group">
                            <label for="username" class="control-label"><?php echo trans('pickup_locations') ?> <span class="required"> *</span></label>
                            <div class="controls">
                                <textarea type="text" name="pickuplocations" class="form-control" id="edit-pickuplocations" placeholder="Entern your Cancel Reason" rows='10'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="submit" value="1" />
                            <button type="submit" class="btn btn-dark pull-right" id="btn-pickuplocations">
                                <?php echo trans('update') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>