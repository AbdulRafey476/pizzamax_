<?php include("header.php"); ?>

<style>
	.lds-ripple {
		display: inline-block;
		position: relative;
		width: 64px;
		height: 64px;
	}

	.lds-ripple div {
		position: absolute;
		border: 4px solid black;
		opacity: 1;
		border-radius: 50%;
		animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
	}

	.lds-ripple div:nth-child(2) {
		animation-delay: -0.5s;
	}

	@keyframes lds-ripple {
		0% {
			top: 28px;
			left: 28px;
			width: 0;
			height: 0;
			opacity: 1;
		}

		100% {
			top: -1px;
			left: -1px;
			width: 58px;
			height: 58px;
			opacity: 0;
		}
	}
</style>

<section class="pmax-deals-card pattern-bg section-padtop-50 section-padbottom-30">
	<div class="container tab-width">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="pmax-h1 pmax-red text-uppercase text-center pmax-extra-bold lh-min mb-5">Tempting<br><span class="pmax-h4 pmax-grey">Deals</span></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="row">

					<?php foreach ($tempting_deals as $item) : ?>

						<div class="col-lg-3 col-md-4 col-sm-4 col-6" style="display:flex;">
							<div class="card">
								<div class="zoom-item">
									<img class="card-img-top img-fluid" src="<?php echo base_url() . $item->path ?>" alt="Card image cap">
								</div>
								<div class="card-body" style="display:grid;">
									<h6 class="pmax-h6"><?php echo $item->name ?></h6>
									<p class="card-para pmax-light-grey"><?php echo $item->description ?></p>
									<div class="row no-gutters">
										<div class="col-6 align-self-center">
											<h6 class="pmax-h6 text-uppercase m-0"><?php echo $item->price ?></h6>
										</div>
										<div class="col-6 align-self-center text-right">
											<a onclick="get_deal_details(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#dealMenuModal">Add <i class="fas fa-plus"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="card">
							<div class="zoom-item ad-zoom">
								<a href="#"><img class="img-fluid" src="<?php echo base_url() . 'statics/images/ads/1.png' ?>" alt="Card image cap"></a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="card">
							<div class="zoom-item ad-zoom">
								<a href="#"><img class="img-fluid" src="<?php echo base_url() . 'statics/images/ads/2.png' ?>" alt="Card image cap"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 side-cart">
				<div class="section-bg-white p-3 side-cart-border">
					<!-- <h4 class="pmax-h4 mb-3">Delivery Location</h4>
					<div class="input-group location-search">
						<input type="text" class="form-control" placeholder="Search...">
						<div class="input-group-append">
							<button class="btn btn-secondary" type="button"> <img src="<?php echo base_url() . 'statics/images/icons/current-location.png' ?>" class="current-location-icon"> </button>
						</div>
					</div>
					<p class="text-center my-3">Yay! We deliver to your selected location</p> -->

					<div id="checkout_cart_div"></div>

				</div>
			</div>
		</div>
	</div>
</section>


<?php include("footer.php"); ?>

<script src="<?php echo base_url() . 'statics/js/custom/deal_modal_v.1.js' ?>"></script>
<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>