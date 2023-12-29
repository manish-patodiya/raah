<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
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
                    <h4 class="page-title"><i class="fa fa-list"></i> <?php echo trans('labels_list') ?></h4>
                </div>

            </div>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="box" id="">
                        <div class="box-header with-border">
                            <h5 class="box-title"><?php echo trans('labels') ?></h5>
                        </div>
                        <div class="media-list media-list-hover media-list-divided form-group mb-0">
                            <div class="row">
                                <div class="input-group">
                                    <input type="text" name="new_label" class="form-control border-0 border-bottom" id="new_label" placeholder="Type to add new label" style='border-redius:0%' data-validation-required-message="This field is required">
                                    <button type="button" class="btn btn-sm btn-info rounded-0" id="add_label">
                                        <?php echo trans('create_label') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="box-body p-0">
                            <div class="media-list media-list-hover media-list-divided lid">
                                <?php
                                foreach ($labels as $key => $value) {
                                ?>
                                    <a class="media media-single labels px-4" lid="<?php echo $value->id ?>" href="#">
                                        <?php echo $value->label ?>
                                        <i class="fa-solid fa-arrow-right arrow" style="display:none;"></i>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h5 class="box-title"><?php echo trans('categories') ?></h5>
                        </div>
                        <div class="box-body p-0">
                            <div class="media-list media-list-hover media-list-divided categories">
                                <!-- <a class="media media-single" href="#">
                                    <span class="title"><?php echo trans('slct_lbl_fst') ?></span>
                                </a> -->
                                <?php
                                foreach ($categories as $key => $value) {
                                ?>
                                    <a class="media media-single cat_id px-2" label_id="" cid="<?php echo $value->id ?>" href="#">
                                        <span class="title"><?php echo $value->category_name ?></span>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="box mb-0" id="value_box">
                        <div class="box-header with-border">
                            <h5 class="box-title"><?php echo trans('value') ?></h5>
                        </div>
                        <div class="box-body p-0 value_box" id="value_content">
                            <div class="media-list media-list-hover media-list-divided values">
                                <a class="media media-single px-2" href="#">
                                    <span class="title"><?php echo trans('slct_cat_fst') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>


<script src="<?php echo base_url('public/custom/js/seller/labels.js') ?>"></script>