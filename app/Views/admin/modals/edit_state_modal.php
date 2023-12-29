<div class="modal center-modal fade" id="mdl_edit_state">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-info mb-0"><i class="fa fa-pencil"></i> <?php echo trans('edit_state_info') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" autocomplete="off" id="edit_state" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" id="state_id" name="state_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label class="control-label"><?php echo trans('state_name') ?></label>
                                <div class="controls ">
                                    <input type="text" name="state_name" class="form-control" id="e_state_name" placeholder="Enter state name" data-validation-required-message="This field is required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=" form-group">
                                <label class="control-label"><?php echo trans('state_code') ?></label>
                                <div class=" controls">
                                    <input type="number" name="state_code" class="form-control" id="e_state_code" placeholder="Enter state code" data-validation-required-message="This field is required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="control-label"><?php echo trans('country') ?></label>
                                <div class="controls">
                                    <select class='form-control ' name="country_id" id="e_country" data-validation-required-message="This field is required" data-live-search="true">
                                        <option value=""><?php echo trans('select_country') ?></option>
                                        <?php foreach ($country as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="submit" value="1" />
                        <button type="submit" class="btn btn-info btn-sm px-4 pull-right " id="">
                            <?php echo trans('update') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>