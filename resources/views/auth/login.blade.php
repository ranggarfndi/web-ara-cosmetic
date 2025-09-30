<x-guest-layout>
    <div class="min-h-screen flex">
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-br from-primary-400 to-violet-500 items-center justify-center p-12 text-white text-center relative overflow-hidden">
            <div>
                <div class="absolute top-10 -left-10 w-48 h-48 bg-white/20 rounded-full animate-pulse"></div>
                <div class="absolute bottom-12 -right-12 w-72 h-72 bg-white/10 rounded-full"></div>

                <h1 class="text-4xl font-bold tracking-wider mb-3">ARA COSMETIC</h1>
                <p class="text-lg opacity-90">Sistem Manajemen Member</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-100 dark:bg-gray-900">
            <div class="max-w-md w-full p-6">
                <div class="flex justify-center mb-8">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Admin Login</h2>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary-600 shadow-sm focus:ring-primary-500 dark:focus:ring-primary-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-4">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
