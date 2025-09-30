<?php

namespace App\Http\Controllers;

use App\Models\RedeemOption;
use Illuminate\Http\Request;

class RedeemOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = RedeemOption::latest()->paginate(10);
        return view('redeem_options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('redeem_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'points_required' => 'required|integer|min:1',
            'type' => 'required|in:voucher,product',
            'is_active' => 'required|boolean', // <-- Tambahkan ini
        ]);

        RedeemOption::create($validated);

        return redirect()->route('redeem-options.index')->with('success', 'Opsi redeem baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RedeemOption $redeemOption)
    {
        return view('redeem_options.edit', compact('redeemOption'));
    }

    public function update(Request $request, RedeemOption $redeemOption)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'points_required' => 'required|integer|min:1',
            'type' => 'required|in:voucher,product',
            'is_active' => 'required|boolean',
        ]);

        $redeemOption->update($validated);

        return redirect()->route('redeem-options.index')->with('success', 'Opsi redeem berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RedeemOption $redeemOption)
    {
        $redeemOption->delete();

        return redirect()->route('redeem-options.index')->with('success', 'Opsi redeem berhasil dihapus.');
    }
}
