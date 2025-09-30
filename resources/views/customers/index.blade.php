<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Manajemen Pelanggan</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Tambah, cari, edit, atau hapus data pelanggan Anda.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex flex-col sm:flex-row sm:justify-between items-center mb-6 gap-4">
                        <a href="{{ route('customers.create') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Tambah Pelanggan
                        </a>
                        <form method="GET" action="{{ route('customers.index') }}"
                            class="w-full sm:w-auto flex items-center">
                            <x-text-input id="search" name="search" type="text" class="block w-full"
                                :value="request('search')" placeholder="Cari Nama/No. HP..." />
                            <x-primary-button class="ms-3">
                                {{ __('Cari') }}
                            </x-primary-button>
                        </form>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 dark:bg-green-900/50 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Pelanggan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Total Poin</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Ulang Tahun</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10"><img class="h-10 w-10 rounded-full"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=F43F5E&background=FFE4E6"
                                                        alt="Avatar"></div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $customer->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $customer->phone_number }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100 font-semibold">
                                                {{ number_format($customer->total_points) }} Poin</div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($customer->birth_date)->format('d F') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-2">
                                                <a href="{{ route('customers.edit', $customer) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium rounded-md transition-colors">Edit</a>
                                                <form action="{{ route('customers.destroy', $customer) }}"
                                                    method="POST" onsubmit="return confirm('Apakah Anda yakin?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/50 dark:hover:bg-orange-800 text-orange-800 dark:text-orange-300 text-xs font-medium rounded-md transition-colors">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Tidak
                                            ada data pelanggan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="block md:hidden space-y-4">
                        @forelse ($customers as $customer)
                            <div
                                class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-10 w-10"><img class="h-10 w-10 rounded-full"
                                            src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=F43F5E&background=FFE4E6"
                                            alt="Avatar"></div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $customer->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $customer->phone_number }}</div>
                                    </div>
                                </div>
                                <div class="space-y-2 border-t border-gray-200 dark:border-gray-600 pt-4">
                                    <div class="flex justify-between text-sm"><span
                                            class="text-gray-500 dark:text-gray-400">Total Poin:</span><span
                                            class="font-semibold">{{ number_format($customer->total_points) }}
                                            Poin</span></div>
                                    <div class="flex justify-between text-sm"><span
                                            class="text-gray-500 dark:text-gray-400">Ulang
                                            Tahun:</span><span>{{ \Carbon\Carbon::parse($customer->birth_date)->format('d F') }}</span>
                                    </div>
                                </div>
                                <div
                                    class="flex justify-end items-center space-x-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('customers.edit', $customer) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium rounded-md transition-colors">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/50 dark:hover:bg-orange-800 text-orange-800 dark:text-orange-300 text-xs font-medium rounded-md transition-colors">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-sm text-gray-500">Tidak ada data pelanggan.</div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $customers->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
