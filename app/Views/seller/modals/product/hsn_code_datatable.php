<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><?php echo trans('slct_hsn') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="hsn_code_table" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo trans('hsn_code') ?></th>
                            <th scope="col"><?php echo trans('details') ?></th>
                            <th scope="col"><?php echo trans('gst%') ?></th>
                            <th width="100" class="text-right"><?php echo trans('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm text-start" data-bs-dismiss="modal"><?php echo trans('close') ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>