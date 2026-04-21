<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('status', 'completed')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        $monthlySales = Order::where('status', 'completed')
            ->select(
                DB::raw('SUM(total) as total'),
                DB::raw("DATE_FORMAT(created_at, '%M %Y') as month"),
                DB::raw("DATE_FORMAT(created_at, '%Y%m') as month_order")
            )
            ->groupBy('month', 'month_order')
            ->orderBy('month_order')
            ->get();

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSales', 
            'totalOrders', 
            'totalProducts', 
            'pendingOrders',
            'monthlySales',
            'recentOrders'
        ));
    }
}
