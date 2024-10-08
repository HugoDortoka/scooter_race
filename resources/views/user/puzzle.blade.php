<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Scooter Leveling</title>
		<!-- Additional CSS Files -->
		<link rel="stylesheet" href="{{ asset('assets/css/puzzle.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
		<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	</head>

	<body>
		<div id="timer">Tiempo restante: <span id="time">5:00</span></div>
		<div id="screen">
			<div id="title">
				<h1>Solve the puzzle by dragging the pieces in the grid</h1>
				<video autoplay muted loop>
					<source src="{{ asset('img/puzzle/vid.mp4') }}" type="video/mp4">
					There is sopoused to be a video, but your browser doesn't support it 
				</video>
				<h2>Preview</h2>
				<img alt="Puzzle preview" src="{{ asset('img/puzzle/puzzle.jpg') }}">
				<p id="warning">This game can't be played on this device</p>
			</div>
			<div id="puzzle">
				<div id="piecesBox"></div>
			</div>
		</div>
		<div id="discount" class="divDiscount"></div>
        <script src="{{ asset('assets/js/puzzle.js') }}"></script>

	</body>

</html>