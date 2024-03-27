<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <title>Login</title>
        <!-- CSS de Bootstrap -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Scripts de Bootstrap (JavaScript) -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
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
        <div class="containerLogin">
            <div class="centrado">
                <a href=""><img src="assets/images/flecha.png" alt="flecha" class="arrowLogin"></a>
                <h1 class="loginTitulo">Login</h1>
                <form action="{{ route('user.checkLogin') }}" method="POST" class="formLogin">
                    @csrf
                    <label for="dni" class="labelLogin">DNI</label><br>
                    <div class="divLogin">
                        <img src="assets/images/usuario.png" alt="user" class="fotoLogin">
                        <input type="text" id="dni" name="dni" class="inputLogin" placeholder="Type your DNI" required>
                    </div>
                    <label for="password" class="labelLogin">Password</label><br>
                    <div class="divLogin">
                        <img src="assets/images/cerrar.png" alt="user" class="fotoLogin">
                        <input type="password" id="password" name="password" class="inputLogin" placeholder="Type your password" required>
                    </div>
                    <input type="submit" value="LOGIN" class="btn btn-pink btnAdd btnLogin">
                </form>
                <a href="{{ route('user.registration') }}">SIGN UP</a>
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
    </body>
</html>