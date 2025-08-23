<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Products::count();
        $totalOrders    = Order::count();
        $totalCustomers = User::count();
        $totalRevenue   = Order::where('status', 'Success')->sum('amount'); 
        // Pastikan kolom 'amount' sesuai nama kolom total harga di tabel orders

        return view('admin.index', compact('totalProducts', 'totalOrders', 'totalCustomers', 'totalRevenue'));
    }
}
