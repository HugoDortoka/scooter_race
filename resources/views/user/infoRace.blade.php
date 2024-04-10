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
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/popup.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <!-- PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWCZuF2EUtzd3XMufIfqko8x_19V9q1zGTnbUXYIi5lU5sLXdpOyHNX_8mRJHvBDolqRKwVr3QpZfn-2&currency=EUR"></script>
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
                          <div>
                            @if ($user==null)
                              @if ($course->max_participants <= $registrationCount)
                                <p class="priceRace">Sold out</p>
                              @else
                                <a href="#myModal" class="trigger-modal btn btn-pink">Register</a>

                                <div id="myModal" style="display: none;">
                                    <!-- Contenido de tu modal aquí -->
                                    <div class="centrado">
                                      
                                      <form action="{{ route('user.register3', $course->id) }}" method="POST" class="formRegister" onsubmit="return validateForm()">
                                          @csrf
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label for="dni" class="labelLogin">DNI</label><br>
                                                  <div class="divLogin" id="divDNI">
                                                      <input type="text" id="dni" name="dni" class="inputLogin" placeholder="Type your DNI" required>
                                                  </div>
                                                  <label for="name" class="labelLogin">Name</label><br>
                                                  <div class="divLogin">
                                                      <input type="text" id="name" name="name" class="inputLogin" placeholder="Type your name" required>
                                                  </div>
                                                  <label for="surname" class="labelLogin">Surname</label><br>
                                                  <div class="divLogin">
                                                      <input type="text" id="surname" name="surname" class="inputLogin" placeholder="Type your surname" required>
                                                  </div>
                                                  <label for="address" class="labelLogin">Address</label><br>
                                                  <div class="divLogin">
                                                      <input type="text" id="address" name="address" class="inputLogin" placeholder="Type your address" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <label for="birth" class="labelLogin">Date of birth</label><br>
                                                  <div class="divLogin">
                                                      <input type="date" id="birth" name="birth" class="inputLogin" max="{{ date('Y-m-d', strtotime('-1 day')) }}" required>
                                                  </div>
                                                
                                                  <label for="PRO_OPEN" class="labelLogin">What are you?</label><br>
                                                  <div class="divLogin">
                                                      <select id="PRO_OPEN" name="PRO_OPEN" class="inputLogin" required>
                                                          <option value="OPEN">OPEN</option>
                                                          <option value="PRO">PRO</option>
                                                      </select>
                                                  </div>
                                                  <div id="federationInput" style="display: none;">
                                                      <label for="federation" class="labelLogin">Federation number</label><br>
                                                      <div class="divLogin" id="divFederation">
                                                          <input type="text" id="federation" name="federation" class="inputLogin" placeholder="Type your fed. number">
                                                      </div>
                                                  </div>
                                                  <label for="insurerId" class="labelLogin">Choose your Insurer</label><br>
                                                  <div class="divLogin">
                                                    <select id="insurerId" name="insurerId" class="inputLogin"  required>
                                                      @foreach($insurers as $insurer)
                                                        <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                                      @endforeach
                                                    </select>
                                                  </div>
                                          
                                              </div>
                                              <input type="submit" value="Register" class="btn btn-pink btnAdd btnLogin">
                                          </div>
                                      </form>
                                  </div>
                                </div>
                              @endif
                            @else
                              @if ($registration->contains('competitor_id', $user->id))
                                <p class="priceRace">Registered</p>
                              @elseif ($course->max_participants <= $registrationCount)
                                <p class="priceRace">Sold out</p>
                              @else
                                @if ($user->PRO==true)
                                  <span><a href="#" class="button btn-pink" id="registerPRO-button">Register</a></span>
                                  <div id="paypal-button-container" class="divPayPal" style="display: none;"></div>
                                @else
                                  <form action="{{ route('user.register', $course->id) }}" id="registerNoPRO-form" method="POST" >
                                    @csrf
                                    <select id="insurerId" name="insurerId" required>
                                      @foreach($insurers as $insurer)
                                        <option value="{{ $insurer->id }}">{{ $insurer->name }}</option>
                                      @endforeach
                                    </select>
                                    
                                    <span><a href="#" class="button btn-pink" id="registerNoPRO-button">Register</a></span>
                                  </form>
                                  <div id="paypal-button-container" class="divPayPal" style="display: none;"></div>
                                @endif
                                  
                              @endif
                            @endif
                          </div>
                        </div>
                      </div> 
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-12 text-center">
                  @foreach ($sponsorsCourse as $sponsorCourse)
                    <img src="{{ asset($sponsorCourse->logo) }}" alt="{{ asset($sponsorCourse->name) }}" class="sponsorPrincipal">
                  @endforeach
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
                <div class="owl-features owl-carousel">
                  @foreach($photos as $photo)
                    <div class="item">
                      <div class="thumb">
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
  <script src="{{ asset('assets/js/federation.js') }}"></script>
  <script src="{{ asset('assets/js/validation.js') }}"></script>
  <script>
    var registerPRO = "{{ route('user.register2', $course->id) }}";
    var price = "{{ $course->registration_price }}";
  </script>
  <script src="{{ asset('assets/js/paypalPRO.js') }}"></script>
  <script src="{{ asset('assets/js/paypalNoPRO.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/tabs.js') }}"></script>
  <script src="{{ asset('assets/js/popup.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('.trigger-modal').leanModal({
          top: 100,
          overlay: 0.5,
          closeButton: ".close-modal"
      });
    });
  </script>

  </body>

</html>


