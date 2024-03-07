<form action="{{ route('admin.courseUpdate', $course->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $course->name }}" required><br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="{{ $course->description }}" required><br><br>

    <label for="elevation">Elevation (0-100%):</label>
    <input type="number" id="elevation" name="elevation" min="0" max="100" value="{{ $course->elevation }}" required><br><br>

    <!-- <label for="map_image">Map Image:</label>
    <input type="file" id="map_image" name="map_image" accept="image/*" value="{{ $course->map_image }}" readonly><br><br> -->

    <label for="max_participants">Max Participants:</label>
    <input type="number" id="max_participants" name="max_participants" min="1" value="{{ $course->max_participants }}" required><br><br>

    <label for="distance_km">Distance (km):</label>
    <input type="number" id="distance_km" name="distance_km" min="0" step="0.01" value="{{ $course->distance_km }}" required><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="{{ $course->date }}" required><br><br>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time" value="{{ $course->time }}" required><br><br>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="{{ $course->location }}" required><br><br>

    <!-- <label for="promotion_poster">Promotion Poster:</label>
    <input type="file" id="promotion_poster" name="promotion_poster" accept="image/*" value="{{ $course->promotion_poster }}" readonly><br><br> -->

    <label for="sponsorship_cost">Sponsorship Cost:</label>
    <input type="number" id="sponsorship_cost" name="sponsorship_cost" min="0" step="0.01" value="{{ $course->sponsorship_cost }}" required><br><br>

    <label for="registration_price">Registration Price:</label>
    <input type="number" id="registration_price" name="registration_price" min="0" step="0.01" value="{{ $course->registration_price }}" required><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>