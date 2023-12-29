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
                    <h4 class="page-title"><i class='fa-solid fa-moon fa-lg'></i> <?php echo trans('notification_dnd') ?></h4>
                    <a type="button" href="" user_email="" class="btn btn-primary btn-sm"><i class="ion ion-link"></i></a>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- <div class='col-md-12'> -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form method="post" autocomplete="off" id="product_image">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo trans('product_image') ?><br><span>( Default
                                                image of your product)</span></label>
                                        <div class='d-flex bg-secondary flex-column align-items-center justify-content-center mb-2' style='height: 250px; width:100%;'>
                                            <img src="<?php echo base_url('/public/uploads/image_found/add_product_images.jpg') ?>" id="logo" class="logo" style='max-height:100%; max-width:100%;'>
                                        </div>
                                        <input type="file" class='' name="logo" id="product_img" accept="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info pull-right ms-3" id="">
                                        <?php echo trans('add') ?>
                                    </button>
                                    <div class="pull-right ms-2">
                                    </div>
                                </div>
                            </form>
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
<script src='<?php echo base_url('public/custom/js/seller/product.js') ?>'></script>