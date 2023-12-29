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
                    <h4 class="page-title"><i class="fa fa-list"></i> &nbsp; <?php echo trans('language_list') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- For Messages -->
            <div class="row">
                <?php if (check_method_access('language', 'add', true)) { ?>
                    <div class="col-md-8">
                    <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="languages_table" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans('sn') ?></th>
                                            <th scope="col"><?php echo trans('name') ?></th>
                                            <th scope="col"><?php echo trans('short_name') ?></th>
                                            <th scope="col"><?php echo trans('status') ?></th>
                                            <th width="100" class="text-right"><?php echo trans('status') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <?php if (check_method_access('language', 'add', true)) : ?>
                            <div class="col-md-4">
                                <div class="card card-default">
                                    <div class="m-3">
                                        <h4 class="text-info mb-0"><i class="fa fa-plus"></i> <?php echo trans('create_lang') ?></h4>
                                        <hr class="my-15">
                                        <form method="post" autocomplete="off" id="language_details" onsubmit="return false">
                                            <?php echo csrf_field() ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class=" form-group">
                                                        <label class="control-label"><?php echo trans('lang_name') ?> <span class="required"> *</span></label>
                                                        <div class=" controls input-group">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" name="language_name" class="form-control" id="language_name" placeholder="Enter language name" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class=" form-group">
                                                        <label class="control-label"><?php echo trans('short_name') ?> <span class="required"> *</span></label>
                                                        <div class=" controls input-group">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" name="short_name" class="form-control" id="short_name" placeholder="Enter short name" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo trans('status') ?> <span class="required"> *</span></label>
                                                        <div class="controls">
                                                            <select class='form-control ' name="status" id="status" data-validation-required-message="This field is required" data-live-search="true">
                                                                <option value=""><?php echo trans('slct_status') ?></option>
                                                                <option value="1"><?php echo trans('active') ?></option>
                                                                <option value="0"><?php echo trans('inactive') ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-sm px-4 pull-right " id="">
                                                    <?php echo trans('add') ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
        </section>
    </div>
</div>
<?php
if (check_method_access('language', 'edit', true)) :
    echo view('admin/modals/edit_languages_modal.php');
endif;
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/languages.js') ?>"></script>