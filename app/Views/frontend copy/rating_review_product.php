<?php
echo view('frontend/include/header_top');
echo view('frontend/include/header');
?>
<style>
    .img-thumbs-hidden {
        display: none;
    }

    .wrapper-thumb {
        position: relative;
        display: inline-block;
        justify-content: space-around;
    }

    .img-preview-thumb {
        background: #fff;
        border: 1px solid none;
        border-radius: 0.25rem;
        box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
        margin-right: 1rem;
        width: 140px;
        height: 140px;
        padding: 0.25rem;
    }

    .remove-btn {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: .7rem;
        top: -5px;
        right: 10px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
    }

    .remove-btn:hover {
        box-shadow: 0px 0px 3px grey;
        transition: all .3s ease-in-out;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <div class="card " style='border-radius:0px'>
                <div class="card-header" style='border-bottom:0px'>
                    <h4 class="col-md-6" style='font-size:22px'> Ratings & Reviews</h4>

                    <div class='col-md-6'>
                        <div class='row'>
                            <div class="col-md-10" style='text-align:end'>
                                <?php echo $product->title ?>
                                </br>
                                <span class='badge badge-pill badge-success'>
                                    <?php echo to_fixed($product->rating, 1) ?>
                                    <i class='mdi mdi-star'></i>
                                </span>
                                <span style='color: #878787;'>(2340)</span>
                            </div>
                            <div class="col-md-2">
                                <img src="<?php echo base_url("/public/uploads/product_images/" . $product->product_image) ?>" id="product-image" class="" alt="" style='max-width:42%;' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <form method="post" autocomplete="off" id='review-img-product'>
                        <?php echo csrf_field() ?>
                        <input type="hidden" class="" id='pid' name='pid' value='<?php echo $product->id ?>'>
                        <div class="card" style='border-radius:0px'>
                            <div class="card-header">
                                <div class="row">
                                    <h4 style='font-size:20px'>Product images</h4>
                                </div>
                            </div>
                            <div class="row" style='padding: 2rem;'>
                                <div class="d-flex">
                                    <div class="" id="img-preview"></div>
                                    <div class='d-flex justify-content-center align-items-center img-preview-thumb'>
                                        <input type="file" name='file' multiple='' class="d-none" id='img' accept=".png, .jpg, .jpeg, .gif, .svg">
                                        <span style='font-size:50px' id='camera'><i class="mdi mdi-camera"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style='border-radius:0px'>
                            <div class="card-header">
                                <div class="row">
                                    <h4 style='font-size:20px'> Rate this product</h4>
                                    <div id="star"></div>
                                </div>
                            </div>


                            <div class="card-body" style='padding: 2rem;'>
                                <div class="row">
                                    <h4 style='font-size:22px'> Review this product</h4>
                                </div>
                                <div style='border: 1px solid #e0e0e0;border-radius: 2px;'>
                                    <div class="row" style='padding:15px'>
                                        <div class="col-md-6">
                                            <span>Description</span>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="controls">
                                            <textarea name="description" id="" placeholder="Description..." rows="6" style='outline: none; border: none; width: 100%; font-size: 14px;    font-weight: 400;    resize: none;' data-validation-required-message="This field is required"></textarea>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row" style='padding: 0px 13px 11px'>
                                        <div class="col-md-6">
                                            <span>Title (optional) </span>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class='controls'>
                                            <input name="title" id="" placeholder="Review title..." style='outline: none; border: none; width: 100%; font-size: 14px;    font-weight: 400;    resize: none;' data-validation-required-message="This field is required" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style='margin-bottom: 15px;text-align: end; margin-right: 20px;'>
                                <button type="submit" class='btn' style='background-color:#ee4d0c !important; border-color:#ee4d0c !important; color: #ffffff !important;' onclick='rate_and_review();' id='btn-save'>Submit</button>
                            </div>
                    </form>
                </div>
            </div>

        </section>
    </div>
</div>

<?php echo view('frontend/include/footer') ?>

<script src="<?php echo base_url('public/assets/vendor_components/raty-master/lib/jquery.raty.js') ?>"></script>
<script>
    $(function() {

        'use strict'

        $.fn.raty.defaults.path = base_url('/public/images/rating/');

        // Cancel Star
        $('#star').raty({
            space: false,
        });


        $("#camera").click(function() {
            $("#img").click();
        });

        $("#img").change(function() {
            let file = this.files[0];

            var form_data = new FormData();
            form_data.append('image', file);


            $.ajax({
                url: base_url("/products/upload_rating_img"),
                data: form_data,
                method: "post",
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        var img = res.rating_img;
                        $("#img-preview").append(`<div class="wrapper-thumb">
                            <span class='remove-btn'>x</span>
                            <input type="hidden" name='rating_img[]' value='${img}'>
                            <img src="${base_url(`/public/uploads/product_images/${img}`)}" alt="" class='img-preview-thumb'>
                        </div>`);

                        $('.remove-btn').click(function() {
                            $(this).parent('.wrapper-thumb').remove();
                        });
                    }
                }
            });
        });
    }); // End of use strict

    var btn_save;

    function rate_and_review() {
        $("#review-img-product").submit(function(e) {
            e.preventDefault();
            pid = $('#pid').val();
            var formData = new FormData(this);
            let branches = {
                url: base_url("/products/add_rate_and_review"),
                beforeSend: function() {
                    $("#btn-save").attr("disabled", true);
                    btn_save = $("#btn-save").html();
                    $("#btn-save").html(
                        `<span class="fa-lg"><i class="fa fa-spinner fa-spin"></i></span>`);
                },
                data: formData,
                contentType: false,
                processData: false,
                method: "post",
                dataType: "json",
                success: function(res) {
                    if (res.status == 1) {
                        $.toast({
                            // heading: 'Welcome to my Deposito Admin',
                            text: res.msg,
                            position: "top-right",
                            loaderBg: "#ff6849",
                            icon: "success",
                            hideAfter: 1500,
                            stack: 6,
                        });
                        setTimeout(() => {
                            window.location = base_url("/products/product_detail?p=" +
                                pid);
                        }, 3500);
                    } else {
                        $.toast({
                            // heading: 'Welcome to my Deposito Admin',
                            text: res.msg,
                            position: "top-right",
                            loaderBg: "#ff6849",
                            icon: "error",
                            hideAfter: 1500,
                            stack: 6,
                        });
                    }
                },
                complete: function() {
                    $("#btn-save").attr("disabled", false).html(btn_save);
                },
            };
            $.ajax(branches);

        });
    }
</script>