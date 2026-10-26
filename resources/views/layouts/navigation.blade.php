<nav x-data="{ open: false }" class="bg-blue-600 border-b border-blue-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white font-bold text-xl">
                        KPOPMERCH
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-gray-200">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Hanya tampil untuk admin -->
                    @if(strtolower(trim(auth()->user()->role)) === 'admin')
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="text-white hover:text-gray-200">
                            {{ __('Kategori') }}
                        </x-nav-link>
                        <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')" class="text-white hover:text-gray-200">
                            {{ __('Supplier') }}
                        </x-nav-link>
                    @endif

                    <!-- DIPAKSA TAMPIL TANPA SYARAT UNTUK UJI COBA -->
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-white hover:text-gray-200">
                        {{ __('Produk') }}
                    </x-nav-link>

                    <x-nav-link :href="route('customer.transactions')" :active="request()->routeIs('customer.transactions')" class="text-white hover:text-gray-200 font-bold">
                        {{ __('Pesanan Saya') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 focus:outline-none">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-gray-200">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if(strtolower(trim(auth()->user()->role)) === 'admin')
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="text-white hover:text-gray-200">
                    {{ __('Kategori') }}
                </x-responsive-nav-link>
            @endif

            <!-- DIPAKSA TAMPIL TANPA SYARAT UNTUK UJI COBA -->
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="text-white hover:text-gray-200">
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('customer.transactions')" :active="request()->routeIs('customer.transactions')" class="text-white hover:text-gray-200">
                {{ __('Pesanan Saya') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>