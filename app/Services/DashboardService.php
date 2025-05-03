<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\MonthlyBilling;
use App\Models\LectureRecord;
use Carbon\Carbon;

class DashboardService
{
    public function getStats(string $selectedMonth): array
    {
        $month = Carbon::parse($selectedMonth);

        // return [
        //     'totalLectures' => $this->getTotalLectures($month),
        //     'totalAmount' => $this->getTotalAmount($selectedMonth),
        //     'activeEmployees' => $this->getActiveEmployees(),
        //     'inactiveEmployees' => $this->getInactiveEmployees(),
        // ];
        // generate dummy data
        return [
            'totalLectures' => 22,
            'totalAmount' => 10000,
            'activeEmployees' => 10,
            'inactiveEmployees' => 5,
        ];
    }

    private function getTotalLectures(Carbon $month): int
    {
        return LectureRecord::whereMonth('date', $month->month)
            ->whereYear('date', $month->year)
            ->sum('lectures');
    }

    private function getTotalAmount(string $month): float
    {
        return MonthlyBilling::where('month', $month)
            ->sum('total_amount');
    }

    private function getActiveEmployees(): int
    {
        return Employee::active()->count();
    }

    private function getInactiveEmployees(): int
    {
        return Employee::inactive()->count();
    }
}
