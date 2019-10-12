<script>
	const sessionStoragejsoncheck = (str) => {
		try {
			let a = JSON.parse(str);
			if (!isNaN(a)) {
				return false;
			}
		} catch (e) {
			return false;
		}
		return true;
	}

	var customer = sessionStorage['customer'];

	if (customer) {
		if (!sessionStoragejsoncheck(customer)) {
			window.location.href = location.origin
		}
	} else {
		window.location.href = location.origin
	}
</script>

<?php include "header.php"; ?>

<style>
  /* Absolute Center Spinner */
  .loading {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
  }

  /* Transparent Overlay */
  .loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

    background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
  }

  /* :not(:required) hides these rules from IE9 and below */
  .loading:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
  }

  .loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 1500ms infinite linear;
    -moz-animation: spinner 1500ms infinite linear;
    -ms-animation: spinner 1500ms infinite linear;
    -o-animation: spinner 1500ms infinite linear;
    animation: spinner 1500ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
  }

  /* Animation */

  @-webkit-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @-moz-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @-o-keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  @keyframes spinner {
    0% {
      -webkit-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -ms-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }

  .hidden {
    display: none
  }
</style>


<section class="pmax-profile pattern-bg section-padtop-50 section-padbottom-30">
	<div class="container tab-width">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="pmax-h1 pmax-red text-uppercase text-center pmax-extra-bold lh-min mb-5">Account<br><span class="pmax-h4 pmax-grey">Details</span></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-3">
				<div class="profile-card">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</a>
						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">My Orders</a>
						<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Addresses</a>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="profile-card p-3">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
						    <h6 id="update_basicinfo_success" style="color: green"></h6>
							<form id="profile_form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Full Name</label>
											<input type="text" id="profile_name" name="profile_name" class="form-control" placeholder="Full name here" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email Address</label>
											<input type="email" id="profile_email" name="profile_email" class="form-control" placeholder="Email address here" readonly required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Mobile Number</label>
											<div style="position:relative">
                      <p style="position:absolute;top:10px;left:20px;color:#444">92-</p>
                      <input type="text" id="profile_number" name="profile_number"  class="form-control" style="padding-left:42px !important" placeholder="Mobile number here" required>
                      </div>
											<!-- <input type="number" id="profile_number" name="profile_number" class="form-control" placeholder="Mobile number here" required> -->
										</div>
									</div>
									<!-- <div class="col-md-6">
										<div class="form-group">
											<label>Landline (Optional)</label>
											<input type="number" id="profile_landline" name="profile_landline" class="form-control" placeholder="landline number here" required>
										</div>
									</div> -->
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="text-center mt-3">
											<button class="btn pmax-btn pmax-btn-lg">Update <i class="hidden fa fa-lg fa-spinner fa-spin profile_form_spin"></i></button>
										</div>
									</div>
								</div>
							</form>

							<hr>

						    <h6 id="update_password_success" style="color: green"></h6>
							<form id="profile_update_password">
								<div class="row">
								    
								    <div class="col-md-4">
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" id="update_profile_old_pwd" class="form-control" placeholder="Enter current password here" required>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Password</label>
											<input type="password" id="update_profile_pwd" class="form-control" placeholder="Enter password here" required>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-group">
											<label>Re-enter Password</label>
											<input type="password" id="update_profile_pwd_confirm" class="form-control" placeholder="Re-enter password here" required>
										</div>
									</div>
									
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="text-center mt-3">
											<button class="btn pmax-btn pmax-btn-lg">Update Password <i class="hidden fa fa-lg fa-spinner fa-spin profile_update_password_spin"></i></button>
										</div>
									</div>
								</div>
				                <h6 id="update_password_fail" style="color: red"></h6>
							</form>

						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<h5 class="pmax-h5 pmax-grey">Active Orders</h5>
							<hr>

							<p id="user_no_active_orders" class="pmax-h6 pmax-light-grey pmax-medium text-center"></p>
							<ul id="user_active_orders" class="list-unstyled p-0 m-0 order-history-list"></ul>

							<br>
							<h5 class="pmax-h5 pmax-grey">Orders History</h5>
							<hr>

							<p id="user_no_history_orders" class="pmax-h6 pmax-light-grey pmax-medium text-center"></p>
							<ul id="user_history_orders" class="list-unstyled p-0 m-0 order-history-list"></ul>

						</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<h5 class="pmax-h5 pmax-grey">Addresses</h5>
							<div class="address-showcase">

								<div id="user_profile_addresses"></div>

								<div class="card mb-3">
									<div class="card-body">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#addressModal" class="pmax-h6 pmax-red mb-0 new-card-btn">+ Add New Address</a>
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

<div class="loading hidden">Loading&#8230;</div>

<?php include "footer.php"; ?>

<script src="<?php echo base_url() . 'statics/js/custom/profile_v.4.js' ?>"></script>
<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>