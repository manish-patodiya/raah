<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400 !important;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><?php echo trans('profile') ?></h4>
                </div>
                <a href='#' onclick="history.back();" class="pull-right me-2">
                    <i class="fa fa-long-arrow-left"></i> <?php echo trans('back') ?>
                </a>

            </div>
        </div>

        <div class="alert alert-danger" id="validation-err" style="display: none;"></div>
        <div class="alert alert-danger" id="change-pass-err" style="display: none;"></div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4">
                    <div class="box box-widget widget-user">
                        <form class="form-horizontal form-element col-12" id="user_profile_updete_detail" onsubmit="return false">
                            <?php echo csrf_field(); ?>
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class=" d-flex flex-column align-items-center justify-content-center">
                                        <div class='d-flex bg-secondary  align-items-center justify-content-center mb-2' style='height: 200px; width:200px;'>
                                            <img src="<?php echo $info->profile_photo ?: base_url('public/images/avatar/avatar-1.png') ?>" id="logo" class="logo " style='max-height:100%; max-width:100%;'>
                                        </div>

                                        <a type="text" class="btn btn-info btn-sm" id="cho_img"><?php echo trans('btn_choose_img') ?></a>
                                        <input type="file" class='d-none' name="logo" id="user_img" accept=".png, .jpg, .jpeg, .gif, .svg">
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><?php echo trans('name') ?></p>
                                            </div>
                                            <div class="col-md-9">
                                                <p>:<span class="text-gray ps-10"><?php echo $info->full_name ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><?php echo trans('role') ?></p>
                                            </div>
                                            <div class="col-md-9">
                                                <p>:<span class="text-gray ps-10"><?php echo format_name($admin_roles->role) ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><?php echo trans('email') ?></p>
                                            </div>
                                            <div class="col-md-9">
                                                <p>:<span class="text-gray ps-10"><?php echo $info->email ?></span> </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><?php echo trans('phone_no') ?></p>
                                            </div>
                                            <div class="col-md-9">
                                                <p>:<span class="text-gray ps-10"><?php echo $info->phone ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                    </div>
                </div>

                <!-- /.col -->
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#profile" data-bs-toggle="tab"><?php echo trans('profile') ?></a></li>
                            <li><a href="#ch_pass" data-bs-toggle="tab"><?php echo trans('chang_pass') ?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">
                                <div class="box no-shadow">
                                    <input type="hidden" value='<?php echo $info->user_id ?>' name="user_id">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-md-2 form-label"><?php echo trans('name') ?></label>

                                        <div class="controls col-md-7">
                                            <input type="text" name="full_name" class="form-control" id="inputName" placeholder="Full Name" value="<?php echo $info->full_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-md-2 form-label"><?php echo trans('email') ?></label>

                                        <div class="controls col-md-7">
                                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Enter your email" value="<?php echo $info->email ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPhone" class="col-md-2 form-label"><?php echo trans('phone') ?></label>

                                        <div class="controls  col-md-7">
                                            <input type="number" class="form-control" name="phone" id="inputPhone" placeholder="Enter your phone NO." value="<?php echo $info->phone ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="ms-auto col-sm-10">
                                            <button type="submit" class="btn btn-info btn-sm" id='btn-update-profile'>
                                                <?php echo trans('btn_submit') ?></button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="ch_pass">
                                <div class="box no-shadow">
                                    <form class="form-horizontal col-md-12" id="user_password" onsubmit="return false">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputName" class="form-label"><?php echo trans('old_pass') ?></label>
                                            </div>
                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="old_password" id="old_password" placeholder="Old Password ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputName" class="form-label"><?php echo trans('new_pass') ?></label>
                                            </div>
                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputEmail" class="form-label"><?php echo trans('conf_pass') ?></label>
                                            </div>

                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="confirm_password" id="confirm_password" placeholder="confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="ms-auto col-sm-10">
                                                <button type="submit" class="btn btn-info btn-sm"><?php echo trans('chang_pass') ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
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

<script src="<?php echo base_url('public/custom/js/user_profile.js') ?>"></script>