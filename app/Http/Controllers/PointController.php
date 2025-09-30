<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PointHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('points.create', compact('customers'));
    }

    public function store(Request $request)
    {
        // Membersihkan input dari format titik ribuan
        $request->merge(['purchase_amount' => str_replace('.', '', $request->purchase_amount)]);

        // 1. Validasi
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'purchase_amount' => 'required|numeric|min:1',
        ]);

        // 2. Cari Customer
        $customer = Customer::findOrFail($request->customer_id);

        // 3. Hitung Poin (total belanja * 0.005, bulatkan ke bawah)
        $earnedPoints = floor($request->purchase_amount * 0.005);

        // Hanya jalankan jika poin yang didapat lebih dari 0
        if ($earnedPoints > 0) {
            // Gunakan DB Transaction untuk memastikan kedua operasi (update & create) berhasil
            DB::transaction(function () use ($customer, $earnedPoints, $request) {
                // 4. Update Saldo Poin Pelanggan
                $customer->increment('total_points', $earnedPoints);

                // 5. Catat di Riwayat Poin
                PointHistory::create([
                    'customer_id' => $customer->id,
                    'purchase_amount' => $request->purchase_amount,
                    'points_earned' => $earnedPoints,
                ]);
            });
        }

        // 6. Redirect dengan pesan sukses
        return redirect()->route('customers.index')->with('success', "Poin berhasil ditambahkan untuk {$customer->name}.");
    }
}
