
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Admin Drag and Drop</title>
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
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('admin.home') }}" class="active">Races</a></li>
                            <li> <a href="{{ route('admin.insurers') }}">Insurers</a></li>
                            <li><a href="{{ route('admin.sponsors') }}">Sponsors</a></li>
                            <li><a href="{{ route('admin.competitors') }}">Competitors</a></li>
                            <li><a href="{{ route('admin.logout') }}">Logout<img src="{{ asset('assets/images/profile-header.jpg') }}" alt="profile"></a></li>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content uploadPhotos">
                    <h1 class="titleUpload">{{ $course->name }}</h1>
                    <form action="{{ route('admin.courseSaveUploadPhotos', $course->id) }}" method="post" enctype="multipart/form-data" class="formUpload">
                        @csrf    
                        <input type="hidden" name="photo_urls" id="photo_urls">
                        <div id="drop-area" class="drop-area" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
                            Drag and drop here
                        </div>
                        <div class="buttonsUpload">
                            <input type="submit" value="Save" class="btn btn-pink">
                            <input type="button" value="Cancel" onclick="window.location.href = '{{ route('admin.home') }}';" class="btn btn-pink"/>
                        </div>
                    </form>
                    <div id="imagenes"></div>
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
<script>
    const uploadImageUrl = '{{ route('admin.courseSaveUploadPhotosTemporarily', $course->id) }}';
    const baseImageUrl = "{{ asset('') }}";
</script>
<script src="{{ asset('assets/js/drag_and_drop.js') }}"></script>
</body>
</html>