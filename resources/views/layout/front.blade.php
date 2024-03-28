<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <?php
        $sitesetting = \App\Models\Sitesettings::find(1);   
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $sitesetting->sitename }} - @yield('title')</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ URL::to('/') }}/public/front/img/2.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/animate.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/LineIcons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/owl.theme.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/nivo-lightbox.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/main.css">    
    <link rel="stylesheet" href="{{ URL::to('/') }}/public/front/css/responsive.css">
    <script>
        var baseUrl = "<?php echo URL::to('/'); ?>";
    </script>
  </head>
  
  <body>

    <!-- Header Section Start -->
    <header id="home" class="hero-area">    
      <div class="overlay">
        <span></span>
        <span></span>
      </div>
      <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container">
          <a href="{{ URL::to('/') }}" class="navbar-brand">{{ $sitesetting->sitename }}</a>       
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
              <li class="nav-item">
                <?php 
                if(Route::is('patient_landing')) {
                ?>
                <a class="nav-link page-scroll" href="#contact">Add Enquiry</a>
                <?php } else if(Route::is('confirm_appointment')) { ?>
                  <a class="nav-link page-scroll" href="#appointment">Appointment</a>
                <?php } ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>  
      <div class="container">      
        <div class="row space-100">
          <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="contents">
              <h2 class="head-title">Book your Appoinment, <br>through online</h2>
              <p>Create your appointment on your available time, to get contact with our physician.</p>

                @if(Session::has('enquiry_message'))
                    <div class="alert {{ Session::get('enquiry_alert') }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('enquiry_message') }}
                    </div>
                @endif
              <div class="header-button">
                <?php 
                if(Route::is('patient_landing')) {
                ?>
                <a href="#contact" class="btn btn-border-filled page-scroll">Enquire Now</a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-xs-12 p-0">
            <div class="intro-img">
              <img src="{{ URL::to('/') }}/public/front/img/banner.jpg" alt="">
            </div>            
          </div>
        </div> 
      </div>        
    </header>
    <!-- Header Section End --> 

    <!-- Contact Us Section -->
    @yield('content')
    <!-- Contact Us Section End -->

    <!-- Footer Section Start -->
    <footer>
      <!-- <section id="footer-Content">
        <div class="container">
          <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              
              <div class="footer-logo">
               <img src="img/footer-logo.png" alt="">
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Company</h3>
                <ul class="menu">
                  <li><a href="#">  - About Us</a></li>
                  <li><a href="#">- Career</a></li>
                  <li><a href="#">- Blog</a></li>
                  <li><a href="#">- Press</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Product</h3>
                <ul class="menu">
                  <li><a href="#">  - Customer Service</a></li>
                  <li><a href="#">- Enterprise</a></li>
                  <li><a href="#">- Price</a></li>
                  <li><a href="#">- Scurity</a></li>
                  <li><a href="#">- Why SLICK?</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Download App</h3>
                <ul class="menu">
                  <li><a href="#">  - Android App</a></li>
                  <li><a href="#">- IOS App</a></li>
                  <li><a href="#">- Windows App</a></li>
                  <li><a href="#">- Play Store</a></li>
                  <li><a href="#">- IOS Store</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Subscribe Now</h3>
                <p>Appropriately implement calysts for change visa wireless catalysts for change. </p>
                <div class="subscribe-area">
                  <input type="email" class="form-control" placeholder="Enter Email">
                  <span><i class="lni-chevron-right"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="site-info text-center">
                  <p>Crafted by <a href="http://uideck.com" rel="nofollow">UIdeck</a></p>
                </div>              
                
              </div>
            </div>
          </div>
        </div>
      </section> -->
      
    </footer>


    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a> 

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ URL::to('/') }}/public/front/js/jquery-min.js"></script>
    <script src="{{ URL::to('/') }}/public/front/js/popper.min.js"></script>
    <script src="{{ URL::to('/') }}/public/front/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/public/front/js/owl.carousel.js"></script>      
    <script src="{{ URL::to('/') }}/public/front/js/jquery.nav.js"></script>    
    <script src="{{ URL::to('/') }}/public/front/js/scrolling-nav.js"></script>    
    <script src="{{ URL::to('/') }}/public/front/js/jquery.easing.min.js"></script>     
    <script src="{{ URL::to('/') }}/public/front/js/nivo-lightbox.js"></script>     
    <script src="{{ URL::to('/') }}/public/front/js/jquery.magnific-popup.min.js"></script>      
    <script src="{{ URL::to('/') }}/public/front/js/main.js"></script>
    <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>
  </body>
</html>