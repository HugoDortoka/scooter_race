
<form action="{{ route('admin.sponsorAdd') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" required><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="name">Logo:</label>
    <input type="file" id="logo" name="logo" accept="image/*" required><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="principal">Principal:</label>
    <input type="checkbox" id="principal" name="principal" required><br><br>

    <label for="extra_cost">Coste extra</label>
    <input type="number" id="extra_cost" name="extra_cost" required><br><br>


    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>