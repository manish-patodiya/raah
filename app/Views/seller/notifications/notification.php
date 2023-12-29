<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<style>
    tr {
        cursor: pointer;
    }
</style>
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-bell'></i> <?php echo trans('notifications') ?></h4>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <?php foreach ($notifications as $n) : ?>
                    <!-- <div class="box col-md-12">
                    <div class="body-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class='m-0'><?php echo trim($n->text) ?></p>
                            </div>
                        </div>
                    </div>
                </div> -->

                    <div class="box col-md-12">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="fa fa-<?php echo $n->fa_icon ?>"></i>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-danger btn-sm " noti_id='<?php echo $n->id ?>' onclick="delete_notification_by_seller(this,event)"><i class="fas fa-xmark"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <p class='m-0'><?php echo trim($n->text) ?></p>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <?php echo time_diff_string($n->date, 'now') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
                <!-- <div class="col-12">
                    <div class="mailbox-messages inbox-bx">
                        <div class="table-responsive">
                            <table class="table table-hover no-wrap ">
                                <?php echo csrf_field() ?>
                                <tbody>
                                    <?php foreach ($notifications as $n) : ?>
                                    <tr onclick="redirect('<?php echo $n->uri ?>',event)">
                                        <td></td>
                                        <td width='80%'>
                                            <p class='m-0'><?php echo trim($n->text) ?></p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                        </td>
                                        <td><button type="button" class="btn btn-primary btn-sm" noti_id='<?php echo $n->id ?>'
                                                onclick="delete_notification_by_seller(this,event)"><i
                                                    class="ion ion-trash-a"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
        </section>
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>
<script src='<?php echo base_url('public/custom/js/notification/notification.js') ?>'></script>