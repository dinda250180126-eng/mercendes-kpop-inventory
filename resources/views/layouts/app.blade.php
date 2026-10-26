<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'KPOPMERCH') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            <!-- NAVBAR LANGSUNG TERPASANG AMAN DI SINI -->
            <nav x-data="{ open: false }" class="bg-blue-600 border-b border-blue-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo Aplikasi -->
                            <div class="shrink-0 flex items-center text-white font-bold text-xl tracking-wider">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                    KPOPMERCH
                                </a>
                            </div>

                            <!-- Menu Navigasi -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-white text-white font-bold' : 'border-transparent text-blue-100 hover:text-white hover:border-gray-300 font-medium' }} text-sm leading-5 transition duration-150 ease-in-out">
                                    Dashboard
                                </a>
                                
                                @if(auth()->check() && auth()->user()->role !== 'customer')
                                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('categories.*') ? 'border-white text-white font-bold' : 'border-transparent text-blue-100 hover:text-white hover:border-gray-300 font-medium' }} text-sm leading-5 transition duration-150 ease-in-out">
                                        Kategori
                                    </a>
                                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-white text-white font-bold' : 'border-transparent text-blue-100 hover:text-white hover:border-gray-300 font-medium' }} text-sm leading-5 transition duration-150 ease-in-out">
                                        Produk
                                    </a>
                                    <a href="{{ route('suppliers.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('suppliers.*') ? 'border-white text-white font-bold' : 'border-transparent text-blue-100 hover:text-white hover:border-gray-300 font-medium' }} text-sm leading-5 transition duration-150 ease-in-out">
                                        Supplier
                                    </a>
                                    <a href="{{ route('transactions.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('transactions.*') ? 'border-white text-white font-bold' : 'border-transparent text-blue-100 hover:text-white hover:border-gray-300 font-medium' }} text-sm leading-5 transition duration-150 ease-in-out">
                                        Transaksi
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Dropdown Profil & Logout -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                                <div @click="open = ! open">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name ?? 'User' }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                                <!-- Isi Dropdown -->
                                <div x-show="open" style="display: none;" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0">
                                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                        <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                            Profile
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                                Log Out
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Bagian Header Halman (Contoh: Kelola Kategori) -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Bagian Konten Utama -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>