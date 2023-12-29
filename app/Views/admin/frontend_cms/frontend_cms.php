<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<style>
    .btn-lg {
        font-size: 1.286rem;
        padding: 6px 32px;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-plus"></i><?php echo trans('frontend_cms') ?></h4>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="vtabs card-body" style='width:100%'>
                            <ul class="nav nav-tabs tabs-vertical" role="tablist" style='width:250px'>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                        <?php echo trans('home') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#about" role="tab">
                                        <?php echo trans('about') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#terms_conditions" role="tab">
                                        <?php echo trans('terms_conditions') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy_policy" role="tab">
                                        <?php echo trans('privacy_policy') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#cancellation_policy" role="tab">
                                        <?php echo trans('cancellation_policy') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#return_refund_replacement_policy" role="tab">
                                        <?php echo trans('return_refund_replacement_policy') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#responsible_disclosure_policy" role="tab">
                                        <?php echo trans('responsible_disclosure_policy') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#intellectual_property_policy" role="tab">
                                        <?php echo trans('intellectual_property_policy') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#anti_plishing_alert" role="tab">
                                        <?php echo trans('anti_plishing_alert') ?>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="active tab-pane" id="home">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_home') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="about">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_about') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="terms_conditions">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_terms_and_conditions') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="privacy_policy">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_privacy_policy') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="cancellation_policy">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_cancellation_policy') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="return_refund_replacement_policy">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_rrr_policy') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="responsible_disclosure_policy">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_responsible_disclosure') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="intellectual_property_policy">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_intellectual_property_policy') ?>
                                    </div>
                                </div>

                                <div class="tab-pane" id="anti_plishing_alert">
                                    <div class="mx-3">
                                        <?php echo view('admin/frontend_cms/frm_anti_plishing_alert') ?>
                                    </div>
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
echo view('admin/include/footer');
?>
<script src="<?php echo base_url("public/assets/vendor_components/ckeditor/ckeditor.js") ?>"></script>
<script src="<?php echo base_url('public/custom/js/frontend_cms.js') ?>"></script>

<script>
    $(function() {
        "use strict";
        CKEDITOR.replaceClass = 'ckeditor';
    });
</script>