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
                    <h4 class="page-title"><i class="fa-solid fa-database"></i> <?php echo trans('backup')?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class='card rounded-0'>
                        <div class="card-header p-3">
                            <?php echo csrf_field()?>
                            <h4 class='m-0'><i class='fa fa-list'></i> <?php echo trans('backup_history')?></h4>
                            <button class='btn btn-success btn-sm' onclick='getBackup(this)'><i
                                    class='fa fa-plus-square-o'></i>
                                <?php echo trans('create_backup')?></button>
                        </div>
                        <div class="card-body p-3 py-2">
                            <div class="table-responsive">
                                <table class='table no-wrap table-hover' id='tbl-bckup'>
                                    <thead>
                                        <th><?php echo trans('backup_time')?></th>
                                        <th><?php echo trans('backup_file')?></th>
                                        <th><?php echo trans('action')?></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class='col-md-4'>
                    <div class='card rounded-0'>
                        <div class="card-header p-3">
                            <?php echo csrf_field()?>
                            <h4 class='m-0'><i class='fa fa-plus'></i> <?php echo trans('import_database')?></h4>
                        </div>
                        <form id='frm-sql-import'>
                            <div class="card-body p-3 py-2">
                                <input class="form-control" name='sql' type="file" />
                            </div>
                            <div class="card-footer p-3 py-2">
                                <button class='btn btn-primary btn-sm pull-right' onclick='getBackup(this)'>
                                    <?php echo trans('import')?></button>
                            </div>
                        </form>
                    </div>
                </div>g -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('admin/include/footer.php');
?>

<script src='<?php echo base_url('public/custom/js/backup.js')?>'></script>