	<!---page Title --->
	<!--Page content -->

	<section class="py-170 cust-accordion">
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-md-6 col-12 text-center">
	                <div class="section-heading mb-30">
	                    <h2 class="heading fw-500"><span class="text-primary">FAQs</span></h2>
	                    <hr class="p-1 bg-primary w-30">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-12">
	                <div class="tab-wrapper v1">
	                    <div class="list">
	                        <?php foreach ($faqs as $k => $v) {?>
	                        <div class="item">
	                            <div class="tab-btn">
	                                <a href="#"><?php echo $v->question ?><em class="mdi mdi-plus"></em></a>
	                            </div>
	                            <div class="tab-content">
	                                <p><?php echo $v->answer ?></p>
	                            </div>
	                        </div>
	                        <?php }?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>