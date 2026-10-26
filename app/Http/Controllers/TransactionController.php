<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactionsIn = Transaction::with(['product', 'supplier'])->where('type', 'in')->latest()->get();
        $transactionsOut = Transaction::with(['product', 'user'])->where('type', 'out')->latest()->get();
        
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $monthlyIn = Transaction::where('type', 'in')->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->sum('total_price');
        $monthlyOut = Transaction::where('type', 'out')->whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->sum('total_price');

        $products = Product::all();
        $suppliers = Supplier::all();

        return view('transactions.index', compact('transactionsIn', 'transactionsOut', 'products', 'suppliers', 'monthlyIn', 'monthlyOut'));
    }

    public function export($type)
    {
        $transactions = Transaction::with(['product', 'supplier', 'user'])->where('type', $type)->latest()->get();
        return view('transactions.export', compact('transactions', 'type'));
    }

    public function createIn()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.create_in', compact('products', 'suppliers'));
    }

    public function storeIn(Request $request)
    {
        $request->validate(['product_id' => 'required', 'supplier_id' => 'required', 'quantity' => 'required|numeric|min:1']);
        
        $product = Product::findOrFail($request->product_id);
        $product->increment('stock', $request->quantity);

        Transaction::create([
            'reference_number' => 'IN-' . time(),
            'transaction_date' => now(),
            'user_id' => auth()->id(),
            'supplier_id' => $request->supplier_id,
            'product_id' => $product->id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'total_price' => $product->purchase_price * $request->quantity,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Barang masuk berhasil dicatat.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return back()->with('success', 'Catatan transaksi berhasil dihapus.');
    }

    public function customerHistory()
    {
        $transactions = Transaction::with('product')->where('user_id', auth()->id())->where('type', 'out')->latest()->paginate(10);
        return view('customer.transactions', compact('transactions'));
    }
    public function showCheckoutForm(Product $product)
    {
        if ($product->stock < 1) return back()->with('error', 'Stok habis.');
        return view('customer.checkout', compact('product'));
    }
   public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Sisa stok: ' . $product->stock);
        }

        $product->decrement('stock', $request->quantity);

        Transaction::create([
            'reference_number' => 'OUT-' . time(),
            'transaction_date' => now(),
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'type' => 'out',
            'quantity' => $request->quantity,
            'total_price' => $product->selling_price * $request->quantity,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
        ]);

        return redirect()->route('customer.transactions')->with('success', 'Pesanan berhasil dibuat.');
    }
}