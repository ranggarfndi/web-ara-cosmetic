<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Models\Customer;
use App\Models\PointHistory;
use App\Models\RedeemHistory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $pointQuery = PointHistory::with('customer');
        $redeemQuery = RedeemHistory::with(['customer', 'redeemOption']);

        // Filter
        if ($request->filled('customer_id')) {
            $pointQuery->where('customer_id', $request->customer_id);
            $redeemQuery->where('customer_id', $request->customer_id);
        }
        if ($request->filled('start_date')) {
            $pointQuery->whereDate('created_at', '>=', $request->start_date);
            $redeemQuery->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $pointQuery->whereDate('created_at', '<=', $request->end_date);
            $redeemQuery->whereDate('created_at', '<=', $request->end_date);
        }

        // Ambil dan format data riwayat poin
        $pointHistories = $pointQuery->get()->map(function ($item) {
            return (object) [
                'date' => $item->created_at,
                'customer_name' => $item->customer->name,
                'description' => 'Penambahan Poin',
                'amount' => 'Rp ' . number_format($item->purchase_amount), // <-- DATA BARU
                'change' => '+' . $item->points_earned,
                'type' => 'credit',
            ];
        });

        // Ambil dan format data riwayat redeem
        $redeemHistories = $redeemQuery->get()->map(function ($item) {
            return (object) [
                'date' => $item->created_at,
                'customer_name' => $item->customer->name,
                'description' => 'Redeem: ' . $item->redeemOption->name,
                'amount' => '', // <-- Redeem tidak punya total belanja, jadi kosong
                'change' => '-' . $item->points_spent,
                'type' => 'debit',
            ];
        });

        // Gabungkan, urutkan, dan paginasi
        $mergedHistories = $pointHistories->merge($redeemHistories);
        $sortedHistories = $mergedHistories->sortByDesc('date');
        
        $perPage = 15;
        $currentPage = request()->get('page', 1);
        $currentPageItems = $sortedHistories->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $histories = new LengthAwarePaginator($currentPageItems, count($sortedHistories), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        
        return view('history.index', compact('histories', 'customers'));
    }

    public function export(Request $request)
    {
        $filters = $request->only(['customer_id', 'start_date', 'end_date']);
        return Excel::download(new HistoryExport($filters), 'riwayat_transaksi_poin.xlsx');
    }
}