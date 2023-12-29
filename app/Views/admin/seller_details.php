<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
$store_name = '';
?>
<style>
    table,
    th,
    td {
        border: 1px groove gainsboro;
        border-radius: 5px;
    }

    th,
    td {
        padding: 4px;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-plus'></i> <?php echo trans('sellers_list') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <?php if (check_method_access('sellers', 'add', true)) : ?>
                        <a href="#" id='add-user' class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                            <?php echo trans('create_seller') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <!-- <div class='card'>
                        <div class="card-body"> -->
                    <div class="col-12">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="box p-30 pt-50 text-center">
                                        <div>
                                            <a class="avatar avatar-xxl status-success mb-3 bg-transparent" href="#">
                                                <img src="<?php echo $seller_info->profile_photo ? $seller_info->profile_photo : base_url("/public/images/avatar/avatar-1.png") ?>" class="rounded-circle bg-primary-light" alt="...">
                                            </a>
                                        </div>
                                        <h5 class="mt-5 "><a class="text-default hover-primary" href="#"><?php echo $seller_info->full_name ?>
                                            </a></h5>
                                        <p><small class="fs-12"><?php echo $seller_info->phone ?>,
                                                <?php echo $seller_info->email ?></small></p>
                                        <p class="text-fade fs-12 mb-50"><?php echo $seller_info->address ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <div class="box box-widget widget-user-4">
                                        <div class="widget-user-header <?php echo ($seller_info->status == 1 ? 'bg-info' : $seller_info->status == 2) ? 'bg-danger' : ($seller_info->status == 0 ? 'bg-warning' : 'bg-danger') ?>">
                                            <div class="overlay overlay-none">
                                                <h3 class="widget-user-username" id="store_name">Store Details
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <ul class="nav d-block nav-stacked store_details">
                                                    <?php foreach ($store_info as $k => $v) {
                                                        switch ($k) {
                                                            case 'user_id':
                                                                break;
                                                            case 'state_id':
                                                                break;
                                                            case 'city_id':
                                                                break;
                                                            case 'status':
                                                                break;
                                                            default: ?>
                                                                <li class="nav-item"><a href="#" class="nav-link"><?php echo $k ?><span class="pull-right badge bg-info-light"><?php echo $v ?>
                                                                        </span></a></li>
                                                    <?php break;
                                                        }
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="box-footer" style="padding:10px 35px;">
                                            <?php switch ($seller_info->status) {
                                                case 0: ?>
                                                    <button type="submit" class="btn btn-warning pull-right ms-3" id="approve-btn" store_id=<?php echo $seller_info->sid ?> onclick="change_status('#approve-btn')">
                                                        <?php echo trans('approve') ?>
                                                    </button>
                                                    <button type="submit" class="btn btn-danger pull-right ms-3" id="reject-btn" store_id=<?php echo $seller_info->sid ?> onclick="change_status('#reject-btn')">
                                                        <?php echo trans('reject') ?>
                                                    </button>
                                                <?php break;
                                                case 1: ?>
                                                    <button type="submit" class="btn btn-danger pull-right ms-3" id="reject-btn" store_id=<?php echo $seller_info->sid ?> onclick="change_status('#reject-btn')">
                                                        <?php echo trans('reject') ?>
                                                    </button>
                                                <?php break;
                                                case 2: ?>
                                                    <button type="submit" class="btn btn-warning pull-right ms-3" id="approve-btn" store_id=<?php echo $seller_info->sid ?> onclick="change_status('#approve-btn')">
                                                        <?php echo trans('approve') ?>
                                                    </button>
                                            <?php break;
                                            } ?>
                                            <!-- <div class="pull-right ms-2">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
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
echo view('admin/include/footer');
?>

<script src="<?php echo base_url('public/custom/js/sellers.js') ?>"></script>