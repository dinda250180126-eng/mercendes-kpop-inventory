<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-blue-900 leading-tight">
            ✨ {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <!-- Latar Belakang Soft Blue -->
    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Banner Gambar Penuh -->
            <div class="relative w-full h-80 sm:h-96 rounded-3xl overflow-hidden shadow-md border-4 border-white group">
                <!-- Foto Background menggunakan tag img agar langsung tampil -->
                <img src="{{ asset('images/home.jpg') }}" alt="Dashboard Home" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                
                <!-- Lapisan Gelap Transparan agar Teks Terbaca Jelas -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-8 sm:p-12 text-white z-10">
                    <span class="inline-block px-3.5 py-1 bg-white/20 backdrop-blur-md text-white font-bold text-xs uppercase tracking-widest rounded-full w-max mb-3">
                        Role: {{ Auth::user()->role }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-2">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-gray-200 font-medium text-sm sm:text-base max-w-xl">
                        Selamat datang di sistem manajemen KPOPMERCH. Kelola koleksi dan pantau aktivitas belanja dengan mudah dan cepat.
                    </p>
                </div>
            </div>

            <!-- Konten Spesifik Berdasarkan Role (Tombol Warna Putih) -->
            @if(strtolower(trim(auth()->user()->role)) === 'customer')
                
                <!-- Menu Customer -->
                <div class="flex flex-col sm:flex-row justify-center gap-6 max-w-4xl mx-auto">
                    <a href="{{ route('products.index') }}" class="flex-1 flex flex-col items-center justify-center p-8 bg-white text-gray-800 font-bold rounded-3xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 hover:shadow-xl shadow-sm border border-gray-100 group">
                        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">🛍️</div>
                        <span class="text-lg">Katalog Produk</span>
                    </a>
                    <a href="{{ route('customer.transactions') }}" class="flex-1 flex flex-col items-center justify-center p-8 bg-white text-gray-800 font-bold rounded-3xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 hover:shadow-xl shadow-sm border border-gray-100 group">
                        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">🧾</div>
                        <span class="text-lg">Riwayat Pesanan</span>
                    </a>
                </div>

            @else
                
                <!-- Menu Admin / Staff -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <a href="{{ route('products.index') }}" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-blue-300 transition-all duration-300 group flex items-center gap-6 transform hover:-translate-y-1">
                        <div class="p-5 bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-gray-900 text-lg mb-1">Kelola Katalog</h4>
                            <p class="text-gray-500 text-sm font-medium">Tambah, edit, atau hapus merchandise.</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('transactions.index') }}" class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-pink-300 transition-all duration-300 group flex items-center gap-6 transform hover:-translate-y-1">
                        <div class="p-5 bg-pink-50 text-pink-600 rounded-2xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-gray-900 text-lg mb-1">Manajemen Transaksi</h4>
                            <p class="text-gray-500 text-sm font-medium">Pantau data barang masuk & pesanan keluar.</p>
                        </div>
                    </a>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>