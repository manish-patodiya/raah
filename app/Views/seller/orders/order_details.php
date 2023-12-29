<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa-solid fa-basket-shopping"></i>
                        <?php echo trans('order_detail') ?>
                    </h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="row">
                    <div class="col-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Order Details</h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body p-0">
                                <ul class="nav d-block nav-stacked">
                                    <li class="nav-item"><a href="#" class="nav-link">Order Number: <span
                                                class="pull-right badge bg-info-light"><?php echo $order_details->order_id ?></span></a>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Order Date <span
                                                class="pull-right badge bg-success-light"><?php echo $order_details->created_at ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Shipping Information</h4>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body p-0">
                                <ul class="nav d-block nav-stacked">
                                    <li class="nav-item"><a href="#" class="nav-link">Shipping Address: <span
                                                class="pull-right badge bg-info-light"><?php echo $order_details->address ?></span></a>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link">Order Date <span
                                                class="pull-right badge bg-success-light"><?php echo $order_details->created_at ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="box box-widget widget-user-2 pb-3">
                        <div class="">
                            <h3 class="m-3">Prdouct</h3>
                        </div>
                        <div class="box-footer no-padding table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Product</th>
                                        <th>Requested Shipping Date</th>
                                        <th>Status</th>
                                        <th>Qty</th>
                                        <th>Each</th>
                                        <th>Total</th>
                                    </tr>
                                    <?php foreach ($order_products_details as $k => $product) {
    $status = "";
    switch ($product->status) {
        case 0:
            $status .= "<span class='badge badge-warning-light'>Pending</span>";
            break;
        case 1:
            $status .= "<label class='badge badge-success-light'>Confirmed</label>";
            break;
        case 2:
            $status .= "<label class='badge badge-danger-light'>Rejected</label>";
            break;
    }
    ?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <img src="<?php echo $product->product_image ?>" alt=""
                                                    style="max-height:50px;max-width:50px;"
                                                    onerror="this.src = '<?php echo base_url('/public/uploads/image_found/no-image.jpg'); ?>'">
                                            </div>
                                        </td>
                                        <td><?php echo $order_details->created_at ?></td>
                                        <td><?php echo $status ?></td>
                                        <td><?php echo $product->qty ?></td>
                                        <td><?php echo $product->product_amt ?></td>
                                        <td><?php echo $product->qty * $product->product_amt ?></td>
                                    </tr>
                                <tbody>
                                    <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box box-widget widget-user-2">
                        <div class="">
                            <h3 class="m-3">Billing Information</h3>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav d-block nav-stacked">
                                <li class="nav-item"><a href="#" class="nav-link">Shipping Address: <span
                                            class="pull-right badge bg-info-light"><?php echo $order_details->address ?></span></a>
                                </li>
                                <li class="nav-item"><a href="#" class="nav-link">Order Date <span
                                            class="pull-right badge bg-success-light"><?php echo $order_details->created_at ?></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- </div>
                </div> -->
            </div>
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?php
echo view('seller/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/seller/order.js') ?>"></script>