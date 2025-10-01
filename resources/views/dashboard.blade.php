<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Selamat Datang Kembali, {{ Auth::user()->name }}! 👋</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Berikut adalah ringkasan untuk ARA COSMETIC hari ini.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Pelanggan</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($totalCustomers) }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pastel-yellow-100 dark:bg-pastel-yellow-900/50 text-pastel-yellow-600 dark:text-yellow-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 21.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Poin Beredar</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($totalPoints) }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-pastel-teal-100 dark:bg-pastel-teal-900/50 text-pastel-teal-600 dark:text-teal-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Transaksi Hari Ini</p>
                        <p class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($todayTransactions) }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm flex items-center space-x-4 border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:scale-105">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pendapatan Hari Ini</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium">Aktivitas Poin Terbaru</h3>
                            <a href="{{ route('history.index') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse ($recentHistories as $history)
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($history->type == 'credit')
                                            <div class="h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/50 flex items-center justify-center"><svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg></div>
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-red-100 dark:bg-red-900/50 flex items-center justify-center"><svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg></div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0"><p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $history->customer_name }}</p><p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $history->description }}</p></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 text-right">{{ $history->date->diffForHumans() }}</div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas poin.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                     <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">🎂 Ulang Tahun Hari Ini</h3>
                        <div class="space-y-3">
                            @forelse ($todayBirthdays as $customer)
                                <div class="flex items-center space-x-3">
                                    <img class="inline-block h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=F43F5E&background=FFE4E6" alt="Avatar">
                                    <div>
                                        <p class="font-semibold text-sm">{{ $customer->name }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $customer->phone_number }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada yang berulang tahun hari ini.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>