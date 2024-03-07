
<form action="{{ route('admin.courseAdd') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required><br><br>

    <label for="elevation">Elevation (0-100%):</label>
    <input type="number" id="elevation" name="elevation" min="0" max="100" required><br><br>

    <label for="map_image">Map Image:</label>
    <input type="file" id="map_image" name="map_image" accept="image/*" required><br><br>

    <label for="max_participants">Max Participants:</label>
    <input type="number" id="max_participants" name="max_participants" min="1" required><br><br>

    <label for="distance_km">Distance (km):</label>
    <input type="number" id="distance_km" name="distance_km" min="0" step="0.01" required><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br><br>

    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required><br><br>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br><br>

    <label for="promotion_poster">Promotion Poster:</label>
    <input type="file" id="promotion_poster" name="promotion_poster" accept="image/*" required><br><br>

    <label for="sponsorship_cost">Sponsorship Cost:</label>
    <input type="number" id="sponsorship_cost" name="sponsorship_cost" min="0" step="0.01" required><br><br>

    <label for="registration_price">Registration Price:</label>
    <input type="number" id="registration_price" name="registration_price" min="0" step="0.01" required><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>