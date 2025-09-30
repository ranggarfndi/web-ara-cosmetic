<div class="flex flex-1 flex-col overflow-y-auto pt-5 pb-4">
    <div class="flex h-16 flex-shrink-0 items-center px-4">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-800 dark:text-white">
            ARA COSMETIC MEMBER
        </a>
    </div>

    <nav class="mt-8 flex-1 space-y-2 px-2">
        <x-nav-link-icon :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </x-slot>
            {{ __('Dashboard') }}
        </x-nav-link-icon>
        <x-nav-link-icon :href="route('customers.index')" :active="request()->routeIs('customers.*')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.24.232-.487.335-.737M12 12c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6-2.686 6-6 6z" />
                </svg>
            </x-slot>
            {{ __('Pelanggan') }}
        </x-nav-link-icon>
        {{-- Anda bisa menambahkan ikon untuk link lain di sini --}}
        <x-nav-link-icon :href="route('points.create')" :active="request()->routeIs('points.create')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot>
            {{ __('Input Poin') }}
        </x-nav-link-icon>
        <x-nav-link-icon :href="route('redeem.create')" :active="request()->routeIs('redeem.create')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-slot>
            {{ __('Redeem Poin') }}
        </x-nav-link-icon>
        <x-nav-link-icon :href="route('redeem-options.index')" :active="request()->routeIs('redeem-options.*')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 11.25v8.25a2.25 2.25 0 01-2.25 2.25H5.25a2.25 2.25 0 01-2.25-2.25v-8.25M12 4.875A2.625 2.625 0 1012 10.125A2.625 2.625 0 0012 4.875zM12 12.75v4.5" />
                </svg>
            </x-slot>
            {{ __('Opsi Redeem') }}
        </x-nav-link-icon>
        <x-nav-link-icon :href="route('history.index')" :active="request()->routeIs('history.index')">
            <x-slot name="icon">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </x-slot>
            {{ __('Riwayat') }}
        </x-nav-link-icon>
    </nav>
</div>

<div class="flex flex-shrink-0 border-t border-gray-200 dark:border-gray-700 p-4">
    <div class="flex-shrink-0 w-full group block">
        <div class="flex items-center">
            <div>
                <img class="inline-block h-9 w-9 rounded-full"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=F43F5E&background=FFE4E6"
                    alt="User Avatar" />
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Log
                        Out</a>
                </form>
            </div>
        </div>
    </div>
</div>
