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
                    <h4 class="page-title"><i class="fa-solid fa-file-invoice"></i> <?php echo trans('invoice') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="box">
                    <div class="box-body printableArea">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-header">
                                    <h2 class="d-inline"><span class="fs-30">Invoice</span></h2>
                                    <div class="pull-right text-end">
                                        <h3><?php echo $order_date = date("d M Y", strtotime($details[0]->created_at));
?></h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row invoice-info">
                            <div class="col-md-6 invoice-col">
                                <strong>From</strong>
                                <address>
                                    <strong class="text-blue fs-24"><?php echo $details[1]->full_name ?></strong>
                                    <br><?php echo $details[1]->address ?><br>
                                    <strong>Phone: <?php echo $details[1]->phone ?> &nbsp;&nbsp;&nbsp;&nbsp; Email:
                                        <?php echo $details[1]->email ?></strong>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6 invoice-col text-end">
                                <strong>To</strong>
                                <address>
                                    <strong class="text-blue fs-24"><?php echo $details[0]->full_name ?></strong><br>
                                    <?php echo $details[0]->address ?><br>
                                    <strong>Phone: <?php echo $details[0]->phone ?>&nbsp;&nbsp;&nbsp;&nbsp; Email:
                                        <?php echo $details[0]->email ?></strong>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-12 invoice-col mb-15">
                                <div class="invoice-details row no-margin">
                                    <div class="col-md-7 col-lg-4"><b>Order ID:
                                        </b><?php echo $details[0]->product_order_id . '-' . $details[0]->order_id ?>
                                    </div>
                                    <div class="col-md-7 col-lg-4"><b>Order Date:</b>
                                        <?php echo date('d/m/Y', strtotime($details[0]->created_at)) ?> </div>
                                    <div class="col-md-7 col-lg-4"><b>Payment:</b>
                                        <?php echo $details[0]->payment_type ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Tax</th>
                                            <th class="text-end">Unit Cost</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $details[0]->title ?></td>
                                            <td class="text-center"><?php echo $details[0]->qty ?></td>
                                            <td class="text-center"><?php echo $details[0]->gst_rate ?></td>
                                            <td class="text-end">₹<?php echo $details[0]->product_amt ?></td>
                                            <td class="text-end">
                                                ₹<?php echo $sub_total = $details[0]->qty * $details[0]->product_amt; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <p class="lead"><b>Order Date</b><span class="text-danger">
                                        <?php echo date('d/m/Y', strtotime($details[0]->created_at)) ?> </span></p>
                                <div>
                                    <p>Shipping : ₹0</p>
                                </div>
                                <div class="total-payment">
                                    <h3><b>Total :</b> <?php echo $sub_total ?></h3>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-12">
                                <div class="bb-1 clearFix">
                                    <div class="text-end pb-15">
                                        <button class="btn btn-success" type="button"> <span><i class="fa fa-print"></i>
                                                Save</span> </button>
                                        <button id="print2" class="btn btn-warning" type="button"> <span><i
                                                    class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>
<!-- <script src="../assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js"></script> -->
<script src="<?php echo base_url('public/assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js') ?>"></script>
<script src="<?php echo base_url('public/custom/js/seller/order.js') ?>"></script>