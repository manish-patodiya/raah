<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400 !important;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-plus'></i> <?php echo trans('sellers_list') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <?php if (check_method_access('sellers', 'add', true)) : ?>
                        <a href="#" id='add-user' class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                            <?php echo trans('create_seller') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class='card'>
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <div class="row">
                                    <div class="mb-2 col-md-2">
                                        <a href="<?php echo base_url("/admin/pendingstores") ?>" id='pending_stores' class="btn btn-info btn-app btn-sm" style="height:80%;">
                                            <span class="badge badge-pill badge-warning"><?php echo $pending_stores ?></span>
                                            Pending Sotres</a>
                                    </div>
                                </div>
                                <table class='table table-responsive table-hover' id='tbl-seller'>
                                    <thead>
                                        <!-- <th><?php echo trans('sn') ?></th> -->
                                        <th><?php echo trans('name') ?></th>
                                        <!-- <th><?php echo trans('phone') ?></th> -->
                                        <th><?php echo trans('store_name') ?></th>
                                        <!-- <th><?php echo trans('status') ?></th> -->
                                        <th><?php echo trans('action') ?></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
if (check_method_access('sellers', 'edit', true)) {
    echo view('admin/modals/seller/edit_seller_modal.php');
}
if (check_method_access('sellers', 'add', true)) {
    echo view('admin/modals/seller/add_seller_modal.php');
}
if (check_method_access('sellers', 'view', true)) {
    echo view('admin/modals/seller/view_seller_modal.php');
}
echo view('admin/include/footer');
echo view('admin/modals/seller/store_details_modal.php');
?>

<script src="<?php echo base_url('public/custom/js/sellers.js') ?>"></script>