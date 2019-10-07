
$(document).ready(function(){
   
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    autoplay:true,
    autoplayTimeout: 2000,
    autoplaySpeed: 4000,
    slideTransition: 'linear',
    autoplayHoverPause:true,
    responsive:{
            0:{
                items:1
            
            },
            600:{
                items:2
                
            },
            1024:{
                items:4
            },
            1025:{
                items:6
            }

        }
});

    AOS.init({
      once: true,
      nitClassName: 'aos-init',
      animatedClassName: 'aos-animate',
      duration: 1000,
      easing: 'ease'
    });
    
   
});

//menu active Start
$(document).ready(function () {
        var url = window.location;
        $('ul.navbar-nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.navbar-nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    console.log("tab shown...");
});
//Top header
$(document).ready(function () {
    var url = window.location;
    $('.top-header-ul a[href="'+ url +'"]').parent().addClass('active');
    $('.top-header-ul a').filter(function() {
         return this.href == url;
    }).parent().addClass('active');
});

//Scrolling Menu
$(document).ready(function () {
    var url = window.location;
    $('.pn-ProductNav_Contents a[href="'+ url +'"]').parent().addClass('active');
    $('.pn-ProductNav_Contents a').filter(function() {
         return this.href == url;
    }).parent().addClass('active');
});

//menu active End

// read hash from page load and change tab
var hash = document.location.hash;
var prefix = "tab_";
if (hash) {
    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
} 


$(document).ready(function () {
            
            //Sidebar
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('.dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            //secondary-sidebar
            $("#secondary-sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#secondary-dismiss, .overlay').on('click', function () {
                $('#secondary-sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('.secondarySidebarCollapse').on('click', function () {
                $('#secondary-sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });


//Input Number Spinner

$(document).on('click', '.number-spinner .btn', function () {    
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0;
    
    if (btn.attr('data-dir') == 'up') {
        newVal = parseInt(oldValue) + 1;
    } else {
        if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }
    btn.closest('.number-spinner').find('input').val(newVal);
});



/** 
 * Initialize GMAP
 */
function initMap() {
    var stylez = [
        {
            featureType: "all",
            elementType: "all",
            stylers: [
                { saturation: -100 } // <-- THIS
            ]
        }
    ];

    // The location
    var loc = { lat: 24.9098005, lng: 67.1206051 };
    // The map, 
    var mapOptions = {
        zoom: 11,
        center: loc,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
        }
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var mapType = new google.maps.StyledMapType(stylez, { name: "Grayscale" });
    map.mapTypes.set('tehgrayz', mapType);
    map.setMapTypeId('tehgrayz');

    var locations = [
        ['<h6 class="map-title">PIZZA MAX</h6><p class="map-info"><i class="fas fa-store"></i> Khayaban-e-Nishat,</p><p class="map-tel"><a href="tel:+92 21 111 629 111"><i class="fa fa-phone fa-flip-horizontal"></i> 111-629-111</a></p><p class="map-locator"><a href="https://goo.gl/m96mhQ" target="_blank"><i class="fas fa-external-link-alt"></i> Click to view on Google Maps</a></p>', 24.8000676, 67.0557367],
        ['<h6 class="map-title">PIZZA MAX</h6><p class="map-info"><i class="fas fa-store"></i> Jinnah Ave, Model Colony</p><p class="map-tel"><a href="tel:+92 21 111 629 111"><i class="fa fa-phone fa-flip-horizontal"></i> 111-629-111</a></p><p class="map-locator"><a href="https://goo.gl/m96mhQ" target="_blank"><i class="fas fa-external-link-alt"></i> Click to view on Google Maps</a></p>', 24.9051809, 67.1805308],
        ['<h6 class="map-title">PIZZA MAX</h6><p class="map-info"><i class="fas fa-store"></i> Block 18 Gulistan-e-Johar</p><p class="map-tel"><a href="tel:+92 21 111 629 111"><i class="fa fa-phone fa-flip-horizontal"></i> 111-629-111</a></p><p class="map-locator"><a href="https://goo.gl/m96mhQ" target="_blank"><i class="fas fa-external-link-alt"></i> Click to view on Google Maps</a></p>', 24.9098005, 67.1206051]
    ];


    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    //var marker = new google.maps.Marker({position: loc, map: map});
}


// Login, Signup, Forget password forms
    $('#forget-password').click(function () {
      $('.login-form').slideUp(500, function () {
        $('.forget-form').slideDown(500, function () {

          $('.forget-form .form-group .help-block').slideUp(500, function () { $(this).remove(); });

          $('.forget-form .alert').slideUp(500);
          $('.forget-form .form-group').removeClass('has-error').slideDown(500);
          $('.login-form .form-group input').val('');
        });
      });
    });
    $('.lnkNewSignUp').click(function () {
      $('.login-form').slideUp(500, function () {
        $('.signup-form').slideDown(500, function () {

          $('.signup-form .form-group .help-block').slideUp(500, function () { $(this).remove(); });

          $('.signup-form .alert').slideUp(500);
          $('.signup-form .form-group').removeClass('has-error').slideDown(500);
          $('.login-form .form-group input').val('');
        });
      });
    });

    $('#signUpback-btn').click(function () {
      $('.signup-form').slideUp(500, function () {
        $('.login-form').slideDown(500, function () {
          $('.login-form .form-group').removeClass('has-error');
          $('.login-form .form-group .help-block').slideUp(500, function () { $(this).remove(); });

          $('.login-form .alert-danger').slideUp(500);
        });
      });
    });

    $('#back-btn').click(function () {
      $('.forget-form').slideUp(500, function () {
        $('.login-form').slideDown(500, function () {
          $('.login-form .form-group').removeClass('has-error');
          $('.login-form .form-group .help-block').slideUp(500, function () { $(this).remove(); });

          $('.login-form .alert-danger').slideUp(500);
        });
      });
    });




$(document).ready(function(){
    var prm = new URLSearchParams(window.location.search)
    if(prm.has('s')) {
        $(document).find('a:contains("'+prm.get('s').replace(/%20/g, " ")+'")').click();
        var el = $(document).find('a:contains("'+prm.get('s').replace(/%20/g, " ")+'")');
        document.getElementById($(el[0]).parent().data('id')).scrollIntoView();
        window.scrollBy(0, -40);
    }
})