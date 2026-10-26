<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pesanan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-indigo-500">
                
                <h3 class="text-lg font-bold text-gray-800 mb-6">🛍️ Daftar Barang yang Pernah Dibeli</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                                <th class="p-3 font-bold text-gray-700">Tanggal Transaksi</th>
                                <th class="p-3 font-bold text-gray-700">Nomor Resi</th>
                                <th class="p-3 font-bold text-gray-700">Produk</th>
                                <th class="p-3 font-bold text-gray-700">Data Pengiriman</th>
                                <th class="p-3 font-bold text-gray-700">Kuantitas</th>
                                <th class="p-3 font-bold text-gray-700">Total Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $t)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 text-sm">
                                    <td class="p-3">{{ \Carbon\Carbon::parse($t->transaction_date ?? $t->created_at)->format('d M Y, H:i') }}</td>
                                    <td class="p-3 font-mono text-xs text-gray-500">{{ $t->reference_number ?? '-' }}</td>
                                    <td class="p-3 font-semibold text-gray-800">{{ $t->product->name ?? 'Produk Dihapus' }}</td>
                                    <td class="p-3">
                                        <p class="font-bold text-gray-800">{{ $t->customer_name ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ $t->customer_phone ?? '-' }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $t->customer_address ?? '-' }}</p>
                                    </td>
                                    <td class="p-3 text-gray-600">{{ $t->quantity }} pcs</td>
                                    <td class="p-3 font-bold text-green-600">Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">
                                        <p class="text-lg font-semibold mb-2">Belum Ada Pesanan</p>
                                        <p class="text-sm">Anda belum pernah melakukan pembelian produk apapun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>