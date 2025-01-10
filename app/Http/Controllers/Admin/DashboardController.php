<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung data total
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBrands = Brand::count();

        $totalAllUsers = User::count();
        $totalAdmin = User::where('role_as', '0')->count();
        $totalUser = User::where('role_as', '1')->count();

        // Mengambil data pesanan
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count(); // Perbaikan query bulan
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();   // Perbaikan query tahun

        // Mengambil data total penjualan per bulan
        $salesData = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->selectRaw('MONTH(orders.created_at) as month, SUM(order_items.price * order_items.quantity) as total_sales')
            ->groupBy('month')
            ->pluck('total_sales', 'month')
            ->toArray();

        // Pastikan bulan yang tidak ada datanya tetap terisi 0
        $salesData = array_replace(
            array_fill(1, 12, 0), // Menambahkan bulan dari 1 sampai 12
            $salesData // Menggabungkan dengan data yang sudah ada
        );

        // Mengembalikan data ke tampilan dashboard
        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalBrands' => $totalBrands,
            'totalAllUsers' => $totalAllUsers,
            'totalAdmin' => $totalAdmin,
            'totalUser' => $totalUser,
            'todayDate' => $todayDate,
            'totalOrder' => $totalOrder,
            'todayOrder' => $todayOrder,
            'thisMonthOrder' => $thisMonthOrder,
            'thisYearOrder' => $thisYearOrder,
            'salesData' => $salesData,
        ]);
    }
}
