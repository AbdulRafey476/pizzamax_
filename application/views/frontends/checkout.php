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

<section class="pmax-accordian pattern-bg section-padtop-50 section-padbottom-30">
  <div class="container tab-width">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="pmax-h1 pmax-red text-uppercase text-center pmax-extra-bold lh-min mb-5">Checkout<br><span class="pmax-h4 pmax-grey">Details</span></h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-7">
        <div id="accordion">

          <div class="card">
          
            <div class="card-header section-bg-gradient" id="headingTwo">
              <h5 data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true">
                Personal Details
              </h5>
            </div>
            <div id="collapseTwo" class="collapse show">
              <div class="card-body edit-info">


                <div class="row">
                  <div class="col-12">

                    <div class="form-group">
                      <label>Full Name</label>
                      <input id="user_name" type="test" class="form-control" placeholder="e.g 'Jhon'" required>
                    </div>

                    <div class="form-group">
                      <label>Email Address</label>
                      <input id="user_email" type="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>

                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" id="user_number_input" class="form-control" placeholder="Mobile number here" required>
                    </div>
                    
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="card">

            <div class="card-header section-bg-gradient" id="headingOne">
              <h5 class="link" class="collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false">
                Delivery Locations
              </h5>
            </div>

            <div id="collapseOne" class="collapse">
              <div class="card-body">

                <form id="new_addresses">
                  <div class="edit-address">
                    <div class="form-group">
                      <label>Title</label>
                      <input id="new_address_title" type="text" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input id="new_address" type="text" class="form-control" placeholder="Building & street number here" required>
                    </div>
                    <div class="form-group">
                      <label>Contact Number</label>
                      <input id="new_address_contact" type="number" class="form-control" placeholder="Contact number here" required>
                    </div>
                  </div>
                </form>

                <div class="address-showcase">

                  <div id="addresses_render_div"></div>

                  <div class="card mb-3" id="add_new_address_box" style="display: none">
                    <div class="card-body">
                      <a href="javascript:void(0);" data-toggle="modal" data-target="#addressModal" class="pmax-h6 pmax-red mb-0 new-card-btn">+ Add New Address</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header section-bg-gradient" id="headingThree">
              <h5 class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">
                Payment Method
              </h5>
            </div>
            <div id="collapseThree" class="collapse">
              <div class="card-body">
                <form>
                  <div class="address-showcase">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-10 align-self-center">
                            <h6 class="pmax-h6 pmax-grey mb-0">Cash On Delivery</h6>
                          </div>
                          <div class="col-2 align-self-center text-right">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="paymentSelect1" name="example1" value="customEx" checked="checked">
                              <label class="custom-control-label" for="paymentSelect1">&nbsp;</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 checkout-cart">

        <div class="section-bg-white p-3 side-cart-border">

          <div id="checkout_cart_div"></div>

          <button id="order_data_submit" class="btn pmax-btn pmax-btn-lg w-100 mt-3" style="display: none">Place Order</button>

        </div>
      </div>
    </div>
  </div>
</section>

<div class="loading hidden">Loading&#8230;</div>

<?php include "footer.php"; ?>

<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>