<?php
echo view('frontend/include/header_top');
echo view('frontend/include/header');
echo view('frontend/include/navbar');
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

    p {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-120">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <?php if ($count) : ?>
                <div class="row">
                    <div style='width:22%;'>
                        <div class='border'>
                            <div class='card-header' style='border-top-left-radius: 10px;border-top-right-radius: 10px;background-color: #d2d6e5 !important;color: black'>
                                <h4 class='m-0'>Filters</h4>
                            </div>
                            <div class='card-body p-3' id='attr-filter'>
                            </div>
                        </div>
                    </div>
                    <div class="col px-2" style='min-height:80vh;'>
                        <div class="content-header">
                            <div class="d-flex with-border">
                                <div class="col-md-10" id='filters-chips'>
                                    <!-- <div class="chip mt-2 mb-0">
                                    <i class="fa fa-filter"></i> Brand: Dell
                                    <a href="<?php echo base_url('products') ?>"><i class="fa fa-close"></i></a>
                                </div>
                                <div class="chip mt-2 mb-0">
                                    <i class="fa fa-inr"></i> Sort: Price(Low to High)
                                    <a href="<?php echo base_url('products') ?>"><i class="fa fa-close"></i></a>
                                </div> -->
                                </div>
                                <div class="col-md-2">
                                    <div class="mt-2 mb-0">
                                        <button type="button" class="waves-effect waves-light btn btn-primary-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" style="width:130px"><i class="fa fa-sort"></i> Sort
                                            By</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Most Popular</a>
                                            <a class="dropdown-item" href="#">Price: Low to High</a>
                                            <a class="dropdown-item" href="#">Price: Low to High</a>
                                            <a class="dropdown-item" href="#">Newest First</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row fx-element-overlay' id='products'></div>
                    </div>
                </div>
                <div class='mt-3'>
                    <ul id="pagination" class="pagination align-items-center justify-content-center"></ul>
                </div>
            <?php else : ?>
                <?php if (!$is_wishlist) : ?>
                    <div class='card'>
                        <div class='card-body d-flex justify-content-center align-items-center flex-column'>
                            <img src="<?php echo base_url('public/images/no-product-found.png') ?>" style="" alt="">
                            <h3 style='font-weight:500'>Sorry, no result found!</h3>
                            <h4 class='text-light'>Please check the spelling or try searching for something else</h4>
                        </div>
                    </div>
                <?php else : ?>
                    <div class='card'>
                        <div class='card-body d-flex justify-content-center align-items-center flex-column'>
                            <img src='<?php echo base_url('public/images/empty-wishlist.png') ?>' height='200' />
                            <div class='d-flex flex-column align-items-center'>
                                <h4>Empty Wishlist.</h4>
                                <p>You have no items in your wishlist. Start adding!</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <!-- /.content -->

        <form onsubmit='return false' id='frm-filters'>
            <?php if ($search) { ?>
                <input type="hidden" name='search' value='<?php echo $search ?>' />
            <?php } ?>

            <?php if ($category) { ?>
                <input type="hidden" name='cat' value='<?php echo $category ?>' />
            <?php } ?>

            <?php if ($is_wishlist) { ?>
                <input type="hidden" name='wishlist' value='<?php echo $is_wishlist ?>' />
            <?php } ?>

            <input type="hidden" name='page' value='<?php echo $page ?: 1 ?>' id='inpt-page' />

            <input type="hidden" name='filters' id='inpt-filters' value='<?php echo $filters ?>' />
        </form>
    </div>
</div>
<!-- /.content-wrapper -->

<?php echo view('frontend/include/footer') ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js'></script>

<script>
    $(function() {
        let count = <?php echo $count ?: 0 ?>;
        products.filters.set(JSON.parse('<?php echo $filters; ?>'));
        if (count) {
            products.search();
        }
    })
</script>

<script src='<?php echo base_url('public/frontend/custom/js/products.js') ?>'></script>