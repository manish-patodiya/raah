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
                    <h4 class="page-title"><i class='fa fa-plus'></i> <?php echo trans('pending_stores_list') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <?php if (check_method_access('sellers', 'view', true)) : ?>
                        <a href="<?php echo base_url("/admin/sellers") ?>" id='add-user' class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                            <?php echo trans('manage_sellers') ?></a>
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
                                <!-- <div class="row">
                                    <div class="mb-2 col-md-2">
                                        <a href="#" id='pending_stores' class="btn btn-info btn-app btn-sm"
                                            style="height:80%;"><span class="badge bg-danger"></span>
                                            Pending Sotres</a>
                                    </div>
                                </div> -->
                                <table class='table table-responsive table-hover' id='tbl-pending-store'>
                                    <thead>
                                        <th><?php echo trans('sn') ?></th>
                                        <th><?php echo trans('store_name') ?></th>
                                        <th><?php echo trans('gstin') ?></th>
                                        <th><?php echo trans('address') ?></th>
                                        <th><?php echo trans('status') ?></th>
                                        <th><?php echo trans('action') ?></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($store_details as $key => $value) {
                                            $i = 0;
                                        ?>
                                            <tr>
                                                <td><?php echo ++$i ?></td>
                                                <td><?php echo $value->name ?></td>
                                                <td><?php echo $value->gstin ?></td>
                                                <td><?php echo $value->address ?></td>
                                                <td><span class="badge badge-danger">Pending</span></td>
                                                <td><a title="View" style="font-size:1.2rem;" class="text-primary sup_view me-1" href="#" store_id='<?php echo $value->id ?>'><i class="fa fa-eye"></i> </a></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
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
echo view('admin/include/footer');
echo view('admin/modals/seller/store_details_modal.php');
?>
<script src="<?php echo base_url('public/custom/js/pending_stores.js') ?>"></script>