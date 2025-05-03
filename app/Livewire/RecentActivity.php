<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MonthlyBilling;
use App\Models\LectureRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class RecentActivity extends Component
{
    public $activities = [];
    public $selectedMonth;

    public function mount()
    {
        $this->selectedMonth = now()->format('Y-m');
        $this->loadActivities();
    }

    #[On('month-updated')]
    public function updateMonth($value)
    {
        $this->selectedMonth = $value;
        $this->loadActivities();
    }

    protected function loadActivities()
    {
        $user = Auth::user();
        $activities = collect();

        if ($user->isAdmin() || $user->isSuperAdmin() || $user->isPrincipal()) {
            $recentBillings = MonthlyBilling::with('employee')
                ->whereYear('created_at', substr($this->selectedMonth, 0, 4))
                ->whereMonth('created_at', substr($this->selectedMonth, 5, 2))
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($billing) {
                    return [
                        'employee' => $billing->employee,
                        'action' => 'Billing record created',
                        'date' => $billing->created_at,
                        'status' => $billing->status,
                        'type' => 'billing'
                    ];
                });

            $activities = $activities->concat($recentBillings);
        }

        if ($user->isTeacher()) {
            $recentLectures = LectureRecord::where('employee_id', $user->employee->id)
                ->whereYear('created_at', substr($this->selectedMonth, 0, 4))
                ->whereMonth('created_at', substr($this->selectedMonth, 5, 2))
                ->latest()
                ->take(5)
                ->get()
                ->map(function ($lecture) use ($user) {
                    return [
                        'employee' => $user->employee,
                        'action' => 'Lecture record added',
                        'date' => $lecture->created_at,
                        'status' => $lecture->status,
                        'type' => 'lecture'
                    ];
                });

            $activities = $activities->concat($recentLectures);
        }

        $this->activities = $activities->sortByDesc('date')->take(5)->values()->all();
    }

    public function render()
    {
        return view('livewire.recent-activity');
    }
}
