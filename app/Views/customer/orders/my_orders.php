<?php
echo view('customer/include/header_top');
echo view('customer/include/header');
echo view('customer/include/sidebar');
?>
<style>
tr {
    cursor: pointer;
}
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-list'></i> <?php echo trans('my_orders') ?></h4>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <?php
if ($orders) {
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
                                        <span>Rs <?php echo $v->total_amt ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <span>SHIP TO</span><br>
                                        <span><?php echo $v->full_name ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a>Transaction Id: # <?php echo $v->order_id ?></a><br>
                                <a title="Click to see order details" style="cursor:pointer;"
                                    href="<?php echo base_url("/customer/myorders/order_detail/" . $v->id) ?>">View
                                    order details</a> | <a style=""
                                    href="<?php echo base_url("/customer/myorders/order_invoice/" . $v->id) ?>">Invoice</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <!-- <div class="row"> -->
                        <h3>Ordered <?php echo $order_date; ?></h3>
                        <?php
if (isset($order_products)) {
            foreach ($order_products as $kp => $product):
                $label = '';
                $action = '';
                $confirm_btn = "change_status('#confirm-btn-" . $v->id . "')";
                $cancel_btn = "change_status('#cancel-btn-" . $v->id . "')";
                $download_btn = "change_status('#download-btn-" . $v->id . "')";
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
                if ($product->fk_order_id == $v->id):
                ?>
                        <div class="row">
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
                                        <?php echo $label ?></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a title="Get product support"
                                    class="me-1 btn btn-warning btn-sm btn-rounded btn-block mb-10" id="" onclick=""
                                    style="color:black;">Get
                                    Product Support</a>
                                <a href="<?php echo base_url("/products/rating_review_product?pid=" . $product->product_id) ?>"
                                    title="Write product review"
                                    class="me-1 btn btn-default btn-sm btn-rounded btn-block mb-10" id="" onclick=""
                                    style="">Write
                                    Product Review</a>
                            </div>
                        </div>
                        <hr>
                        <?php
endif;
            endforeach;
        }
        ?>
                    </div>

                    <!-- <div class="box-footer">
                        <div class="row">
                            <div class="col-md-2">
                                <?php echo $label ?>
                            </div>

                            <div class="col-md-6 text-end">
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <?php echo $action ?>
                            </div>
                        </div>
                    </div> -->
                </div>
                <?php }} else {?>
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">No orders found</div>
                    </div>
                </div>
                <?php }?>
                <!-- /.row -->
        </section>

    </div>
</div>
<?php
echo view('customer/include/footer.php');
?>