
<form action="{{ route('admin.courseAdd') }}" method="post">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" ><br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" ><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" ><br><br>

    <label for="price">Precio por carrera:</label>
    <input type="number" id="price" name="price" ><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>