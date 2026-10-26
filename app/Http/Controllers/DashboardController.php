<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalSuppliers = Supplier::count();
        $totalTransactions = Transaction::count();

        return view('dashboard', compact('totalCategories', 'totalProducts', 'totalSuppliers', 'totalTransactions'));
    }
}