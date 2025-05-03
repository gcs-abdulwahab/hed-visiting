<?php

namespace App\Http\Livewire;

use App\Services\DashboardService;
use Livewire\Component;

class Dashboard extends Component
{
    public $selectedMonth;
    public $totalLectures = 0;
    public $totalAmount = 0;
    public $activeEmployees = 0;
    public $inactiveEmployees = 0;

    protected DashboardService $dashboardService;

    public function boot(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

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
        $stats = $this->dashboardService->getStats($this->selectedMonth);

        $this->totalLectures = $stats['totalLectures'];
        $this->totalAmount = $stats['totalAmount'];
        $this->activeEmployees = $stats['activeEmployees'];
        $this->inactiveEmployees = $stats['inactiveEmployees'];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
