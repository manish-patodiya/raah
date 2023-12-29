<form class='frontend-frm' method="post" onsubmit='return false'>
    <?php echo csrf_field() ?>
    <div class='mb-3'>
        <h4><?php echo trans('general_infomation') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class="col-md-6">
                <div class='form-group controls'>
                    <label class="control-label"><?php echo trans('name') ?></label>
                    <input type="text" name='title' class="form-control" placeholder="Enter name" value="<?php echo isset($home['title']) && $home['title'] ? $home['title'] : "" ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class='form-group controls'>
                    <label class="control-label"><?php echo trans('title') ?></label>
                    <input name="name" type="text" class="form-control" placeholder="Enter title" value="<?php echo isset($home['name']) && $home['name'] ? $home['name'] : "" ?>" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class='form-group controls'>
                    <label class="control-label"><?php echo trans('url') ?></label>
                    <input type="text" name='url' class="form-control" placeholder="Enter URL" value="<?php echo isset($home['url']) && $home['url'] ? $home['url'] : "" ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h4><?php echo trans('seo_information') ?></h4>
        <hr class='mt-1'>
        <div class='row'>
            <div class="col-md-12">
                <div class='form-group controls'>
                    <label class="control-label"><?php echo trans('meta_title') ?></label>
                    <input name="seo_title" type="text" class="form-control" placeholder="Enter SEO title" value="<?php echo isset($home['seo_title']) && $home['seo_title'] ? $home['seo_title'] : "" ?>" />
                </div>
            </div>
            <div class="col-md-12">
                <div class='form-group controls'>
                    <label class="control-label"><?php echo trans('meta_description') ?></label>
                    <textarea name="seo_description" id="" class="form-control" placeholder="Enter description"><?php echo isset($home['seo_description']) && $home['seo_description'] ? $home['seo_description'] : "" ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name='id' value='<?php echo isset($home['id']) && $home['id'] ? $home['id'] : "" ?>' />

    <button type="submit" class="btn btn-success px-4">
        <?php echo trans('update') ?>
    </button>
</form>