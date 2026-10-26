<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Transaksi K-Pop Inventory</h2>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No Referensi</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $trx->reference_number }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d/m/Y') }}</td>
                <td>{{ $trx->product->name ?? '-' }}</td>
                <td>{{ $trx->type == 'in' ? 'Barang Masuk' : 'Barang Keluar' }}</td>
                <td>{{ $trx->quantity }}</td>
                <td>{{ $trx->notes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>