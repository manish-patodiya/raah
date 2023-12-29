<div class="modal center-modal fade" id="mdl_customers_user">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-info mb-0"><i class="fa fa-pencil"></i> <?php echo trans('edit_customer_info') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="m-3">
                <form method="post" id="frm-customer-user" autocomplete="off" onsubmit="return false">
                    <?php echo csrf_field() ?>
                    <input type="hidden" name='user_id' id='edit-user-id'>
                    <input type="hidden" name='users_profile_id' id='edit-users-profile-id'>
                    <div class='row'>
                        <!-- <div class="col-md-4">
                            <div class="box-body m-0 p-0">
                                <div class="form-group">
                                    <div class=" d-flex flex-column align-items-center justify-content-center">
                                        <div class='d-flex bg-secondary  align-items-center justify-content-center mb-2'
                                            style='height: 225px; width:250px;' id='profile-photo'>
                                            <img src="<? //=base_url('public/images/avatar/avatar-1.png')
                                                        ?>" id="edit-logo"
                                                class="logo" style='max-height:100%; max-width:100%;'>
                                        </div>

                                        <a type="text" class="btn btn-info btn-sm"
                                            id="edit-user-cho-img"><? //=trans('btn_choose_img')
                                                                    ?></a>
                                        <input type="file" class='d-none' name="logo" id="edit-user-profile"
                                            accept=".png, .jpg, .jpeg, .gif, .svg">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="inputName" class='form-label'><?php echo trans('name') ?></label>
                                    <div class='controls '>
                                        <input type="text" name='full_name' class="form-control" placeholder="Full Name" id='edit-full-name'>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="inputEmail" class='form-label'><?php echo trans('email') ?></label>
                                    <div class='controls'>
                                        <input type="email" name='email' class="form-control" placeholder="Email" id='edit-email'>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="inputphone" class='form-label'><?php echo trans('phone') ?></label>
                                    <div class='controls'>
                                        <input name="phone" type="number" class="form-control" placeholder="Phone no." id='edit-phone' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="inputphone" class='form-label'><?php echo trans('address') ?></label>
                            <div class='controls'>
                                <textarea name='address' id='edit-address' type="text" class="form-control" placeholder="Address" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="companyname" class="control-label">State</label>
                                <div class="controls">
                                    <select name="state_id" class="form-control" id='edit-state'>
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
                                    <select name="city_id" class="form-control" id='edit-city'>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="inputphone" class='form-label'><?php echo trans('pincode') ?></label>
                            <div class='controls'>
                                <input name="pincode" type="number" class="form-control" placeholder="pincode" id='edit-pincode' />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-sm pull-right" id="btn-updata-customer">
                        <?php echo trans('create') ?>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>