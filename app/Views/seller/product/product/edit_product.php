<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<style>
body {
    background-color: #f5f5f5;
}
</style>
<script>
let properties = JSON.parse('<?php echo json_encode($properties) ?>');
</script>

<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-pencil"></i> <?php echo trans('edit_product') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url("seller/product/product/manage_products") ?>"
                        class="btn btn-info btn-sm"><i class="fa fa-list"></i>
                        <?php echo trans('manage_product_list') ?>
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
                                <li><a class="active" id="dflt_active_tab" data-bs-toggle="tab"
                                        href="#update_product_details"><?php echo trans('product_info') ?></a></li>
                                <li id="dropzone_tab"><a href="#dz-update-product" data-bs-toggle="tab"
                                        id="dropzone_active"><?php echo trans('product_images') ?></a>
                                </li>
                            </ul>

                            <div class="tab-content" style="padding:0px;">
                                <div class="active tab-pane" id="update_product_details">
                                    <div class="col-md-12">
                                        <div class="m-3">
                                            <form method="post" autocomplete="off" id="product_updated_detail"
                                                onsubmit="return false">
                                                <?php echo csrf_field() ?>
                                                <input type="hidden" name='pro_id' id='pro_id'
                                                    value="<?php echo $product['id'] ?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <h4><?php echo trans('gen_info') ?></h4>
                                                            </div>
                                                            <?php switch ($product['status']) {
    case 1: ?>
                                                            <div class="col-md-4">
                                                                <button type='button'
                                                                    class="btn btn-success pull-right ms-3 btn-update-product"
                                                                    data-status="2">
                                                                    <?php echo trans('publish') ?>
                                                                </button>
                                                                <button type='button'
                                                                    class="btn btn-warning pull-right ms-3 btn-update-product"
                                                                    data-status="1">
                                                                    <?php echo trans('save_as_draft') ?>
                                                                </button>
                                                            </div>
                                                            <?php break;
    case 2: ?>
                                                            <div class="col-md-4">
                                                                <button type='button'
                                                                    class="btn btn-danger pull-right ms-3 btn-update-product"
                                                                    data-status="2">
                                                                    <?php echo trans('publish') ?>
                                                                </button>
                                                            </div>
                                                            <?php break;
}?>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="username"
                                                                        class="control-label"><?php echo trans('category') ?><span
                                                                            class="required"> *</span></label>
                                                                    <div class="controls">
                                                                        <select name="category_id" class="form-control"
                                                                            id="category">

                                                                            <?php render_options($category, 0, $product['category_id']);?>

                                                                            <?php
