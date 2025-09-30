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
    /**
     * Menampilkan halaman riwayat transaksi dengan filter dan paginasi.
     */
    public function index(Request $request)
    {
        // Ambil semua customer untuk dropdown filter
        $customers = Customer::orderBy('name')->get();

        // Query dasar untuk riwayat penambahan poin
        $pointQuery = PointHistory::with('customer');

        // Query dasar untuk riwayat redeem poin
        $redeemQuery = RedeemHistory::with(['customer', 'redeemOption']);

        // Terapkan filter jika ada yang diisi di form
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

        // Eksekusi query dan format data penambahan poin
        $pointHistories = $pointQuery->get()->map(function ($item) {
            return (object) [
                'date' => $item->created_at,
                'customer_name' => $item->customer->name,
                'description' => 'Penambahan Poin dari Belanja',
                'change' => '+' . $item->points_earned,
                'type' => 'credit',
            ];
        });

        // Eksekusi query dan format data redeem poin
        $redeemHistories = $redeemQuery->get()->map(function ($item) {
            return (object) [
                'date' => $item->created_at,
                'customer_name' => $item->customer->name,
                'description' => 'Redeem: ' . $item->redeemOption->name,
                'change' => '-' . $item->points_spent,
                'type' => 'debit',
            ];
        });

        // Gabungkan kedua hasil query
        $mergedHistories = $pointHistories->merge($redeemHistories);

        // Urutkan data gabungan berdasarkan tanggal (dari yang terbaru)
        $sortedHistories = $mergedHistories->sortByDesc('date');

        // Buat paginasi (menampilkan data per halaman) secara manual
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $currentPageItems = $sortedHistories->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $histories = new LengthAwarePaginator($currentPageItems, count($sortedHistories), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(), // Sertakan parameter filter di link paginasi
        ]);

        // Kirim data ke view
        return view('history.index', [
            'histories' => $histories,
            'customers' => $customers,
        ]);
    }

    /**
     * Menangani permintaan untuk export data ke Excel.
     */
    public function export(Request $request)
    {
        // Ambil filter yang sedang aktif dari URL
        $filters = $request->only(['customer_id', 'start_date', 'end_date']);

        // Panggil class HistoryExport dan mulai download file
        return Excel::download(new HistoryExport($filters), 'riwayat_transaksi_poin.xlsx');
    }
}
