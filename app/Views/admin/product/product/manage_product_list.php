<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
.btn-lg {
    font-size: 1.286rem;
    padding: 6px 32px;
}

#manage_product p {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i> <?php echo trans('manage_product') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url("seller/product/product") ?>" class="btn btn-info btn-sm"><i
                            class="fa fa-list"></i>
                        <?php echo trans('add_new_product') ?>
                    </a>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class='mb-2 col-md-2'>
                    <select name="care" class='select_category form-select' id="get_categ_id">
                        <option value=""><?php echo trans('slct_cat') ?></option>
                        <?php foreach ($category as $val) {?>
                        <option value="<?php echo $val->id ?>"><?php echo $val->category_name ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-10 mb-2">
                    <a class="text-white btn btn-primary btn-sm box-inverse" href="javascript:void(0)"
                        id="status_pending" sid='2'>
                        <span>Pending</span>
                    </a>
                    <a class="text-white btn btn-success btn-sm box-inverse" href="javascript:void(0)"
                        id="status_publish" sid='3'>
                        <span>Published</span>
                    </a>
                    <a class="text-white btn btn-danger btn-sm box-inverse" href="javascript:void(0)"
                        id="status_rejected" sid='4'>
                        <span>Rejected</span>
                    </a>
                    <a class="text-white btn btn-info btn-sm box-inverse" href="javascript:void(0)" id="status_rejected"
                        sid='5'>
                        <span>Disable</span>
                    </a>
                    <a class="text-white btn btn-danger btn-sm" href="javascript:void(0)" id="out_of_stock">
                        <span>Out of Stock</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <input type="hidden" id='status-shown-in-tbl' value=''>
                        <input type="hidden" id='stock' value=''>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="manage_product" class="table no-wrap product-order" data-page-size="10">
                                    <div class="row">
                                        <div class='mb-2 col-md-2'>

                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th><?php echo trans('image') ?></th>
                                            <th><?php echo trans('product_details') ?></th>
                                            <th><?php echo trans('category') ?></th>
                                            <th><?php echo trans('status') ?></th>
                                            <th><?php echo trans('hsn') ?></th>
                                            <th><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
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

<script src="<?php echo base_url('public/custom/js/product.js') ?>"></script>