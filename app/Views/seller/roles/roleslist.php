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
                    <h4 class="page-title"><i class='fa fa-list'></i> <?php echo trans('roles') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <th width='70%'><?php echo trans('role') ?></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($roles as $key => $role) { ?>
                                        <tr>
                                            <td><?php echo format_name($role->role) ?></td>
                                            <td>
                                                <?php if (check_method_access('roles', 'edit', true)) : ?>
                                                    <a href="<?php echo base_url("admin/settings/roles/permissions/$role->role_id") ?>" style="font-size: 1.2rem;" class='text-primary'><i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
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