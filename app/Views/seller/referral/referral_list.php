<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');

function create_actions($id)
{
    $action = '';
    $url = base_url("admin/referrals/generate_qr/$id");
    if (check_method_access('referrals', 'view', true)) {
        $action .= '<a title="Generate QR" class="btn btn-sm btn-dark me-1" href="' . $url . '" > <i class="fa fa-qrcode"></i></a>';
    }
    if (check_method_access('referrals', 'edit', true)) {
        $action .= '<a title="Edit" class="btn btn-sm btn-warning sup_update me-1" href="#" rfid="' . $id . '" > <i class="fa fa-pencil-square-o"></i></a>';
    }
    if (check_method_access('referrals', 'delete', true)) {
        $action .= '<a title="Delete" class="btn btn-sm btn-danger sup_delete me-1"  rfid="' . $id . '" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#modal-center" > <i class="fa fa-trash-o"></i></a>';
    }
    return $action;
}
?>
<style>
    label.error {
        color: #fb5ea8;
        font-weight: 400 !important;
    }

    .rounded-top-card {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .rounded-bottom-card {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .rounded-card {
        border-radius: 10px;
    }

    p {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-list'></i> <?php echo trans('referral_list') ?></h4>
                </div>
                <a href='#' class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#mdl_add_org'><?php echo trans('add_org') ?></a>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($list as $v) : ?>
                                    <div style='width:33%;' class='mb-3'>
                                        <div class='rounded-card'>
                                            <div>
                                                <img src="<?php echo base_url('public/images/product/product-1.png') ?>" alt="" width='100%;' height='250px' class='rounded-top-card' />
                                            </div>
                                            <div class='p-2 b-1 rounded-bottom-card' style='border-color: #bbbbbb !important'>
                                                <h4><?php echo $v->name ?><span class='pull-right'><?php echo create_actions($v->id) ?></span>
                                                </h4>
                                                <p><?php echo $v->about ?></p>
                                                <?php $address = $v->address . ', ' . $v->city_name . ', ' . $v->state_name . ', ' . $v->pincode; ?>
                                                <small>
                                                    <?php echo $v->contact_no . ', ' . $v->email . '<br>' . "<span> $address</span>" ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
<?php
echo view('admin/include/footer.php');
echo view('admin/modals/referral/add_referral_modal.php');
echo view('admin/modals/referral/edit_referral_modal.php');
?>
<script>
    function reload_page() {
        window.location.reload();
    }
    $(function() {
        $('#frm-add-org').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                },
                email: {
                    required: true,
                    email: true,
                },
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                state: 'required',
                city: 'required',
            },
            messages: {},
            submitHandler: function(form, event) {
                event.preventDefault();
                $.ajax({
                    type: "post",
                    url: base_url('/admin/referrals/add'),
                    data: $(form).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $("#add-org-err").html(``).hide();;
                        $("#btn-add").attr("disabled", true);
                        btn_add = $("#btn-add").html();
                        $("#btn-add").html(
                            `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
                        );
                    },
                    success: function(res) {
                        if (res.status == 1) {
                            show_toast(res.msg, '', 'top-right', 'success');
                            $('.modal').modal('hide');
                            reload_page();
                            $('#frm-add-org').trigger('reset');
                        } else {
                            if (res.errors) {
                                let keys = Object.keys(res.errors);
                                keys.map(function(key) {
                                    $("#add-org-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                                });;
                                $("#add-org-err").show();
                            } else {
                                show_toast(res.msg, '', 'top-right', 'error');
                            }
                        }
                    },
                    complete: function() {
                        $("#btn-add").attr("disabled", false).html(btn_add);
                    },
                });
            }
        })

        $(document).on('click', '.sup_update', function() {
            $('#frm-edit-org').trigger('reset');
            let id = $(this).attr('rfid');
            $.ajax({
                url: base_url("/admin/referrals/get"),
                data: {
                    'id': id,
                },
                method: "GET",
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        let org = res.data.org_details;
                        $('#edit-name').val(org.name);
                        $('#edit-email').val(org.email);
                        $('#edit-contact').val(org.contact_no);
                        $('#edit-about').val(org.about.trim());
                        $('#edit-rfid').val(org.id);
                        $('#edit-address').val(org.address);
                        $('#edit-pincode').val(org.pincode);
                        $('#edit-state').val(org.state_id);
                        let city_id = org.city_id;
                        let city = res.data.city;
                        let option = '';
                        city.map(function(key) {
                            option +=
                                `<option value="${key.city_id}"${key.city_id == city_id ? 'selected' : false}>${key.city_name}</option>`;
                        })
                        console.log(option);
                        $('#edit-city').append(option);
                        $('#mdl_edit_org').modal('show');
                    } else {
                        $.toast({
                            // heading: 'Welcome to my Deposito Admin',
                            text: res.msg,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3000,
                            stack: 6
                        });
                    }
                }
            });
        })

        let btn_update;

        $('#frm-edit-org').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                },
                email: {
                    required: true,
                    email: true,
                },
                contact: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                state: 'required',
                city: 'required',
            },
            messages: {},
            submitHandler: function(form, event) {
                event.preventDefault();
                $.ajax({
                    type: "post",
                    url: base_url('/admin/referrals/edit'),
                    data: $(form).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $("#edit-org-err").html(``).hide();;
                        $("#btn-edit").attr("disabled", true);
                        btn_update = $("#btn-edit").html();
                        $("#btn-edit").html(
                            `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`
                        );
                    },
                    success: function(res) {
                        if (res.status == 1) {
                            show_toast(res.msg, '', 'top-right', 'success');
                            $('.modal').modal('hide');
                            reload_page()
                        } else {
                            if (res.errors) {
                                let keys = Object.keys(res.errors);
                                keys.map(function(key) {
                                    $("#edit-org-err").append(`
                                <li>${res.errors[key]}</li>
                                `);
                                });;
                                $("#edit-org-err").show();
                            } else {
                                show_toast(res.msg, '', 'top-right', 'error');
                            }
                        }
                    },
                    complete: function() {
                        $("#btn-edit").attr("disabled", false).html(btn_update);
                    },
                });
            }
        });


        $(document).on('click', '.sup_delete', function() {
            let id = $(this).attr('rfid');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this seller ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true,
                showLoaderOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: base_url("/admin/referrals/delete"),
                        method: "POST",
                        data: {
                            id: id,
                            "csrf_test_name": $('input[name=csrf_test_name]').val(),
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.status == 1) {
                                $.toast({
                                    // heading: 'Welcome to my Deposito Admin',
                                    text: res.msg,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3000,
                                    stack: 6
                                });
                                reload_page();
                            } else {
                                swal("Deletion Failed!", res.msg, "error");
                            }
                        }
                    })
                }
            });
        });


    })
</script>