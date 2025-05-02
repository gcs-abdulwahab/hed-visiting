@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Teacher Info -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">My Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p><strong>Name:</strong> {{ auth()->user()->employee->name }}</p>
                    <p><strong>Employee Code:</strong> {{ auth()->user()->employee->employee_code }}</p>
                    <p><strong>Department:</strong> {{ auth()->user()->employee->department->name }}</p>
                </div>
                <div>
                    <p><strong>Designation:</strong> {{ auth()->user()->employee->designation }}</p>
                    <p><strong>Inter Rate:</strong> Rs. {{ number_format(auth()->user()->employee->inter_rate, 2) }}</p>
                    <p><strong>BS Rate:</strong> Rs. {{ number_format(auth()->user()->employee->bs_rate, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Records -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">My Monthly Records</h2>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month/Year</th>
                            <th>Inter Lectures</th>
                            <th>BS Lectures</th>
                            <th>Inter Amount</th>
                            <th>BS Amount</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyRecords as $record)
                        <tr>
                            <td>{{ date('F Y', mktime(0, 0, 0, $record->month, 1, $record->year)) }}</td>
                            <td>{{ $record->inter_lectures ?? '-' }}</td>
                            <td>{{ $record->bs_lectures ?? '-' }}</td>
                            <td>Rs. {{ number_format($record->inter_amount ?? 0, 2) }}</td>
                            <td>Rs. {{ number_format($record->bs_amount ?? 0, 2) }}</td>
                            <td>Rs. {{ number_format($record->total_amount, 2) }}</td>
                            <td>
                                <span class="badge {{ $record->status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Yearly Summary -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Yearly Summary</h2>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Total Inter Lectures</div>
                    <div class="stat-value">{{ $yearlySummary->total_inter_lectures }}</div>
                    <div class="stat-desc">This year</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Total BS Lectures</div>
                    <div class="stat-value">{{ $yearlySummary->total_bs_lectures }}</div>
                    <div class="stat-desc">This year</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Total Earnings</div>
                    <div class="stat-value">Rs. {{ number_format($yearlySummary->total_earnings, 2) }}</div>
                    <div class="stat-desc">This year</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 