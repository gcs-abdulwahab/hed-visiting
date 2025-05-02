<?php

namespace App\Http\Livewire\MonthlyBillings;

use App\Models\MonthlyBilling;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $month = '';
    public $sortField = 'month';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'month', 'sortField', 'sortDirection'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function generateBills()
    {
        $this->validate([
            'month' => 'required|date_format:Y-m'
        ]);

        $month = \Carbon\Carbon::parse($this->month);
        $employees = \App\Models\Employee::active()->get();

        foreach ($employees as $employee) {
            $totalLectures = \App\Models\LectureRecord::where('employee_id', $employee->id)
                ->whereMonth('date', $month->month)
                ->whereYear('date', $month->year)
                ->sum('lectures');

            if ($totalLectures > 0) {
                $totalAmount = $totalLectures * $employee->salary;

                MonthlyBilling::updateOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'month' => $month->format('Y-m')
                    ],
                    [
                        'total_lectures' => $totalLectures,
                        'total_amount' => $totalAmount
                    ]
                );
            }
        }

        session()->flash('message', 'Monthly bills generated successfully.');
    }

    public function render()
    {
        return view('livewire.monthly-billings.index', [
            'billings' => MonthlyBilling::query()
                ->when($this->search, function ($query) {
                    $query->whereHas('employee', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->month, function ($query) {
                    $query->where('month', $this->month);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }
}
