<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--Single Menu Modal Popup-->

<style>
  .hidden {
    display: none
  }
</style>

<div class="footer-modal">
  <div class="modal fade" id="singleMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-forms modal-content section-bg-grey">
        <div class="modal-body food-modal pattern-bg">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>

          <div id="food_details"></div>

          <h6 class="pmax-h6 pmax-extra-bold">Instructions</h6>
          <div class="card instruction-textarea">
            <div class="card-body p-3">
              <form>
                <div class="form-group m-0">
                  <textarea class="form-control p-0" rows="4" placeholder="Write here..."></textarea>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-5">
              <!--ATC Spinner Start-->
              <div class="modal-counter">
                <div class="input-group number-spinner"> <span class="input-group-btn">
                    <button class="btn pmax-btn-minus" data-dir="dwn"><i class="fas fa-minus"></i></button>
                  </span>
                  <input type="text" class="form-control text-center" id="food_qty" value="1">
                  <span class="input-group-btn">
                    <button class="btn pmax-btn-plus" data-dir="up"><i class="fas fa-plus"></i></button>
                  </span> </div>
              </div>
              <!--ATC Spinner End-->
            </div>
            <div class="col-7">
              <button id="food_modal_details_form" class="btn pmax-btn pmax-btn-lg w-100">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--Deal Menu Modal Popup-->

