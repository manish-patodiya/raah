<form class='frontend-frm' method="post" onsubmit='return false'>
    <?php echo csrf_field() ?>
    <div class='mb-3'>
        <h4><?php echo trans('general_infomation') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class="col-md-6">
                <div class='controls form-group'>
                    <label class="control-label"><?php echo trans('name') ?></label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name" value="<?php echo isset($cncl_policy['name']) && $cncl_policy['name'] ? $cncl_policy['name'] : "" ?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class='controls form-group'>
                    <label class="control-label"><?php echo trans('title') ?></label>
                    <input type="text" name='title' class="form-control" placeholder="Enter title" value="<?php echo isset($cncl_policy['title']) && $cncl_policy['title'] ? $cncl_policy['title'] : "" ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class='controls form-group'>
                    <label class="control-label"><?php echo trans('url') ?></label>
                    <input type="text" name='url' class="form-control" placeholder="Enter URL" value="<?php echo isset($cncl_policy['url']) && $cncl_policy['url'] ? $cncl_policy['url'] : "" ?>">
                </div>
            </div>
        </div>
    </div>

    <div class='mb-3'>
        <h4><?php echo trans('seo_information') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class='controls form-group'>
                <label class="control-label"><?php echo trans('meta_title') ?></label>
                <input name="seo_title" type="text" class="form-control" placeholder="Enter SEO title " value="<?php echo isset($cncl_policy['seo_title']) && $cncl_policy['seo_title'] ? $cncl_policy['seo_title'] : "" ?>" />
            </div>
        </div>
        <div class="row">
            <div class='controls form-group'>
                <label class="control-label"><?php echo trans('meta_description') ?></label>
                <textarea name="seo_description" id="" class="form-control" placeholder="Enter description"><?php echo isset($cncl_policy['seo_description']) && $cncl_policy['seo_description'] ? $cncl_policy['seo_description'] : "" ?></textarea>
            </div>
        </div>
    </div>

    <div class='mb-3'>
        <h4><?php echo trans('page_content') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class='controls form-group'>
                <label class="control-label"><?php echo trans('content') ?></label>
                <textarea name="content2" cols="30" rows="10" class='form-control ckeditor'><?php echo isset($cncl_policy['content']) && $cncl_policy['content'] ? $cncl_policy['content'] : "" ?></textarea>
            </div>
        </div>
    </div>

    <input type="hidden" name='id' value='<?php echo isset($cncl_policy['id']) && $cncl_policy['id'] ? $cncl_policy['id'] : "" ?>' />
    <button type="submit" class="btn btn-success px-4">
        <?php echo trans('update') ?>
    </button>
</form>