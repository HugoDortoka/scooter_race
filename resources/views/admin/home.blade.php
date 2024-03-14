<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<title>Admin Home</title>
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
                        <li><a href="{{ route('admin.home') }}" class="active">Races</a></li>
                        <li> <a href="{{ route('admin.insurers') }}">Insurers</a></li>
                        <li><a href="{{ route('admin.sponsors') }}">Sponsors</a></li>
                        <li><a href="streams.html">Competitors</a></li>
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

                <a href="{{ route('admin.courseShowAdd') }}" class="btn btn-pink btnAdd">Add</a>
                <div id="bodyList">
                    @foreach($courses as $course)
                        <div class="row justify-content-center">
                            <div>
                                <div class="races">
                                    <h5>Name: {{ $course->name }}</h5>
                                    <?php
                                        $actual_date = date("Y-m-d");
                                        $course_date = $course->date;
                                    ?>
                                    @if($course_date < $actual_date)
                                        <a href="{{ route('admin.courseUploadPhotos', $course->id) }}" class="btn btn-pink mr-2">Upload photos</a>
                                    @else
                                        <a class="btn btn-pink mr-2">Not finished</a>
                                    @endif
                                    <a href="{{ route('admin.courseShow', $course->id) }}" class="btn btn-pink mr-2">Show details</a>
                                    <a href="{{ route('admin.courseChange', $course->id) }}" class="btn btn-pink">Change active</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    
<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var searchCoursesRoute = "{{ route('admin.coursesSearch') }}";
</script>
<script src="{{ asset('assets/js/search_bar.js') }}"></script>

</body>
</html>


