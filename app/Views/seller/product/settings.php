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
                    <h4 class="page-title"><i class="fa fa-gears"></i> <?php echo trans('prduct_settings') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default p-3">
                        <div class='alert alert-danger' id='prdct-setting-err' style='display:none'></div>
                        <form id='frm-product-settings'>
                            <?php echo csrf_field(); ?>
                            <h4><?php echo trans('limit_setting') ?></h4>
                            <hr>
                            <div class='row mb-3'>
                                <div class='col-md-3'>
                                    <div class='form-group controls'>
                                        <label for=""><?php echo trans('per_page_web') ?></label>
                                        <input type="number" name='per_page_web' value='<?php echo $settings->per_page_web ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group controls'>
                                        <label for=""><?php echo trans('per_page_mobile') ?></label>
                                        <input type="number" name='per_page_mobile' value='<?php echo $settings->per_page_mobile ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group controls'>
                                        <label for=""><?php echo trans('max_product_limit') ?></label>
                                        <input type="number" name='max_product_limit' value='<?php echo $settings->max_product_limit ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group controls'>
                                        <label for=""><?php echo trans('max_description_text_limit') ?></label>
                                        <input type="number" name='max_description_text_limit' value='<?php echo $settings->max_description_text_limit ?: 0 ?>' class='form-control' />
                                    </div>
                                </div>
                            </div>
                            <h4><?php echo trans('cron_job_setting') ?></h4>
                            <hr>
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='form-group controls'>
                                        <label for=""><?php echo trans('cron_url') ?></label>
                                        <input type="text" name='cron_url' value='<?php echo $settings->cron_url ?: '' ?>' class='form-control' />
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
<script src="<?php echo base_url('public/custom/js/seller/product.js') ?>"></script>