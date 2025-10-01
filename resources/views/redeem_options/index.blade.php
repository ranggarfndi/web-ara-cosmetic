<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Manajemen Opsi Redeem</h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">Atur hadiah apa saja yang bisa ditukarkan dengan poin
                    oleh pelanggan.</p>
            </div>

            <div
                class="bg-white dark:bg-gray-800/50 overflow-hidden shadow-sm rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-start mb-6">
                        <a href="{{ route('redeem-options.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Tambah Opsi Baru
                        </a>
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
                                        Nama Hadiah</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Poin Dibutuhkan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Tipe</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($options as $option)
                                    <tr
                                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $option->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ number_format($option->points_required) }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($option->type) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($option->is_active)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Aktif</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Tidak
                                                    Aktif</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-2">
                                                <a href="{{ route('redeem-options.edit', $option) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium rounded-md transition-colors">Edit</a>
                                                <form action="{{ route('redeem-options.destroy', $option) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="delete-button inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/50 dark:hover:bg-orange-800 text-orange-800 dark:text-orange-300 text-xs font-medium rounded-md transition-colors"
                                                        data-option-name="{{ $option->name }}">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Belum
                                            ada data opsi redeem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="block md:hidden space-y-4">
                        @forelse ($options as $option)
                            <div
                                class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                            {{ $option->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($option->type) }}
                                        </p>
                                    </div>
                                    @if ($option->is_active)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Tidak
                                            Aktif</span>
                                    @endif
                                </div>
                                <div class="space-y-2 border-t border-gray-200 dark:border-gray-600 pt-4">
                                    <div class="flex justify-between text-sm"><span
                                            class="text-gray-500 dark:text-gray-400">Poin Dibutuhkan:</span><span
                                            class="font-semibold">{{ number_format($option->points_required) }}
                                            Poin</span></div>
                                </div>
                                <div
                                    class="flex justify-end items-center space-x-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('redeem-options.edit', $option) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium rounded-md transition-colors">Edit</a>
                                    <form action="{{ route('redeem-options.destroy', $option) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="delete-button inline-flex items-center px-3 py-1.5 bg-orange-100 hover:bg-orange-200 dark:bg-orange-900/50 dark:hover:bg-orange-800 text-orange-800 dark:text-orange-300 text-xs font-medium rounded-md transition-colors"
                                            data-option-name="{{ $option->name }}">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-sm text-gray-500">Belum ada data opsi redeem.</div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $options->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const optionName = this.getAttribute('data-option-name');
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Anda Yakin?',
                        html: `Anda akan menghapus opsi redeem: <b>${optionName}</b>. Tindakan ini tidak dapat dibatalkan.`,
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
