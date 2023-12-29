<?php
echo view('customer/include/header_top');
echo view('customer/include/header');
echo view('customer/include/sidebar');
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
                    <h4 class="page-title"><i class='fa fa-bell'></i> <?php echo trans('setting') ?></h4>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body"> </div>
                    </div>
                </div>
        </section>
    </div>
</div>
<?php
echo view('customer/include/footer.php');
?>