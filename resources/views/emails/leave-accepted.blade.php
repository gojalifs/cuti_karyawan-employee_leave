<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengajuan Cuti Diterima</title>
    <style>
        /* Define styles */
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
        }

        h1 {
            color: #009688;
            font-size: 24px;
        }

        .details {
            margin-top: 15px;
            border: 1px solid #dddddd;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div
        style="font-family: Arial, sans-serif; color: #333333; background-color: #f4f4f4; padding: 20px; border-radius: 5px;">
        <h1 style="color: #009688; font-size: 24px;">Pengajuan Cuti Diterima</h1>

        <p>Halo {{ $name }},</p>

        <div class="details" style="margin-top: 15px; border: 1px solid #dddddd; padding: 10px; border-radius: 5px;">
            <p>Dengan senang hati kami informasikan bahwa izin cuti Anda telah <strong>diterima</strong>.</p>

            <p>Berikut ini rinciannya:</p>
            <ul>
                <li><strong>Nama Karyawan:</strong> {{ $name }}</li>
                <li><strong>Tanggal Mulai:</strong> {{ $start_date }}</li>
                <li><strong>Tanggal Selesai:</strong> {{ $end_date }}</li>
                <li><strong>Durasi:</strong> {{ $total }} hari</li>
                <li><strong>Status:</strong> {{ $status }}</li>
                <li><strong>Sisa Cuti:</strong> {{ $remaining }}</li>
                <li><strong>Keterangan:</strong> {{ $note }}</li>
            </ul>
        </div>

        <p>Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut, jangan ragu untuk menghubungi kami.
        </p>

        <p>Terima Kasih,<br>
            Tim HR | PT Nitigura Indonesia</p>
    </div>
</body>

</html>
