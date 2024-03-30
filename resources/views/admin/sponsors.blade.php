<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Admin Sponsors</title>
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
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
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('admin.home') }}" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                        <form id="search" action="#">
                            <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword"/>
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('admin.home') }}" >Races</a></li>
                        <li><a href="{{ route('admin.insurers') }}">Insurers</a></li>
                        <li><a href="{{ route('admin.sponsors') }}" class="active">Sponsors</a></li>
                        <li><a href="{{ route('admin.competitors') }}">Competitors</a></li>
                        <li><a href="{{ route('admin.logout') }}">Logout<img src="assets/images/profile-header.jpg" alt=""></a></li>
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

<!-- Contenido adicional -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content">

                <a href="{{ route('admin.sponsorShowAdd') }}" class="btn btn-pink btnAdd">Add</a>
                <div id="bodyList">
                    @foreach($sponsors as $sponsor)
                        <?php
                            $active = $sponsor->active;
                        ?>
                        @if($active == 1)
                            <div class="row justify-content-center">
                                <div>
                                    <div class="insurer">
                                        <h5>Name: {{ $sponsor->name }}</h5>
                                        <a href="{{ route('admin.sponsorShow', $sponsor->id) }}" class="btn btn-pink mr-2">Show details</a>
                                        <a href="{{ route('admin.sponsorChange', $sponsor->id) }}" class="btn btn-pink">Change active</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-center">
                                <div>
                                    <div class="insurer transparent">
                                        <h5>Name: {{ $sponsor->name }}</h5>
                                        <a href="{{ route('admin.sponsorShow', $sponsor->id) }}" class="btn btn-pink mr-2">Show details</a>
                                        <a href="{{ route('admin.sponsorChange', $sponsor->id) }}" class="btn btn-pink">Change active</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
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

<!-- Scripts de Bootstrap (JavaScript) -->
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var searchSponsorsRoute = "{{ route('admin.sponsorsSearch') }}";
</script>
<script src="{{ asset('assets/js/search_bar.js') }}"></script>
</body>
</html>
