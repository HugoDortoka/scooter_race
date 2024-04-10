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
                        <li><a href="{{ route('user.home') }}" class="active">Home</a></li>
                        <li><a href="{{ route('user.races') }}">Races</a></li>
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

          <!-- ***** Banner Start ***** -->
          <div class="main-banner">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To Scooter Leveling</h6>
                  <h4><em>Browse</em> Our Popular Races Here</h4>
                  <div class="main-button">
                    <a href="{{ route('user.races') }}">Browse Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="heading-section">
                          <h4><em>Most Popular</em> Races</h4>
                      </div>
                      <div class="row">
                        @foreach ($courses->take(8) as $course)
                            <div class="col-lg-3 col-sm-6">
                                <div class="item">
                                  <a href="{{ route('user.infoRace', $course->id) }}">
                                    <img src="{{ asset($course->promotion_poster) }}" alt="promotion_poster">
                                    <h4>{{ $course->name }}<br><span>Date</span></h4>
                                    <ul>
                                        <li><i class="fa fa-star"></i> {{ $course->distance_km }} km</li>
                                        <li>{{ date('d-m-Y', strtotime($course->date)) }}</li>
                                    </ul>
                                  </a>
                                </div>
                            </div>
                        @endforeach
                      </div>
                      <div class="main-button">
                          <a href="{{ route('user.races') }}">Discover More</a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- ***** Most Popular End ***** -->


          <!-- ***** Races register Start ***** -->
          <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Registered</em> Races</h4>
              </div>
              @if ($user==null)
                <div class="col-md-12 text-center mb-4">
                  <p class="h5">ⓘ You are not registered</p>
                </div>
              @else
                @if (count($myRegistrations)===0)
                  <div class="col-md-12 text-center mb-4">
                    <p class="h5">ⓘ No registers</p>
                  </div>
                @else
                  @foreach ($myRegistrations->take(3) as $myRegistration)
                    <div class="item">
                      <ul>
                        <li><img src="{{ asset($myRegistration->map_image) }}" alt="{{ $myRegistration->name }}"  class="difficult"></li>
                        <li><h4>Race</h4><span>{{ $myRegistration->name }}</span></li>
                        <li><h4>Date</h4><span>{{ $myRegistration->date }}</span></li>
                        <li><h4>Location</h4><span>{{ $myRegistration->location }}</span></li>
                        <li><h4>Hour</h4><span>{{ $myRegistration->time }}</span></li>
                        <li><div class="main-border-button border-no-active"><a href="{{ route('user.dropOut', $myRegistration->id) }}">Drop out</a></div></li>
                      </ul>
                    </div>
                  @endforeach
                @endif
              @endif
            </div>
            @if ($user!=null)
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="{{ route('user.profile') }}">View Your Races</a>
                </div>
              </div>
            @endif
          </div>
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>
  <a href="{{ route('user.puzzle') }}">Puzzle</a>
  
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
