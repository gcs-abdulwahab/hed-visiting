<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LectureRecord;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function records()
    {
        $employee = auth()->user()->employee;

        // Get monthly records
        $monthlyRecords = MonthlyBilling::where('employee_id', $employee->id)
            ->with(['lectureRecords'])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($billing) {
                $interRecord = $billing->lectureRecords->where('lecture_type', 'inter')->first();
                $bsRecord = $billing->lectureRecords->where('lecture_type', 'bs')->first();

                return (object)[
                    'month' => $billing->month,
                    'year' => $billing->year,
                    'inter_lectures' => $interRecord ? $interRecord->lecture_count : null,
                    'bs_lectures' => $bsRecord ? $bsRecord->lecture_count : null,
                    'inter_amount' => $interRecord ? $interRecord->amount : null,
                    'bs_amount' => $bsRecord ? $bsRecord->amount : null,
                    'total_amount' => $billing->total_amount,
                    'status' => $billing->status
                ];
            });

        // Get yearly summary
        $currentYear = now()->year;
        $yearlySummary = (object)[
            'total_inter_lectures' => DB::table('lecture_records')
                ->join('monthly_billings', 'lecture_records.monthly_billing_id', '=', 'monthly_billings.id')
                ->where('monthly_billings.employee_id', $employee->id)
                ->where('lecture_records.lecture_type', 'inter')
                ->where('monthly_billings.year', $currentYear)
                ->sum('lecture_records.lecture_count'),

            'total_bs_lectures' => DB::table('lecture_records')
                ->join('monthly_billings', 'lecture_records.monthly_billing_id', '=', 'monthly_billings.id')
                ->where('monthly_billings.employee_id', $employee->id)
                ->where('lecture_records.lecture_type', 'bs')
                ->where('monthly_billings.year', $currentYear)
                ->sum('lecture_records.lecture_count'),

            'total_earnings' => MonthlyBilling::where('employee_id', $employee->id)
                ->where('year', $currentYear)
                ->sum('total_amount')
        ];

        return view('teacher.records', compact('monthlyRecords', 'yearlySummary'));
    }

    public function storeRecord(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'inter_lectures' => 'required|integer|min:0',
            'bs_lectures' => 'required|integer|min:0',
            'remarks' => 'nullable|string|max:255',
        ]);

        LectureRecord::create([
            'employee_id' => Auth::user()->employee->id,
            'date' => $validated['date'],
            'inter_lectures' => $validated['inter_lectures'],
            'bs_lectures' => $validated['bs_lectures'],
            'remarks' => $validated['remarks'],
            'status' => 'pending',
        ]);

        return redirect()->route('teacher.records')
            ->with('success', 'Lecture record submitted successfully.');
    }
}
