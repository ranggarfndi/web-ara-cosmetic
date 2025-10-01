<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Redeem Poin Pelanggan</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Tukarkan poin pelanggan dengan hadiah yang tersedia.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('redeem.store') }}" id="redeem-form">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <x-input-label for="customer_id" :value="__('Pilih Pelanggan')" />
                                <select name="customer_id" id="select-customer" class="block mt-1 w-full" required>
                                    <option value="">-- Pilih atau Cari Pelanggan --</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                            {{ $customer->name }} - ({{ $customer->phone_number }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    Poin Tersedia: <span id="customer-points" class="font-bold">0</span>
                                </div>
                                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="redeem_option_id" :value="__('Pilih Hadiah')" />
                                <select name="redeem_option_id" id="select-redeem" class="block mt-1 w-full" required>
                                    <option value="">-- Pilih Hadiah --</option>
                                    @foreach ($redeemOptions as $option)
                                        <option value="{{ $option->id }}" @selected(old('redeem_option_id') == $option->id)>
                                            {{ $option->name }} - (Butuh {{ $option->points_required }} Poin)
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('redeem_option_id')" class="mt-2" />
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <x-primary-button id="submit-button"
                                class="ms-4 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                {{ __('Redeem Poin') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1. Buat "kamus" data dari PHP
                const customerPointsMap = {!! json_encode($customers->pluck('total_points', 'id')) !!};
                const customerNamesMap = {!! json_encode($customers->pluck('name', 'id')) !!};
                const redeemPointsMap = {!! json_encode($redeemOptions->pluck('points_required', 'id')) !!};
                const redeemNamesMap = {!! json_encode($redeemOptions->pluck('name', 'id')) !!};

                // 2. Fungsi aman untuk inisialisasi TomSelect
                const initTomSelect = (selector) => {
                    const el = document.querySelector(selector);
                    if (el.tomselect) {
                        return el.tomselect;
                    }
                    return new TomSelect(selector, {
                        create: false,
                        sortField: {
                            field: "text",
                            direction: "asc"
                        }
                    });
                };

                // 3. Inisialisasi & ambil elemen HTML
                const customerSelect = initTomSelect("#select-customer");
                const redeemSelect = initTomSelect("#select-redeem");
                const customerPointsEl = document.getElementById('customer-points');
                const submitButton = document.getElementById('submit-button');
                const redeemForm = document.getElementById('redeem-form');

                // 4. Fungsi untuk memeriksa poin & status tombol
                function checkPoints() {
                    const customerId = customerSelect.getValue();
                    const redeemId = redeemSelect.getValue();
                    const customerPoints = customerPointsMap[customerId] || 0;
                    customerPointsEl.textContent = customerPoints.toLocaleString();

                    if (!customerId || !redeemId) {
                        submitButton.disabled = true;
                        return;
                    }
                    const pointsRequired = redeemPointsMap[redeemId];
                    if (customerPoints >= pointsRequired) {
                        submitButton.disabled = false;
                    } else {
                        submitButton.disabled = true;
                    }
                }

                customerSelect.on('change', checkPoints);
                redeemSelect.on('change', checkPoints);
                checkPoints();

                // 5. Logika untuk popup konfirmasi saat submit
                redeemForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const customerId = customerSelect.getValue();
                    const redeemId = redeemSelect.getValue();

                    // Ambil nama dari "kamus" yang kita buat
                    const customerName = customerNamesMap[customerId] || 'Pelanggan';
                    const rewardName = redeemNamesMap[redeemId] || 'Hadiah';
                    const pointsRequired = redeemPointsMap[redeemId] || 0;

                    if (!pointsRequired) return;

                    Swal.fire({
                        title: 'Konfirmasi Redeem',
                        html: `Anda akan menukar <b>${pointsRequired.toLocaleString()} poin</b> milik <b>${customerName}</b> dengan hadiah:<br><br> <b>"${rewardName}"</b><br><br>Lanjutkan transaksi?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            redeemForm.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
