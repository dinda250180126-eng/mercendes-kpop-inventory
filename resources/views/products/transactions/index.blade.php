<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Transaksi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Kartu Laporan Bulanan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Beban Pengeluaran (Bulan Ini)</h3>
                    <p class="text-3xl font-extrabold text-gray-800">Rp {{ number_format($monthlyIn, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total nilai barang masuk bulan ini</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-pink-500">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Pemasukan (Bulan Ini)</h3>
                    <p class="text-3xl font-extrabold text-green-600">Rp {{ number_format($monthlyOut, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total nilai barang terjual bulan ini</p>
                </div>
            </div>

            <!-- Tabel Barang Masuk -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-2 border-blue-200">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 sm:mb-0">📦 Riwayat Barang Masuk</h3>
                    <div class="flex space-x-2">
                        <a href="{{ route('transactions.create_in') }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 text-sm shadow-sm transition">
                            + Tambah Masuk
                        </a>
                        <a href="{{ route('transactions.export', 'in') }}" target="_blank" class="px-4 py-2 bg-gray-800 text-white font-bold rounded-md hover:bg-gray-900 text-sm shadow-sm transition">
                            Unduh PDF/Print
                        </a>
                    </div>
                </div>
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                            <th class="p-3 font-bold">Tanggal</th>
                            <th class="p-3 font-bold">Resi</th>
                            <th class="p-3 font-bold">Produk</th>
                            <th class="p-3 font-bold">Qty</th>
                            <th class="p-3 font-bold">Total Harga</th>
                            <th class="p-3 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactionsIn as $in)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 text-sm">
                                <td class="p-3">{{ \Carbon\Carbon::parse($in->transaction_date)->format('d M Y') }}</td>
                                <td class="p-3 font-mono text-xs text-gray-500">{{ $in->reference_number }}</td>
                                <td class="p-3 font-semibold">{{ $in->product->name ?? '-' }}</td>
                                <td class="p-3"><span class="bg-blue-100 text-blue-700 px-2 py-1 rounded font-bold">+{{ $in->quantity }}</span></td>
                                <td class="p-3 text-gray-600">Rp {{ number_format($in->total_price, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('transactions.destroy', $in->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus catatan barang masuk ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 text-xs font-semibold transition">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-gray-500">Belum ada barang masuk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Barang Keluar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-2 border-pink-200">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 sm:mb-0">🛍️ Riwayat Barang Keluar (Pesanan)</h3>
                    <a href="{{ route('transactions.export', 'out') }}" target="_blank" class="px-4 py-2 bg-gray-800 text-white font-bold rounded-md hover:bg-gray-900 text-sm shadow-sm transition">
                        Unduh PDF/Print
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                            <th class="p-3 font-bold">Tanggal</th>
                            <th class="p-3 font-bold">Resi</th>
                            <th class="p-3 font-bold">Produk</th>
                            <th class="p-3 font-bold">Qty</th>
                            <th class="p-3 font-bold">Total Pemasukan</th>
                            <th class="p-3 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactionsOut as $out)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 text-sm">
                                <td class="p-3">{{ \Carbon\Carbon::parse($out->transaction_date)->format('d M Y') }}</td>
                                <td class="p-3 font-mono text-xs text-gray-500">{{ $out->reference_number }}</td>
                                <td class="p-3 font-semibold">{{ $out->product->name ?? '-' }}</td>
                                <td class="p-3"><span class="bg-pink-100 text-pink-700 px-2 py-1 rounded font-bold">-{{ $out->quantity }}</span></td>
                                <td class="p-3 font-bold text-green-600">Rp {{ number_format($out->total_price, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('transactions.destroy', $out->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus catatan barang keluar ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 text-xs font-semibold transition">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-4 text-center text-gray-500">Belum ada transaksi keluar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>