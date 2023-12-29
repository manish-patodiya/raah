<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400 !important;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-plus"></i> <?php echo trans('bulk_product_upload') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url("seller/product/product") ?>" class="btn btn-info btn-sm"><i class="fa fa-add"></i>
                        <?php echo trans('add_product') ?>
                    </a>
                    <a href="<?php echo base_url("seller/product/product/manage_products") ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>
                        <?php echo trans('manage_product_list') ?>
                    </a>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- mein body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body ribbon-box">
                            <div class="ribbon-two ribbon-two-primary"><span>Upload</span></div>
                            <a href="<?php echo base_url('public/uploads/product_csv/product_csv_sample.csv'); ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-download"></i> Download Sample
                                File</a>
                            <p class="mb-0 pt-20">
                                <span class="text-warning">The first line in downloaded csv file should remain as it is.
                                    Please do not change the order of columns.</span><br>The correct column order is
                                <span class="text-info">
                                    (Title, Barcode, Sale Price, HSN Code, GST Rate, Product Details)</span>
                                &amp; you must follow this.<br>
                                Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).
                            <p class='m-0'>The images can be upload by edit the product information.
                            </p>
                            </p>
                            <hr>
                            <div class='alert alert-danger' style='display:none;' id='bulk-upld-errors'></div>
                            <form id='frm-bulk-upload'>
                                <?php echo csrf_field(); ?>
                                <div class='form-group controls'>
                                    <label><?php echo trans('upload_csv_file') ?></label>
                                    <input class="form-control" name='csv_content' type="file" />
                                </div>
                                <div class='form-group'>
                                    <button type='submit' id='btn-upld' class='btn btn-success btn-sm'><?php echo trans('upload') ?></button>
                                </div>
                            </form>
                        </div> <!-- end box-body-->
                    </div> <!-- end box -->
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>


<script src='<?php echo base_url('public/custom/js/seller/product.js') ?>'></script>