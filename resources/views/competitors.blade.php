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
                        <li><a href="{{ route('user.home') }}" >Home</a></li>
                        <li><a href="{{ route('user.races') }}">Races</a></li>
                        <li><a href="{{ route('user.competitors') }}" class="active">Competitors</a></li>
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
            <div class="col col-lg-4">
              <div class="top-streamers">
                  <div class="heading-section">
                    <h4><em>Top</em> General</h4>
                  </div>
                  <ul>
                  @foreach($topGeneral as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                  @endforeach
                  </ul>
              </div>
            </div>

            <div class="col col-lg-4">
                <div class="top-streamers">
                  <div class="heading-section">
                    <h4><em>Top</em> Male</h4>
                  </div>
                  <ul>
                  @foreach($topMale as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                  @endforeach
                  </ul>
                
                </div>
            </div>


            <div class="col col-lg-4">
              <div class="top-streamers">
                <div class="heading-section">
                  <h4><em>Top</em> Female</h4>
                </div>
                <ul>
                @foreach($topFemale as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col col-lg-4">
              <div class="top-streamers">
                  <div class="heading-section">
                    <h4><em>Top</em> Master 20</h4>
                  </div>
                  <ul>
                  @foreach($topMaster20 as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                  @endforeach
                  </ul>
              </div>
            </div>

            <div class="col col-lg-4">
                <div class="top-streamers">
                  <div class="heading-section">
                    <h4><em>Top</em> Master 30</h4>
                  </div>
                  <ul>
                  @foreach($topMaster30 as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                  @endforeach
                  </ul>
                
                </div>
            </div>


            <div class="col col-lg-4">
              <div class="top-streamers">
                <div class="heading-section">
                  <h4><em>Top</em> Master 40</h4>
                </div>
                <ul>
                @foreach($topMaster40 as $key => $competitor)
                      <li>
                          <span>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                          <img src="assets/images/avatar-02.jpg" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                          <h6><i class="fa fa-check"></i> {{ $competitor->name }} {{ $competitor->surname }}</h6>
                      </li>
                @endforeach
                </ul>
              </div>
            </div>
          </div>
 
          <!-- ***** Featured Games End ***** -->

         

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
