<div class="modal center-modal fade" id="mdl-add-csv">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-info mb-0 modal-title"><?php echo trans('upload_cat_csv') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" id="frm-add-csv">
                <?php echo csrf_field() ?>
                <div class="modal-body mx-5">
                    <div class="form-group">
                        <div class="controls my-2">
                            <input class="form-control" name='csv' accept=".csv" type="file" id="csv_upload_file" data-validation-required-message="This field is required" />
                        </div>
                        <span class="text-secondary" style="font-size:13px"><?php echo trans('only_csv') ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="mx-5 btn btn-primary pull-right" id="">
                        <?php echo trans('upload') ?>
                    </button>
                    <a href="<?php echo base_url('public/downloads/category-csv.csv') ?>" download class="mx-5 btn btn-primary pull-right" id="">
                        <?php echo trans('download_sample') ?>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>