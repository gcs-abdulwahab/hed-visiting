<div>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="mt-4">
                <input type="month" wire:model.live="selectedMonth"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Lectures Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900">Total Lectures</h3>
                <p class="mt-2 text-3xl font-bold text-indigo-600">{{ number_format($totalLectures) }}</p>
                <p class="mt-1 text-sm text-gray-500">For {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</p>
            </div>

            <!-- Total Amount Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900">Total Amount</h3>
                <p class="mt-2 text-3xl font-bold text-green-600">₹{{ number_format($totalAmount, 2) }}</p>
                <p class="mt-1 text-sm text-gray-500">For {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}</p>
            </div>

            <!-- Active Employees Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900">Active Employees</h3>
                <p class="mt-2 text-3xl font-bold text-green-600">{{ $activeEmployees }}</p>
                <p class="mt-1 text-sm text-gray-500">Currently working</p>
            </div>

            <!-- Inactive Employees Card -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900">Inactive Employees</h3>
                <p class="mt-2 text-3xl font-bold text-red-600">{{ $inactiveEmployees }}</p>
                <p class="mt-1 text-sm text-gray-500">Not currently working</p>
            </div>
        </div>
    </div>
</div>
