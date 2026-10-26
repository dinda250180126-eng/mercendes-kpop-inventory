<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout Pesanan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row gap-8">
                
                <!-- Ringkasan Produk -->
                <div class="md:w-1/3">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400?text=No+Image' }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-sm mb-4">
                    <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
                    <p class="text-blue-600 font-extrabold text-xl mt-2">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-2">Sisa Stok: {{ $product->stock }}</p>
                </div>

                <!-- Formulir Pengiriman -->
                <div class="md:w-2/3 border-l-0 md:border-l border-gray-200 md:pl-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Detail Pengiriman</h3>
                    
                    <form action="{{ route('customer.checkout') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                            <input type="text" name="customer_name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="customer_phone" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="customer_address" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Beli</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        
                        <div class="pt-4">
                            <button type="submit" onclick="return confirm('Proses pesanan ini?');" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-700 transition shadow-sm">
                                Konfirmasi & Buat Pesanan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>