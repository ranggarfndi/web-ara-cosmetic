<div class="space-y-4">
    @forelse ($histories as $history)
        <div class="flex justify-between items-start bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
            <div>
                <p class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $history->description }}</p>
                @if($history->amount)
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Belanja: {{ $history->amount }}</p>
                @endif
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $history->date->format('d M Y, H:i') }}</p>
            </div>
            <div class="text-right font-bold text-base flex-shrink-0 ml-4">
                @if($history->type == 'credit')
                    <span class="text-green-500">{{ $history->change }}</span>
                @else
                    <span class="text-red-500">{{ $history->change }}</span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center text-sm text-gray-500 dark:text-gray-400">Pelanggan ini belum memiliki riwayat transaksi.</p>
    @endforelse
</div>
<div class="mt-4">
    {{ $histories->links() }}
</div>