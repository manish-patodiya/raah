<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-list'></i> <?php echo trans('template_list') ?></h4>
                </div>
                <a class='btn btn-sm btn-info pull-right' href="<?php echo base_url('admin/notifications/notificationtemplate/add') ?>"><?php echo trans('create_template') ?></a>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body">
                            <div class='table-responsive'>
                                <table class='table no-wrap table-hover' id='tbl-notification-temp'>
                                    <?php echo csrf_field() ?>
                                    <thead>
                                        <tr>
                                            <th><?php echo trans('sn') ?></th>
                                            <th><?php echo trans('title') ?></th>
                                            <th><?php echo trans('subject') . '/' . trans('body') ?></th>
                                            <th><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
<?php
echo view('admin/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/notification/notification_template.js') ?>"></script>