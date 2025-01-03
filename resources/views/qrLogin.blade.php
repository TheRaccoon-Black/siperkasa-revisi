<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak QR Code - Login SIPERKASA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <h1>Masuk ke Login Website SIPERKASA</h1>
        <p>Scan QR Code di bawah ini untuk menuju halaman login.</p>
        <div class="qr-code">
            {!! QrCode::size(800)->generate(url()->route('login')) !!}
        </div>
    </div>
</body>
</html>
