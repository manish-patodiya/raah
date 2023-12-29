<div class="modal center-modal fade" id="mdl_generate_qr">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 text-info"><i class="fa fa-plus"></i> Generate QR</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" id="frm-generate-qr" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" id="prod_slug" value="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="">Select number of qr codes on one page</label>
                                    <select name="state" class="form-select" id='per_page'>
                                        <option value="1">1 per page </option>
                                        <option value="2">2 per page </option>
                                        <option value="4">4 per page </option>
                                        <option value="8">8 per page </option>
                                    </select>
                                </div>
                                <h6>(Note: Right now you can print for A4 size page only.)</h6>
                            </div>
                            <div class='d-flex justify-content-end'>
                                <button type="submit" class="btn btn-danger btn-sm me-1" data-bs-dismiss='modal'>
                                    <?php echo trans('cancel') ?>
                                </button>
                                <button type="submit" class="btn btn-success btn-sm me-1" id="btn-preview">
                                    <?php echo trans('preview') ?>
                                </button>
                                <button type="submit" class="btn btn-info btn-sm" id="btn-print">
                                    <?php echo trans('print') ?>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center align-items-center" id='div-qr-preview'>
                            <h1 class='m-0 text-light'>Preview</h1>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>