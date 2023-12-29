<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
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
                <?php if (check_method_access('support', 'add', true)) : ?>
                    <div class="d-inline-block float-right">
                        <a href="#" class="btn btn-info btn-sm add"><i class="fa fa-plus"></i>
                            <?php echo trans('add_support_ticket') ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-2">
                    <div class="box box-inverse box-info" id="total_tickets">
                        <div class="box-body">
                            <div class="text-center">
                                <a class="text-white" href="javascript:void(0)">
                                    <div class="fs-24 count"><?php echo $count ?></div>
                                    <span><?php echo trans('total_tickets') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-inverse box-success" id="compl_tickets" tid='2'>
                        <div class="box-body">
                            <div class="text-center">
                                <a class="text-white" href="javascript:void(0)">
                                    <div class="fs-24 count">
                                        <?php if (isset($status_count['2'])) {
                                            echo $status_count['2'] ?>
                                        <?php } else {
                                            echo 0;
                                        } ?></div>
                                    <span><?php echo trans('cmplt_tckts') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-inverse box-danger" id="panding_tickets" tid='1'>
                        <div class="box-body">
                            <div class="text-center">
                                <a class="text-white" href="javascript:void(0)">
                                    <div class="fs-24 count">
                                        <?php if (isset($status_count['1'])) {
                                            echo $status_count['1'] ?>
                                        <?php } else {
                                            echo 0;
                                        } ?></div>
                                    <span><?php echo trans('pending_tckts') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-inverse box-warning" id="hold_tickets" tid='3'>
                        <div class="box-body">
                            <div class="text-center">
                                <a class="text-white" href="javascript:void(0)">
                                    <div class="fs-24 count">
                                        <?php if (isset($status_count['3'])) {
                                            echo $status_count['3'] ?>
                                        <?php } else {
                                            echo 0;
                                        } ?></div>
                                    <span><?php echo trans('on_hold_tckts') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-inverse" style="background-color: #f01935;" id="reject_tickets" tid='4'>
                        <div class="box-body">
                            <div class="text-center">
                                <a class="text-white" href="javascript:void(0)">
                                    <div class="fs-24 count">
                                        <?php if (isset($status_count['4'])) {
                                            echo $status_count['4'] ?>
                                        <?php } else {
                                            echo 0;
                                        } ?>
                                    </div>
                                    <span><?php echo trans('rejected_tckts') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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


                <div class="">

                </div>


        </section>
    </div>
</div>
<?php
echo view('admin/modals/support_ticket/edit_support_modal.php');
echo view('admin/modals/support_ticket/add_support_ticket_modal.php');
echo view('admin/modals/support_ticket/support_tickets_view_modal.php');
echo view('admin/include/footer.php');
?>

<script src="<?php echo base_url('public/custom/js/support.js') ?>"></script>