<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\RedeemHistory; // <-- Tambahkan ini
use App\Models\RedeemOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Tambahkan ini

class RedeemController extends Controller
{
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $redeemOptions = RedeemOption::where('is_active', true)->orderBy('points_required')->get();
        return view('redeem.create', compact('customers', 'redeemOptions'));
    }

    // TAMBAHKAN FUNGSI DI BAWAH INI
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'redeem_option_id' => 'required|exists:redeem_options,id',
        ]);

        // 2. Ambil data
        $customer = Customer::findOrFail($request->customer_id);
        $redeemOption = RedeemOption::findOrFail($request->redeem_option_id);

        // 3. Cek kecukupan poin di backend (PENTING!)
        if ($customer->total_points < $redeemOption->points_required) {
            return back()->withErrors(['customer_id' => 'Poin pelanggan tidak mencukupi untuk hadiah ini.'])->withInput();
        }

        // 4. Gunakan DB Transaction
        DB::transaction(function () use ($customer, $redeemOption) {
            // Kurangi poin pelanggan
            $customer->decrement('total_points', $redeemOption->points_required);

            // Catat di riwayat redeem
            RedeemHistory::create([
                'customer_id' => $customer->id,
                'redeem_option_id' => $redeemOption->id,
                'points_spent' => $redeemOption->points_required,
            ]);
        });

        // 5. Redirect dengan pesan sukses
        return redirect()->route('customers.index')->with('success', "{$redeemOption->name} berhasil diredeem untuk {$customer->name}.");
    }
}
