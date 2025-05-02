@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-base-200">
        <!-- Sidebar -->
        <div class="drawer lg:drawer-open">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />

            <!-- Page content -->
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <div class="w-full navbar bg-base-100">
                    <div class="flex-none lg:hidden">
                        <label for="my-drawer" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block w-5 h-5 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="flex-1">
                        <a class="btn btn-ghost text-xl">College Billing</a>
                    </div>
                    <div class="flex-none">
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="User Avatar"
                                        src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <ul tabindex="0"
                                class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                                <li>
                                    <a class="justify-between">
                                        Profile
                                        <span class="badge">New</span>
                                    </a>
                                </li>
                                <li><a>Settings</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <main class="flex-1 p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isPrincipal())
                            <!-- Monthly Billing Summary -->
                            <div class="card bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h2 class="card-title">Monthly Billing</h2>
                                    <div class="stats stats-vertical shadow">
                                        <div class="stat">
                                            <div class="stat-title">Total Employees</div>
                                            <div class="stat-value">{{ $totalEmployees }}</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Total Departments</div>
                                            <div class="stat-value">{{ $totalDepartments }}</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Current Month Billing</div>
                                            <div class="stat-value">₹{{ number_format($currentMonthBilling, 2) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (auth()->user()->isTeacher())
                            <!-- Teacher's Records -->
                            <div class="card bg-base-100 shadow-xl">
                                <div class="card-body">
                                    <h2 class="card-title">My Records</h2>
                                    <div class="stats stats-vertical shadow">
                                        <div class="stat">
                                            <div class="stat-title">Total Lectures</div>
                                            <div class="stat-value">{{ $totalLectures }}</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Current Month</div>
                                            <div class="stat-value">{{ $currentMonthLectures }}</div>
                                        </div>
                                        <div class="stat">
                                            <div class="stat-title">Pending Approval</div>
                                            <div class="stat-value">{{ $pendingLectures }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Recent Activity -->
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">Recent Activity</h2>
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Activity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentActivities as $activity)
                                                <tr>
                                                    <td>{{ $activity->created_at->format('d M Y') }}</td>
                                                    <td>{{ $activity->description }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $activity->status === 'completed' ? 'success' : 'warning' }}">
                                                            {{ $activity->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <!-- Sidebar -->
            <div class="drawer-side">
                <label for="my-drawer" class="drawer-overlay"></label>
                <ul class="menu p-4 w-80 min-h-full bg-base-100 text-base-content">
                    <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a></li>

                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <li><a href="{{ route('employees.index') }}"
                                class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Employees
                            </a></li>
                    @endif

                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isPrincipal())
                        <li><a href="{{ route('monthly-billings.index') }}"
                                class="{{ request()->routeIs('monthly-billings.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                Monthly Billings
                            </a></li>
                    @endif

                    @if (auth()->user()->isTeacher())
                        <li><a href="{{ route('teacher.records') }}"
                                class="{{ request()->routeIs('teacher.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                My Records
                            </a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
