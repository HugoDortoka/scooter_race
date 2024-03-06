
<form action="{{ route('admin.insurerUpdate', $insurer->id) }}" method="post">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" value="{{ $insurer->CIF }}" readonly ><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="{{ $insurer->name }}" ><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" value="{{ $insurer->address }}" ><br><br>

    <label for="price">Precio por carrera:</label>
    <input type="text" id="price" name="price" value="{{ $insurer->price_per_course }}" ><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>



