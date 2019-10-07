<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pizzamax</title>

  <!-- Theme CSS -->
  <link rel="icon" type="image/png" href="<?php echo base_url() . 'statics/images/fav-icon.png' ?>">
  <link href="<?php echo base_url() . 'statics/css/bootstrap.min.css' ?>" rel="stylesheet">
  <link href="<?php echo base_url() . 'statics/css/svg-with-js.min.css' ?>" rel="stylesheet">
  <link href="<?php echo base_url() . 'statics/css/all.min.css' ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="<?php echo base_url() . 'statics/css/owl.carousel.min.css' ?>" rel="stylesheet">
  <link href="<?php echo base_url() . 'statics/css/owl.theme.default.min.css' ?>" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <link href="<?php echo base_url() . 'statics/css/aos.css' ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link href="<?php echo base_url() . 'statics/css/theme.css' ?>" rel="stylesheet">
</head>

<body>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '672903956526335',
        xfbml      : true,
        version    : 'v4.0'
      });
      FB.AppEvents.logPageView();
    };

    (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a>
  <header>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 align-self-center">

        <div class="top-header section-bg-dark-grey ">
          <div class="pmax-container">
            <div class="row">
              <div class="col-md-12 text-right">
                <ul class="top-header-ul list-inline m-0 p-0">
                  <li class="list-inline-item"><a href="/outlets">Find Pizza Max</a></li>
                  <li id="header_account_link" class="list-inline-item"><a href="/profile">My Account</a></li>
                  <li id="header_login_link" class="list-inline-item"><a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal">Login</a></li>
                  <li id="header_logout_link" onclick="logout()" class="list-inline-item"><a href="javascript:void(0);">Logout</a></li>
                  <li class="list-inline-item">
                      <div class="dropdown track-dropdown show">
                        <a class="dropdown-toggle track-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Track Order
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                          <input type="text" class="form-control" id="track_order_head_code_input" placeholder="Order ID" required> 
                          <button type="submit" class="btn pmax-btn track-btn w-100" onclick="track_my_order(document.getElementById('track_order_head_code_input').value)">Track</button> 
                        </div>
                      </div>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="./"><img src="<?php echo base_url() . 'statics/images/logo.png' ?>" class="img-fluid"></a>
          <ul class="pmax-mob-nav-item list-inline">
            <li class="list-inline-item">
              <button type="button" id="sidebarCollapse" class="btn pmax-btn-toggle"><i class="fas fa-bars"></i></button>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="/checkout">
                <div class="cart-badge"><i class="fas fa-shopping-cart"></i><span class="orders_count_header_icon">0</span></div>
              </a>
            </li>
          </ul>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
              <li>
                <a class="nav-link" href="/real-big-deals">Real Big Deals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/tempting-deals">Tempting Deals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/midnight-deals">Midnight Deals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/menu">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/checkout">
                  <div class="cart-badge"><i class="fas fa-shopping-cart"></i><span class="orders_count_header_icon">0</span></div>
                </a>
              </li>
            </ul>
          </div>
        </nav>


      </div>
    </div>
  </header>


  <div class="wrapper">
    <!-- Main Menu Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="<?php echo base_url() . 'statics/images//logo.png' ?>" alt="logo">
        <button id="dismiss" class="btn pmax-btn-close dismiss">
          <i class="fas fa-times"></i>
        </button>
        <div class="sidenav-login" id="sidenav_login_link">
          <a class="dismiss" href="javascript:void(0);" data-toggle="modal" data-target="#loginModal"><i class="far fa-user"></i> Login / Create Account</a>
        </div>
        <div class="sidenav-login" id="sidenav_logout_link">
          <a onclick="logout()" class="dismiss" href="javascript:void(0);"><i class="far fa-user"></i> Logout</a>
        </div>
        <div class="sidenav-avatar d-none">
          <div class="user-avatar pmax-white">
            <h3 class="pmax-h3 m-0"><i class="far fa-user"></i></h3>
          </div>
          <div class="avatar-info">
            <h5 class="pmax-h5 pmax-white mb-1">John Doe</h5>
            <h6 class="pmax-h6 pmax-white pmax-normal mb-0">john_doe@xyz.com</h6>
          </div>
        </div>
      </div>

      <ul class="list-unstyled components">
        <li>
          <label class="px-2">Track Order</label>
          <div class="input-group location-search px-2 mb-3">
            <input type="text" class="form-control" id="track_order_sidebar_code_input" placeholder="Order ID" required>
            <div class="input-group-append">
              <button class="btn btn-secondary" onclick="track_my_order(document.getElementById('track_order_sidebar_code_input').value)" type="button"> GO </button>
            </div>
          </div>
        </li>
        <li><a href="/menu"><span><img src="<?php echo base_url() . 'statics/images/icons/small-icons-grey/menu.png' ?>"></span> Menu</a></li>
        <li>
          <a href="#homeSubmenuMulti1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span><img src="<?php echo base_url() . 'statics/images/icons/small-icons-grey/deals.png' ?>"></span> Deals</a>
          <ul class="collapse list-unstyled" id="homeSubmenuMulti1">
            <li>
              <a href="/real-big-deals">Real Big Deals</a>
              <a href="/tempting-deals">Tempting Deals</a>
              <a href="/midnight-deals">Midnight Deals</a>
            </li>
          </ul>
        </li>
        <li id="small_account_link"><a href="/profile"><span><img src="<?php echo base_url() . 'statics/images/icons/small-icons-grey/user.png' ?>"></span> My Account</a></li>
        <li><a href="/track-order"><span><img src="<?php echo base_url() . 'statics/images/icons/small-icons-grey/user.png' ?>"></span> Track Order</a></li>
        <li><a href="/outlets"><span><img src="<?php echo base_url() . 'statics/images/icons/small-icons-grey/shop.png' ?>"></span> Find Pizza Max</a></li>
      </ul>
    </nav>
  </div>
  <div class="overlay"></div>

  <script src="<?php echo base_url() . 'statics/js/custom/header_v.2.js' ?>"></script>

