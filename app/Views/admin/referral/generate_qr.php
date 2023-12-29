<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
label.error {
    color: #fb5ea8;
    font-weight: 400 !important;
}
</style>
<script>
let rfid = <?php echo $rfid ?: 0 ?>;
</script>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-list'></i> <?php echo trans('select_product') ?></h4>
                </div>
                <a href='#' class='btn btn-sm btn-info' data-bs-toggle='modal'
                    data-bs-target='#mdl_add_org'><?php echo trans('add_org') ?></a>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body row">
                            <div class='' style='width:auto;min-width:25%;max-width:33%;'>
                                <?php

make_list_view($categories_list);

function make_list_view($categories_list, $pid = 0)
{
    foreach ($categories_list as $value) {
        if ($value->pid == $pid) {
            if ($value->pid == 0) {
                echo "<div class='div-supreme-cat'>";
            }
            $url = base_url("products?c=$value->id");
            if (check_pid($categories_list, $value->id)) {
                echo "<div class='div-cat pb-1'>
                        <a class='row-cat' data-bs-toggle='collapse' href='#child$value->id' aria-expanded='false' aria-controls='child$value->id'>
                            <i class='mdi mdi-plus-box'></i>
                            <span class='pe-2'>$value->category_name</span>
                        </a>";
                echo "<div class='collapse ps-4' id='child$value->id'>";
                make_list_view($categories_list, $value->id);
                echo "</div></div>";
            } else {
                echo "<div class='div-cat pb-1'>
                       <a href='#' onclick='search_product($value->id)'>
                        <i class='mdi mdi-checkbox-blank-circle pe-1'></i>
                        <span class='pe-2'>$value->category_name</span>";
                echo "</a></div>";
            }
            if ($value->pid == 0) {
                echo "</div>";
            }
        }
    }
}

function check_pid($items, $pid)
{
    foreach ($items as $v) {
        if ($v->pid == $pid) {
            return true;
        }
    }
    return false;
}
?>
                            </div>
                            <div class='col border-start'>
                                <div class='row' id="products">
                                    <h3 style='font-weight:500' class="text-center text-light">Please select a category
                                        first.
                                    </h3>
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
echo view('admin/modals/referral/generate_qr_modal.php');
?>
<script src=<?php echo base_url("/public/assets/vendor_plugins/JqueryPrintArea/demo/jquery.printPage.js") ?>></script>

<script>
function search_product(category) {
    $.ajax({
        type: "get",
        url: base_url('/admin/Referrals/get_product'),
        beforeSend: function() {
            $('#products-list').html('');
            // window.scrollTo(0, 0);
        },
        data: {
            cat: category,
        },
        dataType: "json",
        complete: function() {},
        success: function(res) {
            if (res.status == 1) {
                if (res.data.products.length) {
                    $("#products").html("");
                    res.data.products.map((prod) => {
                        $('#products').append(
                            `<div class="col-md-3">
                                <div class="product-box" style="cursor:pointer;" prod_slug="` + prod
                            .slug + `">
                                    <div class="product_img d-flex align-items-center justify-content-center p-2" style="height:150px;">
                                        <img src="` + prod.img + `"
                                            alt="" style="max-height:100%;max-width:100%;">
                                    </div>
                                    <div class="product_name mt-10">
                                        <h5 class='text-center'>` + prod.title + `</h5>
                                    </div>
                                </div>
                            </div>`);
                    });
                } else {
                    $("#products").html(
                        `<div class='d-flex align-items-center flex-column'>
                            <h3 style='font-weight:500'>Sorry, no result found!</h3>
                            <h4 class='text-light'>Please select another category.</h4>
                        </div>`
                    );
                }
            }
        }
    });
}

$(function() {
    $('.row-cat').click(function() {
        $(this).find('i').toggleClass('mdi-plus-box mdi-minus-box');
    });

    $('#btn-preview').click(function() {
        let url = base_url('/admin/referrals/product_qr?slug=' + $('#prod_slug').val() +
            '&per_page=' + $('#per_page').val() + '&rfid=' + rfid);
        $('#div-qr-preview').html(
            `<iframe src="${url}" frameborder="0" style='width:210mm;height:298mm;'></iframe>`);
    })

    $("#btn-print").click(function() {
        $('.content-wrapper').append(`<button class='d-none' id='dynamic-btn'></button>`);
        $("#dynamic-btn").printPage({
            url: base_url('/admin/referrals/product_qr?slug=' + $('#prod_slug').val() +
                '&per_page=' + $('#per_page').val() + '&rfid=' + rfid),
            attr: "href",
            message: "Your document is being created...",
        });
        $('#dynamic-btn').click();
        $('#dynamic-btn').remove();
    });

    $(document).on('click', ".product-box", function() {
        var val = $(this).attr('prod_slug');
        $("#mdl_generate_qr").modal("show")
        $("#prod_slug").val(val);
    })
})
</script>