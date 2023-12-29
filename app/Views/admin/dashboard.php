<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between">
                                <h2 class="my-0 fw-600 text-primary">10+</h2>
                                <div class="w-40 h-40 bg-primary rounded-circle text-center fs-24 l-h-40"><i class="fa fa-inbox"></i></div>
                            </div>
                            <p class="fs-18 mt-10">Total Shelfs</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between">
                                <h2 class="my-0 fw-600 text-warning">3432+</h2>
                                <div class="w-40 h-40 bg-warning rounded-circle text-center fs-24 l-h-40"><i class="fa fa-shopping-bag"></i></div>
                            </div>
                            <p class="fs-18 mt-10">New Order</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between">
                                <h2 class="my-0 fw-600 text-info">Rs. 532k</h2>
                                <div class="w-40 h-40 bg-info rounded-circle text-center fs-24 l-h-40"><i class="fa fa-dollar"></i></div>
                            </div>
                            <p class="fs-18 mt-10">Total Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex justify-content-between">
                                <h2 class="my-0 fw-600 text-danger">2453</h2>
                                <div class="w-40 h-40 bg-danger rounded-circle text-center fs-24 l-h-40"><i class="fa fa-dropbox"></i></div>
                            </div>
                            <p class="fs-18 mt-10">Units Sold</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Top Cities</h4>
                        </div>
                        <div class="box-body py-0">
                            <div id="topcities"></div>
                        </div>
                        <div class="box-footer">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <p class="mb-0 me-10">Show</p>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary-light dropdown-toggle" type="button" data-bs-toggle="dropdown">5 Result</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">10 Result</a>
                                            <a class="dropdown-item" href="#">15 Result</a>
                                            <a class="dropdown-item" href="#">20 Result</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <p class="mb-0 me-10">Short By</p>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary-light dropdown-toggle" type="button" data-bs-toggle="dropdown">Order</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Delivery Date</a>
                                            <a class="dropdown-item" href="#">Payment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                <div class="col-xl-8 col-12">
                    <div class="box position-static">
                        <div class="box-header">
                            <h4 class="box-title">Section Overview</h4>
                            <div class="box-controls pull-right">
                                <input class="form-control no-border bg-lightest" id="e" type="date">
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row mb-20">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <div class="w-40 h-40 m-5"> </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <div class="w-40 h-40 m-5"> </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <div class="w-40 h-40 m-5"> </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="row g-0 row-cols-auto">
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <div class="w-40 h-40 m-5"> </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning-light d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Empty</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="section-bx">
                                                <a href="#" class="w-40 h-40 m-5 bg-warning d-block rounded10">
                                                    <div class="bx-dec">
                                                        <div class="section-dec d-flex align-items-center">
                                                            <div class="box-img">
                                                                <img src="<?php echo  base_url('public/images/box.png') ?>" class="img-fluid" alt="" />
                                                            </div>
                                                            <div class="dec">
                                                                <h4 class="text-white my-0">Row 3 #124578</h4>
                                                                <p class="text-white">H60 x W60 x 20 KG</p>
                                                                <p class="mb-0 text-white-50">Delivered 06:15PM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-20">
                                <div class="d-flex">
                                    <div class="w-20 h-20 bg-warning-light rounded"></div>
                                    <h5 class="mx-15 my-0">Free Place</h5>
                                </div>
                                <div class="d-flex">
                                    <div class="w-20 h-20 bg-warning rounded"></div>
                                    <h5 class="mx-15 my-0">Loaded Place</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="box overflow-h">
                        <div class="box-header no-border">
                            <h4 class="box-title">Revenue Overview</h4>
                            <ul class="box-controls pull-right">
                                <li class="dropdown">
                                    <a data-bs-toggle="dropdown" href="#" class="btn btn-success-light px-10 base-font">Export</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box-body py-0">
                            <div class="row">
                                <div class="col-6">
                                    <div class="py-10">
                                        <div class="text-fade fw-600">Average Profit</div>
                                        <div class="fs-18 fw-600">Rs.150K</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-10">
                                        <div class="text-fade fw-600">Revenue</div>
                                        <div class="fs-18 fw-600">Rs.15,250k</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-10">
                                        <div class="text-fade fw-600">Taxes</div>
                                        <div class="fs-18 fw-600">Rs.50k</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-10">
                                        <div class="text-fade fw-600">Yearly Income</div>
                                        <div class="fs-18 fw-600">Rs.44,850k</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body p-0">
                            <div id="revenue4" class="text-dark min-h-auto"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="box" id="bt-sellers">
                        <div class="box-header">
                            <h4 class="box-title">
                                Best Sellers This Quarter
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="inner-user-div3">
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Kelly Bookshelf</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">124 Units</h3>
                                            <p class="mb-0"><span>Rs.588 per unit</span> | <strong>Rs.72,931</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Darcy Side Table</h5>
                                            <p class="mb-0">BR 3039</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">107 Units</h3>
                                            <p class="mb-0"><span>Rs.188 per unit</span> | <strong>Rs.20,116</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Clarissa Chaise</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">102 Units</h3>
                                            <p class="mb-0"><span>Rs.980 per unit</span> | <strong>Rs.99,960</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Sheffield Bedframe</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">98 Units</h3>
                                            <p class="mb-0"><span>Rs.140 per unit</span> | <strong>Rs.37,200</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Amelia Floorlamp</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">93 Units</h3>
                                            <p class="mb-0"><span>Rs.110 per unit</span> | <strong>Rs.10,230</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Kelly Bookshelf</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">124 Units</h3>
                                            <p class="mb-0"><span>Rs.588 per unit</span> | <strong>Rs.72,931</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Darcy Side Table</h5>
                                            <p class="mb-0">BR 3039</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">107 Units</h3>
                                            <p class="mb-0"><span>Rs.188 per unit</span> | <strong>Rs.20,116</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Clarissa Chaise</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">102 Units</h3>
                                            <p class="mb-0"><span>Rs.980 per unit</span> | <strong>Rs.99,960</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Sheffield Bedframe</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">98 Units</h3>
                                            <p class="mb-0"><span>Rs.100 per unit</span> | <strong>Rs.17,200</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-shadowed p-10 mb-10 rounded10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="my-5">Amelia Floorlamp</h5>
                                            <p class="mb-0">BR 8129</p>
                                        </div>
                                        <div>
                                            <h3 class="my-5">93 Units</h3>
                                            <p class="mb-0"><span>Rs.110 per unit</span> | <strong>Rs.10,230</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">list of sections</h4>
                        </div>
                        <div class="box-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 001</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 20%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">20%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 002</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 28%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">28%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 003</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">80%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 004</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">50%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 005</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 58%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">58%</td>
                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)">Section 006</a></td>
                                        <td><span class="text-muted text-nowrap"><i class="fa fa-calendar-o text-success-light mx-5"></i>
                                                05-12-2021</span> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mx-5">Used</span>
                                                <div class="progress progress-xs w-p100 mt-0">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 36%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">36%</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Average Inventory Turnaround</h4>
                        </div>
                        <div class="box-body py-0">
                            <div id="overview_trend"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('admin/include/footer.php');
?>
<script src="<?php echo  base_url('public/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') ?>"></script>
<script src="<?php echo  base_url('public/assets/vendor_components/progressbar.js-master/dist/progressbar.js') ?>"></script>

<script src="<?php echo  base_url('public/js/pages/dashboard2.js') ?>"></script>