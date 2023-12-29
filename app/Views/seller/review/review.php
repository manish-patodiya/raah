<?php
echo view('seller/include/header_top');
echo view('seller/include/header');
echo view('seller/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class='fa fa-star-o'></i> <?php echo trans('review') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class='col-md-12'>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table_responsive" id="review_tbl">
                                <thead>
                                    <tr>
                                        <th>Product Photo</th>
                                        <th>Review By</th>
                                        <th>Review</th>
                                        <th>Product Rating Images</th>
                                        <th>Reviewed On</th>
                                </thead>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('seller/include/footer.php');
?>
<script src="<?php echo base_url("public/custom/js/seller/review.js") ?>"></script>