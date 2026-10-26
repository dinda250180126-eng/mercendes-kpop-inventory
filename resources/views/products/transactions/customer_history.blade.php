<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @php
                    // Menarik data transaksi khusus untuk customer yang sedang login secara langsung
                    $transactions = \App\Models\Transaction::with('product')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get();
                @endphp

                @if($transactions->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Pesanan</h3>
                        <p class="text-gray-500 mb-6">Anda belum melakukan pemesanan merchandise apa pun.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-bold text-white hover:bg-blue-700 transition shadow-sm">
                            🛍️ Mulai Belanja Sekarang
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider border-b border-gray-200">
                                    <th class="p-4 font-bold">Tanggal</th>
                                    <th class="p-4 font-bold">Produk</th>
                                    <th class="p-4 font-bold text-center">Jumlah</th>
                                    <th class="p-4 font-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($transactions as $trx)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="p-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                                        </td>
                                        <td class="p-4">
                                            <div class="font-bold text-gray-800">{{ $trx->product->name ?? 'Produk Dihapus' }}</div>
                                        </td>
                                        <td class="p-4 text-center font-bold text-gray-700">
                                            {{ $trx->quantity }}
                                        </td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                                Berhasil
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>