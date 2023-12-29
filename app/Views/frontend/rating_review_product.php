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
<section class="content pt-120">
    <div class="container">
        <div class="card" style='border-radius:0px'>
            <div class="card-header" style='border-bottom:0px'>
                <h4 class="col-md-6" style='font-size:22px'> Ratings & Reviews</h4>

                <div class='col-md-6'>
                    <div class='row'>
                        <div class="col-md-10" style='text-align:end'>
                            <?php echo $details["product"]->title ?>
                            </br>
                            <span class='badge badge-pill badge-success'>
                                <?php echo to_fixed($details["product"]->rating, 1) ?>
                                <i class='mdi mdi-star'></i>
                            </span>
                            <span style='color: #878787;'>(<?php echo $details['reviews_count']->count ?>)</span>
                        </div>
                        <div class="col-md-2">
                            <img src="<?php echo $details["product"]->product_image ?>" id="product-image" class=""
                                alt="" style='max-height:50px' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-12">
                <form method="post" autocomplete="off" id='review-img-product' onsubmit="return false;">
                    <?php echo csrf_field() ?>
                    <input type="hidden" class="" id='pid' name='pid' value='<?php echo $details["product"]->id ?>'>
                    <input type="hidden" class="" id='slug' value='<?php echo $details["product"]->slug ?>'>
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
                                    <input type="file" name='file' multiple='' class="d-none" id='img'
                                        accept=".png, .jpg, .jpeg, .gif, .svg">
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
                                    <div class="form-group">
                                        <textarea name="description" id=""
                                            placeholder="Write review for product here..." rows="6"
                                            style='outline: none; border: none; width: 100%; font-size: 14px;    font-weight: 400;    resize: none;'
                                            data-validation-required-message="This field is required"></textarea>
                                    </div>

                                </div>
                                <hr>
                                <div class="row" style='padding: 0px 13px 11px'>
                                    <div class="col-md-6">
                                        <span>Title (optional)</span>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class='controls'>
                                        <input name="title" id="" placeholder="Review title..."
                                            style='outline: none; border: none; width: 100%; font-size: 14px;    font-weight: 400;    resize: none;'
                                            data-validation-required-message="This field is required" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style='margin-bottom: 15px;text-align: end; margin-right: 20px;'>
                            <button type="submit" class='btn'
                                style='background-color:#ee4d0c !important; border-color:#ee4d0c !important; color: #ffffff !important;'
                                id='btn-save'>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>