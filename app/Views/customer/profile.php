<?php
echo view('customer/include/header_top');
echo view('customer/include/header');
echo view('customer/include/sidebar');
?>
<style>
tr {
    cursor: pointer;
}
</style>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">

            <?php if (!$user_detail->is_email_verify): ?>
            <div class="alert alert-danger" id='error-msg'>Note: Hi <?php echo $user_detail->full_name ?>, Your email is
                not
                verified yet.
                please <a href='<?php echo base_url('seller/profile') ?>' onclick='//sendVerificationEmail()'>verify</a>
                or
                <a href='<?php echo base_url('seller/profile') ?>'
                    onclick="//$('#div-get-email').slideDown('slow')">change</a>
                your email
                account for creating store.
            </div>
            <div class="alert alert-success" id='success-msg' style='display:none'></div>
            <?php endif;?>
            <div class="row">
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-img bbsr-0 bber-0"
                            style="background: base_url('public/images/gallery/full/10.jpg') center center;"
                            data-overlay="5">
                            <h3 class="widget-user-username text-white"><?php echo $info->full_name ?></h3>
                            <!-- <h6 class="widget-user-desc text-white">Designer</h6> -->
                            <!-- style="background: <? //=base_url('public/images/gallery/full/10.jpg')
                                                    ?> center center;" -->
                        </div>
                        <div class="widget-user-image">
                            <img class="rounded-circle h-90" id='user-profile'
                                src="<?php echo $info->profile_photo ?: base_url('public/images/avatar/avatar-1.png') ?>"
                                alt="User Avatar">
                            <span id='img-camera'><i class="fa fa-camera"></i></span>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">12K</h5>
                                        <span class="description-text">FOLLOWERS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 be-1 bs-1">
                                    <div class="description-block">
                                        <h5 class="description-header">550</h5>
                                        <span class="description-text">FOLLOWERS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">158</h5>
                                        <span class="description-text">TWEETS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body box-profile">
                            <div class="form-group row">
                                <label for="inputEmail" class="col-md-2 form-label"><?php echo trans('email') ?></label>

                                <div class="controls col-md-7">
                                    <p id='email-hide'
                                        style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">: <span
                                            class="text-gray ps-10"
                                            title="<?php echo $info->email ?>"><?php echo $info->email ?></span>
                                    </p>
                                    <form id='frm-change-email'>
                                        <?php echo csrf_field() ?>
                                        <input type="hidden" name='user_id'
                                            value='<?php echo encrypt_var($user_detail->uid) ?>'>
                                        <div class='input-group d-none' id='div-get-email'>
                                            <input type="text" class='form-control col-md-8' name='email'
                                                value="<?php echo $info->email ?>" placeholder='Enter your email id' />
                                        </div>

                                </div>
                                <div class="col-md-3">
                                    <a href='#' id='verify'
                                        onclick="$('#div-get-email').removeClass('d-none'),$('#email-hide').hide(),$('#change').removeClass('d-none'), $('#change').addClass('d-block'),$(this).hide();">Change</a>

                                    <button type="submit" class='btn btn-primary btn-sm d-none' id='change'
                                        onclick="$('#div-get-email').addClass('d-none'),$('#email-hide').show(),$('#verify').show(),$(this).addClass('d-none');">Verify</button>

                                    </form>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group row">
                                    <label for="inputPhone"
                                        class="col-md-2 form-label"><?php echo trans('phone') ?></label>

                                    <div class="controls  col-md-7">
                                        <p>: <span class="text-gray ps-10"><?php echo $info->phone ?></span></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone"
                                        class="col-md-2 form-label"><?php echo trans('address') ?></label>

                                    <div class="col-md-9">
                                        <p>: <span
                                                class="text-gray ps-10"><?php echo $user_detail->address . ', ' . $user_detail->state_name . ', ' . $user_detail->city_name ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <div class="map-box">
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                                width="100%" height="100" frameborder="0" style="border:0"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                <div class=" col-12  col-lg-8 col-xl-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a class="active" href="#profile"
                                    data-bs-toggle="tab"><?php echo trans('profile') ?></a></li>
                            <li><a href="#ch_pass" data-bs-toggle="tab"><?php echo trans('chang_pass') ?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="active tab-pane" id="profile">

                                <form class="form-horizontal col-12" id="user_profile_updete_detail"
                                    onsubmit="return false">
                                    <?php echo csrf_field(); ?>
                                    <input type="file" class='d-none' name="logo" id="user-img"
                                        accept=".png, .jpg, .jpeg, .gif, .svg">
                                    <div class="box no-shadow">
                                        <input type="hidden" value='<?php echo $info->user_id ?>' name="user_id">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-md-2 form-label"><?php echo trans('name') ?></label>

                                            <div class="controls col-md-7">
                                                <input type="text" name="full_name" class="form-control" id="inputName"
                                                    placeholder="Full Name" value="<?php echo $info->full_name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail"
                                                class="col-md-2 form-label"><?php echo trans('email') ?></label>

                                            <div class="controls col-md-7">
                                                <input type="email" class="form-control" name="update_email"
                                                    id="inputEmail" placeholder="Enter your email"
                                                    value="<?php echo $info->email ?>">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                class="col-md-2 form-label"><?php echo trans('phone') ?></label>

                                            <div class="controls  col-md-7">
                                                <input type="number" class="form-control" name="update_phone"
                                                    id="inputPhone" placeholder="Enter your phone NO."
                                                    value="<?php echo $info->phone ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                class="col-md-2 form-label"><?php echo trans('address') ?></label>

                                            <div class="controls  col-md-7">
                                                <input type="text" class="form-control" name="update_address"
                                                    id="inputPhone" placeholder="Enter your address"
                                                    value="<?php echo $info->address ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                class="col-md-2 form-label"><?php echo trans('state') ?></label>

                                            <div class="controls  col-md-7">
                                                <select name="state" class="form-control" id='state'>
                                                    <option value=""><?php echo trans('select_state') ?></option>
                                                    <?php foreach ($states as $state): ?>
                                                    <option value="<?php echo $state->state_id ?>"
                                                        <?php echo $state->state_id == $info->state_id ? 'selected' : false ?>>
                                                        <?php echo $state->state_name ?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone"
                                                class="col-md-2 form-label"><?php echo trans('city') ?></label>

                                            <div class="controls  col-md-7">
                                                <select name="city" class="form-control" id='citie'>
                                                    <option value=""><?php echo trans('select_city') ?></option>
                                                    <?php foreach ($city as $city): ?>
                                                    <option value="<?php echo $city->city_id ?>"
                                                        <?php echo $city->city_id == $info->city_id ? 'selected' : false ?>>
                                                        <?php echo $city->city_name ?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="ms-auto col-sm-10">
                                                <button type="submit" class="btn btn-info btn-sm"
                                                    id='btn-update-profile'>
                                                    <?php echo trans('btn_submit') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="ch_pass">
                                <div class="box no-shadow">
                                    <form class="form-horizontal col-md-12" id="user_password" onsubmit="return false">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputName"
                                                    class="form-label"><?php echo trans('old_pass') ?></label>
                                            </div>
                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="old_password"
                                                    id="old_password" placeholder="Old Password ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputName"
                                                    class="form-label"><?php echo trans('new_pass') ?></label>
                                            </div>
                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="new_password"
                                                    id="new_password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="inputEmail"
                                                    class="form-label"><?php echo trans('conf_pass') ?></label>
                                            </div>

                                            <div class="controls col-md-7">
                                                <input type="text" class="form-control" name="confirm_password"
                                                    id="confirm_password" placeholder="confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="ms-auto col-sm-10">
                                                <button type="submit"
                                                    class="btn btn-info btn-sm"><?php echo trans('chang_pass') ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('customer/include/footer.php');
