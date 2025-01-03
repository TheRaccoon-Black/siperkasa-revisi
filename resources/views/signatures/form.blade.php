<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signature</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 2em;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        p {
            font-size: 1.1em;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        .signature-pad-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .signature-pad {
            border: 2px solid #000;
            width: 300px;
            height: 300px;
            background-color: #fff;
            cursor: crosshair;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            min-width: 120px;
        }

        button:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .signature-pad {
                width: 300px;
                height: 300px;
                max-width: 350px;
            }

            button {
                width: 100%;
                padding: 15px;
                font-size: 1.2em;
            }
        }

        @media (max-width: 768px) {
            .signature-container {
                grid-column: span 12;
            }

            .iframe-container {
                grid-column: span 12;
            }
        }

        @media (min-width: 768px) {
            .signature-container {
                grid-column: span 4;
            }

            .iframe-container {
                grid-column: span 8;
            }
        }
    </style>
</head>

<body>
    <div style="display: grid; grid-template-columns: repeat(12, 1fr); gap: 20px; width: 100%;">
        <div class="signature-container">
            <h1>Tanda Tangan Digital</h1>
            <p><strong>Role:</strong> {{ $role }}</p>
            <p>Harus diisi Oleh: <strong>{{ $name }}</strong></p>

            @if (isset($isFilled) && $isFilled)
                <p>Tanda tangan sudah diisi oleh {{ $role }}.</p>
            @else
                <form id="signature-form" method="POST"
                    action="{{ route('signatures.save', ['link' => request()->route('link')]) }}">
                    @csrf
                    <input type="hidden" id="signature" name="signature">
                    <div class="signature-pad-container">
                        <canvas id="signature-pad" class="signature-pad"></canvas>
                    </div>
                    <div class="button-group">
                        <button type="button" id="clear-button">Clear</button>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="iframe-container">
            <iframe src="{{ url('pemeriksaan/cetak/' . $signature->idHasilPemeriksaan) }}" frameborder="1"
                style="border:1px solid #000;width:100%;height:1000px"></iframe>
        </div>
    </div>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);
        const clearButton = document.getElementById('clear-button');
        const signatureInput = document.getElementById('signature');

        // Resize canvas for proper signature pad functionality
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        clearButton.addEventListener('click', () => {
            signaturePad.clear();
        });

        document.getElementById('signature-form').addEventListener('submit', (e) => {
            if (signaturePad.isEmpty()) {
                e.preventDefault();
                alert('Please provide a signature.');
            } else {
                signatureInput.value = signaturePad.toDataURL();
            }
        });
    </script>
</body>

</html>