<div class="footer-modal footer-deals-modal">
  <div class="modal fade" id="dealMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-forms modal-content section-bg-grey">
        <div class="modal-body food-modal pattern-bg px-0">

          <div id="featured_deal_details"></div>

          <div class="deal-modal-padding px-3">
            <div class="row">
              <div class="col-5">
                <!--ATC Spinner Start-->
                <div class="modal-counter">
                  <div class="input-group number-spinner">
                    <span class="input-group-btn">
                      <button class="btn pmax-btn-minus" data-dir="dwn"><i class="fas fa-minus"></i></button>
                    </span>
                    <input type="text" id="deal_qty" class="form-control text-center" value="1">
                    <span class="input-group-btn">
                      <button class="btn pmax-btn-plus" data-dir="up"><i class="fas fa-plus"></i></button>
                    </span>
                  </div>
                </div>
                <!--ATC Spinner End-->
              </div>
              <div class="col-7">
                <button id="deal_modal_details_form" type="submit" class="btn pmax-btn pmax-btn-lg w-100">Add to Cart</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!--Place Order Modal Popup-->

  <div class="footer-modal">
    <div class="modal fade" id="placeOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal pattern-bg p-0">
            <div class="section-bg-grey text-center p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>
              <div class="modal-food-item">
                <img src="<?php echo base_url() . 'statics/images/modal-pizza.png' ?>" class="img-fluid" alt="pizza-img">
              </div>
            </div>

            <div class="section-bg-white text-center p-4">
              <h5 class="pmax-h5 pmax-grey pmax-bold text-center mb-4">Login Using</h5>
              <div class="row">
                <div class="col-6">
                  <button onclick="facebook_login()" class="btn pmax-btn-fb w-100">Facebook</button>
                </div>
                <div class="col-6">
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" data-dismiss="modal" class="btn pmax-btn-email w-100">Email</a>
                </div>
              </div>

              <h5 class="pmax-h5 pmax-grey pmax-bold text-center my-4">or</h5>
              <a href="/checkout" class="btn pmax-btn-guest">Guest Checkout</a>
              <h6 class="pmax-h6 pmax-grey pmax-medium text-center mt-3">New user? <a href="javascript:void(0);" id="" class="lnkNewSignUp signup-link" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Create an account</a></h6>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--Login Forms-->

  <div class="footer-modal">
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal section-bg-grey p-0">
            <div class="pattern-bg p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <section class="section-padtop-10 section-padbottom-10">
                <form class="login-form" id="user_login_form">
                  <div class="modal-food-item-logo"> <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img"> </div>
                  <h5 class="pmax-h5 pmax-grey pmax-bold text-center">Sign In</h5>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input id="login_email" type="email" class="form-control" placeholder="Email address here" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input id="login_password" type="password" class="form-control" placeholder="Enter password here" required>
                  </div>
                  <div class="row">
                    <div class="col-6"> <a href="javascript:void(0);" class="forget-password-link" id="forget-password">Forgot your password?</a> </div>
                    <div class="col-6 text-right"> <a href="javascript:void(0);" id="" class="lnkNewSignUp signup-link">Create Account</a> </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <h6 id="login_error_msgs" style="color:red"></h6>
                    <button class="btn pmax-btn pmax-btn-lg w-100" id="login_form_btn">Login <i class="hidden fa fa-lg fa-spinner fa-spin"></i></button>
                  </div>
                  <h5 class="pmax-h5 pmax-grey pmax-bold text-center my-3">OR</h5>
                </form>
                <button onclick="facebook_login()" class="btn pmax-btn-fb w-100">Facebook Login</button>

                <form class="forget-form display-hide" method="post">
                  <div class="text-left form-back-btn"> <a href="javascript:void(0);" id="back-btn"><i class="fa fa-angle-left"></i> Back</a>
                  </div>
                  <div class="modal-food-item-logo"> <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img"> </div>
                  <h5 class="pmax-h5 pmax-grey pmax-bold text-center">Forgot your password ?</h5>
                  <p class="text-center w-75 mx-auto">Enter your email below to reset your password.</p>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email address here" required>
                  </div>
                  <br>
                  <div class="text-center">
                    <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Submit</button>
                  </div>
                </form>

                <form class="signup-form display-hide" id="user_signup_form">
                  <div class="text-left form-back-btn">
                    <a href="javascript:void(0);" id="signUpback-btn"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
                  </div>
                  <div class="modal-food-item-logo"> <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img"> </div>
                  <h5 class="pmax-h5 pmax-grey pmax-bold text-center">Create an account</h5>
                  <div class="form-group">
                    <label>Name</label>
                    <input id="signup_name" type="text" class="form-control" placeholder="Full name here" required>
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input id="signup_number" type="number" class="form-control" placeholder="Mobile number here" required>
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input id="signup_email" type="email" class="form-control" placeholder="Email address here" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input id="signup_password" type="password" class="form-control" placeholder="Enter password here" required>
                  </div>
                  <div class="form-group">
                    <label>Re-enter Password</label>
                    <input id="signup_password_confirm" type="password" class="form-control" placeholder="Re-enter password here" required>
                  </div>
                  <br>
                  <div class="text-center">
                    <h6 id="signup_error_msgs" style="color:red"></h6>
                    <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Register <i class="hidden fa fa-lg fa-spinner fa-spin"></i></button>
                  </div>
                </form>
              </section>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!--OTP Modal Popup-->

  <div class="footer-modal">
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal pattern-bg p-0">
            <div class="section-bg-grey p-4">
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>

              <form id="order_otp_verification_form">
                <h6 id="order_otp_success" style="color:green"></h6>

                <h5 class="pmax-h5 pmax-grey pmax-bold text-center">Verfication</h5>
                <p class="text-center w-75 mx-auto">A code has been sent on you mobile number. Enter the code below to proceed.</p>
                <div class="form-group">
                  <label>Code</label>
                  <input id="order_otp_code" type="text" class="form-control" placeholder="Enter code here" required>
                </div>
                <br>
                <div class="text-center">
                  <h6 id="order_otp_err" style="color:red"></h6>
                  <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Submit <i class="hidden fa fa-lg fa-spinner fa-spin"></i></button>
                </div>
              </form>
              <button id="resend_opt_order_verification" class="btn btn-link">Resend Code</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="footer-modal">
    <div class="modal fade" id="otpModal_not" tabindex="-1" role="dialog" aria-labelledby="otpModal_not" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal pattern-bg p-0">
            <div class="section-bg-grey p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>

              <p class="text-center w-75 mx-auto">Your order has been successfully submited</p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--Guest Checkout Modal Popup-->

  <div class="footer-modal">
    <div class="modal fade" id="guestCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel7" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal section-bg-grey p-0">
            <div class="pattern-bg p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>

              <form id="guest_checkout_form">
                <h5 class="pmax-h5 pmax-grey pmax-bold text-center">Guest Checkout</h5>
                <div class="form-group">
                  <label>Name</label>
                  <input id="user_name" name="user_name" type="text" class="form-control" placeholder="e.g Jhon" required>
                </div>
                <div class="form-group">
                  <label>Mobile Number</label>
                  <input id="user_number" name="user_number" type="number" class="form-control" placeholder="923xxxxxxxxx" required>
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input id="user_email" name="user_email" type="email" class="form-control" placeholder="example@gmail.com" required>
                </div>
                <br>
                <div class="text-center">
                  <button type="submit" class="btn pmax-btn pmax-btn-lg w-100">Submit</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--Add and edit Address Modal Popup-->

  <div class="footer-modal">
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel8" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal section-bg-grey p-0">
            <div class="pattern-bg p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>

              <form id="target">
                <div class="edit-address">
                  <label>Current Location</label>
                  <div class="input-group location-search mb-3">
                    <input type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button"> <img src="<?php echo base_url() . 'statics/images/icons/current-location.png' ?>" class="current-location-icon"> </button>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input id="new_address_title_modal" type="text" class="form-control" placeholder="Title" required>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input id="new_address_modal" type="text" class="form-control" placeholder="Building & street number here" required>
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input id="new_address_contact_modal" type="number" class="form-control" placeholder="Contact number here" required>
                  </div>
                  <div class="text-right mt-3">
                    <button class="btn pmax-btn pmax-btn-lg">Save</button>
                  </div>
                </div>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>



  <!--Add and edit Address Modal Popup-->

  <div class="footer-modal">
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel9" aria-hidden="true">
      <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-forms modal-content section-bg-grey">
          <div class="modal-body food-modal section-bg-grey p-0">
            <div class="pattern-bg p-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              <div class="modal-food-item-logo">
                <img src="<?php echo base_url() . 'statics/images/logo-colored.png' ?>" class="img-fluid" alt="pizza-img">
              </div>

              <form id="edit_user_details">
                <div class="edit-address">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input id="ed_user_name" type="test" class="form-control" placeholder="e.g 'Jhon'" required>
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input id="ed_user_email" type="email" class="form-control" placeholder="example@gmail.com" required>
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input id="ed_user_number" type="number" class="form-control" placeholder="923xxxxxxxxx" required>
                  </div>
                  <div class="form-group">
                    <label>Landline Number (optional)</label>
                    <input id="ed_user_landline" type="number" class="form-control" placeholder="923xxxxxxxxx" required>
                  </div>
                  <div class="text-right mt-3">
                    <button class="btn pmax-btn pmax-btn-lg">Save</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="<?php echo base_url() . 'statics/js/custom/my_modal_form_v.5.js' ?>"></script>