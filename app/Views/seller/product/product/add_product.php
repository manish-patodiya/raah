<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-plus"></i> <?php echo  trans('add_new_product') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url("seller/product/product/bulk_upload") ?>" class="btn btn-info btn-sm"><i class="fa fa-add"></i>
                        <?php echo  trans('bulk_upload') ?>
                    </a>
                    <a href="<?php echo base_url("seller/product/product/manage_products") ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>
                        <?php echo  trans('manage_product_list') ?>
                    </a>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- mein body -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="nav-tabs-custom border-0">
                            <ul class="nav nav-tabs">
                                <li><a class="active" id="dflt_active_tab" href="#product_details"><?php echo  trans('product_info') ?></a></li>
                                <li id="dropzone_tab"><a href="" id="dropzone_active"><?php echo  trans('product_images') ?></a>
                                </li>
                            </ul>

                            <div class="tab-content" style="padding:0px;">
                                <div class="tab-pane active" id="product_details">
                                    <div class="col-md-12">
                                        <div class="m-3">
                                            <form method="post" autocomplete="off" id="frm-add-product">
                                                <?php echo  csrf_field() ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <h4 class="control-label"><?php echo  trans('gen_info') ?></h4>
                                                            </div>
                                                            <div class="col-md-4 text-end">
                                                                <button type='button' class="btn btn-success ms-3 btn-submit-product" data-status="1">
                                                                    <?php echo  trans('save_as_draft') ?>
                                                                </button>
                                                                <button type='button' class="btn btn-danger ms-3 btn-submit-product" data-status="2">
                                                                    <?php echo  trans('publish') ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><?php echo  trans('category') ?><span class="required"> *</span></label>
                                                                    <div class="controls">
                                                                        <select name="category_id" class="form-select bg-white" id="category" data-validation-required-message="This field is required">
                                                                            <option value="" selected>
                                                                                <?php echo  trans('slct_cat') ?>
                                                                            </option>
                                                                            <?php render_options($category); ?>

                                                                            <?php
                                                                            function render_options($cat, $pid = 0)
                                                                            {
                                                                                foreach ($cat as $v) {
                                                                                    if ($v->pid == $pid) {
                                                                                        if (check_child($cat, $v->id)) {
                                                                                            echo "<optgroup label='$v->category_name'>";
                                                                                            render_options($cat, $v->id);
                                                                                            echo "</optgroup>";
                                                                                        } else {
                                                                                            echo "<option value='$v->id'>$v->category_name</option>";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                            function check_child($cat, $id)
                                                                            {
                                                                                foreach ($cat as $v) {
                                                                                    if ($v->pid == $id) {
                                                                                        return true;
                                                                                    }
                                                                                }
                                                                                return false;
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8"></div>
                                                        </div>

                                                        <h5 class="control-label mt-30">Product Size, Inventory</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label"><?php echo  trans('product_name') ?>
                                                                                <span class="required"> *</span>
                                                                            </label>
                                                                            <div class="controls">
                                                                                <input type="text" name="title" class="form-control" id="product" placeholder="Enter your product name" data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="" class="control-label"><?php echo  trans('description') ?><span class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <textarea name="pro_details" class="form-control" id="pro_details" placeholder="Enter your product details" rows='4' data-validation-required-message="This field is required" style="height:102px;"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('hsn_details') ?>
                                                                                <span class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" id="hsn_detail" class="form-control pointer" placeholder="Choose HSN code here" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg" readonly data-validation-required-message="This field is required">
                                                                                <input type="hidden" name="hsn_code" id="hsn_code" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('gst%') ?> <span class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" class='form-control' name='gst_rate' id='gst-rate' data-validation-required-message="This field is required" placeholder="To auto fill select HSN first">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('net_weight') ?>
                                                                                (gms)<span class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number" value="" name="net_weight" class="form-control" data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('quantity') ?>
                                                                                (Stock)<span class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number" value="" name="quantity" class="form-control" data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('price') ?> (Rs)
                                                                                <span class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" class='form-control mrp' name='mrp' id='mrp' pattern="^[\d,]+$" data-validation-required-message="This field is required" placeholder="Enter your product value">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('discount') ?></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number" value="0" name="discount" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h5 class="control-label mt-30"><?php echo  trans('properties') ?></h5>
                                                        <hr>
                                                        <div class='row' id='prod-prprty'>
                                                            <h4 class='text-light'>Please select category first.</h4>
                                                        </div>

                                                        <h5 class="control-label mt-30">Other</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        <?php echo  trans('key_highlights') ?></label>
                                                                    <textarea class="form-control wysihtml5" name="key_highlights" cols="80" rows="10"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label"><?php echo  trans('upld_catalogue') ?></label>
                                                                            <input type="file" class='form-control' name='pdf' accept=".pdf" id="pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('brand') ?></label>
                                                                            <div class="controls">
                                                                                <select class="form-select bg-white" name="brand" id="">
                                                                                    <option value="" selected disabled>
                                                                                        Select
                                                                                        Brand
                                                                                    </option>
                                                                                    <?php foreach ($brands as $key => $value) {
                                                                                    ?>
                                                                                        <option value="<?php echo $value->id ?>">
                                                                                            <?php echo $value->name ?>
                                                                                        </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo  trans('country_of_origin') ?><span class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <select class="form-select" name="country_of_origin" id="" data-validation-required-message="This field is required">
                                                                                    <option value="India" selected>
                                                                                        India
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <h5 class="control-label mt-30">SEO</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label"><?php echo  trans('tags') ?></label>
                                                                    <div class="controls">
                                                                        <textarea name="predictive_search" class="form-control" id="predictive_search" placeholder="Enter predictive search keywords of your product" rows='3'></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group d-flex align-items-center justify-content-end">
                                                            <input type="hidden" name="status" value="1" id="inpt-product-status">
                                                            <div class="">
                                                                (On next step you can add product images)
                                                            </div>
                                                            <button type='button' class="btn btn-success ms-3 btn-submit-product" data-status="1">
                                                                <?php echo  trans('save_as_draft') ?>
                                                            </button>
                                                            <button type='button' class="btn btn-danger ms-3 btn-submit-product" data-status="2">
                                                                <?php echo  trans('publish') ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="dz-add-product">
                                    <div class="m-3">
                                        <div class="row">
                                            <div class="col-md-8 row m-0" id='all_pr_img'>
                                            </div>
                                            <div class="col-md-4">
                                                <h6>Please provide only front image for each product</h6>
                                                <form id='frm-upload-img'>
                                                    <input type="file" class='d-none' name="product_image" id="product_img" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                                    <input type="hidden" id="product_id" name="product_id" value='' />
                                                </form>
                                                <div class='btn btn-success' style='width:100%' id='div-upload-img'><i class="fa fa-picture-o fa-lg"></i> Add
                                                    Image</div>
                                                <hr class='mt-15'>
                                                <div class="alert bg-warning-light"><i class="fa fa-exclamation-circle fa-lg   "></i> <span class='text-dark'>Follow guidelines to reduce quality check
                                                        failure</span></div>

                                                <h4>General Guidelines</h4>
                                                <ul>
                                                    <li>You can add maximum 10 product images.
                                                    </li>
                                                    <li>Upload the products from the same category thay you have chosen.
                                                    </li>
                                                </ul>
                                                <h4>Image Guidelines</h4>
                                                <ul>
                                                    <li>Image with test/watermark are not acceptable in primary images.
                                                    </li>
                                                    <li>Product image should not have any text.</li>
                                                    <li>Please add solo product image without any props.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
echo view('seller/modals/product/hsn_code_datatable.php');
echo view('seller/include/footer.php');
?>
<script src="<?php echo base_url("public/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"); ?>">
</script>
<script src="<?php echo base_url('public/custom/js/seller/product.js') ?>"></script>