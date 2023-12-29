<?php
echo view('frontend/include/header_top');
echo view('frontend/include/header');
?>

<style>
    .jq-toast-wrap {
        left: 33%;
        width: 33%;
    }
</style>

<script>
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row" id='div-cart-items' style='display:none;'>
                <div class="col-12 col-lg-8">
                    <div class="border p-3">
                        <div id='product-cart-details' style='min-height: 200px;'>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="border" style='border-radius: 0px; margin-bottom: 0rem !important;'>
                        <span class='pro-detail' style='border-bottom: 1px solid #e0e0e0;'>Price
                            Details</span>
                        <div style='padding: 0 24px' style='border-bootom: 1px dashed #e0e0e0;'>
                            <div class='price-detail'>
                                <span>Price(1 items)</span>
                                <span id='sale-price'></span>
                            </div>
                            <div class='price-detail'>
                                <span>Discount</span>
                                <span style='color: var(--bs-green);' id='discount'></span>
                            </div>
                            <div class='price-detail'>
                                <span>Delivery Charges</span>
                                <span style='color: var(--bs-green);' id='delivery_charge'></span>
                            </div>
                            <div class="" style='border-top: 1px dashed #e0e0e0;font-weight: 500; font-size: 18px;'>
                                <div class='price-detail'>
                                    <span>Total Amount</span>
                                    <span id='Total-price'></span>
                                </div>
                            </div>
                            <div class="" style='border-top: 1px dashed #e0e0e0; margin:0px 0px 12px 0px'>
                                <span style='color: var(--bs-green); padding: 12px 0; font-size: 16px' id='save-amt'>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class='row' id='div-empty-cart'> </div>
        </section>
    </div>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php echo view('frontend/include/footer') ?>

<script src='<?php echo base_url('public/frontend/custom/js/product_cart.js') ?>'></script>