<div class="relative z-10 flex h-16 flex-shrink-0 justify-between bg-white dark:bg-primary-900 shadow lg:hidden">

    <div class="flex items-center">
        <button type="button" class="p-4 text-gray-500 dark:text-gray-200 focus:outline-none" @click="sidebarOpen = true">
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>

    <div class="flex items-center">
        @isset($header)
            <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                {{ $header }}
            </h2>
        @endisset
    </div>

    <div class="flex items-center">
        <div class="w-12">
            {{-- Div kosong ini sengaja dibuat agar judul di tengah bisa benar-benar center --}}
        </div>
    </div>

</div>
