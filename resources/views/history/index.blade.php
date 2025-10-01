<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Riwayat Transaksi</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Lacak semua aktivitas penambahan dan penukaran poin.</p>
            </div>

            <div class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border dark:border-gray-600">
                        <form method="GET" action="{{ route('history.index') }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end">
                                <div class="lg:col-span-2">
                                    <label for="select-customer-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pelanggan</label>
                                    <select name="customer_id" id="select-customer-filter" class="mt-1 block w-full rounded-md shadow-sm">
                                        <option value="">Semua Pelanggan</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @selected(request('customer_id') == $customer->id)>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal</label>
                                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div class="flex space-x-2">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500">Filter</button>
                                    <a href="{{ route('history.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-500">Reset</a>
                                </div>
                                <div class="sm:col-start-2 md:col-start-auto">
                                    <a href="{{ route('history.export', request()->query()) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">Export Excel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal & Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Belanja</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Perubahan Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $history->date->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $history->customer_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">{{ $history->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $history->amount }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-lg">
                                            @if($history->type == 'credit')<span class="text-green-500">{{ $history->change }}</span>
                                            @else<span class="text-red-500">{{ $history->change }}</span>@endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada riwayat transaksi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="block md:hidden space-y-4">
                        @forelse ($histories as $history)
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg shadow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $history->customer_name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $history->date->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="text-right font-bold text-lg">
                                        @if($history->type == 'credit')<span class="text-green-500">{{ $history->change }}</span>
                                        @else<span class="text-red-500">{{ $history->change }}</span>@endif
                                    </div>
                                </div>
                                <div class="mt-2 pt-2 border-t dark:border-gray-600">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $history->description }}</p>
                                    @if($history->amount)
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Belanja: {{ $history->amount }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500">Tidak ada riwayat transaksi.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $histories->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
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
                initTomSelect("#select-customer-filter");
            });
        </script>
    @endpush
</x-app-layout>