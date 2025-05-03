<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-50">
    <!-- Header -->
    <header class="sticky top-0 z-30 w-full border-b border-slate-200 bg-white">
        <div class="flex h-16 items-center px-4 gap-4">
            <!-- Mobile Menu Button -->
            <button type="button" class="btn btn-ghost btn-square lg:hidden hover:bg-slate-100"
                @click="$dispatch('toggle-sidebar')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 lg:ml-0" wire:navigate>
                <x-app-logo />
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex lg:flex-1 lg:gap-2">
                <a href="{{ route('dashboard') }}"
                    class="btn btn-ghost {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}"
                    wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" />
                    </svg>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </nav>

            <!-- Right Side Navigation -->
            <div class="flex items-center gap-2 ml-auto">
                <!-- Search Button -->
                <div class="tooltip tooltip-bottom" data-tip="{{ __('Search') }}">
                    <button class="btn btn-ghost btn-square hover:bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Repository Link -->
                <div class="tooltip tooltip-bottom hidden lg:block" data-tip="{{ __('Repository') }}">
                    <a href="https://github.com/laravel/livewire-starter-kit"
                        class="btn btn-ghost btn-square hover:bg-slate-100" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                clip-rule="evenodd" />
                            <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                        </svg>
                    </a>
                </div>

                <!-- Documentation Link -->
                <div class="tooltip tooltip-bottom hidden lg:block" data-tip="{{ __('Documentation') }}">
                    <a href="https://laravel.com/docs/starter-kits#livewire"
                        class="btn btn-ghost btn-square hover:bg-slate-100" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                    </a>
                </div>

                <!-- User Menu -->
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost gap-2 hover:bg-slate-100">
                        <div class="avatar placeholder">
                            <div class="bg-blue-50 text-blue-600 rounded-lg w-8">
                                <span>{{ auth()->user()->initials() }}</span>
                            </div>
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="dropdown-content menu menu-sm z-[1] mt-3 w-60 rounded-box bg-white p-2 shadow-lg border border-slate-200">
                        <li class="menu-title px-4 py-2">
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-blue-50 text-blue-600 rounded-lg w-8">
                                        <span>{{ auth()->user()->initials() }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-900">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-slate-500">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </li>
                        <div class="divider my-0"></div>
                        <li>
                            <a href="{{ route('settings.profile') }}" class="text-slate-600 hover:bg-slate-100"
                                wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ __('Settings') }}
                            </a>
                        </li>
                        <div class="divider my-0"></div>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left text-slate-600 hover:bg-slate-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Sidebar -->
    <div x-data="{ open: false }" @toggle-sidebar.window="open = !open" class="lg:hidden">
        <!-- Backdrop -->
        <div x-show="open" class="fixed inset-0 z-40 bg-slate-900/50" @click="open = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Sidebar -->
        <div x-show="open" class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r border-slate-200"
            x-transition:enter="transform transition ease-in-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

            <div class="flex h-16 items-center justify-between px-4 border-b border-slate-200">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2" wire:navigate>
                    <x-app-logo />
                </a>
                <button type="button" class="btn btn-ghost btn-square hover:bg-slate-100" @click="open = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="p-4">
                <div class="space-y-4">
                    <div>
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                            {{ __('Platform') }}</h2>
                        <ul class="menu menu-lg gap-1">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="{{ request()->routeIs('dashboard') ? 'active bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-100' }}"
                                    wire:navigate>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z" />
                                    </svg>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="divider"></div>

                    <div>
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                            {{ __('Resources') }}</h2>
                        <ul class="menu menu-lg gap-1">
                            <li>
                                <a href="https://github.com/laravel/livewire-starter-kit"
                                    class="text-slate-600 hover:bg-slate-100" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                            clip-rule="evenodd" />
                                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                                    </svg>
                                    {{ __('Repository') }}
                                </a>
                            </li>
                            <li>
                                <a href="https://laravel.com/docs/starter-kits#livewire"
                                    class="text-slate-600 hover:bg-slate-100" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                    </svg>
                                    {{ __('Documentation') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $slot }}
</body>

</html>
