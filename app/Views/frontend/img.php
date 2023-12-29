<?php
echo view('frontend/include/header');
?>
<style>
.img-thumbs-hidden {
    display: none;
}

.wrapper-thumb {
    position: relative;
    display: inline-block;
    margin: 1rem 0;
    justify-content: space-around;
}

.img-preview-thumb {
    background: #fff;
    border: 1px solid none;
    border-radius: 0.25rem;
    box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
    margin-right: 1rem;
    max-width: 140px;
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
            <div class="row" id='div-product-img'>
                <div class="img-thumbs-hidden" id="img-preview"></div>
                <input type="file" name='images[]' class="d-none" id='img' accept=".png, .jpg, .jpeg, .gif, .svg">
                <span style='font-size:50px' id='camera'><i class="mdi mdi-camera"></i></span>
            </div>

            <div>
                <div style='display: inline-block; position: relative; margin-left: 16px;
                                         font-size: 28px; cursor: pointer; color:#e0e0e0;' id='star-0-add-rating'
                    onclick='change_css();' onmouseover="bigImg(this)" onmouseout="normalImg(this)">
                    ★
                </div>
                <div style='display: inline-block; position: relative; margin-left: 16px;
                                         font-size: 28px; cursor: pointer; color:#e0e0e0;' onclick='change_css1();'
                    id='star-1-add-rating' onmouseover="bigImg(this)" onmouseout="normalImg(this)">★
                </div>
                <div style='display: inline-block; position: relative; margin-left: 16px;
                                         font-size: 28px; cursor: pointer; color:#e0e0e0;' onclick='change_css2();'
                    id='star-2-add-rating' onmouseover="bigImg(this)" onmouseout="normalImg(this)">★
                </div>
                <div style='display: inline-block; position: relative; margin-left: 16px;
                                         font-size: 28px; cursor: pointer; color:#e0e0e0;' onclick='change_css3();'
                    id='star-3-add-rating' onmouseover="bigImg(this)" onmouseout="normalImg(this)">★
                </div>
                <div style='display: inline-block; position: relative; margin-left: 16px;
                                         font-size: 28px; cursor: pointer; color:#e0e0e0;' onclick='change_css4();'
                    id='star-4-add-rating' onmouseover="bigImg(this)" onmouseout="normalImg(this)">★
                </div>
                <span id='text'></span>
            </div>
        </section>
    </div>
</div>

<?php echo view('frontend/include/footer') ?>
<script>
// function bigImg(x) {
//     x.style.color = "#ffe11b";
// }

// function normalImg(x) {
//     x.style.color = "#e0e0e0";
// }

// function add_css() {

//     $('#star-0-add-rating').style.cssText =
//         '';
// }

// function change_css() {
//     document.getElementById('star-0-add-rating').style.cssText =
//         'display: inline-block; position: relative; margin-left: 16px;  color:#ffe11b;                                        font-size: 28px; cursor: pointer;';
//     $('#text').html('testx');
//     document.getElementById('star-0-add-rating').removeAttribute(onmouseover);
//     document.getElementById('star-0-add-rating').removeAttribute(onmouseout);

// }

// function change_css1() {
//     document.getElementById('star-1-add-rating').style.cssText =
//         'display: inline-block; position: relative; margin-left: 16px;  color:#ffe11b;                                        font-size: 28px; cursor: pointer;';
//     $('#text').html('testx');
//     document.getElementById('star-1-add-rating').removeAttribute(onmouseover);
//     document.getElementById('star-1-add-rating').removeAttribute(onmouseout);

// }

// function change_css2() {
//     document.getElementById('star-2-add-rating').style.cssText =
//         'display: inline-block; position: relative; margin-left: 16px;  color:#ffe11b;                                        font-size: 28px; cursor: pointer;';
//     $('#text').html('testx');
//     document.getElementById('star-2-add-rating').removeAttribute(onmouseover);
//     document.getElementById('star-2-add-rating').removeAttribute(onmouseout);

// }

// function change_css3() {
//     document.getElementById('star-3-add-rating').style.cssText =
//         'display: inline-block; position: relative; margin-left: 16px;  color:#ffe11b;                                        font-size: 28px; cursor: pointer;';
//     $('#text').html('testx');
//     document.getElementById('star-3-add-rating').removeAttribute(onmouseover);
//     document.getElementById('star-3-add-rating').removeAttribute(onmouseout);

// }

// function change_css4() {
//     document.getElementById('star-4-add-rating').style.cssText =
//         'display: inline-block; position: relative; margin-left: 16px;  color:#ffe11b;                                        font-size: 28px; cursor: pointer;';
//     $('#text').html('testx');
//     document.getElementById('star-4-add-rating').removeAttribute(onmouseover);
//     document.getElementById('star4-add-rating').removeAttribute(onmouseout);

// }

$("#camera").click(function() {
    $("#img").click();
});

$("#img").change(function() {

    totalFiles = this.files.length;

    if (!!totalFiles) {
        $("#img-preview").removeClass('img-thumbs-hidden');
    }

    for (var i = 0; i < totalFiles; i++) {
        src = URL.createObjectURL(event.target.files[i]);

        $("#img-preview").append(`<div class="wrapper-thumb">
                <span class='remove-btn'>x</span>
                <img src="${src}" alt="" class='img-preview-thumb'>
            </div>`);

        $('.remove-btn').click(function() {
            $(this).parent('.wrapper-thumb').remove();
        });

    }
});
</script>