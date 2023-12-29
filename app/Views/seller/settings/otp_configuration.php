<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400;
    }
</style>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-gears"></i> <?php echo trans('otp_configuration') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger" id='config-err' style='display:none'></div>
                            <form id='frm-otp-config'>
                                <?php echo csrf_field() ?>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for=""><?php echo trans('otp_limit_per_user') ?></label>
                                        <input type="text" name="otp_limit" class='form-control' value='<?php echo $otp_config->otp_limit ?: 0 ?>' />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for=""><?php echo trans('next_otp_time_limit_in_seconds') ?></label>
                                        <input type="number" name="time_limit" class='form-control' value='<?php echo $otp_config->time_limit ?: '0' ?>' />
                                    </div>
                                </div>
                                <button class='btn btn-sm btn-info' id='btn-save-config'><?php echo trans('save') ?></button>
                            </form>
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
<script src="<?php echo base_url('public/custom/js/otp_configuration.js') ?>"></script>