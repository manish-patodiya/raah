<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
.btn-lg {
    font-size: 1.286rem;
    padding: 6px 32px;
}
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-gears"></i> <?php echo trans('general_settings') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">

            <!-- mein body -->
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#general_setting"
                                    data-bs-toggle="tab"><?php echo trans('general_settings') ?></a></li>
                            <li><a href="#start_no" data-bs-toggle="tab"><?php echo trans('email_setting') ?></a></li>
                            <!-- <li><a href="#invoice_concept" data-bs-toggle="tab">Invoice Concept</a></li> -->
                        </ul>

                        <div class="tab-content">

                            <div class="active tab-pane" id="general_setting">
                                <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="m-3">
                                            <h4 class="text-info mb-0">Site Info</h4>
                                            <hr class="my-15">
                                            <form method="post" autocomplete="off" id="edit_general_settings"
                                                onsubmit="return false">
                                                <?php echo csrf_field() ?>
                                                <input type="hidden" name='user_id' id='user_id' value="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="logo"
                                                                class="control-label"><?php echo trans('favicon') ?></label>
                                                            <div class=" d-flex flex-column">
                                                                <div class='d-flex bg-secondary  align-items-center justify-content-center mb-2'
                                                                    style="min-height: 50px; max-width: 50px;">
                                                                    <img src="<?php echo $general_settings->favicon == "" ? base_url('/public/uploads/image_found/logo1.png') : $general_settings->favicon ?>"
                                                                        id="favicon" class="logo "
                                                                        style='height:25px;width:25px;'>
                                                                </div>

                                                                <input type="file" class='d-none' name="favicon"
                                                                    id="user_favicon">
                                                            </div>
                                                            <a type="text" class="btn btn-info btn-sm"
                                                                id="cho_favicon"><?php echo trans('choose_favicon') ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="logo" class="control-label">
                                                                <?php echo trans('Logo') ?></label>
                                                            <div class=" d-flex flex-column">
                                                                <div class='d-flex bg-secondary mb-2'
                                                                    style='max-height:200px; max-width:200px;'>
                                                                    <img src="<?php echo $general_settings->logo == "" ? base_url('/public/uploads/image_found/logo1.png') : $general_settings->logo ?>"
                                                                        id="logo" class="logo "
                                                                        style='max-height:100%; max-width:100%;'>
                                                                </div>

                                                                <input type="file" class='d-none' name="logo"
                                                                    id="user_img">
                                                            </div>
                                                            <a type="text" class="btn btn-info btn-sm"
                                                                id="cho_img"><?php echo trans('choose_logo') ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="companyname"
                                                            class="control-label"><?php echo trans('application_name') ?>
                                                        </label>
                                                        <div class="controls">
                                                            <input type="text" name="app_name" class="form-control"
                                                                id="app_name" placeholder="Enter your application name"
                                                                value='<?php echo $general_settings->application_name == "" ? "" : $general_settings->application_name ?>'>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label"><?php echo trans('copyright') ?></label>
                                                        <div class="controls">
                                                            <input type="text" name="copyright" class="form-control"
                                                                id="copyright" placeholder="Enter your copyright"
                                                                value='<?php echo $general_settings->copyright == "" ? "" : $general_settings->copyright ?>' />
                                                        </div>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="submit" value="1" />
                                                    <button type="submit" class="btn btn-info px-4 pull-right  btn-sm"
                                                        id="">
                                                        Update
                                                    </button>
                                                </div>
                                                <!-- </div>  -->

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="start_no">
                                <div class="card card-default">
                                    <div class="m-3">
                                        <form method="post" autocomplete="off" id="edit_email_settings"
                                            onsubmit="return false">
                                            <?php echo csrf_field() ?>
                                            <h4 class="text-info mb-0"><?php echo trans('email_setting') ?></h4>
                                            <hr class="my-15">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="username"
                                                            class="control-label"><?php echo trans('email_from') ?></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="text" name="eamil_from" class="form-control"
                                                            id="email_from" placeholder=" no-reply@domain.com"
                                                            value="<?php echo $general_settings->email_from == "" ? "" : $general_settings->email_from ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="username"
                                                            class="control-label"><?php echo trans('smtp_host') ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="text" name="smtp_host" class="form-control"
                                                            id="smtp_host" placeholder="SMTP host"
                                                            value="<?php echo $general_settings->smtp_host == "" ? "" : $general_settings->smtp_host ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="username"
                                                            class="control-label"><?php echo trans('smtp_port') ?></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="number" name="smtp_port" class="form-control"
                                                            id="smtp_port" placeholder="SMTP port"
                                                            value="<?php echo $general_settings->smtp_port == "" ? "" : $general_settings->smtp_port ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="username"
                                                            class="control-label"><?php echo trans('smtp_user') ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="text" name="smtp_user" class="form-control"
                                                            id="smtp_user" placeholder="SMTP email"
                                                            value="<?php echo $general_settings->smtp_user == "" ? "" : $general_settings->smtp_user ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="username"
                                                            class="control-label"><?php echo trans('smtp_password') ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <!-- <div class=""> -->
                                                        <input type="text" name="smtp_password" class="form-control"
                                                            id="smtp_password" placeholder="SMTP password"
                                                            value="<?php echo $general_settings->smtp_pass == "" ? "" : $general_settings->smtp_pass ?>">
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-sm px-4 pull-right "
                                                    id="">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
        </section>
    </div>
</div>
<?php
echo view('admin/include/footer');
?>
<script src="<?php echo base_url('public/custom/js/general_setting.js') ?>"></script>