<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PointHistory;
use App\Models\RedeemHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Jumlah Pelanggan
        $totalCustomers = Customer::count();

        // Statistik Total Poin yang Beredar
        $totalPoints = Customer::sum('total_points');

        // Statistik Transaksi Hari Ini
        $todayTransactions = PointHistory::whereDate('created_at', today())->count()
            + RedeemHistory::whereDate('created_at', today())->count();

        // --- TAMBAHAN BARU: Menghitung Total Pendapatan Hari Ini ---
        $todayRevenue = PointHistory::whereDate('created_at', today())->sum('purchase_amount');
        // --- SELESAI ---

        // Pelanggan yang Ulang Tahun Hari Ini
        $todayBirthdays = Customer::whereMonth('birth_date', '=', date('m'))
            ->whereDay('birth_date', '=', date('d'))
            ->get();

        // Mengambil 5 Riwayat Transaksi Terakhir
        $pointHistories = PointHistory::with('customer')->latest()->limit(5)->get()->map(function ($item) {
            return (object) ['date' => $item->created_at, 'customer_name' => $item->customer->name, 'description' => 'Mendapat ' . $item->points_earned . ' poin dari belanja Rp ' . number_format($item->purchase_amount), 'type' => 'credit'];
        });
        $redeemHistories = RedeemHistory::with(['customer', 'redeemOption'])->latest()->limit(5)->get()->map(function ($item) {
            return (object) ['date' => $item->created_at, 'customer_name' => $item->customer->name, 'description' => 'Redeem: ' . $item->redeemOption->name, 'type' => 'debit'];
        });
        $recentHistories = $pointHistories->merge($redeemHistories)->sortByDesc('date')->take(5);

        return view('dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalPoints' => $totalPoints,
            'todayTransactions' => $todayTransactions,
            'todayRevenue' => $todayRevenue, // Kirim data baru ke view
            'todayBirthdays' => $todayBirthdays,
            'recentHistories' => $recentHistories,
        ]);
    }
}
