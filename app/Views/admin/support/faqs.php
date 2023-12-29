<?php
echo view('admin/include/header_top');
echo view('admin/include/header');
echo view('admin/include/sidebar');
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title"><i class="fa-solid fa-circle-question"></i> <?php echo trans('faqs') ?></h4>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills rounded nav-justified">
                                <li class="nav-item"> <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">General</a> </li>
                                <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Payment</a> </li>
                                <li class="nav-item"> <a href="#navpills-3" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Offers</a> </li>
                                <li class="nav-item"> <a href="#navpills-4" class="nav-link" data-bs-toggle="tab" aria-expanded="true">Security and Privacy</a> </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="navpills-1" class="tab-pane active">
                                    <!-- Categroy 1 -->
                                    <div class=" tab-pane animation-fade active" id="category-1" role="tabpanel">
                                        <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2" aria-multiselectable="true" role="tablist">
                                            <!-- Question 1 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-1" role="tab">
                                                    <a class="panel-title" aria-controls="answer-1" aria-expanded="true" data-bs-toggle="collapse" href="#answer-1" data-parent="#accordion2">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-1" aria-labelledby="question-1" role="tabpanel" data-bs-parent="#category-1">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 1 -->
                                            <!-- Question 2 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-2" role="tab">
                                                    <a class="panel-title" aria-controls="answer-2" aria-expanded="false" data-bs-toggle="collapse" href="#answer-2" data-parent="#accordion2">
                                                        Nulla nec libero sit amet ligula tincidunt imperdiet vitae sit
                                                        amet lectus?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-2" aria-labelledby="question-2" role="tabpanel" data-bs-parent="#category-1">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 2 -->
                                            <!-- Question 3 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-3" role="tab">
                                                    <a class="panel-title" aria-controls="answer-3" aria-expanded="false" data-bs-toggle="collapse" href="#answer-3" data-parent="#accordion2">
                                                        Morbi quis dui at justo posuere aliquam?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-3" aria-labelledby="question-3" role="tabpanel" data-bs-parent="#category-1">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 3 -->
                                            <!-- Question 4 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-4" role="tab">
                                                    <a class="panel-title" aria-controls="answer-4" aria-expanded="false" data-bs-toggle="collapse" href="#answer-4" data-parent="#accordion2">
                                                        Vivamus dictum turpis at nisi mattis congue?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-4" aria-labelledby="question-4" role="tabpanel" data-bs-parent="#category-1">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 4 -->
                                        </div>
                                    </div>
                                    <!-- End Categroy 1 -->
                                </div>
                                <div id="navpills-2" class="tab-pane">
                                    <!-- Categroy 2 -->
                                    <div class="tab-pane animation-fade" id="category-2" role="tabpanel">
                                        <div class="panel-group panel-group-simple panel-group-continuous" id="accordion" aria-multiselectable="true" role="tablist">
                                            <!-- Question 5 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-5" role="tab">
                                                    <a class="panel-title" aria-controls="answer-5" aria-expanded="true" data-bs-toggle="collapse" href="#answer-5" data-parent="#accordion">
                                                        Nunc porttitor lectus non aliquam semper?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-5" aria-labelledby="question-5" role="tabpanel" data-bs-parent="#category-2">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 5 -->
                                            <!-- Question 6 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-6" role="tab">
                                                    <a class="panel-title" aria-controls="answer-6" aria-expanded="false" data-bs-toggle="collapse" href="#answer-6" data-parent="#accordion">
                                                        Aliquam a lacus et mi convallis pellentesque?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-6" aria-labelledby="question-6" role="tabpanel" data-bs-parent="#category-2">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 6 -->
                                            <!-- Question 7 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-7" role="tab">
                                                    <a class="panel-title" aria-controls="answer-7" aria-expanded="false" data-bs-toggle="collapse" href="#answer-7" data-parent="#accordion">
                                                        Praesent at felis feugiat, malesuada nibh vitae, accumsan erat?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-7" aria-labelledby="question-7" role="tabpanel" data-bs-parent="#category-2">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 7 -->
                                        </div>
                                    </div>
                                    <!-- End Categroy 2 -->
                                </div>
                                <div id="navpills-3" class="tab-pane">
                                    <!-- Categroy 3 -->
                                    <div class="tab-pane animation-fade" id="category-3" role="tabpanel">
                                        <div class="panel-group panel-group-simple panel-group-continuous" id="accordion1" aria-multiselectable="true" role="tablist">
                                            <!-- Question 8 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-8" role="tab">
                                                    <a class="panel-title" aria-controls="answer-8" aria-expanded="true" data-bs-toggle="collapse" href="#answer-8" data-parent="#accordion1">
                                                        Proin ac velit non neque efficitur pretium a a nunc?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-8" aria-labelledby="question-8" role="tabpanel" data-bs-parent="#category-3">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 8 -->
                                            <!-- Question 9 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-9" role="tab">
                                                    <a class="panel-title" aria-controls="answer-9" aria-expanded="false" data-bs-toggle="collapse" href="#answer-9" data-parent="#accordion1">
                                                        Nam egestas massa vitae magna interdum volutpat?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-9" aria-labelledby="question-9" role="tabpanel" data-bs-parent="#category-3">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 9 -->
                                            <!-- Question 10 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-10" role="tab">
                                                    <a class="panel-title" aria-controls="answer-10" aria-expanded="false" data-bs-toggle="collapse" href="#answer-10" data-parent="#accordion1">
                                                        Praesent pretium leo sed turpis vehicula semper?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-10" aria-labelledby="question-10" role="tabpanel" data-bs-parent="#category-3">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 10 -->
                                        </div>
                                    </div>
                                    <!-- End Categroy 3 -->
                                </div>
                                <div id="navpills-4" class="tab-pane">
                                    <!-- Categroy 4 -->
                                    <div class="tab-pane animation-fade" id="category-4" role="tabpanel">
                                        <div class="panel-group panel-group-simple panel-group-continuous" id="accordion3" aria-multiselectable="true" role="tablist">
                                            <!-- Question 11 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-11" role="tab">
                                                    <a class="panel-title" aria-controls="answer-11" aria-expanded="true" data-bs-toggle="collapse" href="#answer-11" data-parent="#accordion3">
                                                        Sed quis nunc bibendum, luctus nulla non, luctus odio?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse show" id="answer-11" aria-labelledby="question-11" role="tabpanel" data-bs-parent="#category-4">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 11 -->
                                            <!-- Question 12 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-12" role="tab">
                                                    <a class="panel-title" aria-controls="answer-12" aria-expanded="false" data-bs-toggle="collapse" href="#answer-12" data-parent="#accordion3">
                                                        Mauris sit amet justo pharetra, venenatis purus eu, efficitur
                                                        nunc?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-12" aria-labelledby="question-12" role="tabpanel" data-bs-parent="#category-4">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 12 -->
                                            <!-- Question 13 -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-13" role="tab">
                                                    <a class="panel-title" aria-controls="answer-13" aria-expanded="false" data-bs-toggle="collapse" href="#answer-13" data-parent="#accordion3">
                                                        Cras venenatis lectus sit amet purus rutrum, non facilisis
                                                        ligula aliquet?
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse" id="answer-13" aria-labelledby="question-13" role="tabpanel" data-bs-parent="#category-4">
                                                    <div class="panel-body">
                                                        I must explain to you how all this mistaken idea of denouncing
                                                        pleasure and praising pain was born and I will give you a
                                                        complete account of the system, and expound the actual teachings
                                                        of the great explorer of the truth, the master-builder of human
                                                        happiness. No one rejects, dislikes, or avoids pleasure itself,
                                                        because it is pleasure, but because those who do not know how to
                                                        pursue pleasure rationally encounter consequences that are
                                                        extremely painful. Nor again is there anyone who loves or
                                                        pursues or desires to obtain pain of itself, because it is pain,
                                                        but because occasionally circumstances occur in which toil and
                                                        pain can procure him some great pleasure. To take a trivial
                                                        example, which of us ever undertakes laborious physical
                                                        exercise, except to obtain some advantage from it? But who has
                                                        any right to find fault with a man who chooses to enjoy a
                                                        pleasure that has no annoying consequences, or one who avoids a
                                                        pain that produces no resultant pleasure?
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Question 13 -->
                                        </div>
                                    </div>
                                    <!-- End Categroy 4 -->
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php
echo view('admin/include/footer.php');
?>