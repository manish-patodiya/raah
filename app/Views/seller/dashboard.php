<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="box box-body">
                        <h6>
                            <span class="text-uppercase fs-18">Revenue</span>
                            <span class="float-end"><a class="btn btn-xs btn-primary-light" href="<?php echo base_url("seller/products"); ?>">View</a></span>
                        </h6>
                        <br>
                        <p class="fs-26">Rs.845,1258</p>

                        <div class="progress progress-xxs mt-0 mb-10">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 35%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="fs-12"><i class="ion-arrow-graph-down-right text-primary me-1"></i> %18 decrease
                            from last month</div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-xl-4 col-12">
                    <div class="box box-body">
                        <h6>
                            <span class="text-uppercase fs-18">Products Sold</span>
                            <span class="float-end"><a class="btn btn-xs btn-danger-light" href="<?php echo base_url("seller/products"); ?>">View</a></span>
                        </h6>
                        <br>
                        <p class="fs-26">586</p>

                        <div class="progress progress-xxs mt-0 mb-10">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 55%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="fs-12"><i class="ion-arrow-graph-down-right text-danger me-1"></i> %95 down</div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="box box-body">
                        <h6>
                            <span class="text-uppercase fs-18">Total Products</span>
                            <span class="float-end">
                                <a class="btn btn-xs btn-info-light" href="<?php echo base_url("seller/products"); ?>">View</a>
                            </span>
                        </h6>
                        <br>
                        <p class="fs-26">89</p>

                        <div class="progress progress-xxs mt-0 mb-10">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 52%; height: 4px;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="flexbox fs-12">
                            <span><i class="ion-arrow-graph-down-right text-info me-1"></i>4 Added last week</span>
                            <span>5 Out of Stock</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-xl-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Purchase By Week</h4>
                        </div>
                        <div class="box-body py-0">
                            <div id="hour-data"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Inventory Stock</h4>
                        </div>
                        <div class="box-body">
                            <div id="recent_trend"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>

<?php
echo view('seller/include/footer.php');
?>
<script src="<?php echo  base_url('public/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') ?>"></script>
<script src="<?php echo  base_url('public/assets/vendor_components/progressbar.js-master/dist/progressbar.js') ?>"></script>

<script>
    document.getElementById('e').value = new Date().toISOString().substring(0, 10);
</script>
<script src="<?php echo  base_url('public/js/pages/dashboard3.js') ?>"></script>