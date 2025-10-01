<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">

                <div class="p-6 md:p-8 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-4">
                            <img class="h-20 w-20 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&color=F43F5E&background=FFE4E6&size=128"
                                alt="Avatar">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $customer->name }}</h1>
                                <p class="mt-1 text-gray-500 dark:text-gray-400">{{ $customer->phone_number }}</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0 flex items-center space-x-2 mt-4 sm:mt-0">
                            {{-- TOMBOL BARU --}}
                            <a href="{{ route('customers.index') }}"
                                class="inline-flex items-center px-3 py-1.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-300 text-xs font-medium rounded-md transition-colors">
                                Kembali
                            </a>

                            <a href="{{ route('customers.edit', $customer) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium rounded-md transition-colors">
                                Edit
                            </a>

                            <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                class="delete-form" data-customer-name="{{ $customer->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/50 dark:hover:bg-orange-800 text-orange-800 dark:text-orange-300 text-xs font-medium rounded-md transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-6 text-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Poin</p>
                            <p class="mt-1 text-2xl font-bold text-primary-600 dark:text-primary-400">
                                {{ number_format($customer->total_points) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Member Sejak</p>
                            <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $customer->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ulang Tahun</p>
                            <p class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">
                                {{ \Carbon\Carbon::parse($customer->birth_date)->format('d F') }}</p>
                        </div>
                    </div>
                </div>

                <div x-data="{ tab: 'history' }">
                    <div class="px-6 md:px-8 border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                            <button @click="tab = 'history'"
                                :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': tab === 'history', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'history' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Riwayat Transaksi
                            </button>
                            <button @click="tab = 'details'"
                                :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': tab === 'details', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'details' }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Info Detail
                            </button>
                        </nav>
                    </div>

                    <div class="p-6 md:p-8">
                        <div x-show="tab === 'history'" x-cloak>
                            @include('customers.partials.history-list', ['histories' => $histories])
                        </div>

                        <div x-show="tab === 'details'" x-cloak>
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6 text-sm">
                                <div class="sm:col-span-1">
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->email ?? '-' }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-gray-200">
                                        {{ \Carbon\Carbon::parse($customer->birth_date)->format('d F Y') }}</dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                                    <dd class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->address ?? '-' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Event listener untuk tombol delete dengan SweetAlert2
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const customerName = this.getAttribute('data-customer-name');
                    Swal.fire({
                        title: 'Anda Yakin?',
                        html: `Anda akan menghapus pelanggan bernama <b>${customerName}</b>. Tindakan ini tidak dapat dibatalkan.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e11d48',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
