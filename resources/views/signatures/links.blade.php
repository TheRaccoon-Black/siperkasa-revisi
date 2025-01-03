<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Tangan</title>
    <script>
        function copyToClipboard(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            document.execCommand("copy");
            alert("Link copied to clipboard: " + copyText.value);
        }
        function shareToWhatsApp(elementId) {
            const inputElement = document.getElementById(elementId);
            const url = inputElement.value;
            const whatsappURL = `https://wa.me/?text=${encodeURIComponent(url)}`;
            window.open(whatsappURL, '_blank');
        }
    </script>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #000;
            margin-bottom: 20px;
        }

        div {
            margin-bottom: 15px;
            width: 100%;
            max-width: 400px;
            margin: 10px auto;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            font-size: 1.1em;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #444;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            div {
                width: 90%;
            }

            button {
                width: 100%;
                padding: 12px 0;
            }
        }
    </style>
</head>

<body>
    <h1>Link Tanda Tangan</h1>

    <div>
        <label for="linkDanruPenerima">Danru Penerima:</label>
        <input type="text" id="linkDanruPenerima" value="{{ url('signatures/' . $signature->linkDanruPenerima) }}"
            readonly>
        <button onclick="copyToClipboard('linkDanruPenerima')">Copy</button>
        <button onclick="shareToWhatsApp('linkDanruPenerima')">Share to WhatsApp</button>
    </div>

    <div>
        <label for="linkDanruPenyerah">Danru Penyerah:</label>
        <input type="text" id="linkDanruPenyerah" value="{{ url('signatures/' . $signature->linkDanruPenyerah) }}"
            readonly>
        <button onclick="copyToClipboard('linkDanruPenyerah')">Copy</button>
        <button onclick="shareToWhatsApp('linkDanruPenyerah')">Share to WhatsApp</button>
    </div>

    <div>
        <label for="linkAsstMan">Asst Man:</label>
        <input type="text" id="linkAsstMan" value="{{ url('signatures/' . $signature->linkAsstMan) }}" readonly>
        <button onclick="copyToClipboard('linkAsstMan')">Copy</button>
        <button onclick="shareToWhatsApp('linkAsstMan')">Share to WhatsApp</button>
    </div>

    <script>
        function copyToClipboard(elementId) {
            const inputElement = document.getElementById(elementId);
            inputElement.select();
            inputElement.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Copied to clipboard: " + inputElement.value);
        }

        function shareToWhatsApp(elementId) {
            const inputElement = document.getElementById(elementId);
            const url = inputElement.value;
            const whatsappURL = `https://wa.me/?text=${encodeURIComponent(url)}`;
            window.open(whatsappURL, '_blank');
        }
    </script>
</body>


</html>
