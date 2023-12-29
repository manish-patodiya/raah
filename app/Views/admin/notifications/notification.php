<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
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
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="mailbox-messages inbox-bx">
                                <div class="table-responsive">
                                    <table class="table table-hover no-wrap ">
                                        <?php echo csrf_field() ?>
                                        <tbody>
                                            <?php foreach ($notifications as $n) : ?>
                                                <tr onclick="redirect('<?php echo $n->uri ?>',event)">
                                                    <td><i class="fa fa-<?php echo $n->fa_icon ?>"></i></td>
                                                    <td width='80%'>
                                                        <p class='m-0'><?php echo trim($n->text) ?></p>
                                                    </td>
                                                    <td class="mailbox-date"><?php echo time_diff_string($n->date, 'now') ?></td>
                                                    <td><button type="button" class="btn btn-primary btn-sm" noti_id='<?php echo $n->id ?>' onclick="delete_notification_by_admin(this,event)"><i class="ion ion-trash-a"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
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
echo view('admin/include/footer.php');
?>
<script src='<?php echo base_url('public/custom/js/notification/notification.js') ?>'></script>