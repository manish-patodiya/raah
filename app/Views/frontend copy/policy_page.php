<?php
echo view('frontend/include/header_top');
echo view('frontend/include/header');
?>
<style>
    .mx-300 {
        margin-left: 300px !important;
        margin-right: 300px !important;
    }

    .mx-250 {
        margin-left: 250px !important;
        margin-right: 250px !important;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-80 mx-250" style='width:auto;'>
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <h3 class="text-center"><?php echo $name ?></h3>
        </div>
        <!-- Main content -->
        <section class="content" style='font-size:16px;line-height:1.9;'>
            <?php echo $content ?>
        </section>
    </div>
</div>
<!-- /.content-wrapper -->

<?php echo view('frontend/include/footer') ?>