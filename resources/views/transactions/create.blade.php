<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Catat Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-blue-100">
                <div class="p-6 text-gray-900">
                    
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-sm">
                            <ul class="list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 gap-6">
                        @csrf
                        
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi <span class="text-red-500">*</span></label>
                            <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">-- Pilih Jenis Transaksi --</option>
                                <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Barang Masuk (Restok dari Supplier)</option>
                                <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Barang Keluar (Penjualan ke Customer)</option>
                            </select>
                        </div>

                        <div>
                            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Produk <span class="text-red-500">*</span></label>
                            <select name="product_id" id="product_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->sku }} - {{ $product->name }} (Stok saat ini: {{ $product->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Barang <span class="text-red-500">*</span></label>
                                <input type="number" name="quantity" id="quantity" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('quantity') }}" required min="1">
                            </div>

                            <div>
                                <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi <span class="text-red-500">*</span></label>
                                <input type="date" name="transaction_date" id="transaction_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Misal: Pembelian dari Supplier A / Penjualan ke Customer B">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                            <a href="{{ route('transactions.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition font-semibold text-sm">Batal</a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition font-semibold text-sm">Proses Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>