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

.product_details {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.bootstrap-select {
    width: 80% !important;
}
</style>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex justify-content-between">

                <h4 class="page-title"><i class="fa-solid fa-basket-shopping"></i>
                    <?php echo trans('my_orders') ?>
                </h4>
                <div class=''>
                    <!-- <i class="fa fa-filter btn btn-sm"></i> -->
                    <div class='form-control' id="daterange-fltr">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span>
                        <i class="fa fa-caret-down"></i>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='input-group'>
                        <input type="text" placeholder='Search with product order id' class='form-control'
                            id='prod-odr-id-fltr'
                            value="<?php echo isset($get_data['search']) ? $get_data['search'] : '' ?>" />
                        <button class='btn btn-sm btn-primary' id='btn-search'><i class="fa fa-search"></i></button>
                    </div>
                    <small>Search without # <i>(eg: ABC34-EFG12)</i></small>
                </div>
                <div class='col-md-2'>
                    <div class='input-group'>
                        <i class="fa fa-filter btn btn-sm btn-primary" style='width:20%'></i>
                        <select class="selectpicker" id='status-fltr'
                            data-style="btn-primary btn-sm text-white border-0 width-100">
                            <option value="">All
                            </option>
                            <option value="0"
                                <?php echo isset($get_data['status']) && $get_data['status'] == 0 ? 'selected' : '' ?>>
                                Pending
                            </option>
                            <option value="1"
                                <?php echo isset($get_data['status']) && $get_data['status'] == 1 ? 'selected' : '' ?>>
                                Confirmed</option>
                            <option value="2"
                                <?php echo isset($get_data['status']) && $get_data['status'] == 2 ? 'selected' : '' ?>>
                                Rejected</option>
                            <option value="3"
                                <?php echo isset($get_data['status']) && $get_data['status'] == 3 ? 'selected' : '' ?>>
                                Shipped
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="">
                <?php if (isset($orders) && $orders) {
    foreach ($orders as $k => $v) {
        $order_date = date("d M Y", strtotime($v->created_at));
        ?>
                <div class='box col-md-12'>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span>ORDER PLACED</span><br>
                                        <span><?php echo $order_date ?></span>

                                    </div>
                                    <div class="col-md-4">
                                        <span>TOTAL</span><br>
                                        <span>₹<?php echo to_fixed($v->total_amt) ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span>SHIP TO</span><br>
                                        <span><?php echo $v->full_name ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a>Order ID: #<?php echo $v->order_id ?></a><br>
                                <a title="Click to see order details" style="cursor:pointer;"
                                    href="<?php echo base_url("/seller/orders/myorders/order_detail/" . $v->id) ?>">View
                                    order details</a>
                                <!-- <a style=""
                                                href="<?php echo base_url("/seller/orders/myorders/order_invoice/" . $v->id) ?>">Invoice</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <!-- <div class="row"> -->
                        <?php
foreach ($order_products as $kp => $product):
            $label = '';
            $action = '';

            switch ($product->status) {
                case 0:
                    $label .= "<span class='badge badge-warning-light'>Pending</span>";
                    break;
                case 1:
                    $label .= "<label class='badge badge-success-light'>Confirmed</label>";
                    break;
                case 2:
                    $label .= "<label class='badge badge-danger-light'>Rejected</label>";
                    break;
            }

            $confirm_btn = "change_status('#confirm-btn-" . $v->id . '-' . $product->product_id . "')";
            $cancel_btn = "change_status('#cancel-btn-" . $v->id . '-' . $product->product_id . "')";

            switch ($product->status) {
                case 0:
                    $action = '<div class="col-md-6"><a title="Confirm" class="me-1 btn btn-success btn-sm btn-rounded btn-block mb-10" id ="confirm-btn-' . $v->id . '-' . $product->product_id . '" onclick="' . $confirm_btn . '">Confirm</a></div><div class="col-md-6"><a title="Cancel" class="me-1 btn btn-danger btn-sm btn-rounded btn-block cancel-btn" title="Cancel"  style="" onclick="' . $cancel_btn . '">Cancel </a></div>';
                    break;
                case 1:
                    // $action = '<a title="Download Label" href="' . base_url("/seller/orders/myorders/order_invoice/" . $v->id . "?pid=" . $product->product_id) . '" class="me-1 btn btn-sm btn-info btn-block btn-rounded" id="download-btn-' . $v->id . '-' . $product->product_id . '" onclick="">Download Label <i class="fa-solid fa-download"></i></a>';
                    $action = "<button title='Download Label' oid='$v->id' pid='$product->product_id' class='btn btn-sm btn-info btn-rounded btn-download-inv'><i class='fa-solid fa-download'></i> Download</Button>";
                    break;
                case 2:
                    $action = "";
                    break;
                case 3:
                    $action = '<a title="Ship Item" class="me-1 btn btn-sm btn-info" id ="shipping-btn-' . $v->id . '">Confirm</a>';
                    break;
            }?>
                        <?php if ($product->fk_order_id == $v->id): ?>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Ordered <?php echo $order_date; ?></h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h4>Product Order ID: #<?php echo $product->product_order_id . '-' . $v->order_id ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <img src="<?php echo $product->product_image; ?>" style="width: 100px"
                                    onerror="this.src = '<?php echo base_url('/public/uploads/image_found/no-image.jpg'); ?>'">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6><?php echo $product->title ?></h6>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="product_details"><?php echo $product->product_details ?></p>
                                    </div>
                                    <div class="col-md-12">
                                        <span class='badge badge-info-light'> Price:
                                            ₹<?php echo to_fixed($product->product_amt, 2) ?></span>
                                        <?php echo $label ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 align-items-center justify-content-md-center">
                                <div class="row">
                                    <?php echo $action ?></div>
                            </div>
                        </div>
                        <hr>
                        <?php endif;?>
                        <?php endforeach;?>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8 text-end">
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} else {?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <span>No Orders Found</span>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <!-- /.row -->
            <div id='temp-html'></div>
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('seller/include/footer.php');
echo view('seller/modals/order/add_order_setting_modal');
?>
<script src="<?php echo base_url('public/custom/js/seller/order.js') ?>"></script>
<script src="<?=base_url('public/assets/vendor_components/moment/min/moment.min.js')?>"></script>
<script src="<?=base_url('public/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url("public/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"); ?>">
</script>

<script src="<?=base_url('public/assets/vendor_components/jquery-ui/jquery-ui.js')?>">