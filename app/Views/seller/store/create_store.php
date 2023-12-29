<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
// prd($info);
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='alert alert-danger' id='add-store-err' style='display:none'></div>
                <?php if (!$info->is_email_verify) : ?>
                    <div class="alert alert-danger" id='error-msg'>Your email verification is still pending to create a
                        store you have to veify your email first. <a href="<?php echo base_url('seller/profile') ?>">I have'nt
                            received email yet.</a>
                        <form id='frm-change-email'>
                            <?php echo csrf_field() ?>
                            <input type="hidden" name='user_id' value='<?php echo encrypt_var($info->id) ?>'>
                            <div class='mt-2 input-group' id='div-get-email' style='display:none;width:50%;'>
                                <input type="text" class='form-control col-md-5' name='email' placeholder='Enter your email id' />
                                <button class='btn btn-success'>Change</button>
                            </div>
                        </form>
                    </div>
                    <div class="alert alert-success" id='success-msg' style='display:none'></div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header p-3">
                        <h4 class='m-0'><i class="fa fa-plus"></i> Create Store</h4>
                    </div>
                    <div class="card-body p-3">
                        <form id="add_store" method="post" autocomplete="off">
                            <?php echo csrf_field() ?>
                            <input type="hidden" name='user_id' value='<?php echo encrypt_var($info->id) ?>'>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 form-group">
                                    <label for="">Store Name (Registered Firm Name) <i class='text-danger'>*</i></label>
                                    <input type="text" class='form-control' name="name" value="<?php echo $info->name ?>" />
                                </div>
                                <div class="col-md-4 col-lg-4 form-group">
                                    <label for="">GSTIN</label>
                                    <input type="number" class='form-control' name="gst" value="<?php echo $info->gstin ?>" />
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="">About Store</label>
                                <textarea name=" about" id="" class='form-control' rows="4"><?php echo $info->about_store ?></textarea>
                            </div>
                            <h4 class='mt-4'>Store Location (This address will be used to calculate shipping
                                charges)
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for="">Country <i class='text-danger'>*</i></label>
                                    <select class="form-select" name="country" id="country">
                                        <?php foreach ($countries as $key => $value) {
                                            if ($value->name == "India") { ?>
                                                <option value="<?php echo $value->id ?>" selected><?php echo $value->name ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for="">Pincode <i class='text-danger'>*</i></label>
                                    <input type="text" class='form-control' name="pincode" value="<?php echo $info->pincode ?>" />
                                </div>
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for="">State <i class='text-danger'>*</i></label>
                                    <select class="form-select" name="state" id="states">
                                        <option value="">Select your state</option>
                                        <?php foreach ($states as $key => $value) { ?>
                                            <option value="<?php echo $value->state_id ?>"><?php echo $value->state_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for="">City <i class='text-danger'>*</i></label>
                                    <select class="form-select" name="city" id="city">
                                        <option value="">Select your city</option>
                                        <?php foreach ($cities as $key => $value) { ?>
                                            <option value="<?php echo $value->city_id ?>"><?php echo $value->city_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="">Address</label>
                                <textarea name="address" id="" class='form-control' rows="2"><?php echo $info->address ?></textarea>
                            </div>
                            <h4 class='mt-4'>Bank Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 form-group">
                                    <label for="">Account Number <i class='text-danger'>*</i></label>
                                    <input type="text" class='form-control' name="account_no" value="<?php echo $info->account_no ?>" />
                                </div>
                                <div class="col-md-4 col-lg-4 form-group">
                                    <label for="">IFSC Code <i class='text-danger'>*</i></label>
                                    <input type="number" class='form-control' name="ifsc_code" value="<?php echo $info->ifsc_code ?>" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer p-3">
                        <input type="hidden" value="<?php echo $info->created_at ?>" id="status">
                        <button class='btn btn-success btn-sm' id="store_btn" <?php echo !$info->is_email_verify ? 'disabled' : false; ?> <?php echo $info->created_at != "NULL" ? 'disabled' : false; ?> onclick='$("#add_store").submit();'>Create
                        </button>
                        <span class='text-danger'><?php echo !$info->is_email_verify ? 'Please verify your email.' : false; ?></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/seller/store.js') ?>"></script>