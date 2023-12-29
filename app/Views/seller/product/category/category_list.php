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

    .ps-5r {
        padding-left: 2.1rem !important;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i> Category List</h4>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="alert alert-success" style="display:none" id="success-msg"></div>
            <!-- mein body -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-body" id='cat-list'>
                        </div>
                    </div>
                </div>
                <?php if (check_method_access('categories', 'add', true)) : ?>
                    <div class="col-md-4" id='div-add-cat'>
                        <div class="card card-default">
                            <div class="m-3">
                                <form method="post" autocomplete="off" id="categories_detail" onsubmit="return false">
                                    <?php echo csrf_field(); ?>
                                    <h4 class="mb-0"><i class="fa fa-plus"></i> Add New Category</h4>
                                    <hr class="my-15">
                                    <div class='form-group'>
                                        <label for="">Parent Category</label>
                                        <select name="parent_cat" id="slct-prnt-cat" class='form-control slct-prnt-cat'>
                                        </select>
                                    </div>
                                    <div class=" form-group">
                                        <label for="username" class="control-label">Category Name<i class='text-danger'>*</i></label>
                                        <div class="controls">
                                            <input type="text" name="category_name" class="form-control" id="ctegory" placeholder="Enter your category name" data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-sm pull-right" id="">
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (check_method_access('categories', 'edit', true)) : ?>
                    <div class="col-md-4 d-none" id='div-edit-cat'>
                        <div class="card p-3">
                            <div class="row">
                                <h4 class="mb-0 col-8"><i class="fa fa-edit"></i> Update Category</h4>
                                <div class='col-4'>
                                    <a class="btn btn-sm btn-info pull-right" id='toggle-card'><i class='fa fa-plus'></i>
                                        Add</a>
                                </div>
                            </div>
                            <hr class='my-15'>
                            <form method="post" id="edit_form" autocomplete="off" onsubmit="return false">
                                <?php echo csrf_field() ?>
                                <input type="hidden" name='cate_id' id='e_category_id'>
                                <div class='form-group'>
                                    <label for="">Parent Category</label>
                                    <select name="parent_cat" id="e-slct-prnt-cat" class='form-control slct-prnt-cat'>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label"><?php echo trans('category_name') ?></label>
                                    <div class="controls">
                                        <input type="text" name="category_name" class="form-control" id="e_ctegory" placeholder="Entern your category name" data-validation-required-message="This field is required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="submit" value="1" />
                                    <button type="submit" class="btn btn-success btn-sm pull-right" id="">
                                        <?php echo trans('update') ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

<?php
if (check_method_access('categories', 'add', true)) {
    echo view('seller/modals/product/upload_csv_file.php');
}
echo view('seller/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/seller/category.js') ?>"></script>