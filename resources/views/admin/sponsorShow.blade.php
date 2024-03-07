
<form action="{{ route('admin.sponsorUpdate', $sponsor->id) }}" method="post">
    @csrf
    <label for="cif">CIF:</label>
    <input type="text" id="cif" name="cif" value="{{ $sponsor->CIF }}" readonly ><br><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="{{ $sponsor->name }}" ><br><br>

    <label for="name">Logo:</label>
    <input type="text" id="logo" name="logo" value="{{ $sponsor->logo }}" ><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" value="{{ $sponsor->address }}" ><br><br>
    
    <label for="principal">Principal:</label>
    <input type="checkbox" id="principal" name="principal" value="1" {{ $sponsor->principal ? 'checked' : '' }}><br><br>

    <label for="extra_cost">Coste extra</label>
    <input type="number" id="extra_cost" name="extra_cost" value="{{ $sponsor->extra_cost }}" ><br><br>

    <!-- Agrega aquí más campos si es necesario -->

    <input type="submit" value="Enviar">
</form>



