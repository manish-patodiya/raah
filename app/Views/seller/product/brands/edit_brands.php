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
                    <h4 class="page-title"><i class="fa fa-plus"></i> <?php echo trans('edit_brand') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url("seller/product/brands") ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>
                        <?php echo trans('manage_brand_list') ?>
                    </a>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- mein body -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="m-3">
                            <form method="post" autocomplete="off" id="edit_brand_detail">
                                <?php echo csrf_field() ?>
                                <input type="hidden" value="<?php echo $brand_detail["id"] ?>" id="brand_id"></input>
                                <h4 class="text-info mb-0"><i class="ti-user"></i> <?php echo trans('brand_info') ?></h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group controls">
                                            <label class="control-label"><?php echo trans('brand_image') ?></label>
                                            <div class='d-flex bg-secondary flex-column align-items-center justify-content-center mb-2' style='height: 250px; width:100%;'>
                                                <img src="<?php echo $brand_detail["logo"] == "" ? base_url('/public/uploads/image_found/add_product_images.jpg') : $brand_detail["logo"] ?>" id="logo" class="logo" style='max-height:100%; max-width:100%;'>
                                            </div>
                                            <input type="file" class='' name="logo" id="brand_logo">
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <h4 for="username" class="control-label"><?php echo trans('gen_info') ?></h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="brand_name" class="control-label"><?php echo trans('brand_name') ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="name" value="<?php echo $brand_detail["name"] ?>" class="form-control" id="edit_name" placeholder="Enter your brand name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="website_link" class="control-label"><?php echo trans('website_link') ?></label>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <input type="text" name="link" class="form-control" id="edit_website_link" value="<?php echo $brand_detail["website_link"] ?>" placeholder="Enter your website link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="description" class="control-label"><?php echo trans('brand_description') ?></label>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <textarea name="description" class="form-control" id="edit_description" placeholder="Enter your brand description" rows='3'><?php echo $brand_detail["description"] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class='mt-0'>
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="form-group">
                                                <label for=""><?php echo trans('seo_title') ?></label>
                                                <div class="controls">
                                                    <input type="text" name="seo_title" class="form-control" value="<?php echo $brand_detail["seo_title"] ?>" id="edit_seo_title" placeholder="Enter your seo title">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-8'>
                                        <div class="form-group">
                                            <label for=""><?php echo trans('seo_description') ?></label>
                                            <div class="controls">
                                                <textarea name="seo_description" class="form-control" id="edit_seo_description" placeholder="Enter your seo description" rows='3'><?php echo $brand_detail["seo_description"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">


                                    <button type="submit" class="btn btn-info btn-sm  pull-right ms-3" id="edit_btn">
                                        <?php echo trans('update') ?>
                                    </button>
                                    <div class="pull-right ms-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
echo view('seller/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/seller/brands.js') ?>"></script>