<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KPOPMERCH</title>
    
    <!-- Memuat Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Memuat FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-blue-500 font-sans antialiased h-screen flex items-center justify-center relative">

    <!-- Tombol Back di Pojok Kiri Atas -->
    <a href="/" class="absolute top-6 left-6 text-white text-2xl hover:text-gray-200 transition">
        <i class="fas fa-chevron-left"></i>
    </a>

    <!-- Kartu Login Utama -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 text-center mx-4">
        
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Login</h2>
        <p class="text-sm text-gray-500 mb-8">Silahkan masukan kata kuncinya</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Input Email -->
            <div class="mb-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-blue-400"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Masukan email anda">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 text-left">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="mb-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-key text-blue-400"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" 
                       placeholder="Password">
                @error('password')
                    <p class="mt-2 text-sm text-red-600 text-left">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forget Password -->
            <div class="flex items-center justify-between mb-6 px-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-xs font-medium text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                        Forget password
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition duration-150 ease-in-out shadow-lg shadow-blue-500/30">
                Log in
            </button>
        </form>

        <!-- Garis Pemisah (Or) -->
        <div class="mt-6 flex items-center justify-center space-x-2">
            <div class="h-px bg-gray-200 w-full"></div>
            <span class="text-xs text-gray-400 font-medium uppercase px-2">Or</span>
            <div class="h-px bg-gray-200 w-full"></div>
        </div>

        <!-- Tombol Sosial Media -->
        <div class="mt-6 flex gap-4">
            <!-- Tombol Google (Hanya UI / Tampilan) -->
            <button type="button" class="w-1/2 flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2 hover:bg-gray-50 transition">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-4 h-4">
                <span class="text-xs font-bold text-gray-700">Google</span>
            </button>
            <!-- Tombol Facebook (Hanya UI / Tampilan) -->
            <button type="button" class="w-1/2 flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2 hover:bg-gray-50 transition">
                <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="w-4 h-4">
                <span class="text-xs font-bold text-gray-700">Facebook</span>
            </button>
        </div>

        <!-- Link Sign Up -->
        <div class="mt-8">
            <a href="{{ route('register') }}" class="text-xs font-semibold text-gray-500 hover:text-blue-600">
                Sign up
            </a>
        </div>
        
    </div>
</body>
</html>