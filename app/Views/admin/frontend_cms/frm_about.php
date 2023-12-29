<form class='frontend-frm' method="post" onsubmit='return false'>
    <?php echo csrf_field() ?>
    <div class="mb-3">
        <h4><?php echo trans('general_infomation') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class="form-group col-md-6">
                <div class='controls'>
                    <label class="control-label"><?php echo trans('name') ?></label>
                    <div class="input-group">
                        <input name="name" type="text" class="form-control" placeholder="Enter name" value="<?php echo isset($about['name']) && $about['name'] ? $about['name'] : "" ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class='controls'>
                    <label class="control-label"><?php echo trans('title') ?></label>
                    <div class="input-group">
                        <input type="text" name='title' class="form-control" placeholder="Enter title" value="<?php echo isset($about['title']) && $about['title'] ? $about['title'] : "" ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class='controls'>
                    <label class="control-label"><?php echo trans('url') ?></label>
                    <div class="input-group">
                        <input type="text" name='url' class="form-control" placeholder="Enter URL" value="<?php echo isset($about['url']) && $about['url'] ? $about['url'] : "" ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h4><?php echo trans('seo_information') ?></h4>
        <hr class='mt-1'>
        <div class="row">
            <div class='controls form-group'>
                <label class="control-label"><?php echo trans('meta_title') ?></label>
                <input name="seo_title" type="text" class="form-control" placeholder="Enter SEO title " value="<?php echo isset($about['seo_title']) && $about['seo_title'] ? $about['seo_title'] : "" ?>" />
            </div>
        </div>
        <div class="row">
            <div class='controls form-group'>
                <label class="control-label"><?php echo trans('meta_description') ?></label>
                <textarea name="seo_description" id="" class="form-control" placeholder="Enter description"><?php echo isset($about['seo_description']) && $about['seo_description'] ? $about['seo_description'] : "" ?></textarea>
            </div>
        </div>
    </div>
    <input type="hidden" name='id' value='<?php echo isset($about['id']) && $about['id'] ? $about['id'] : "" ?>'>
    <button type="submit" class="btn btn-success px-4">
        <?php echo trans('update') ?>
    </button>
</form>