<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        // Logika pencarian berdasarkan nama atau SKU
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        // Logika filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10)->appends($request->all());
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        // Blokir jika user adalah staff
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Blokir jika user adalah staff
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $cleanPurchasePrice = (int) preg_replace('/[^0-9]/', '', $request->input('purchase_price'));
        $cleanSellingPrice = (int) preg_replace('/[^0-9]/', '', $request->input('selling_price'));
        $cleanStock = (int) preg_replace('/[^0-9]/', '', $request->input('stock'));

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->purchase_price = $cleanPurchasePrice;
        $product->selling_price = $cleanSellingPrice;
        $product->stock = $cleanStock;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        // Blokir jika user adalah staff
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Blokir jika user adalah staff
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        $cleanPurchasePrice = (int) preg_replace('/[^0-9]/', '', $request->input('purchase_price'));
        $cleanSellingPrice = (int) preg_replace('/[^0-9]/', '', $request->input('selling_price'));
        $cleanStock = (int) preg_replace('/[^0-9]/', '', $request->input('stock'));

        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->purchase_price = $cleanPurchasePrice;
        $product->selling_price = $cleanSellingPrice;
        $product->stock = $cleanStock;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Blokir jika user adalah staff
        if (auth()->user()->role === 'staff') {
            abort(403, 'Aksi ini tidak diizinkan untuk Staff.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}