<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <title>Scooter Leveling</title>
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
                <a href="{{ route('user.login') }}"><img src="assets/images/flecha.png" alt="flecha" class="arrowLogin"></a>
                <h1 class="loginTitulo">Register</h1>
                <form action="{{ route('user.insertRegistration') }}" method="POST" class="formRegister" onsubmit="return validateForm()">
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
                            <label for="password" class="labelLogin">Password</label><br>
                            <div class="divLogin">
                                <input type="password" id="password" name="password" class="inputLogin" placeholder="Type your password" required>
                            </div>
                        </div>
                        <input type="submit" value="Register" class="btn btn-pink btnAdd btnLogin">
                    </div>
                </form>
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('assets/js/federation.js') }}"></script>
        <script src="{{ asset('assets/js/validation.js') }}"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
        <script src="{{ asset('assets/js/tabs.js') }}"></script>
        <script src="{{ asset('assets/js/popup.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </body>
</html>