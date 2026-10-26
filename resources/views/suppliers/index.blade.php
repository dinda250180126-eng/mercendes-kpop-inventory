<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Supplier</h2>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                + Tambah Supplier
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                            <th class="p-4 font-bold">Nama Supplier</th>
                            <th class="p-4 font-bold">Kontak</th>
                            <th class="p-4 font-bold">Alamat</th>
                            <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 text-sm">
                                <td class="p-4 font-semibold text-gray-800">{{ $supplier->name }}</td>
                                <td class="p-4 text-gray-600">{{ $supplier->phone ?? '-' }}</td>
                                <td class="p-4 text-gray-600">{{ $supplier->address ?? '-' }}</td>
                                <td class="p-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="px-3 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 text-xs font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>