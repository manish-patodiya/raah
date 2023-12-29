<?php
//echo view('frontend/include/navbar');
$is_wishlist = isset($request_data['wishlist']) && $request_data['wishlist'] ? 1 : '';
$search = isset($request_data['search']) ? $request_data['search'] : '';
$category = isset($request_data['cat']) ? $request_data['cat'] : '';
$page = isset($request_data['page']) ? $request_data['page'] : '';

$filters = isset($request_data['filters']) ? $request_data['filters'] : '{}';
?>

<style>
#attr-filter li {
    list-style: none;
}

#products p {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.badge-chip {
    font-weight: 500 !important;
    background-color: #ebebeb !important;
    color: #757575;
}

.badge-chip a {
    color: #757575;
}

a.page-link {
    width: 100%;
    height: 100%;
    display: flex !important;
    justify-content: center;
    align-items: center;
}

.tooltip-inner {
    color: black !important;
}
</style>

<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<section class="content pt-170">
    <?php echo view('frontend/include/nav-cat.php'); ?>
    <?php if ($count): ?>
    <div class="row" style='min-height:70vh'>
        <div class="col-lg-3 col-md-4 col-12">
            <div class="side-block px-20 py-10 bg-white">
                <div class="widget courses-search-bx placeholdertx mb-10">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="form-label">Search...</label>
                            <input name="name" type="text" required="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="widget">
                    <h4 class="pb-15 mb-15 bb-1">Filters</h4>
                    <div class="media-list media-list-divided">
                        <!-- price filter -->
                        <div>
                            <span class="px-0 py-2 media  pointer collapse-btn" data-bs-toggle="collapse"
                                data-bs-target="#div-price-slider" aria-controls='div-price-slider'>
                                <span class="title ms-0">Price</span>
                                <i class="fa fa-angle-down"></i>
                            </span>
                            <div class='my-1 px-10 collapse' id='div-price-slider'>
                                <input type='hidden' id='price-slider'></input>
                            </div>
                        </div>

                        <!-- discount filter -->
                        <div>
                            <span class="px-0 py-2 media  pointer collapse-btn" data-bs-toggle="collapse"
                                data-bs-target="#div-dis-slider" aria-controls='div-dis-slider'>
                                <span class="title ms-0">Discount</span>
                                <i class="fa fa-angle-down"></i>
                            </span>
                            <div class='my-1 px-10 collapse' id='div-dis-slider'>
                                <input type='hidden' id='dis-slider'></input>
                            </div>
                        </div>

                        <!-- discount filter -->
                        <div id='attr-filter'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col px-2">
            <div class="content-header p-0 pb-3">
                <div class="row mb-2 align-items-center">
                    <div class="col-md-2 text-left" id='ttl-prod-cnt'>
                        <?php echo $data['prod_count'] ?: 'No' ?> products found
                    </div>
                    <div class="col-md-8" id='filters-chips'></div>
                    <div class="col-md-2">
                        <select class="selectpicker" data-style="btn-primary-light py-1" id="slct-sort">
                            <option value="0">Sort By</option>
                            <option value="1">Most Popular</option>
                            <option value="2">Price: Low to High</option>
                            <option value="3">Price: High to Low</option>
                            <option value="4">Newest First</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class='row fx-element-overlay' id='products'>
            </div>
        </div>
        <div class='mt-3'>
            <ul id="pagination" class="pagination align-items-center justify-content-center"></ul>
        </div>
    </div>
    <?php else: ?>
    <?php if (!$is_wishlist): ?>
    <div class='card-body d-flex justify-content-center align-items-center flex-column my-100'>
        <img src="<?php echo base_url('public/images/no-product-found.png') ?>" style="" alt="">
        <h3 style='font-weight:500'>No Result Found!</h3>
        <h4 class='text-light'>Please check the spelling or try searching for something else</h4>
    </div>
    <?php else: ?>
    <div class='card'>
        <div class='card-body d-flex justify-content-center align-items-center flex-column'>
            <img src='<?php echo base_url('public/images/empty-wishlist.png') ?>' height='200' />
            <div class='d-flex flex-column align-items-center'>
                <h4>Empty Wishlist.</h4>
                <p>You have no items in your wishlist. Start adding!</p>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php endif;?>
</section>
<!-- /.content -->

<form onsubmit='return false' id='frm-filters'>
    <?php if ($search) {?>
    <input type="hidden" name='search' value='<?php echo $search ?>' />
    <?php }?>

    <?php if ($category) {?>
    <input type="hidden" name='cat' value='<?php echo $category ?>' />
    <?php }?>

    <?php if ($is_wishlist) {?>
    <input type="hidden" name='wishlist' value='<?php echo $is_wishlist ?>' />
    <?php }?>

    <input type="hidden" name='page' value='<?php echo $page ?: 1 ?>' id='inpt-page' />

    <input type="hidden" name='filters' id='inpt-filters' value='<?php echo $filters ?>' />
</form>