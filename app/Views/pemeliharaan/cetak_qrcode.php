<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak QR Code Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-print {
            width: 300px;
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid #007bff;
            margin: 40px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, #0052cc, #0099ff);
            color: #fff;
            text-align: center;
            padding: 15px 10px;
        }

        .card-header h5 {
            font-weight: bold;
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .plate {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            padding: 6px 16px;
            border-radius: 6px;
            margin: 10px auto;
            font-size: 16px;
        }

        .qrcode img {
            width: 180px;
            height: 180px;
            display: block;
            margin: 0 auto 15px auto;
        }

        .footer {
            background: #f8f9fa;
            color: #6c757d;
            font-size: 12px;
            text-align: center;
            padding: 5px;
        }

        @media print {
            body {
                background: #fff !important;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            .card-print {
                box-shadow: none;
                border: 1px solid #000;
                margin: 0;
            }
        }
    </style>
</head>

<body onload="setTimeout(() => window.print(), 500)">

    <div class="card-print">
        <div class="card-header">
            <h5>QR CODE KENDARAAN</h5>
        </div>

        <div class="text-center mt-3">
            <div class="plate"><?= esc($kendaraan['nopol']) ?></div>
        </div>

        <div class="qrcode">
            <img src="<?= $qrcode ?>" alt="QR Code Kendaraan">
        </div>

        <div class="footer">
            <?= date('Y') ?> @ Dinas Lingkungan Hidup Kota Pekalongan
        </div>
    </div>
    <script>
        // Setelah print selesai atau dibatalkan, kembali ke halaman sebelumnya
        window.onafterprint = () => {
            window.history.back();
        };
    </script>
</body>

</html>