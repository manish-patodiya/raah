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
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-plus'></i> <?php echo trans('create_template') ?></h4>
                </div>
                <a class='btn btn-sm btn-info pull-right' href="<?php echo base_url('admin/notifications/notificationtemplate') ?>"><?php echo trans('template_list') ?></a>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class='col-md-8'>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger" id='add-temp-err' style='display:none'></div>
                            <form id='frm-add-template'>
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for=""><?php echo trans('title') ?> <span class="required"> *</span></label>
                                    <input type="text" name='title' class='form-control' />
                                </div>

                                <div class="form-group">
                                    <label for=""><?php echo trans('type') ?></label>
                                    <?php $type_arr = [1 => 'sms', 'email', 'push', 'screen'] ?>
                                    <select name="type" class="form-control" onchange='set_text_area(this.value)'>
                                        <?php foreach ($type_arr as $key => $value) : ?>
                                            <option value="<?php echo $key ?>">
                                                <?php echo trans($value) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="d-none" id='editor-area'>
                                    <div class="form-group">
                                        <label for=""><?php echo trans('subject') ?> <span class="required"> *</span></label>
                                        <input type="text" name='subject' class='form-control' />
                                    </div>
                                    <div class='form-group'>
                                        <label for=""><?php echo trans('content') ?> <span class="required"> *</span></label>
                                        <textarea name="editor_content" class="form-control" id="ckeditor"></textarea>
                                    </div>
                                </div>
                                <div class="d-none" id='text-area'>
                                    <div class='form-group'>
                                        <label for=""><?php echo trans('content') ?> <span class="required"> *</span></label>
                                        <textarea name="text_content" class='form-control' rows="8"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name='submit' value='1' />
                                <button class='btn btn-sm btn-info pull-right' id='btn-create-temp'><?php echo trans('create') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='box'>
                        <div class="box-header p-3 d-block">
                            <h6>Write these variable in your content for add information</h6>
                            <p class='m-0'><small>eg: <i>Our site name is {site_name}</i></small></p>
                        </div>

                        <div class="box-body p-0">
                            <div class="media-list media-list-hover media-list-divided div-variable" style="height:590px;">
                                <?php foreach (NOTIFICATION_TEMPLATE_VARIABLE as $name => $description) : ?>
                                    <div class="media media-single">
                                        <div class="media-body">
                                            <h6><?php echo $name ?></h6>
                                            <small class="text-fader"><?php echo $description ?></small>
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-secondary btn-xs" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Insert" onclick='add_variable("<?php echo $name ?>")'>
                                                <i class='fa fa-plus'></i>
                                            </a>
                                            <a class="btn btn-secondary btn-xs" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick='copy_variable("<?php echo $name ?>")'>
                                                <i class='fa fa-copy'></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
<?php
echo view('admin/include/footer.php');
?>
<script src="http://localhost/invento/public/assets/vendor_components/ckeditor/ckeditor.js"></script>
<script>
    $(function() {
        CKEDITOR.replace('ckeditor');
    });
</script>
<script src="<?php echo base_url('public/custom/js/notification/notification_template.js') ?>"></script>