
<form action="{{ route('admin.sponsorAdd') }}" method="post">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" ><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name"  ><br><br>

    <label for="name">Logo:</label>
    <input type="text" id="logo" name="logo"  ><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" ><br><br>

    <label for="principal">Principal:</label>
    <input type="checkbox" id="principal" name="principal"><br><br>

    <label for="extra_cost">Coste extra</label>
    <input type="number" id="extra_cost" name="extra_cost" ><br><br>


    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>