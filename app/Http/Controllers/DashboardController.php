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

        // Pelanggan yang Ulang Tahun Hari Ini
        $todayBirthdays = Customer::whereMonth('birth_date', '=', date('m'))
            ->whereDay('birth_date', '=', date('d'))
            ->get();

        return view('dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalPoints' => $totalPoints,
            'todayTransactions' => $todayTransactions,
            'todayBirthdays' => $todayBirthdays,
        ]);
    }
}
