<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa-solid fa-basket-shopping"></i> <?php echo trans('my_orders') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='card col-md-12'>
                    <div class="card-body">
                        <div class="col-12 table-responsive">
                            <table class='table table-responsive table-hover' id='tbl-orders'>
                                <thead>
                                    <th><?php echo trans('img') ?></th>
                                    <th><?php echo trans('product_details') ?></th>
                                    <th><?php echo trans('user_info') ?></th>
                                    <th><?php echo trans('status') ?></th>
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
<?php
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/order.js') ?>"></script>