<?php echo view('seller/include/header_top'); ?>
<!-- Main content -->
<section class="content bg-white">
    <div class="container" id='printableArea'>
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <h2 class="d-inline"><span class="fs-30">Invoice</span></h2>
                    <div class="pull-right text-end">
                        <h3><?php echo $order_date = date("d M Y", strtotime($details[0]->created_at)); ?></h3>
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
                            <td class="text-end">₹<?php echo to_fixed($details[0]->product_amt) ?></td>
                            <td class="text-end">
                                ₹<?php echo to_fixed($sub_total = $details[0]->qty * $details[0]->product_amt); ?>
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
                    <p>Shipping : ₹<?php echo to_fixed($details[0]->shipping_charges) ?></p>
                </div>
                <div class="total-payment">
                    <h3><b>Total :</b> ₹<?php echo to_fixed($sub_total) ?></h3>
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>
</section>
<?php echo view('seller/include/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
$(function() {
    var doc = new jsPDF();

    //Create screenshot of body
    html2canvas($('#printableArea')[0], {
        scale: 2,
        scrollY: -window.scrollY
    }).then(canvas => {
        // document.body.appendChild(canvas);
        var imgData = canvas.toDataURL('image/png');

        //add the image to pdf
        var pdf = new jsPDF('L', 'pt', [canvas.width, canvas.height]);
        pdf.addImage(imgData, 'PNG', 50, 50, canvas.width - 100, canvas.height - 50);
        pdf.save('invoice.pdf');
    });
})
</script>