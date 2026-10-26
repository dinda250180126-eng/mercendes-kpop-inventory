<x-app-layout>
    <div class="py-12 flex justify-center">
        <div class="max-w-xl w-full bg-white p-8 rounded-xl shadow-lg border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Form Pembelian</h2>
            
            <!-- Info Produk yang Dibeli -->
            <div class="flex items-center gap-4 bg-blue-50 p-4 rounded-lg mb-6">
                <div>
                    <p class="text-sm text-gray-500 font-semibold">Produk:</p>
                    <p class="text-lg font-bold text-blue-700">{{ $product->name }}</p>
                    <p class="text-sm text-gray-600">Sisa Stok: <span class="font-bold text-red-500">{{ $product->stock }}</span></p>
                </div>
            </div>

            <form action="{{ route('checkout.proses') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. WhatsApp / HP</label>
                    <input type="text" name="no_hp" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Pengiriman</label>
                    <textarea name="alamat" rows="3" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Beli</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Metode Pembayaran</label>
                        <input type="text" value="Transfer Bank" readonly class="w-full rounded-md border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md font-semibold hover:bg-gray-300">Batal</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md font-bold hover:bg-blue-700 shadow-md">Proses Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>