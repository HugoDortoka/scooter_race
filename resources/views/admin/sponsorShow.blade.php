<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Admin Sponsors Show</title>
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
                            <li><a href="{{ route('admin.home') }}">Races</a></li>
                            <li> <a href="{{ route('admin.insurers') }}">Insurers</a></li>
                            <li><a href="{{ route('admin.sponsors') }}" class="active">Sponsors</a></li>
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
    <!-- Contenido adicional -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div>
                        <form action="{{ route('admin.sponsorUpdate', $sponsor->id) }}" method="post" enctype="multipart/form-data" class="editForm">
                            @csrf
                            <div>
                                <label for="cif">CIF</label>
                                <input type="text" id="cif" name="cif" value="{{ $sponsor->CIF }}" readonly>
                            </div>
                            <div>
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $sponsor->name }}" required>
                            </div>
                            <div>
                                <label for="logo">Logo</label>
                                <input type="file" id="logo" name="logo" accept="image/*">
                            </div>
                            <div>
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" value="{{ $sponsor->address }}" required>
                            </div>
                            <div>
                                <label for="principal">Principal</label>
                                <input type="checkbox" id="principal" name="principal" value="1" {{ $sponsor->principal ? 'checked' : '' }}>
                            </div>
                            <div>
                                <label for="extra_cost">Extra cost</label>
                                <input type="number" id="extra_cost" name="extra_cost" min="0" step="0.01" value="{{ $sponsor->extra_cost }}">
                            </div>
                            <a href="{{ route('admin.printInvoice', $sponsor->id) }}" class="btn btn-pink">Print invoice</a>
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