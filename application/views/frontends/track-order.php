<?php include("header.php");?>

<section class="pattern-bg section-padtop-50 section-padbottom-50">

  <div class="container">
            <div class="row">
				<div class="col-lg-12">
					<h1 class="pmax-h1 pmax-red text-uppercase text-center pmax-extra-bold lh-min mb-5">Track<br><span class="pmax-h4 pmax-grey">Order</span></h1>
					<p style="text-align:center; font-weight: 900;" id="display_order_code"></p>
				</div>
			</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline12">
                        <div id="order_pending" class="col-md-3 col-sm-4 timeline">
                            <span class="timeline-icon">
                                <i class="fas fa-exclamation"></i>
                            </span>
                            <div class="border"></div>
                            <div class="timeline-content">
                                <h5 class="title">Order Pending</h5>
                                <!-- <p class="description">02 Sep, 2019 20:30 pm</p> -->
                            </div>
                        </div>
                        <div id="order_accepted" class="col-md-3 col-sm-4 timeline">
                        	<div class="row-inv">
                        		<div class="col-inv">
                        			<div class="timeline-content">
		                                <h5 class="title">Order Accepted</h5>
		                                <!-- <p class="description">02 Sep, 2019 20:30 pm</p> -->
		                            </div>
                        		</div>
                        		<div class="col-inv">
                        			<div class="row-inv">
                        				<div class="col-inv">
                        					<div class="border"></div>
                        				</div>
                        				<div class="col-inv">
                        					<span class="timeline-icon">
	                                    		<i class="fas fa-check"></i>
	                                		</span>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
                        <div id="order_dispatched" class="col-md-3 col-sm-4 timeline">
                            <span class="timeline-icon">
                                <i class="fas fa-motorcycle"></i>
                            </span>
                            <div class="border"></div>
                            <div class="timeline-content">
                                <h5 class="title">Order Dispatched</h5>
                                <!-- <p class="description">02 Sep, 2019 20:30 pm</p> -->
                            </div>
                        </div>
                        
                        <div id="order_delivered" class="col-md-3 col-sm-4 timeline">
                        	<div class="row-inv">
                        		<div class="col-inv">
                        			<div class="timeline-content">
		                                <h5 class="title">Order Delivered</h5>
		                                <!-- <p class="description">02 Sep, 2019 20:30 pm</p> -->
		                            </div>
                        		</div>
                        		<div class="col-inv">
                        			<div class="row-inv">
                        				<div class="col-inv">
                        					<div class="border"></div>
                        				</div>
                        				<div class="col-inv">
                        					<span class="timeline-icon">
	                                    		<i class="fas fa-check-double"></i>
	                                		</span>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

		

<?php include("footer.php");?>

<script src="<?php echo base_url() . 'statics/js/custom/track_order_v.2.js' ?>"></script>
<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>