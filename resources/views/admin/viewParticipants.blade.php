<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Participants</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="{{ route('admin.home') }}" class="logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="">
                    </a>
                    <ul class="nav">
                        <li><a href="{{ route('admin.home') }}" class="active">Races</a></li>
                        <li><a href="{{ route('admin.insurers') }}">Insurers</a></li>
                        <li><a href="{{ route('admin.sponsors') }}">Sponsors</a></li>
                        <li><a href="{{ route('admin.competitors') }}">Competitors</a></li>
                        <li><a href="{{ route('admin.logout') }}">Logout<img src="{{ asset('assets/images/profile-header.jpg') }}" alt=""></a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content">
                @if(count($competitors)===0)
                    <p>There is no competitor signed up for this race</p>
                @else
                    <a href="{{ route('admin.pdfParticipants', $course->id) }}" class="btn btn-pink btnAdd">View participants</a>
                    <div id="bodyList">
                        @foreach($competitors as $competitor)
                            <div class="row justify-content-center">
                                <div>
                                    <div class="registrations">
                                        <h5>Name: {{ $competitor->name }}</h5>
                                        <h5>Surname: {{ $competitor->surname }}</h5>
                                        <a href="{{ route('admin.pdfParticipant', ['courseId' => $course->id, 'competitorId' => $competitor->id]) }}" class="btn btn-pink">View participant</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>
</html>
