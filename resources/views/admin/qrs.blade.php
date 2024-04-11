<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Codes</title>
</head>
<body>

    @foreach ($qrCodesData as $qrCodeData)
        <div>
            <h2>Dorsal Number: {{ $qrCodeData['dorsalNumber'] }}</h2>
            <img src="{{ $qrCodeData['qrCodeImage'] }}" alt="QR Code">
            <div style="page-break-after: always;"></div>
            <!-- Aquí puedes agregar cualquier otra información adicional que desees mostrar para cada competidor -->
        </div>
    @endforeach
</body>
</html>
