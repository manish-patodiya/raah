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
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h4 class="card-title"> <i class="fa fa-plus"></i>
                        <?php echo trans('add_hsn_detail') ?>
                    </h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?php echo base_url('/hsn'); ?>" class="btn btn-dark"><i class="fa fa-list"></i>
                        <?php echo trans('hsn_list') ?></a>
                </div>
            </div>
        </div>
        <!-- mein body -->
        <div class="row">

            <div class="col-md-12">
                <!-- <div class="alert alert-success alert-dismissible fade hidden show" role="alert" id="success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong id="success-msg">
                    </strong>
                </div> -->
                <div class="card card-default">
                    <div class="m-3">
                        <form method="post" autocomplete="off" id="hsn_detail" onsubmit="return false">
                            <?php echo csrf_field() ?>
                            <h4 class="text-info mb-0"><i class="ti-user me-15"></i> <?php echo trans('hsn_info') ?></h4>
                            <hr class="my-15">
                            <div class="form-group">
                                <label for="username" class="control-label"><?php echo trans('details') ?></label>
                                <div class="controls">
                                    <input type="text" name="details" class="form-control" id="detail" placeholder="Enter your detail" data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="control-label"><?php echo trans('hsn_code') ?></label>
                                <div class="controls">
                                    <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter your hsn code" data-validation-required-message="This field is required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="control-label"><?php echo trans('hsn_code_4_digits') ?></label>
                                <div class="controls">
                                    <input type="text" name="hsn_code_4_digits" class="form-control" id="hsn_code_4_digits" placeholder="Enter your hsn code (4 digit)" data-validation-required-message="This field is required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="control-label"><?php echo trans('gst_rate') ?></label>
                                <div class="controls">
                                    <input type="text" name="gst_rate" class="form-control" id="gst_rate" placeholder="Enter your gst rate" data-validation-required-message="This field is required">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="submit" value="hello" class="hidden" />
                                <button type="submit" name="submit" class="btn btn-dark btn-lg px-4 pull-right " id="">
                                    <?php echo trans('add_new_details') ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/hsn.js') ?>"></script>