<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500 leading-tight tracking-wide">
                ✨ {{ __('Katalog Merchandise') }}
            </h2>
            @if(strtolower(trim(auth()->user()->role)) !== 'customer')
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-purple-600 to-pink-500 rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:shadow-lg hover:shadow-pink-300/50 hover:-translate-y-0.5 transition-all">
                    + Tambah Produk
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl shadow-sm relative">
                    <span class="font-bold block sm:inline">Yeay! 🎉 {{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl shadow-sm relative">
                    <span class="font-bold block sm:inline">Oops! ⚠️ {{ session('error') }}</span>
                </div>
            @endif

            <!-- Form Pencarian dan Filter -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-purple-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-pink-200 to-transparent opacity-30 rounded-full -mr-10 -mt-10"></div>
                <form action="{{ route('products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 relative z-10">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Cari nama merchandise, photocard, atau SKU..." class="w-full border-gray-200 bg-gray-50 rounded-xl shadow-inner focus:border-purple-400 focus:ring focus:ring-purple-200 transition-all">
                    </div>
                    <div class="sm:w-64">
                        <select name="category_id" class="w-full border-gray-200 bg-gray-50 rounded-xl shadow-inner focus:border-purple-400 focus:ring focus:ring-purple-200 transition-all">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gray-800 text-white font-bold rounded-xl hover:bg-gray-900 transition-all shadow-sm">
                            Filter
                        </button>
                    </div>
                    @if(request('search') || request('category_id'))
                        <div>
                            <a href="{{ route('products.index') }}" class="w-full sm:w-auto flex items-center justify-center px-6 py-2.5 bg-pink-50 text-pink-600 font-bold rounded-xl hover:bg-pink-100 transition-all">
                                Reset
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Katalog Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col relative group hover:shadow-xl hover:shadow-purple-200/40 transition-all duration-300 transform hover:-translate-y-2">
                            
                            <!-- Lencana Stok -->
                            <div class="absolute top-3 right-3 z-10 {{ $product->stock > 0 ? 'bg-gradient-to-r from-purple-500 to-pink-500' : 'bg-gray-800' }} text-white text-xs font-black px-3 py-1.5 rounded-full shadow-md tracking-wider">
                                {{ $product->stock > 0 ? 'SISA ' . $product->stock : 'SOLD OUT' }}
                            </div>
                            
                            <!-- Gambar Produk dengan Efek Zoom -->
                            <div class="h-64 bg-gray-100 w-full overflow-hidden relative">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent z-0"></div>
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x400?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            
                            <div class="p-5 flex flex-col flex-grow relative z-10 bg-white">
                                <span class="text-purple-600 text-xs font-black uppercase tracking-widest mb-2">
                                    {{ $product->category->name ?? 'K-MERCH' }}
                                </span>
                                <h3 class="text-gray-900 font-bold text-base leading-snug mb-1 line-clamp-2">{{ $product->name }}</h3>
                                <span class="text-gray-400 text-xs mb-4 font-medium uppercase">SKU: {{ $product->sku ?? '-' }}</span>
                                
                                <div class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700 mb-5">
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </div>
                                
                                <div class="mt-auto">
                                    @if(strtolower(trim(auth()->user()->role)) !== 'customer')
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="flex-1 flex justify-center items-center px-3 py-2.5 bg-purple-50 text-purple-600 rounded-xl hover:bg-purple-100 text-sm font-bold transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1 m-0" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full flex justify-center items-center px-3 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 text-sm font-bold transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        @if($product->stock > 0)
                                            <a href="{{ route('customer.checkout.form', $product->id) }}" class="w-full flex justify-center items-center px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white rounded-xl text-sm font-bold shadow-md shadow-pink-200 transition-all transform active:scale-95">
                                                Pesan Sekarang 🛒
                                            </a>
                                        @else
                                            <button disabled class="w-full flex justify-center items-center px-4 py-3 bg-gray-200 cursor-not-allowed text-gray-500 rounded-xl text-sm font-bold transition-all">
                                                Sold Out 🥺
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center">
                        <div class="text-6xl mb-4">💿</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Merchandise</h3>
                        <p class="text-gray-500">Katalog masih kosong atau merchandise yang dicari tidak ditemukan.</p>
                    </div>
                @endif
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>