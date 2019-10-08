<?php include("header.php"); ?>

<section class="pmax-menu-card pattern-bg section-padbottom-70">
  <div class="section-bg-white">
    <div class="container tab-width">
      <div class="row">
        <div class="col-12">
          <ul class="nav nav-pills nav-justified m-0" id="pills-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link active" id="pills-appetizer-tab" data-toggle="pill" href="#pills-appetizer" role="tab" aria-controls="pills-appetizer" aria-selected="true">Appetizers</a> </li>
            <li class="nav-item"> <a class="nav-link" id="pills-pizza-tab" data-toggle="pill" href="#pills-pizza" role="tab" aria-controls="pills-pizza" aria-selected="false">Pizza</a> </li>
            <li class="nav-item"> <a class="nav-link" id="pills-pasta-tab" data-toggle="pill" href="#pills-pasta" role="tab" aria-controls="pills-pasta" aria-selected="false">Pastas</a> </li>
            <li class="nav-item"> <a class="nav-link" id="pills-sandwich-tab" data-toggle="pill" href="#pills-sandwich" role="tab" aria-controls="pills-sandwich" aria-selected="false">Sandwiches</a> </li>
            <li class="nav-item"> <a class="nav-link" id="pills-beverage-tab" data-toggle="pill" href="#pills-beverage" role="tab" aria-controls="pills-beverage" aria-selected="false">Beverages</a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="container tab-width">
    <div class="row">
      <div class="col-lg-8">
        <div class="tab-content my-4" id="pills-tabContent">

          <!-- appetizer -->
          <div class="tab-pane fade show active" id="pills-appetizer" role="tabpanel" aria-labelledby="pills-appetizer-tab">

            <?php foreach ($appetizer as $item) : ?>

              <div class="card">
                <div class="row no-gutters">
                  <div class="col-sm-3 col-4"> <img class="card-img-top img-fluid" src="<?php echo base_url() . $item->image ?>" alt="Card image cap"> </div>
                  <div class="col-sm-9 col-8">
                    <div class="card-body">
                      <h5 class="pmax-h5"><?php echo $item->name ?></h5>
                      <p class="pmax-light-grey pr-5"><?php echo $item->description ?></p>
                      <div class="pmax-menu-card-box">
                        <div class="row no-gutters">
                          <div class="col-8 align-self-center">
                            <h5 class="pmax-h5 m-0"><span class="pmax-light-grey small-text pmax-normal">From</span> PKR <?php echo $item->price ?></h5>
                          </div>
                          <div class="col-4 align-self-center text-right">
                            <a onclick="get_foods_items(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#singleMenuModal">Add <i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <!-- appetizer -->

          <!--Pizza-->
          <div class="tab-pane fade" id="pills-pizza" role="tabpanel" aria-labelledby="pills-pizza-tab">

            <?php foreach ($pizza as $item) : ?>

              <div class="card">
                <div class="row no-gutters">
                  <div class="col-sm-3 col-4"> <img class="card-img-top img-fluid" src="<?php echo base_url() . $item->image ?>" alt="Card image cap"> </div>
                  <div class="col-sm-9 col-8">
                    <div class="card-body">
                      <h5 class="pmax-h5"><?php echo $item->name ?></h5>
                      <p class="pmax-light-grey pr-5"><?php echo $item->description ?></p>
                      <div class="pmax-menu-card-box">
                        <div class="row no-gutters">
                          <div class="col-8 align-self-center">
                            <h5 class="pmax-h5 m-0"><span class="pmax-light-grey small-text pmax-normal">From</span> PKR <?php echo $item->price ?></h5>
                          </div>
                          <div class="col-4 align-self-center text-right">
                            <a onclick="get_foods_items(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#singleMenuModal">Add <i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <!--Pizza-->

          <!--Pastas-->
          <div class="tab-pane fade" id="pills-pasta" role="tabpanel" aria-labelledby="pills-pasta-tab">

            <?php foreach ($pastas as $item) : ?>

              <div class="card">
                <div class="row no-gutters">
                  <div class="col-sm-3 col-4"> <img class="card-img-top img-fluid" src="<?php echo base_url() . $item->image ?>" alt="Card image cap"> </div>
                  <div class="col-sm-9 col-8">
                    <div class="card-body">
                      <h5 class="pmax-h5"><?php echo $item->name ?></h5>
                      <p class="pmax-light-grey pr-5"><?php echo $item->description ?></p>
                      <div class="pmax-menu-card-box">
                        <div class="row no-gutters">
                          <div class="col-8 align-self-center">
                            <h5 class="pmax-h5 m-0"><span class="pmax-light-grey small-text pmax-normal">From</span> PKR <?php echo $item->price ?></h5>
                          </div>
                          <div class="col-4 align-self-center text-right">
                            <a onclick="get_foods_items(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#singleMenuModal">Add <i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <!--Pastas-->

          <!--Sandwich-->
          <div class="tab-pane fade" id="pills-sandwich" role="tabpanel" aria-labelledby="pills-sandwich-tab">

            <?php foreach ($sandwiches as $item) : ?>

              <div class="card">
                <div class="row no-gutters">
                  <div class="col-sm-3 col-4"> <img class="card-img-top img-fluid" src="<?php echo base_url() . $item->image ?>" alt="Card image cap"> </div>
                  <div class="col-sm-9 col-8">
                    <div class="card-body">
                      <h5 class="pmax-h5"><?php echo $item->name ?></h5>
                      <p class="pmax-light-grey pr-5"><?php echo $item->description ?></p>
                      <div class="pmax-menu-card-box">
                        <div class="row no-gutters">
                          <div class="col-8 align-self-center">
                            <h5 class="pmax-h5 m-0"><span class="pmax-light-grey small-text pmax-normal">From</span> PKR <?php echo $item->price ?></h5>
                          </div>
                          <div class="col-4 align-self-center text-right">
                            <a onclick="get_foods_items(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#singleMenuModal">Add <i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <!--Sandwich-->

          <!--Beverages-->
          <div class="tab-pane fade" id="pills-beverage" role="tabpanel" aria-labelledby="pills-beverage-tab">

            <?php foreach ($beverages as $item) : ?>

              <div class="card">
                <div class="row no-gutters">
                  <div class="col-sm-3 col-4"> <img class="card-img-top img-fluid" src="<?php echo base_url() . $item->image ?>" alt="Card image cap"> </div>
                  <div class="col-sm-9 col-8">
                    <div class="card-body">
                      <h5 class="pmax-h5"><?php echo $item->name ?></h5>
                      <p class="pmax-light-grey pr-5"><?php echo $item->description ?></p>
                      <div class="pmax-menu-card-box">
                        <div class="row no-gutters">
                          <div class="col-8 align-self-center">
                            <h5 class="pmax-h5 m-0"><span class="pmax-light-grey small-text pmax-normal">From</span> PKR <?php echo $item->price ?></h5>
                          </div>
                          <div class="col-4 align-self-center text-right">
                            <a onclick="get_foods_items(<?php echo $item->id ?>)" href="javascript:(void);" class="btn pmax-btn" data-toggle="modal" data-target="#singleMenuModal">Add <i class="fas fa-plus"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>

          </div>
          <!--Beverages-->

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


<script src="<?php echo base_url() . 'statics/js/custom/food_modal_v.1.js' ?>"></script>
<script src="<?php echo base_url() . 'statics/js/custom/my_cart_v.6.js' ?>"></script>