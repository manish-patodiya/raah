<div class="modal center-modal fade" id="mdl_customer_user">
    <div class="modal-dialog  modal-lg modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="mb-0 text-info"><i class="fa fa-plus"></i> <?php echo trans('create_customer') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" autocomplete="off" id="frm-add-custm" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <div class="alert alert-danger" id="validation-err" style="display: none;"></div>
                    <div class='row'>
                        <!-- <div class="col-md-4">
                            <div class="box-body m-0 p-0">
                                <div class="form-group">
                                    <div class=" d-flex flex-column align-items-center justify-content-center">
                                        <div class='d-flex bg-secondary  align-items-center justify-content-center mb-2'
                                            style='height: 225px; width:250px;'>
                                            <img src="<? //=base_url('public/images/avatar/avatar-1.png')
                                                        ?>" id="logo"
                                                class="logo" style='max-height:100%; max-width:100%;'>
                                        </div>

                                        <a type="text" class="btn btn-info btn-sm"
                                            id="user-cho-img"><? //=trans('btn_choose_img')
                                                                ?></a>
                                        <input type="file" class='d-none' name="logo" id="user-profile"
                                            accept=".png, .jpg, .jpeg, .gif, .svg">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="inputName" class='form-label'><?php echo trans('name') ?></label>
                                    <div class='controls '>
                                        <input type="text" name='full_name' class="form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="inputEmail" class='form-label'><?php echo trans('email') ?></label>
                                    <div class='controls'>
                                        <input type="email" name='email' class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label for="inputphone" class='form-label'><?php echo trans('phone') ?></label>
                                    <div class='controls'>
                                        <input name="phone" type="tel" class="form-control" placeholder="Phone no." />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputphone" class='form-label'><?php echo trans('password') ?></label>
                            <div class='controls'>
                                <input name='password' id='password' type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputphone" class='form-label'><?php echo trans('rep_pass') ?></label>
                            <div class='controls'>
                                <input type="password" name='cpassword' class="form-control" placeholder="Retype Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="inputphone" class='form-label'><?php echo trans('address') ?></label>
                            <div class='controls'>
                                <textarea name='address' id='address' type="text" class="form-control" placeholder="Address" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyname" class="control-label">State</label>
                                <div class="controls">
                                    <select name="state_id" class="form-control" id='state' data-validation-required-message="This field is required">
                                        <option value="">Select state</option>
                                        <?php foreach ($states as $v) { ?>
                                            <option value="<?php echo $v->state_id ?>"><?php echo $v->state_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <div class="controls">
                                    <select name="city_id" class="form-control" id='citie' data-validation-required-message="This field is required">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="inputgst"><?php echo trans("pincode") ?></label>
                            <div class="controls">
                                <input type="text" id='pincode' name='pincode' class='form-control' placeholder='pincode'>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm pull-right" id="btn-create">
                        <?php echo trans('create') ?>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>