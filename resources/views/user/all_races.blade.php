<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Scooter Leveling</title>

    <!-- CSS de Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Scripts de Bootstrap (JavaScript) -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
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
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('user.home') }}" >Home</a></li>
                        <li><a href="{{ route('user.races') }}">Races</a></li>
                        <li><a href="{{ route('user.competitors') }}">Competitors</a></li>
                        <li><a href="{{ route('user.profile') }}">Profile <img src="{{ asset('assets/images/profile-header.jpg') }}" alt="profile"></a></li>
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
          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="heading-section">
                          <h4><em>All</em> Races</h4>
                      </div>
                      <div class="row">
                        @foreach($courses as $course)
                            <div class="col-lg-3 col-sm-6">
                                <div class="item">
                                  <a href="{{ route('user.infoRace', $course->id) }}">
                                    <img src="{{ asset($course->map_image) }}" alt="map_image">
                                    <h4>{{ $course->name }}<br><span>Unevenness</span></h4>
                                    <ul>
                                        <li><i class="fa fa-star"></i> {{ $course->distance_km }}</li>
                                        <li><i class="fa fa-download"></i> {{ $course->elevation }}%</li>
                                    </ul>
                                  </a>
                                </div>
                            </div>
                        @endforeach
                      </div>
                     
                  </div>
              </div>
          </div>
          <!-- ***** Most Popular End ***** -->


          
        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>
            @foreach ($sponsorsPrincipal as $sponsorPrincipal)
              <img src="{{ asset($sponsorPrincipal->logo) }}" alt="" class="sponsorPrincipal">
            @endforeach
          </p>
          <p>Copyright © 2036 <a href="#">Scooter Leveling</a> Company. All rights reserved. 
          
          <br>Design by <a href="https://templatemo.com" target="_blank" title="free CSS templates">Hugo Varela and Lucas Moreno</a></p>
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