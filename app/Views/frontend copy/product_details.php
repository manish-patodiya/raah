<?php
echo view('frontend/include/header_top');
echo view('frontend/include/header');
?>
<style>
    .pro-photos .photos-item img {
        max-height: 4rem;
        max-width: 4rem;
    }

    #read-only-stars>img {
        height: 18px;
    }

    .rat-revi {
        font-size: 23px;
        padding: 14px;
    }

    .bg-light {
        background-color: #f3f6f9 !important;
    }

    .width {
        width: 55%;
    }

    .width1 {
        width: 45%;
    }

    ul {
        list-style-type: none;
        padding-left: 0rem;
    }

    .progress-xs {
        border-radius: 5px;
        height: 4px;
    }

    .w-100 {
        width: 84px !important;
    }
</style>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-lg-12">
                    <div class="box no-shadow">
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" id='pro_id' value='<?php echo  $product->id ?>'>
                                <div class="col-md-4 col-sm-6">
                                    <div class="col-md-10 box box-body b-1 text-center no-shadow d-flex justify-content-center align-items-center" style="height:20rem;">
                                        <img src="<?php echo  base_url("/public/uploads/product_images/" . $product->product_image) ?>" id="product-image" class="" alt="" style='max-width:100%;max-height:100%;' />
                                    </div>
                                    <div class="pro-photos">
                                        <div class="photos-item item-active d-flex justify-content-center align-items-center" style="height:4rem;">
                                            <img src="<?php echo  base_url("public/uploads/product_images/" . $product->product_image) ?>" alt="">
                                        </div>
                                        <?php foreach ($product_images as $key => $value) { ?>
                                            <div class="photos-item d-flex justify-content-center align-items-center" style="height:4rem;">
                                                <img src="<?php echo  base_url("/public/uploads/product_images/" . $value->product_image) ?>" height='' alt="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="col-md-8 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h2 class="box-title mt-0"><?php echo  $product->title ?></h2>
                                            <div class="list-inline">
                                                <div>
                                                    <span class='badge badge-pill badge-success'>
                                                        <?php echo  to_fixed($product->rating, 1) ?>
                                                        <i class='mdi mdi-star'></i>
                                                    </span>

                                                    <span style='color: #878787;'>
                                                        <span>27 Ratings</span>
                                                        <span>&</span>
                                                        <span>6 Reviews</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <h1 class="pro-price mb-0 mt-20">₹<?php echo  fmt_amt($sale_price) ?>
                                                <?php if ($product->discount) { ?>
                                                    <span class="old-price">₹
                                                        <?php echo  $product->mrp ?>
                                                    </span>
                                                    <span class="text-danger"><?php echo  $product->discount ?>% off</span>
                                                <?php } ?>
                                            </h1>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo  base_url("public/uploads/qrcodes/" . $product->qr_code_img) ?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <p><?php echo  $product->product_details ?></p>
                                    <hr>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-success me-2">
                                            <i class="mdi mdi-shopping"></i> Buy Now!
                                        </a>
                                        <div class='me-2'>
                                            <a href='#' onclick="add_to_cart(<?php echo  $product->id ?>,this)" class="btn btn-primary" style='display:<?php echo  $exist_in_cart ? 'none' : '' ?>'><i class="mdi mdi-cart-plus btn-add-to-cart"></i> Add
                                                To Cart</a>

                                            <a href="<?php echo  base_url("cart") ?>" class="btn btn-primary btn-go-to-cart" style='display:<?php echo  $exist_in_cart ? '' : 'none' ?>'><i class="mdi mdi-cart"></i> Go To Cart</a>
                                        </div>

                                        <a href="#" class='btn btn-secondary px-3 py-2 <?php echo  $exist_in_wishlist ? 'text-danger' : '' ?>' onclick='add_to_wishlist(<?php echo  $product->id ?>,this)'><i class='mdi <?php echo  $exist_in_wishlist ? 'mdi-heart' : 'mdi-heart-outline' ?> fa-lg'></i></a>

                                    </div>
                                    <?php if ($product->key_highlights) { ?>
                                        <h4 class="box-title mt-20">Key Highlights</h4>
                                        <?php echo  $product->key_highlights ?>
                                    <?php } ?>
                                    <div>
                                        <h4 class="box-title mt-40">General Info</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <?php foreach ($general_info as $key => $value) { ?>
                                                        <tr>
                                                            <td width="390"><?php echo  format_name($value->label) ?></td>
                                                            <td><?php echo  format_name($value->value) ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="card " style='border-radius:0px'>
                                            <div class="card-header" style='border-bottom:0px'>
                                                <h4 class="col-md-8" style='font-size:22px'> Ratings & Reviews</h4>
                                                <a href=" <?php echo  base_url("/products/rating_review_product?pid=$product->id") ?>" class='btn btn-sm bg-light'>Rate Product</a>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="width">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class='text-center' style='font-size:25px'>
                                                                    <?php echo  to_fixed($product->rating, 1) ?>
                                                                    <i class='mdi mdi-star'></i>
                                                                </div>
                                                                <div class='text-center' style='color: #878787;'>
                                                                    <span>Ratings</span>
                                                                    <span>&</span>
                                                                    <span>Reviews</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9" style='border-right: 1px solid #f0f0f0;'>
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <ul style='font-size: 10px;'>
                                                                            <li>
                                                                                <div>5 <i class='mdi mdi-star'>
                                                                                    </i>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div>4 <i class='mdi mdi-star'>
                                                                                    </i></div>
                                                                            </li>
                                                                            <li>
                                                                                <div>3 <i class='mdi mdi-star'>
                                                                                    </i></div>
                                                                            </li>
                                                                            <li>
                                                                                <div>2 <i class='mdi mdi-star'>
                                                                                    </i></div>
                                                                            </li>
                                                                            <li>
                                                                                <div>1 <i class='mdi mdi-star'>
                                                                                    </i></div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <?php $highest = max($all_ratings); ?>
                                                                        <ul>
                                                                            <?php for ($i = 5; $i > 0; $i--) : ?>
                                                                                <li>
                                                                                    <div class="progress progress-xs" style='margin-top: 12px;'>
                                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ($all_ratings[$i] / $highest) * 100 ?>%;">
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php endfor; ?>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <ul>
                                                                            <?php for ($i = 5; $i > 0; $i--) : ?>
                                                                                <li> <?php echo  $all_ratings[$i] ?></li>
                                                                            <?php endfor; ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="width1">
                                                        <div class="box-body">
                                                            <div class="d-flex justify-content-evenly">
                                                                <div>
                                                                    <div id="progressbar1" class="w-100 text-center position-relative">
                                                                        <span style='font-size: 14px;'>3.8</span>
                                                                    </div>
                                                                    <span>Performance</span>
                                                                </div>
                                                                <div>
                                                                    <div id="progressbar2" class="w-100 text-center position-relative">
                                                                        <span style='font-size: 14px;'>3.9</span>
                                                                    </div>
                                                                    <span style="margin-left: 23px;">Design</span>
                                                                </div>
                                                                <div>
                                                                    <div id="progressbar3" class="w-100 text-center position-relative">
                                                                        <span style='font-size: 14px;'>4.0</span>
                                                                    </div>
                                                                    <span>Value for Money</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->


<?php echo view('frontend/include/footer') ?>

<script src="<?php echo  base_url('public/assets/vendor_components/progressbar.js-master/dist/progressbar.js') ?>"></script>

<script src='<?php echo  base_url('public/frontend/custom/js/product_details.js') ?>'></script>
<script>
    var bar = new ProgressBar.Circle(progressbar1, {
        color: '#ffffff',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 10,
        trailWidth: 5,
        trailColor: '#4dae47',
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        from: {
            color: '#ffffff',
            width: 5
        },
        to: {
            color: '#ffffff',
            width: 5
        },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 150);
            if (value === 0) {
                circle.setText('');
            } else {
                circle.setText(value);
            }

        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '2rem';

    bar.animate(3.8);



    var bar = new ProgressBar.Circle(progressbar2, {
        color: '#f7f8f9',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 10,
        trailWidth: 5,
        trailColor: '#4dae47',
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        from: {
            color: '#f7f8f9',
            width: 5
        },
        to: {
            color: '#f7f8f9',
            width: 5
        },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 150);
            if (value === 0) {
                circle.setText('');
            } else {
                circle.setText(value);
            }

        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '2rem';

    bar.animate(3.9);



    var bar = new ProgressBar.Circle(progressbar3, {
        color: '#ffffff',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 10,
        trailWidth: 5,
        trailColor: '#4dae47',
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        from: {
            color: '#ffffff',
            width: 5
        },
        to: {
            color: '#ffffff',
            width: 5
        },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 150);
            if (value === 0) {
                circle.setText('');
            } else {
                circle.setText(value);
            }

        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '2rem';

    bar.animate(3.92);
</script>