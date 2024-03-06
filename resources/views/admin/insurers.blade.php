@foreach($insurers as $insurer)
    <p>CIF: {{ $insurer->CIF }}</p>
    <p>Nombre: {{ $insurer->name }}</p>
    <p>Dirección: {{ $insurer->address }}</p>
    <p>Precio por carrera: {{ $insurer->price_per_course }}</p>
    <hr>
@endforeach

