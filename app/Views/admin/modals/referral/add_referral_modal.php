<div class="modal center-modal fade" id="mdl_add_org">
    <div class="modal-dialog  modal-lg modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 text-info"><i class="fa fa-plus"></i> <?php echo trans('add_org') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" id="frm-add-org" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <div class="alert alert-danger" id="add-org-err" style="display: none;"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputName"><?php echo trans('name') ?> <span class="required"> *</span></label>
                                <div class='controls '>
                                    <input type="text" name='name' class="form-control" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail"><?php echo trans('email') ?> <span class="required"> *</span></label>
                                <div class='controls'>
                                    <input type="email" name='email' class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputphone"><?php echo trans('contact_no') ?> <span class="required">
                                        *</span></label>
                                <div class='controls'>
                                    <input name="contact" type="number" class="form-control" placeholder="Contact no." />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputphone"><?php echo trans('about_org') ?></label>
                                <div class='controls'>
                                    <textarea name='about' id='about' type="text" class="form-control" rows='5'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputgst"><?php echo trans("pincode") ?> <span class="required"> *</span></label>
                                <div class="controls">
                                    <input type="number" id='pincode' name='pincode' class='form-control' placeholder='pincode'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="companyname" class="control-label">State <span class="required">
                                        *</span></label>
                                <div class="controls">
                                    <select name="state" class="form-control" id='state'>
                                        <option value="">Select state</option>
                                        <?php foreach ($states as $v) { ?>
                                            <option value="<?php echo $v->state_id ?>"><?php echo $v->state_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">City <span class="required"> *</span></label>
                                <div class="controls">
                                    <select name="city" class="form-control" id='citie'>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label for="inputphone"><?php echo trans('address') ?></label>
                                <div class='controls'>
                                    <textarea name='address' id='address' type="text" class="form-control" placeholder="Address" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info pull-right" id="btn-add">
                            <?php echo trans('save') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>