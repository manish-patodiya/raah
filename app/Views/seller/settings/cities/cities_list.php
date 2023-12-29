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
                    <h4 class="page-title"><i class="fa fa-list"></i> &nbsp; <?php echo trans('cities_list') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <?php if (check_method_access('city', 'add', true)) { ?>
                    <div class="col-md-8">
                    <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>

                        <div class="card card-default">
                            <div class="card-body table-responsive">
                                <table id="cities_table" class="table" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?php echo trans('sn') ?></th>
                                            <th scope="col"><?php echo trans('city') ?></th>
                                            <th scope="col"><?php echo trans('state') ?></th>
                                            <th width="100" class="text-right"><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <?php if (check_method_access('city', 'add', true)) : ?>
                            <div class="col-md-4">
                                <div class="card card-default">
                                    <div class="m-3">
                                        <h4 class="text-info mb-0"><i class="fa fa-plus"></i> <?php echo trans('add_city') ?></h4>
                                        <hr class="my-15">
                                        <form method="post" autocomplete="off" id="city_details" onsubmit="return false">
                                            <?php echo csrf_field() ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class=" form-group">
                                                        <label class="control-label"><?php echo trans('city_name') ?></label>
                                                        <div class=" controls input-group">
                                                            <div class="input-group-prepend">
                                                            </div>
                                                            <input type="text" name="city_name" class="form-control" id="city_name" placeholder="Enter city name" data-validation-required-message="This field is required" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="username" class="control-label"><?php echo trans('state') ?></label>
                                                        <div class="controls">
                                                            <select class='form-control ' name="state_id" id="state" data-validation-required-message="This field is required" data-live-search="true">
                                                                <option value=""><?php echo trans('select_state') ?></option>
                                                                <?php foreach ($state as $key => $value) { ?>
                                                                    <option value="<?php echo $value->state_id ?>"><?php echo $value->state_name ?>
                                                                    </option>
                                                                <?php } ?>
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
                    </div>
        </section>
    </div>
</div>
<?php
if (check_method_access('city', 'edit', true)) :
    echo view('admin/modals/edit_cities_modal.php');
endif;
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/cities.js') ?>"></script>