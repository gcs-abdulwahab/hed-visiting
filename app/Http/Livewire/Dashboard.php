<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\MonthlyBilling;
use App\Models\LectureRecord;
use Livewire\Component;

class Dashboard extends Component
{
    public $selectedMonth;
    public $totalLectures = 0;
    public $totalAmount = 0;
    public $activeEmployees = 0;
    public $inactiveEmployees = 0;

    public function mount()
    {
        $this->selectedMonth = now()->format('Y-m');
        $this->updateStats();
    }

    public function updatedSelectedMonth()
    {
        $this->updateStats();
    }

    protected function updateStats()
    {
        $month = \Carbon\Carbon::parse($this->selectedMonth);

        // Get total lectures and amount for the selected month
        $this->totalLectures = LectureRecord::whereMonth('date', $month->month)
            ->whereYear('date', $month->year)
            ->sum('lectures');

        $this->totalAmount = MonthlyBilling::where('month', $this->selectedMonth)
            ->sum('total_amount');

        // Get employee counts
        $this->activeEmployees = Employee::active()->count();
        $this->inactiveEmployees = Employee::inactive()->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
