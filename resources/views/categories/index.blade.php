<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- TOMBOL TAMBAH HANYA MUNCUL UNTUK ADMIN -->
            @if(auth()->user()->role === 'admin' || auth()->user()->is_admin)
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800"></h3>
                    <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 text-sm shadow-sm transition">
                        + Tambah Kategori
                    </a>
                </div>
            @endif

            <!-- Tabel Daftar Kategori -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                            <th class="p-3 font-bold">Nama Kategori</th>
                            <th class="p-3 font-bold">Deskripsi</th>
                            @if(auth()->user()->role !== 'staff')
                                <th class="p-3 font-bold text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="border-b border-gray-100 text-sm">
                                <td class="p-3 font-semibold">{{ $category->name }}</td>
                                <td class="p-3 text-gray-500">{{ $category->description ?? '-' }}</td>
                                
                                <!-- Kolom Aksi Hanya untuk Admin -->
                                @if(auth()->user()->role !== 'staff')
                                    <td class="p-3 text-center space-x-2">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-600 font-bold hover:underline">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>