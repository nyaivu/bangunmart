<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan BangunMart</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>BANGUNMART - LAPORAN PENJUALAN</h2>
        <p>Periode: {{ $tgl_mulai }} s/d {{ $tgl_selesai }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Metode</th>
                <th>Total Tagihan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $row)
            <tr>
                <td>{{ date('d-m-Y H:i', strtotime($row->tgl_nota)) }}</td>
                <td>{{ strtoupper($row->metode) }}</td>
                <td>Rp {{ number_format($row->jumlah_tagihan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Omset: Rp {{ number_format($total_omzet, 0, ',', '.') }}
    </div>
</body>
</html>