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

.rating-bars {
    list-style-type: none;
}

.progress-xs {
    border-radius: 5px;
    height: 4px;
}
</style>

<!-- Main content -->
<section class="content pt-120">
    <div class="row">
        <div class="col-lg-12">
            <div class="box no-shadow">
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" id='pro_id' value='<?php echo $details['product']->id ?>'>
                        <div class="col-md-4 col-sm-6">
                            <div class="col-md-10 box box-body b-1 text-center no-shadow d-flex justify-content-center align-items-center"
                                style="height:20rem;">
                                <?php foreach ($details["product_images"] as $key => $value) {?>
                                <?php if ($value->is_default) {?>
                                <img src="<?php echo $value->product_image ?>" id="product-image" class="" alt=""
                                    style='max-width:100%;max-height:100%;' />
                                <?php }
}?>
                            </div>
                            <div class="pro-photos">
                                <?php foreach ($details["product_images"] as $key => $value) {?>
                                <div class="photos-item <?php echo $value->is_default ? 'item-active' : "" ?> d-flex justify-content-center align-items-center"
                                    style="height:4rem;">
                                    <img src="<?php echo $value->product_image ?>" height='' alt="">
                                </div>
                                <?php }?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <div class="row">
                                <div class="col-md-10">
                                    <h2 class="box-title mt-0"><?php echo $details["product"]->title ?></h2>
                                    <div class="list-inline">
                                        <div>
                                            <?php if ($details["reviews_count"]->count) {?>
                                            <a href="#review-section" class='badge badge-pill badge-success'>
                                                <i class='mdi mdi-star'></i>
                                                <?php echo to_fixed($details["product"]->rating, 1) ?>
                                            </a>
                                            <span style='color: #878787;'>
                                                <span><?php echo $details["reviews_count"]->count ?> Ratings</span>
                                                <!-- <span>&</span>
                                                <span>6 Reviews</span> -->
                                            </span>
                                            <?php } else {?>
                                            <a href='#review-section' class='badge badge-pill badge-secondary'>
                                                No Reviews
                                            </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <h1 class="pro-price mb-0 mt-20">
                                        ₹<?php echo fmt_amt($details["sale_price"]) ?>
                                        <?php if ($details["product"]->discount) {?>
                                        <span class="old-price">₹
                                            <?php echo $details["product"]->mrp ?>
                                        </span>
                                        <span class="text-danger"><?php echo $details["product"]->discount ?>%
                                            off</span>
                                        <?php }?>
                                    </h1>
                                </div>
                                <div class="col-md-2">
                                    <img src="<?php echo $details["product"]->qr_code_img ?>">
                                </div>
                            </div>
                            <hr>
                            <p><?php echo $details["product"]->product_details ?></p>
                            <hr>
                            <div class="d-flex">
                                <a href="#" class="btn btn-success me-2">
                                    <i class="mdi mdi-shopping"></i> Buy Now!
                                </a>
                                <div class='me-2'>
                                    <a href='#' onclick="add_to_cart(<?php echo $details['product']->id ?>,this)"
                                        class="btn btn-primary"
                                        style='display:<?php echo $details["exist_in_cart"] ? 'none' : '' ?>'><i
                                            class="mdi mdi-cart-plus btn-add-to-cart"></i> Add
                                        To Cart</a>

                                    <a href="<?php echo base_url("cart") ?>" class="btn btn-primary btn-go-to-cart"
                                        style='display:<?php echo $details["exist_in_cart"] ? '' : 'none' ?>'><i
                                            class="mdi mdi-cart"></i> Go To Cart</a>
                                </div>

                                <a href="#" class='btn btn-danger'
                                    onclick='add_to_wishlist(<?php echo $details["product"]->id ?>,this)'><i
                                        class='mdi <?php echo $details["exist_in_wishlist"] ? 'mdi-heart' : 'mdi-heart-outline' ?> fa-lg'></i>
                                    Favorite</a>

                            </div>
                            <?php if ($details["product"]->key_highlights) {?>
                            <h4 class="box-title mt-20">Key Highlights</h4>
                            <?php echo $details["product"]->key_highlights ?>
                            <?php }?>
                            <div>
                                <h4 class="box-title mt-40">General Info</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <?php foreach ($details["general_info"] as $key => $value) {?>
                                            <tr>
                                                <td width="390"><?php echo format_name($value->label) ?></td>
                                                <td><?php echo format_name($value->value) ?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <section id='review-section'>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="col-md-8 p-0" style='font-size:22px'> Ratings & Reviews</h4>
                                        <?php $prod_id = $details["product"]->id;?>
                                        <a href=" <?php echo base_url("/products/rating_review_product?pid=$prod_id") ?>"
                                            class='btn btn-sm btn-success'>Rate Product</a>
                                    </div>
                                    <?php if ($details["reviews_count"]->count): ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="width">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class='text-center' style='font-size:30px'>
                                                            <?php echo to_fixed($details["product"]->rating, 1) ?>
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
                                                            <?php //prd($details["all_ratings"])
?>
                                                            <div class='col-md-12 row'>
                                                                <?php $highest = max($details["all_ratings"]) ?: 1;?>
                                                                <ul class='rating-bars'>
                                                                    <?php foreach ($details["all_ratings"] as $k => $v): ?>
                                                                    <?php $width = ($v / $highest) * 100;
$color = '';
$color = 'bg-success';?>
                                                                    <li>
                                                                        <div class='d-flex align-items-center'>
                                                                            <div class='me-2'>
                                                                                <?php echo $k; ?> <i
                                                                                    class='mdi mdi-star'></i>
                                                                            </div>
                                                                            <div class="progress progress-xs mb-0 me-2"
                                                                                style='width:250px;'>
                                                                                <div class="progress-bar <?php echo $color ?>"
                                                                                    role="progressbar"
                                                                                    style="width: <?php echo $width ?>%;">
                                                                                </div>
                                                                            </div>
                                                                            <div> <?php echo $v; ?></div>
                                                                        </div>
                                                                    </li>
                                                                    <?php endforeach;?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ($details["last_month_reviews"] as $key => $value) {
    $araa = array(0, 1, 2, 3)?>
                                        <?php if (in_array($key, $araa)) {?>
                                        <?php $css = '';
        $rating = [1, 2];
        if (in_array($value->rating_rate, $rating)) {
            $css = "badge-danger";
        } else {
            $css = "badge-success";
        }?>
                                        <hr>
                                        <div class="row g-0">
                                            <div class="col-md-12 col-12">
                                                <div class="box-body">
                                                    <div class="list-inline">
                                                        <div class="row">
                                                            <div class='' style='width:7%;'>
                                                                <span class='badge badge-pill <?php echo $css ?>'>
                                                                    <?php echo to_fixed($value->rating_rate, 1) ?>
                                                                    <i class='mdi mdi-star'></i>
                                                                </span>
                                                            </div>
                                                            <div class='' style='width: 90%;'>
                                                                <span style='color: #878787;'>
                                                                    <h4><?php echo $value->title ?></h4>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mb-10">
                                                        <div class="me-10">
                                                            <i class="fa fa-user me-5"></i>
                                                            <?php echo $value->full_name ?>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-calendar me-5"></i>
                                                            <?php echo $value->created_at ?>
                                                        </div>
                                                    </div>
                                                    <p><?php echo $value->description ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
}?>
                                        <div>
                                            <?php $prod_id = $details["product"]->id;?>
                                            <a
                                                href="<?php echo base_url("/products/all_review_product?pid=$prod_id") ?>">
                                                <span>All Review
                                                    <?php echo $details["reviews_count"]->count ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="card-body">
                                        <h4 class='text-secondary'>No Reviews</h4>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /.content -->