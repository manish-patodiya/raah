<section class="content pt-120 pb-70 px-100" style='min-height:100vh'>
    <div class="container">
        <div class="">
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header">
                            <h4 class="d-inline"><span>Payment Details</span></h4>
                            <div class="pull-right text-end">
                                <h5><?php echo date('d M Y') ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Unit Cost</th>
                                    <th class="text-end">Discount</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                                <?php foreach ($data['list'] as $k => $v) {?>
                                <tr>
                                    <td><?php echo ++$k ?></td>
                                    <td><?php echo $v->title ?></td>
                                    <td class="text-end"><?php echo $v->quantity ?></td>
                                    <td class="text-end">₹<?php echo fmt_amt($v->mrp) ?></td>
                                    <td class="text-end">₹<?php echo fmt_amt($v->total_dis) ?> <br><small
                                            class="text-success"><?php echo $v->discount ? "($v->discount%)" : '' ?></small>
                                    </td>
                                    <td class="text-end">₹<?php echo fmt_amt($v->total_amt) ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <p class="lead"><b>Payment Due</b><span class="text-danger"> <?php echo date('d/m/Y') ?>
                            </span></p>
                        <div class="total-payment">
                            <h4><b>Total :</b> ₹<?php echo fmt_amt($data['grand_total']) ?></h4>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <form class='col-md-1' action="<?php echo base_url('products/cancel_payment') ?>" method='post'>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name='order_id' value="<?php echo $data['order_id'] ?>">
                        <button type='submit' class="btn btn-danger me-2 col-md-1 mt-3" style='width:100%'>
                            Cancel
                        </button>
                    </form>
                    <button type="button" class="btn btn-success col-md-2 mt-3" id='rzp-button'><i
                            class="fa fa-credit-card"></i>
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form action="<?php echo base_url('products/payment_success') ?>" method='post' id='payment-form'>
        <?php echo csrf_field(); ?>
        <input type="hidden" name='payment_id' id='payment_id' />
        <input type="hidden" name='paid_amt' value='<?php echo $data['grand_total'] ?>' />
        <input type="hidden" name='order_id' value='<?php echo $data['order_id'] ?>' />
    </form>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var totalAmount = <?php echo $data['grand_total'] ?: 0 ?>;
</script>