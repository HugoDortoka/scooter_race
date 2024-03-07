
<form action="{{ route('admin.insurerAdd') }}" method="post">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" required><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="price">Precio por carrera:</label>
    <input type="number" id="price" name="price" required><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>