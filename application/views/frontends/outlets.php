<?php include "header.php";?>

<section class="pmax-accordian pattern-bg section-padtop-50 section-padbottom-70">
	<div class="container tab-width">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="pmax-h1 pmax-red text-uppercase text-center pmax-extra-bold lh-min mb-5">Our Outlets<br><span class="pmax-h4 pmax-grey">Find Us</span></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div id="map"></div>
			</div>
			<div class="col-lg-6">
				<div class="profile-card outlet-card-box p-3">
					<div class="location-filter dropdown text-right">
						<button class="btn pmax-btn pmax-btn-lg dropdown-toggle mb-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Select City
						</button>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#" onclick="get_outlets('all')">All</a>
							<a class="dropdown-item" href="#" onclick="get_outlets('karachi')">Karachi</a>
							<a class="dropdown-item" href="#" onclick="get_outlets('lahore')">Lahore</a>
							<a class="dropdown-item" href="#" onclick="get_outlets('faisalabad')">Faisalabad</a>
						</div>
					</div>

					<div id="outlets_div"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include "footer.php";?>

<script src="<?php echo base_url() . 'statics/js/custom/outlets_v.1.js' ?>"></script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRlwzku4Z02K2_FWQu_g-TVHRsP8OdKLM&callback=initMap" async defer></script>


<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>