function render_options($cat, $pid = 0, $slct_id)
{
    foreach ($cat as $v) {
        if ($v->pid == $pid) {
            if (check_child($cat, $v->id)) {
                echo "<optgroup label='$v->category_name'>";
                render_options($cat, $v->id, $slct_id);
                echo "</optgroup>";
            } else {
                $slct = $v->id == $slct_id ? 'selected' : '';
                echo "<option $slct value='$v->id'>$v->category_name</option>";
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
                                                                            <label for="username"
                                                                                class="control-label"><?php echo trans('product_name') ?><span
                                                                                    class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" name="title"
                                                                                    class="form-control" id="product"
                                                                                    placeholder="Enter your product name"
                                                                                    value="<?php echo $product['title'] ?>"
                                                                                    data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="username"
                                                                            class="control-label"><?php echo trans('description') ?><span
                                                                                class="required"> *</span></label>
                                                                        <div class="controls">
                                                                            <textarea name="pro_details"
                                                                                class="form-control" id="pro_details"
                                                                                placeholder="Enter your product details"
                                                                                data-validation-required-message="This field is required"
                                                                                rows='4'><?php echo $product['product_details'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('hsn_details') ?><span
                                                                                    class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" id="hsn_detail"
                                                                                    class="form-control pointer"
                                                                                    placeholder="Enter your hsn code"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target=".bs-example-modal-lg"
                                                                                    value="<?php echo $details ?>"
                                                                                    data-validation-required-message="This field is required">
                                                                                <input type="hidden" name="hsn_code"
                                                                                    id="hsn_code"
                                                                                    value="<?php echo $hsn_code ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('gst%') ?><span
                                                                                    class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input type="text" class='form-control'
                                                                                    name='gst_rate' id='gst-rate'
                                                                                    data-validation-required-message="This field is required"
                                                                                    value='<?php echo $product['gst_rate'] ?>'>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('net_weight') ?>
                                                                                {gms)<span class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number"
                                                                                    value="<?php echo $product['net_weight'] ?>"
                                                                                    name="net_weight"
                                                                                    class="form-control"
                                                                                    placeholder="Please give net weight in gms"
                                                                                    data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('quantity') ?>
                                                                                (Stock)<span class="required">
                                                                                    *</span></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number"
                                                                                    value="<?php echo $product['quantity'] ?>"
                                                                                    name="quantity" class="form-control"
                                                                                    placeholder="eg:(Stock)"
                                                                                    data-validation-required-message="This field is required">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for=""><?php echo trans('price') ?>
                                                                                (Rs)<span class="required">
                                                                                    *</span>
                                                                            </label>
                                                                            <div class="controls">
                                                                                <input type="text"
                                                                                    class='form-control mrp' name='mrp'
                                                                                    id='edit_mrp' pattern="^[\d,]+$"
                                                                                    data-validation-required-message="This field is required"
                                                                                    placeholder="Enter your product value"
                                                                                    value="<?php echo $product['mrp'] ?>">
                                                                            </div>
                                                                            <small>Sale
                                                                                Price:<?php echo $product['sale_price'] ?></small>


                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('discount') ?></label>
                                                                            <div class="controls">
                                                                                <input id="" type="number"
                                                                                    value="<?php echo $product['discount'] ?>"
                                                                                    name="discount"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5 class="control-label mt-30">
                                                            <?php echo trans('properties') ?></h5>
                                                        <hr>

                                                        <h5 class="control-label mt-30">Other</h5>
                                                        <hr>
                                                        <div class='row' id='prod-prprty'></div>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label"><?php echo trans('key_highlights') ?></label>
                                                                    <div class="controls">
                                                                        <textarea class="form-control wysihtml5"
                                                                            name="key_highlights" cols="80"
                                                                            rows="10"><?php echo $product['key_highlights'] ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="control-label"><?php echo trans('upld_catalogue') ?></label>
                                                                            <div class="input-group">
                                                                                <input type="file" class='form-control'
                                                                                    name='pdf' accept=".pdf" id="pdf">
                                                                                <a href="<?php echo base_url($product['catalog_file']) ?>"
                                                                                    class="btn btn-success btn-sm"
                                                                                    download><i
                                                                                        class="fa fa-arrow-down"></i></a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('brand') ?></label>
                                                                            <div class="controls">
                                                                                <select class="form-select bg-white"
                                                                                    name="brand" id="">
                                                                                    <option value="India" selected
                                                                                        disabled>Select
                                                                                        Brand
                                                                                    </option>
                                                                                    <?php foreach ($brands as $key => $value) {
    $slct = $product['brand_id'] == $value->id ? "selected" : ""?>
                                                                                    <option
                                                                                        value="<?php echo $value->id ?>"
                                                                                        <?php echo $slct ?>>
                                                                                        <?php echo $value->name ?>
                                                                                    </option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for=""><?php echo trans('country_of_origin') ?><span
                                                                                    class="required"> *</span></label>
                                                                            <div class="controls">
                                                                                <select class="form-select"
                                                                                    name="country_of_origin" id=""
                                                                                    data-validation-required-message="This field is required">
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
                                                                    <label for=""
                                                                        class="control-label"><?php echo trans('tags') ?></label>
                                                                    <div class="controls">
                                                                        <textarea name="predictive_search"
                                                                            class="form-control" id="predictive_search"
                                                                            placeholder="Enter predictive search keywords of your product"
                                                                            rows='3'><?php echo $product["predictive_search"] ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="submit" value="1" />
                                                            <input type="hidden" name="status" value="1"
                                                                id="inpt-product-status">
                                                            <?php switch ($product['status']) {
    case 1: ?>
                                                            <button type='button'
                                                                class="btn btn-success pull-right ms-3 btn-update-product"
                                                                data-status="2">
                                                                <?php echo trans('publish') ?>
                                                            </button>
                                                            <button type='button'
                                                                class="btn btn-warning ms-3 btn-update-product pull-right"
                                                                data-status="1">
                                                                <?php echo trans('save_as_draft') ?>
                                                            </button>
                                                            <?php break;
    case 2: ?>
                                                            <button type='button'
                                                                class="btn btn-success pull-right ms-3 btn-update-product"
                                                                data-status="2">
                                                                <?php echo trans('publish') ?>
                                                            </button>
                                                            <?php break;
}?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="dz-update-product">
                                    <div class="m-3">
                                        <div class="row">
                                            <div class="col-md-8 row m-0" id='all_pr_img'>

                                            </div>
                                            <div class="col-md-4">
                                                <h6>Please provide only front image for each product</h6>
                                                <form id='frm-upload-img'>
                                                    <input type="file" class='d-none' name="product_image"
                                                        id="product_img" accept=".png, .jpg, .jpeg, .gif, .svg, .jfif">
                                                    <input type="hidden" id="product_id" name="product_id"
                                                        value='<?php echo $product['id'] ?>' />
                                                </form>
                                                <div class='btn btn-success mt-3' style='width:100%'
                                                    id='div-upload-img'><i class="fa fa-picture-o fa-lg"></i> Add
                                                    Image</div>
                                                <hr class='mt-15'>
                                                <div class="alert bg-warning-light"><i
                                                        class="fa fa-exclamation-circle fa-lg   "></i> <span
                                                        class='text-dark'>Follow guidelines to reduce quality check
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
<script src="<?php echo base_url('public/custom/js/seller/product.js') ?>">
</script>