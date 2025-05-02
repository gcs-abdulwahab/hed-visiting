<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\MonthlyBilling;
use App\Models\LectureRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->isAdmin() || $user->isSuperAdmin() || $user->isPrincipal()) {
            $data['totalEmployees'] = Employee::count();
            $data['totalDepartments'] = Department::count();
            $data['currentMonthBilling'] = MonthlyBilling::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total_amount');
        }

        if ($user->isTeacher()) {
            $data['totalLectures'] = LectureRecord::where('employee_id', $user->employee->id)->count();
            $data['currentMonthLectures'] = LectureRecord::where('employee_id', $user->employee->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            $data['pendingLectures'] = LectureRecord::where('employee_id', $user->employee->id)
                ->where('status', 'pending')
                ->count();
        }

        // Recent activities for all users
        $data['recentActivities'] = collect();

        if ($user->isAdmin() || $user->isSuperAdmin() || $user->isPrincipal()) {
            $recentBillings = MonthlyBilling::with('employee')
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($billing) {
                    return (object)[
                        'created_at' => $billing->created_at,
                        'description' => "Billing record for {$billing->employee->name}",
                        'status' => $billing->status
                    ];
                });

            $data['recentActivities'] = $data['recentActivities']->concat($recentBillings);
        }

        if ($user->isTeacher()) {
            $recentLectures = LectureRecord::where('employee_id', $user->employee->id)
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($lecture) {
                    return (object)[
                        'created_at' => $lecture->created_at,
                        'description' => "Lecture record for {$lecture->date->format('d M Y')}",
                        'status' => $lecture->status
                    ];
                });

            $data['recentActivities'] = $data['recentActivities']->concat($recentLectures);
        }

        $data['recentActivities'] = $data['recentActivities']
            ->sortByDesc('created_at')
            ->take(5);

        return view('dashboard', $data);
    }
}
