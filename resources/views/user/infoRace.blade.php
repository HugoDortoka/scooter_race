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
                        <img src="{{ asset('assets/images/logo.png') }}" alt="">
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
                        <li><a href="{{ route('user.profile') }}">Profile <img src="{{ asset('assets/images/profile-header.jpg') }}" alt=""></a></li>
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


          <!-- ***** Info Race Start ***** -->
         
          <div class="most-popular">
              <div class="row">
                <div class="col col-6">
                      <img src="{{ asset($course->map_image) }}" alt="{{ $course->name }}">
                </div>
                <div class="col col-6">
                      <div class="heading-section">
                         <h4>{{ $course->name }}</h4>
                      </div>
                      <div class="col col-12"><p class="white">{{ $course->description }}</p></div>
                      <div class="row">
                        <div class="col col-6"><p>Unevenness: {{ $course->elevation }}%</p></div>
                        <div class="col col-6"><p>Distance: {{ $course->distance_km }} km</p></div>
                      </div>
                      <div class="row">
                        <div class="col col-6"><p>Max participants: {{ $course->max_participants }}</p></div>
                        <div class="col col-6"><p>Location: {{ $course->location }}</p></div>
                      </div>
                      <div class="row">
                        <div class="col col-6"><p>Date: {{ date('d-m-Y', strtotime($course->date)) }}</p></div>
                        <div class="col col-6"><p>Time: {{ $course->time }}</p></div>
                      </div>
                      <div class="row mt-4">
                        <div class="col col-6"><p class="priceRace">Price: {{ $course->registration_price }}€</p></div>
                        <div class="col col-6"> 
                          <div class="main-button">
                            @if ($registration->contains('competitor_id', $user->id))
                                <p class="priceRace">Registered</p>
                            @else
                                <a href="{{ route('user.register', $course->id) }}">Register</a>
                            @endif
                          </div>
                        </div>
                      </div> 
                </div>
              </div>
          </div>
          <!-- ***** Most Popular End ***** -->

          <!-- ***** Start Stream Start ***** -->
          <div class="start-stream">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Photos From</em> The Races</h4>
              </div>
              @if($photos->isNotEmpty())
                  <div class="row">
                      @foreach($photos as $photo)
                          <div class="col-lg-4 col-sm-6 mt-4">
                              <div class="item">
                                  <img src="{{ asset($photo->photo_url) }}" alt="{{ $photo->photo_url }}" title="{{ $photo->photo_url }}" class="imgRace">
                              </div>
                          </div>
                      @endforeach
                  </div>
              @else
                  <div class="row mt-4">
                      <div class="col-md-12 text-center">
                          <p class="h5">ⓘ Photos not available</p>
                      </div>
                  </div>
              @endif  
        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
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


