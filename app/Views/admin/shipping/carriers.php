<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
.btn-lg {
    font-size: 1.286rem;
    padding: 6px 32px;
}
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-gears"></i> <?php echo trans('carriers') ?></h4>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="alert alert-success" style="display:none" id="success-msg"></div>
            <!-- mein body -->
            <div class="row">
                <?php if (check_method_access('carriers', 'view', true)) {?>
                <div class="col-md-8">
                    <?php } else {?>
                    <div class="col-md-12">
                        <?php }?>
                        <div class="card card-default">
                            <div class="card-body table-responsive">
                                <table id="order_setting_table" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans('sn') ?></th>
                                            <th scope="col"><?php echo trans('carriers') ?></th>
                                            <th width="100" class="text-right"><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if (check_method_access('carriers', 'add', true)): ?>
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="m-3">
                                <form method="post" autocomplete="off" id="frm-order-setting-detail"
                                    onsubmit="return false">
                                    <?php echo csrf_field(); ?>
                                    <h4 class="mb-0"><i class="fa fa-plus"></i> <?php echo trans('create_carriers') ?>
                                    </h4>
                                    <hr class="my-15">
                                    <div class="form-group">
                                        <label for="username" class="control-label"><?php echo trans('carriers') ?>
                                            <span class="required"> *</span></label>
                                        <div class="controls">
                                            <textarea type="text" name="carriers" class="form-control" id="carriers"
                                                placeholder="Enter your carrier" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm pull-right"
                                            id="btn-order-create">
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
        </section>
    </div>
</div>
<?php
if (check_method_access('carriers', 'edit', true)) {
    echo view('admin/modals/edit_carriers_modal.php');
}
echo view('admin/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/shipping/carriers.js') ?>"></script>