<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBilling;
use App\Models\Employee;
use Illuminate\Http\Request;

class MonthlyBillingController extends Controller
{
    public function index()
    {
        $billings = MonthlyBilling::with('employee.department')
            ->latest()
            ->paginate(10);

        return view('monthly-billings.index', compact('billings'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('monthly-billings.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000',
            'inter_lectures' => 'nullable|integer|min:0',
            'bs_lectures' => 'nullable|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,paid',
        ]);

        MonthlyBilling::create($validated);

        return redirect()->route('monthly-billings.index')
            ->with('success', 'Monthly billing record created successfully.');
    }

    public function show(MonthlyBilling $monthlyBilling)
    {
        return view('monthly-billings.show', compact('monthlyBilling'));
    }

    public function edit(MonthlyBilling $monthlyBilling)
    {
        $employees = Employee::all();
        return view('monthly-billings.edit', compact('monthlyBilling', 'employees'));
    }

    public function update(Request $request, MonthlyBilling $monthlyBilling)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000',
            'inter_lectures' => 'nullable|integer|min:0',
            'bs_lectures' => 'nullable|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,paid',
        ]);

        $monthlyBilling->update($validated);

        return redirect()->route('monthly-billings.index')
            ->with('success', 'Monthly billing record updated successfully.');
    }

    public function destroy(MonthlyBilling $monthlyBilling)
    {
        $monthlyBilling->delete();

        return redirect()->route('monthly-billings.index')
            ->with('success', 'Monthly billing record deleted successfully.');
    }
}
