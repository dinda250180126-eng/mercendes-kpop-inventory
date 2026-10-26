<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi KPOPMERCH</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .print-btn { margin-bottom: 20px; display: inline-block; padding: 10px 20px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; cursor: pointer; font-weight: bold; border: none; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()">🖨️ Cetak / Simpan sebagai PDF</button>

    <div class="header">
        <h2>KPOPMERCH - LAPORAN BARANG {{ strtoupper($type == 'in' ? 'MASUK' : 'KELUAR') }}</h2>
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th>{{ $type == 'in' ? 'Supplier' : 'Customer' }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                <td>{{ $t->product->name ?? '-' }}</td>
                <td>{{ $t->quantity }}</td>
                <td>Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                <td>{{ $type == 'in' ? ($t->supplier->name ?? '-') : ($t->user->name ?? '-') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>