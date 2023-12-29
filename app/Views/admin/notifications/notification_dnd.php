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
                    <h4 class="page-title"><i class='fa-solid fa-moon fa-lg'></i> <?php echo trans('notification_dnd') ?></h4>
                    <a type="button" href="<?php echo base_url("/notifications?email=") . $session->admin_info["email"] ?>" user_email="<?php echo $session->admin_info["email"] ?>" class="btn btn-primary btn-sm"><i class="ion ion-link"></i></a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="notification_dnd_table" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo trans('sn') ?></th>
                                        <th scope="col"><?php echo trans('email') ?></th>
                                        <th scope="col"><?php echo trans('reasons') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
echo view('admin/include/footer.php');
?>
<script src='<?php echo base_url('public/custom/js/notification/notification_dnd.js') ?>'></script>