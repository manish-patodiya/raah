<div class="modal center-modal fade" id="mdl_edit_carriers">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-pencil"></i> <?php echo trans('edit_carriers') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" id="frm-edit-carriers" autocomplete="off" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" name='carriers_id' id='edit-carriers-id'>
                    <div class="mx-5">
                        <div class="form-group">
                            <label for="username" class="control-label"><?php echo trans('carriers') ?> <span
                                    class="required">
                                    *</span></label>
                            <div class="controls">
                                <textarea type="text" name="carriers" class="form-control" id="edit-carriers"
                                    placeholder="Entern your carrier" rows='10'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="submit" value="1" />
                            <button type="submit" class="btn btn-dark pull-right" id="btn-carriers">
                                <?php echo trans('update') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>