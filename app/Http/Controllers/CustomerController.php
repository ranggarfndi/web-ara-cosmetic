<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan dengan fungsionalitas pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // Query dasar untuk mengambil data pelanggan
        $query = Customer::query();

        // Terapkan filter pencarian jika ada input 'search'
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('phone_number', 'like', "%{$searchTerm}%");
            });
        }

        // Ambil data, urutkan dari yang terbaru, dan tampilkan per halaman (paginasi)
        $customers = $query->latest()->paginate(10);

        // Kirim data ke view
        return view('customers.index', compact('customers'));
    }

    /**
     * Menampilkan form untuk membuat pelanggan baru.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Menyimpan data pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:customers,phone_number',
            'birth_date' => 'required|date',
            'email' => 'nullable|email|unique:customers,email',
            'address' => 'nullable|string',
        ]);

        // Buat data baru
        Customer::create($validated);

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan data spesifik pelanggan (tidak digunakan di alur kita saat ini).
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Menampilkan form untuk mengedit data pelanggan.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data pelanggan di database.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validasi input, dengan aturan 'unique' yang mengabaikan data pelanggan saat ini
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => ['required', 'string', Rule::unique('customers')->ignore($customer->id)],
            'birth_date' => 'required|date',
            'email' => ['nullable', 'email', Rule::unique('customers')->ignore($customer->id)],
            'address' => 'nullable|string',
        ]);

        // Perbarui data
        $customer->update($validated);

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus data pelanggan dari database.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
