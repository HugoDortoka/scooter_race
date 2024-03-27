<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - Awesome HTML5 Template</title>

    <!-- CSS de Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Scripts de Bootstrap (JavaScript) -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('user.home') }}" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                      <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                      </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('user.home') }}" >Home</a></li>
                        <li><a href="{{ route('user.races') }}" class="active">Races</a></li>
                        <li><a href="{{ route('user.competitors') }}">Competitors</a></li>
                        <li><a href="{{ route('user.profile') }}">Profile <img src="assets/images/profile-header.jpg" alt=""></a></li>
                    </ul>      
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Featured Games Start ***** -->
          <div class="row">
            <div class="col-lg-8">
              <div class="featured-games header-text">
                <div class="heading-section">
                  <h4><em>Most Popular</em> Races</h4>
                </div>
                <div class="owl-features owl-carousel">
                  @foreach($recents as $recent)
                    <div class="item">
                      <div class="thumb">
                        <img src="{{ asset($recent->promotion_poster) }}" alt="{{ $recent->name }}">
                      </div>
                      <h4>{{ $recent->name }}</h4>
                      <ul>
                          <li><i class="fa fa-eye"></i> {{ $recent->distance_km }} km</li>
                          <li><i class="fa fa-gamepad"></i> {{ $recent->elevation }}%</li>
                      </ul>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="top-downloaded">
                <div class="heading-section">
                  <h4><em>Most Difficult</em> Races</h4>
                </div>
                <ul>
                  @foreach($difficulties as $difficult)
                    <li>
                      <img src="{{ asset($difficult->map_image) }}" alt="{{ $difficult->name }}" class="templatemo-item difficult">
                      <h4>{{ $difficult->name }}</h4>
                      <h6>{{ $difficult->elevation }}%</h6>
                    </li>
                  @endforeach
                </ul>
                <div class="text-button">
                  <a href="{{ route('user.allraces') }}">View All Races</a>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Featured Games End ***** -->

          <!-- ***** Start Stream Start ***** -->
          <div class="start-stream">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>How To Start Your</em> Races</h4>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="item">
                    <div class="icon">
                      <img src="assets/images/service-01.jpg" alt="" style="max-width: 60px; border-radius: 50%;">
                    </div>
                    <h4>Go To Your Profile</h4>
                    <p>Cyborg Gaming is free HTML CSS website template provided by TemplateMo. This is Bootstrap v5.2.0 layout.</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item">
                    <div class="icon">
                      <img src="assets/images/service-02.jpg" alt="" style="max-width: 60px; border-radius: 50%;">
                    </div>
                    <h4>Live Stream Button</h4>
                    <p>If you wish to support us, you can make a <a href="https://paypal.me/templatemo" target="_blank">small contribution via PayPal</a> to info [at] templatemo.com</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item">
                    <div class="icon">
                      <img src="assets/images/service-03.jpg" alt="" style="max-width: 60px; border-radius: 50%;">
                    </div>
                    <h4>You Are Live</h4>
                    <p>You are not allowed to redistribute this template's downloadable ZIP file on any other template collection website.</p>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="profile.html">Go To Profile</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Start Stream End ***** -->

        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved. 
          
          <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a> Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a>
        </div>
      </div>
    </div>
  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/tabs.js') }}"></script>
  <script src="{{ asset('assets/js/popup.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>


  </body>

</html>
