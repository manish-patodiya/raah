<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<div class="alert alert-success" style="display:none" id="success-msg"></div>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i> &nbsp; <?php echo trans('country_list') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <?php if (check_method_access('countries', 'add', true)) { ?>
                    <div class="col-md-8">
                    <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="countries_table" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans('sn') ?></th>
                                            <th scope="col"><?php echo trans('country') ?></th>
                                            <th scope="col"><?php echo trans('sort_name') ?></th>
                                            <th scope="col"><?php echo trans('phone_code') ?></th>
                                            <th width="100" class="text-right"><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <?php if (check_method_access('countries', 'add', true)) : ?>
                            <div class="col-md-4">
                                <div class="card card-default">
                                    <div class="m-3">
                                        <h4 class="text-info mb-0"><i class="fa fa-plus"></i> <?php echo trans('add_country') ?></h4>
                                        <hr class="my-15">
                                        <form method="post" autocomplete="off" id="frm-add-country" onsubmit="return false">
                                            <?php echo csrf_field() ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo trans('country_name') ?> <span class="required"> *</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="country_name" class="form-control" id="coun_name" placeholder="Enter country name" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo trans('sort_name') ?> <span class="required"> *</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="sort_name" class="form-control" placeholder="Eg: IN for India" id="s_name" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo trans('slug') ?> <span class="required">
                                                                *</span></label>
                                                        <div class="controls">
                                                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Eg: india for India" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo trans('phone_code') ?> <span class="required"> *</span></label>
                                                        <div class="controls">
                                                            <input type="number" name="phone_code" class="form-control" placeholder="Eg: 91 for India" id="phone_code" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-sm px-4 pull-right ">
                                                    <?php echo trans('add') ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
        </section>
    </div>
</div>
<?php
if (check_method_access('countries', 'edit', true)) :
    echo view('admin/modals/edit_country_modal.php');
endif;
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/countries.js') ?>"></script>