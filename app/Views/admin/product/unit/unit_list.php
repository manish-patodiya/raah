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
                    <h4 class="page-title"><i class="fa fa-list"></i> <?php echo trans('unit_list') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">
            <!-- mein body -->
            <div class="row">
                <?php if (check_method_access('unit', 'add', true)) { ?>
                    <div class="col-md-8">
                    <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>
                        <div class="card card-default">
                            <div class="card-body table-responsive">
                                <table id="unit_table" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans('sn') ?></th>
                                            <th scope="col"><?php echo trans('title') ?></th>
                                            <th scope="col"><?php echo trans('base_unit') ?></th>
                                            <th scope="col"><?php echo trans('conversion_rate') ?></th>
                                            <th width="100" class="text-right"><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <?php if (check_method_access('unit', 'add', true)) : ?>
                            <div class="col-md-4">
                                <div class="card card-default">
                                    <div class="m-3">
                                        <form method="post" autocomplete="off" id="unit_detail" onsubmit="return false">
                                            <?php echo csrf_field() ?>
                                            <h4 class="mb-0"><i class="fa fa-plus"></i> <?php echo trans('create_unit') ?></h4>
                                            <hr class="my-15">
                                            <div class="form-group">
                                                <label for="username" class="control-label"><?php echo trans('title') ?> <span class="required"> *</span></label>
                                                <div class="controls">
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter your title " data-validation-required-message="This field is required">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="firstname" class="control-label"><?php echo trans('base_unit') ?></label>
                                                <div class="">
                                                    <select name="base_unit" class="form-control" value="0" id="base_unit">
                                                        <option value=""><?php echo trans('slct_base_unit') ?></option>
                                                        <?php foreach ($unit as $v) { ?>
                                                            <option value="<?php echo $v->id ?>"><?php echo $v->title ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="lastname" class="control-label"><?php echo trans('conversion_rate') ?> <span class="required"> *</span></label>
                                                <div class="controls">
                                                    <input type="number" name="con_rate" step="0.01" class="form-control" id="con_rate" placeholder="Enter your conversion rate" data-validation-required-message="This field is required" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-sm pull-right" id="">
                                                    <?php echo trans('create') ?>
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
if (check_method_access('unit', 'edit', true)) :
    echo view('admin/modals/product/edit_unit_modal.php');
endif;
echo view('admin/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/unit.js') ?>"></script>