<div class="modal center-modal  fade" id="mdl_view_customer">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-start">
                <h5> <span class="subject" style="word-wrap: break-word;"><?php echo trans('view_customer') ?></span></h5>
                <button type="button" class="btn-close pull-right" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style='min-height:200px'>
                <div class='row'>
                    <!-- <div class="col-md-5">
                        <img src="" alt=" " id='profile' class='' width=' 200' height='200' />
                    </div> -->
                    <div class="col-md-12 ">
                        <div class="row">
                            <label for="" class='col-md-3'><?php echo trans('name') ?></label>
                            <span class="text-gray ps-10 col-md-9" id='span-full-name'></span>
                        </div>
                        <div class="row">
                            <label for="" class='col-md-3'><?php echo trans('email') ?></label>
                            <span class="text-gray ps-10 col-md-9" id='span-email'></span>
                        </div>
                        <div class="row">
                            <label for="" class='col-md-3'><?php echo trans('phone') ?></label>
                            <span class="text-gray ps-10 col-md-9" id='span-phone'></span>
                        </div>
                        <div class="row">
                            <label for="" class='col-md-3'><?php echo trans('address') ?></label>
                            <span class="text-gray ps-10 col-md-9" id='span-address'></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>