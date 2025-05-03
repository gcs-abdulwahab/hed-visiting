<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderSection extends Component
{
    public $selectedMonth;

    public function mount()
    {
        $this->selectedMonth = now()->format('Y-m');
    }

    public function updatedSelectedMonth($value)
    {
        $this->dispatch('month-updated', $value);
    }

    public function render()
    {
        return view('livewire.header-section');
    }
}
