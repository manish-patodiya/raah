<div class="modal center-modal fade" id="store_details">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 text-info"><i class="fa-solid fa-shop"></i> <?php echo trans('store_details') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <div class="box box-widget widget-user-4">
                    <div class="widget-user-header bg-info">
                        <div class="overlay overlay-none">
                            <h3 class="widget-user-username" id="store_name"></h3>
                            <h6 class="widget-user-desc" id="about_store"></h6>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <ul class="nav d-block nav-stacked store_details">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm pull-right" store_id="" id="btn-create">
                        <?php echo trans('permit') ?>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>