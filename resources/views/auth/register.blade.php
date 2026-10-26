<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - KPOPMERCH</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-blue-500 font-sans antialiased h-screen flex items-center justify-center relative">

    <!-- Tombol Back -->
    <a href="/" class="absolute top-6 left-6 text-white text-2xl hover:text-gray-200 transition">
        <i class="fas fa-chevron-left"></i>
    </a>

    <!-- Kartu Register -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 text-center mx-4">
        
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Sign Up</h2>
        <p class="text-sm text-gray-500 mb-8">Daftarkan akun KPOPMERCH kamu</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Input Nama -->
            <div class="mb-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-blue-400"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Nama Lengkap">
                @error('name') <p class="mt-1 text-xs text-red-600 text-left">{{ $message }}</p> @enderror
            </div>

            <!-- Input Email -->
            <div class="mb-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-blue-400"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Masukan email anda">
                @error('email') <p class="mt-1 text-xs text-red-600 text-left">{{ $message }}</p> @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-blue-400"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Password">
                @error('password') <p class="mt-1 text-xs text-red-600 text-left">{{ $message }}</p> @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-key text-blue-400"></i>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Konfirmasi Password">
            </div>

            <!-- Tombol Daftar -->
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition shadow-lg shadow-blue-500/30">
                Sign Up
            </button>
        </form>

        <!-- Link ke Login -->
        <div class="mt-6">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-gray-500 hover:text-blue-600">
                Sudah punya akun? Log in di sini
            </a>
        </div>
        
    </div>
</body>
</html>