<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Produk Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">SKU (Kode Barang)</label>
                        <input type="text" name="sku" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 font-bold">Harga Beli/Awal (Wajib Angka Murni)</label>
                        <input type="number" name="purchase_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="0">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 font-bold">Harga Jual (Wajib Angka Murni)</label>
                        <input type="number" name="selling_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="0">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required min="0">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        <input type="file" name="image" class="mt-1 block w-full border-gray-300">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-bold">
                        Simpan Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>