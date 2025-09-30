<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Tambah Opsi Redeem Baru</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Buat hadiah baru yang dapat ditukarkan pelanggan dengan
                    poin mereka.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('redeem-options.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Nama Hadiah')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus
                                    placeholder="Contoh: Voucher Diskon Rp 25.000" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="points_required" :value="__('Poin yang Dibutuhkan')" />
                                <x-text-input id="points_required" class="block mt-1 w-full" type="number"
                                    name="points_required" :value="old('points_required')" required placeholder="Contoh: 2500" />
                                <x-input-error :messages="$errors->get('points_required')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="type" :value="__('Tipe Hadiah')" />
                                <select name="type" id="type"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="voucher" @selected(old('type') == 'voucher')>Voucher</option>
                                    <option value="product" @selected(old('type') == 'product')>Produk</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="is_active" :value="__('Status')" />
                                <select name="is_active" id="is_active"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="1" @selected(old('is_active', '1') == '1')>Aktif (Bisa diredeem)</option>
                                    <option value="0" @selected(old('is_active') == '0')>Tidak Aktif (Disembunyikan)
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('redeem-options.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Opsi') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
