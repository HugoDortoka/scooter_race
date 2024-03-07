
<form action="{{ route('admin.insurerAdd') }}" method="post">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" ><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" ><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" ><br><br>

    <label for="price">Precio por carrera:</label>
    <input type="number" id="price" name="price" ><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>