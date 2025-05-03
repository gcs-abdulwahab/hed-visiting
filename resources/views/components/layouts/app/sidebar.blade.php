<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Main Layout -->
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

        <!-- Main Content Area -->
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Top Navigation Bar -->
            <div class="sticky top-0 z-20 navbar bg-white shadow-sm lg:hidden">
                <div class="flex-none">
                    <label for="sidebar-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-5 h-5 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost normal-case text-xl" wire:navigate>
                        <x-app-logo />
                    </a>
                </div>
                <div class="flex-none gap-2">
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar placeholder">
                            <div class="bg-primary text-primary-content rounded-full w-8">
                                <span class="text-xs">{{ auth()->user()->initials() }}</span>
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="mt-3 z-[1] p-2 shadow-lg menu menu-sm dropdown-content bg-white rounded-box w-52">
                            <li class="menu-title px-4 py-2">
                                <span class="font-semibold">{{ auth()->user()->name }}</span>
                                <span class="text-xs text-gray-500 block">{{ auth()->user()->email }}</span>
                            </li>
                            <div class="divider my-0"></div>
                            <li><a href="{{ route('settings.profile') }}" wire:navigate>{{ __('Settings') }}</a></li>
                            <div class="divider my-0"></div>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-grow">
                {{ $slot }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side z-40">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="w-80 min-h-screen bg-white text-base-content border-r border-gray-200">
                <!-- Sidebar Header -->
                <div class="sticky top-0 z-20 hidden lg:block bg-white border-b border-gray-200">
                    <div class="navbar min-h-16 px-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-ghost normal-case text-xl px-4"
                            wire:navigate>
                            <x-app-logo />
                        </a>
                    </div>
                </div>

                <div class="h-full flex flex-col">
                    <!-- Navigation Menu -->
                    <div class="flex-1 px-4 py-4">
                        <ul class="menu menu-lg gap-2 font-medium">
                            <li class="menu-title text-xs font-semibold uppercase tracking-wider text-gray-500">
                                {{ __('Platform') }}</li>
                            <li>
                                <a href="{{ route('dashboard') }}"
                                    class="{{ request()->routeIs('dashboard') ? 'active bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-100' }}"
                                    wire:navigate>
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('employees.index') }}"
                                    class="{{ request()->routeIs('employees.index') ? 'active bg-primary/10 text-primary' : 'text-gray-600 hover:bg-gray-100' }}"
                                    wire:navigate>
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                    {{ __('All Employees') }}
                                </a>
                            </li>

                            <li class="menu-title mt-6 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                {{ __('Resources') }}</li>
                            <li>
                                <a href="https://github.com/laravel/livewire-starter-kit" target="_blank"
                                    class="text-gray-600 hover:bg-gray-100">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                            clip-rule="evenodd" />
                                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                                    </svg>
                                    {{ __('Repository') }}
                                </a>
                            </li>
                            <li>
                                <a href="https://laravel.com/docs/starter-kits#livewire" target="_blank"
                                    class="text-gray-600 hover:bg-gray-100">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                    </svg>
                                    {{ __('Documentation') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- User Profile Section -->
                    <div class="border-t border-gray-200 p-4">
                        <div class="dropdown dropdown-top w-full">
                            <label tabindex="0"
                                class="btn btn-ghost w-full justify-start gap-3 normal-case h-auto py-4">
                                <div class="avatar placeholder">
                                    <div class="bg-primary text-primary-content rounded-lg w-10">
                                        <span>{{ auth()->user()->initials() }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-start">
                                    <span class="font-medium text-gray-900">{{ auth()->user()->name }}</span>
                                    <span class="text-xs text-gray-500">{{ auth()->user()->email }}</span>
                                </div>
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content z-[1] menu p-2 shadow-lg bg-white rounded-box w-52 mb-4">
                                <li><a href="{{ route('settings.profile') }}" wire:navigate>{{ __('Settings') }}</a>
                                </li>
                                <div class="divider my-0"></div>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left">{{ __('Log Out') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
