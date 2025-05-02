<div>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Monthly Billings</h1>
            <div class="flex space-x-4">
                <div>
                    <input type="month" wire:model.live="month"
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <button wire:click="generateBills" class="btn btn-primary">Generate Bills</button>
            </div>
        </div>

        <div class="mb-4">
            <input type="text" wire:model.live="search" placeholder="Search billings..."
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('month')">
                            Month
                            @if ($sortField === 'month')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Employee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('total_lectures')">
                            Total Lectures
                            @if ($sortField === 'total_lectures')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('total_amount')">
                            Total Amount
                            @if ($sortField === 'total_amount')
                                @if ($sortDirection === 'asc')
                                    ↑
                                @else
                                    ↓
                                @endif
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($billings as $billing)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($billing->month)->format('F Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $billing->employee->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $billing->employee->department->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $billing->total_lectures }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($billing->total_amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $billings->links() }}
        </div>
    </div>
</div>
