<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $selectedMonth;
    public $totalAmount = 0;
    public $activeEmployees = 0;
    public $inactiveEmployees = 0;

    public function mount()
    {
        $this->selectedMonth = now()->format('Y-m');
        $this->loadData();
    }

    #[On('month-updated')]
    public function updateMonth($value)
    {
        $this->selectedMonth = $value;
        $this->loadData();
    }

    protected function loadData()
    {
        $this->activeEmployees = Employee::active()->count();
        $this->inactiveEmployees = Employee::inactive()->count();
        // Add other data loading logic here
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