?>
<script>
$("#user-img").change(function() {
    var file = this.files[0];
    let path =
        console.log(file);
    if (file) {
        $("#user-profile").attr('src',
            URL.createObjectURL(file)
        );
    }
})
$('#img-camera').click(function() {
    $("#user-img").click();
})
let toast;
$(function() {
    $('#frm-change-email').validate({
        onkeyup: false,
        rules: {
            'user_id': {
                required: true,
            },
            'email': {
                required: true,
                email: true,
            }
        },
        errorPlacement: function(error, element) {
            if (toast) toast.reset();
            create_toast($(error).html(), 'error');
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: base_url('/auth/changeEmail'),
                data: $(form).serialize(),
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        create_toast(res.msg, 'success');
                        $('#error-msg').addClass('d-none');
                        $('#success-msg').html(
                            'We have sent a verification email to your registerd email account. Please go and check.<br> '
                        ).show();
                        setTimeout(function() {
                            window.location = base_url("/customer/profile");
                        }, 4000);
                    } else {
                        if (res.errors) {
                            msg = '';
                            for (i in res.errors) {
                                msg += res.errors[i] + '<br>';
                            }
                            create_toast(msg, 'error');
                        } else {
                            create_toast(res.msg, 'error');
                        }
                    }
                }
            });
        }
    });
})


function create_toast(msg, type) {
    $.toast({
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: type,
        hideAfter: 3500,
        stack: 6
    });
}
</script>