<div class="modal center-modal fade" id="mdl_edit_lang">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-info mb-0"><i class="fa fa-pencil"></i> <?php echo trans('edit_lang_info') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" autocomplete="off" id="edit_language" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" id="e_language_id" name="lang_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label class="control-label"><?php echo trans('language_name') ?></label>
                                <div class="controls ">
                                    <input type="text" name="language_name" class="form-control" id="e_language_name" placeholder="Enter language name" data-validation-required-message="This field is required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label class="control-label"><?php echo trans('short_name') ?></label>
                                <div class="controls ">
                                    <input type="text" name="short_name" class="form-control" id="e_short_name" placeholder="Enter short name" data-validation-required-message="This field is required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo trans('status') ?></label>
                                <div class="controls">
                                    <select class='form-control ' name="status" id="e_status" data-validation-required-message="This field is required" data-live-search="true">
                                        <option value="1"><?php echo trans('active') ?></option>
                                        <option value="0"><?php echo trans('inactive') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-sm px-4 pull-right " id="">
                            <?php echo trans('update') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>