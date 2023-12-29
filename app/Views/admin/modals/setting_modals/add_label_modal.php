<style>
    .select2-container--open {
        z-index: 9999999
    }
</style>
<div class="modal center-modal fade" id="modal-center" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title"><?php echo trans('label') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <!-- <div class="card card-default"> -->
                <div class="m-3">
                    <form method="post" autocomplete="off" id="add_label" onsubmit="return false">
                        <?php echo csrf_field() ?>
                        <div class="form-group">
                            <label for="label" class="control-label m-2"><?php echo trans('labels') ?></label>
                            <div class="controls">
                                <select class="form-control" name="label" id="label" style="width:100%">
                                    <option value="">
                                        <? trans('select_label') ?>
                                    </option>
                                    <?php foreach ($labels as $l => $v) { ?>
                                        <option value="<?php echo $v->id ?>">
                                            <?php echo $v->label ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="control-label m-2"><?php echo trans('hsn_code') ?></label>
                            <div class="controls">
                                <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter your hsn code" data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                                <input type="hidden" name="submit" value="hello" class="hidden" />
                                <button type="submit" name="submit" class="btn btn-dark btn-lg px-4 pull-right " id="">
                                    Add New Detail
                                </button>
                            </div> -->
                    </form>
                </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo trans('close') ?></button>
                <button type="button" class="btn btn-primary float-end"><?php echo trans('save_changes') ?></button>
            </div>
        </div>
    </div>
</div>