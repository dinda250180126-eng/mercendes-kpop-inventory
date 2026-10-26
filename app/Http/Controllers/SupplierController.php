<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}