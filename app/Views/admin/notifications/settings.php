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
                    <h4 class="page-title"><i class="fa fa-gears"></i> <?php echo trans('notification_setting') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default p-3">
                        <div class='alert alert-danger' id='noti-set-err' style='display:none'></div>
                        <form id='frm-notification-settings'>
                            <?php echo csrf_field(); ?>
                            <div class='row mb-3'>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for=""><?php echo trans('notification_limit_per_page') ?> <span class="required">
                                                *</span></label>
                                        <input type="number" name='per_page' value='<?php echo $setting->per_page ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for=""><?php echo trans('email_limit_per_user') ?> <span class="required">
                                                *</span></label>
                                        <input type="number" name='email_limit' value='<?php echo $setting->email_limit ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for=""><?php echo trans('max_notification_text_limit') ?> <span class="required">
                                                *</span></label>
                                        <input type="number" name='notification_text_limit' value='<?php echo $setting->notification_text_limit ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                            </div>
                            <button class='btn btn-success pull-right' id='btn-save-settings'><?php echo trans('save') ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('admin/include/footer');
?>
<script src="<?php echo base_url('public/custom/js/notification/notification_settings.js') ?>"></script>