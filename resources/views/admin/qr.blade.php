<!DOCTYPE html>
<html>
<head>
    <title>Código QR</title>
</head>
<body>
    <img src="{{ $qrCodeImage }}" alt="QR Code Image">
    <a href=" {{ route('admin.finishTime', ['dorsalNumber' => $dorsalNumber, 'courseId' => $courseId]) }}">A</a>
</body>
</html>