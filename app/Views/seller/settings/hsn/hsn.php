<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<div class="alert alert-success" style="display:none" id="success-msg"></div>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i>&nbsp; <?php echo trans('hsn_details') ?></h4>
                </div>
                <?php if (check_method_access('hsn', 'add', true)) : ?>
                    <div class="d-inline-block float-right">
                        <a href="#" class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                            <?php echo trans('add_new_details') ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <section class="content">
            <!-- For Messages -->

            <div class="card">
                <div class="card-body table-responsive">
                    <table id="hsn_details_table" class="table" width="100%">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo trans('sn') ?></th>
                                <th scope="col"><?php echo trans('hsn_code') ?></th>
                                <th scope="col"><?php echo trans('hsn_code_4_digits') ?></th>
                                <th scope="col"><?php echo trans('details') ?></th>
                                <th scope="col"><?php echo trans('gst_rate') ?></th>
                                <th width="100" class="text-right"><?php echo trans('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('admin/modals/add_hsn_modal.php');
echo view('admin/modals/edit_hsn_modal.php');
echo view('admin/include/footer.php');
?>
<script src="<?php echo base_url('public/custom/js/hsn.js') ?>"></script>