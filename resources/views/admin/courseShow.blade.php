
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<title>Admin Races Show</title>
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
                            <li><a href="{{ route('admin.home') }}" class="active">Races</a></li>
                            <li> <a href="{{ route('admin.insurers') }}">Insurers</a></li>
                            <li><a href="{{ route('admin.sponsors') }}">Sponsors</a></li>
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
                    <div>
                        <form action="{{ route('admin.courseUpdate', $course->id) }}" method="post" enctype="multipart/form-data" class="editForm">
                            @csrf
                            <div>
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $course->name }}" required>
                            </div>
                            <div>
                                <label for="description">Description</label>
                                <input type="text" id="description" name="description" value="{{ $course->description }}" required>
                            </div>
                            <div>
                                <label for="elevation">Elevation (0-100%)</label>
                                <input type="number" id="elevation" name="elevation" min="0" max="100" value="{{ $course->elevation }}" required>
                            </div>
                            <div>
                                <label for="map_image">Map Image</label>
                                <input type="file" id="map_image" name="map_image" accept="image/*">
                            </div>
                            <div>
                                <label for="max_participants">Max Participants</label>
                                <input type="number" id="max_participants" name="max_participants" min="1" value="{{ $course->max_participants }}" required>
                            </div>
                            <div>
                                <label for="distance_km">Distance (km)</label>
                                <input type="number" id="distance_km" name="distance_km" min="0" step="0.01" value="{{ $course->distance_km }}" required>
                            </div>
                            <div>
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ $course->date }}" required>
                            </div>
                            <div>
                                <label for="time">Time</label>
                                <input type="time" id="time" name="time" value="{{ $course->time }}" required>
                            </div>
                            <div>
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" value="{{ $course->location }}" required>
                            </div>
                            <div>
                                <label for="promotion_poster">Promotion Poster</label>
                                <input type="file" id="promotion_poster" name="promotion_poster" accept="image/*">
                            </div>
                            <div>
                                <label for="sponsorship_cost">Sponsorship Cost</label>
                                <input type="number" id="sponsorship_cost" name="sponsorship_cost" min="0" step="0.01" value="{{ $course->sponsorship_cost }}" required>
                            </div>
                            <div>
                                <label for="registration_price">Registration Price</label>
                                <input type="number" id="registration_price" name="registration_price" min="0" step="0.01" value="{{ $course->registration_price }}" required>
                            </div>
                            <div>
                                <label for="sponsors">Sponsors</label>
                                <div class="sponsors">
                                    @foreach($sponsors as $sponsor)
                                        <input type="checkbox" name="sponsors[]" id="sponsor{{ $sponsor->id }}" value="{{ $sponsor->id }}" 
                                            {{ $sponsorsCourse->contains($sponsor) ? 'checked' : '' }}>
                                        <label for="sponsor{{ $sponsor->id }}" class="alignLeft">{{ $sponsor->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <label for="insurers">Insurers</label>
                                <div class="sponsors">
                                    @foreach($insurers as $insurer)
                                        <input type="checkbox" name="insurers[]" id="insurer{{ $insurer->id }}" value="{{ $insurer->id }}" 
                                            {{ $insurersCourse->contains($insurer) ? 'checked' : '' }}>
                                        <label for="insurer{{ $insurer->id }}" class="alignLeft">{{ $insurer->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Agrega aquí más campos si es necesario -->
                            <a href="{{ route('admin.showParticipants', $course->id) }}" class="btn btn-pink">View participants</a>
                            <input type="submit" value="Save" class="btn btn-pink">
                        </form>
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
