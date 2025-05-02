<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use App\Models\Department;
use Livewire\Component;

class Form extends Component
{
    public $employee;
    public $name;
    public $email;
    public $department_id;
    public $employee_type;
    public $salary;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'department_id' => 'required|exists:departments,id',
        'employee_type' => 'required|in:teacher,staff',
        'salary' => 'required|numeric|min:0',
        'is_active' => 'boolean'
    ];

    public function mount(Employee $employee = null)
    {
        if ($employee->exists) {
            $this->employee = $employee;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->department_id = $employee->department_id;
            $this->employee_type = $employee->employee_type;
            $this->salary = $employee->salary;
            $this->is_active = $employee->is_active;
            $this->rules['email'] = 'required|email|unique:employees,email,' . $employee->id;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'department_id' => $this->department_id,
            'employee_type' => $this->employee_type,
            'salary' => $this->salary,
            'is_active' => $this->is_active
        ];

        if ($this->employee->exists) {
            $this->employee->update($data);
            session()->flash('message', 'Employee updated successfully.');
        } else {
            Employee::create($data);
            session()->flash('message', 'Employee created successfully.');
        }

        return redirect()->route('employees.index');
    }

    public function render()
    {
        return view('livewire.employees.form', [
            'departments' => Department::all()
        ]);
    }
}
