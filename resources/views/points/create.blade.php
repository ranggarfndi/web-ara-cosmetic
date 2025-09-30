<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Input Poin Belanja</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Pilih pelanggan dan masukkan total belanja untuk menambahkan poin.</p>
            </div>

            <div class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('points.store') }}">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="customer_id" :value="__('Pilih Pelanggan')" />
                                <select name="customer_id" id="select-customer" class="block mt-1 w-full" required>
                                    <option value="">-- Pilih atau Cari Pelanggan --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} - ({{ $customer->phone_number }})</option>
                                    @endforeach
                                </select>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Poin Saat Ini: <span id="customer-points" class="font-bold">0</span>
                                </div>
                                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="purchase_amount" :value="__('Total Belanja (Rp)')" />
                                <x-text-input id="purchase_amount" class="block mt-1 w-full" type="text" name="purchase_amount" :value="old('purchase_amount')" required placeholder="Contoh: 50.000" x-data x-mask:dynamic="$money($input, '.', ',')" />
                                <x-input-error :messages="$errors->get('purchase_amount')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <x-primary-button class="ms-4">
                                {{ __('Simpan & Tambah Poin') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Buat "kamus" data poin
                const customerPointsMap = {!! json_encode($customers->pluck('total_points', 'id')) !!};

                // Fungsi aman untuk inisialisasi TomSelect
                const initTomSelect = (selector) => {
                    const el = document.querySelector(selector);
                    if (el.tomselect) { 
                        return el.tomselect;
                    }
                    return new TomSelect(selector, {
                        create: false,
                        sortField: { field: "text", direction: "asc" }
                    });
                };

                const customerSelect = initTomSelect("#select-customer");
                const customerPointsEl = document.getElementById('customer-points');

                // Fungsi untuk update tampilan poin
                function updatePointsDisplay() {
                    const customerId = customerSelect.getValue();
                    const customerPoints = customerPointsMap[customerId] || 0;
                    customerPointsEl.textContent = customerPoints.toLocaleString();
                }

                customerSelect.on('change', updatePointsDisplay);
                updatePointsDisplay();
            });
        </script>
    @endpush
</x-app-layout>