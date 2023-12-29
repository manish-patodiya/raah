<style>
ul {
    list-style-type: none;
    padding-left: 0rem;
}

.progress-xs {
    border-radius: 5px;
    height: 4px;
}

.w-84 {
    width: 84px !important;
}

a.page-link {
    width: 100%;
    height: 100%;
    display: flex !important;
    justify-content: center;
    align-items: center;
}
</style>

<script>
let pro_id = <?php echo $details["product_id"] ?>;
let page_count = <?php echo isset($details['page_count']) ? $details['page_count'] : '' ?>;
</script>

<section class="content pt-120">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-12">
            <div class="side-block px-20 py-10 bg-white">
                <div class="" style="max-width :300px;max-height: 300px;">
                    <div class="d-flex justify-content-center">
                        <?php if (@getimagesize($details["product_data"]->product_image)): ?>
                        <img src="<?php echo $details["product_data"]->product_image; ?>" alt="">
                        <?php endif;?>
                    </div>
                </div>

                <div class="" style='padding-top:50px;'>
                    <hr>
                    <div class="row">
                        <?php foreach ($details["img"] as $key => $value) {?>
                        <?php if (@getimagesize($value->images)): ?>
                        <div class="col-3 m-2" style="max-width :80px;max-height: 80px;">
                            <img src="<?php echo $value->images ?>" alt="">
                        </div>
                        <?php endif;?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-8 col-12">
            <div class="side-block px-20 py-10 bg-white">
                <div class="row">
                    <h1 class='m-5'><?php echo $details["product_data"]->title; ?></h1>
                </div>
                <hr>
                <div class="row">
                    <div class="row">
                        <div class="col-md-3">
                            <div class='text-center' style='font-size:25px'>
                                <?php echo to_fixed($details["product_data"]->rating, 1) ?>
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
                                <?php //prd($details["all_ratings"])?>
                                <div class='col-md-12 row'>
                                    <?php $highest = max($details["all_ratings"] ? $details["all_ratings"] : '');?>
                                    <ul class='rating-bars'>
                                        <?php foreach ($details["all_ratings"] as $k => $v): ?>
                                        <?php $width = ($v / $highest) * 100;
$color = '';
$color = 'bg-success';?>
                                        <li>
                                            <div class='d-flex align-items-center'>
                                                <div class='me-2'>
                                                    <?php echo $k; ?> <i class='mdi mdi-star'></i>
                                                </div>
                                                <div class="progress progress-xs mb-0 me-2" style='width:250px'>
                                                    <div class="progress-bar <?php echo $color ?>" role="progressbar"
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
                <div id='review_product'></div>
                <ul id="pagination" class="pagination align-items-center justify-content-center"></ul>
            </div>
        </div>
    </div>
</section>