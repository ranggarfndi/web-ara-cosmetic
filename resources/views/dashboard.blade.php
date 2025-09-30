<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Selamat Datang Kembali,
                    {{ Auth::user()->name }}! 👋</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Berikut adalah ringkasan untuk ARA COSMETIC hari ini.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                <div
                    class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div
                        class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.5-2.962a3.75 3.75 0 015.962 0zM16.5 9.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM6.75 12a3.75 3.75 0 015.962 0zM3.375 19.5a3 3 0 012.754-2.72m2.754 0a3.75 3.75 0 015.962 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Pelanggan</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ number_format($totalCustomers) }}</p>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div
                        class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pastel-yellow-100 dark:bg-pastel-yellow-900/50 text-pastel-yellow-600 dark:text-yellow-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 21.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Poin Beredar</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ number_format($totalPoints) }}</p>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div
                        class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pastel-teal-100 dark:bg-pastel-teal-900/50 text-pastel-teal-600 dark:text-teal-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Transaksi Hari Ini</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ number_format($todayTransactions) }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border-t-4 border-red-200 dark:border-violet-600">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">🎂 Pelanggan yang Ulang Tahun
                        Hari Ini</h3>
                    <div class="space-y-3">
                        @forelse ($todayBirthdays as $customer)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <img class="inline-block h-8 w-8 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=F43F5E&background=FFE4E6"
                                        alt="Avatar">
                                    <div>
                                        <p class="font-semibold text-sm">{{ $customer->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $customer->phone_number }}</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-green-600 dark:text-green-400">Berhak dapat
                                    voucher!</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada pelanggan yang berulang tahun
                                hari ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
