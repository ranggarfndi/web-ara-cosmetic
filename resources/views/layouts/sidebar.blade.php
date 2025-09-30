<div x-show="sidebarOpen" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600/75"></div>

    <div class="fixed inset-0 z-40 flex">
        <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full" @click.away="sidebarOpen = false"
            class="relative flex w-64 max-w-xs flex-1 flex-col bg-white dark:bg-gray-800 m-4 rounded-xl">

            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="sidebarOpen = false" type="button"
                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            @include('layouts.sidebar-content')
        </div>
    </div>
</div>

{{-- Perubahan di sini: inset-y-4, left-4, dan rounded-2xl --}}
<div class="hidden lg:fixed lg:inset-y-4 lg:left-4 lg:z-30 lg:flex lg:w-64 lg:flex-col lg:rounded-2xl">
    <div
        class="flex min-h-0 flex-1 flex-col border border-gray-200/70 dark:border-gray-700/50 bg-white dark:bg-gray-800 rounded-2xl">
        @include('layouts.sidebar-content')
    </div>
</div>
