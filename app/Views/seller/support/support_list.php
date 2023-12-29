<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th {
        vertical-align: top;
    }

    .bg-orange {
        background-color: #f01935 !important;
    }

    .box-body {
        padding: 0.5rem;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        border-radius: 10px;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa fa-list"></i> <?php echo trans('support_ticket') ?></h4>
                </div>
                <div class="d-inline-block float-right">
                    <a href="#" class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                        <?php echo trans('create_support_ticket') ?></a>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box">
                        <input type="hidden" id='status-shown-in-tbl' value=''>
                        <?php echo csrf_field() ?>
                        <div class="box-body p-15">
                            <div class="col-12 table-responsive">
                                <table id="support_table" class="table mt-0 table-hover no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="col"><?php echo trans('ticket_no') ?></th>
                                            <th class="col"><?php echo trans('user_info') ?></th>
                                            <th class="col"><?php echo trans('subject') ?></th>
                                            <th class="col"><?php echo trans('date') ?></th>
                                            <th class="col"><?php echo trans('status') ?></th>
                                            <th class="col"><?php echo trans('action') ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
echo view('admin/modals/support_ticket/edit_support_modal.php');
echo view('admin/modals/support_ticket/add_support_ticket_modal.php');
echo view('admin/modals/support_ticket/support_tickets_view_modal.php');
echo view('seller/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/seller/support.js') ?>"></script>