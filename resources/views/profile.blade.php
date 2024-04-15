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
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('user.home') }}">Home</a></li>
                        <li><a href="{{ route('user.races') }}">Races</a></li>
                        <li><a href="{{ route('user.competitors') }}">Competitors</a></li>
                        <li><a href="{{ route('user.profile') }}"  class="active">Profile <img src="{{ asset('assets/images/profile-header.jpg') }}" alt="profile"></a></li>
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
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <div class="col-lg-4">
                    <img src="{{ asset('assets/images/profile.jpg') }}" alt="" style="border-radius: 23px;">
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <div class="main-info header-text">
                      @if(empty($membership))
                        <span><a href="#" id="membership-button">Make me membership</a></span>
                        <div id="paypal-button-container" style="display: none;"></div>
                      @else
                        <span>You are a membership</span>
                      @endif
                      <h4>{{ $user->name }} {{ $user->surname }}</h4>
                      <p>These are your profile stats</p>
                      <div class="main-border-button">
                        <a href="{{ route('user.logout') }}">LOGOUT</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <ul>
                      <li>Next races <span>3</span></li>
                      <li>Finished races<span>16</span></li>
                      <li>Membership <span>None</span></li>
                      <li>Wins <span>4</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library profile-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Your Gaming</em> Library</h4>
              </div>
              @if (count($myRegistrations)===0)
                  <div class="col-md-12 text-center mb-4">
                    <p class="h5">ⓘ No registers</p>
                  </div>
                @else
                  @foreach ($myRegistrations as $myRegistration)
                    <div class="item">
                      <ul>
                        <li><img src="{{ asset($myRegistration->map_image) }}" alt="{{ $myRegistration->name }}"  class="difficult"></li>
                        <li><h4>Race</h4><span>{{ $myRegistration->name }}</span></li>
                        <li><h4>Date</h4><span>{{ $myRegistration->date }}</span></li>
                        <li><h4>Location</h4><span>{{ $myRegistration->location }}</span></li>
                        <li><h4>Hour</h4><span>{{ $myRegistration->time }}</span></li>
                        <li><div class="main-border-button border-no-active"><a href="{{ route('user.dropOut2', $myRegistration->id) }}">Drop out</a></div></li>
                      </ul>
                    </div>
                  @endforeach
                @endif
            </div>
          </div>
          <!-- ***** Gaming Library End ***** -->
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
  <script>
    var membership = "{{ route('user.newMembership', $user->id) }}";
  </script>
  @if(isset($pdfPath))
    <script src="{{ asset('assets/js/downloadPdf.js') }}"></script>
  @endif
  <script src="{{ asset('assets/js/paypalMembership.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('assets/js/tabs.js') }}"></script>
  <script src="{{ asset('assets/js/popup.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>


  </body>

</html>
