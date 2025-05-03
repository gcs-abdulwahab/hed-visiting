<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Recent Activity</h2>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-gray-600">Employee</th>
                        <th class="text-gray-600">Action</th>
                        <th class="text-gray-600">Date</th>
                        <th class="text-gray-600">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar placeholder">
                                        <div class="bg-primary/10 text-primary w-8 rounded-full">
                                            <span class="text-xs">{{ $activity['employee']->initials() }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $activity['employee']->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $activity['employee']->department->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-gray-600">{{ $activity['action'] }}</td>
                            <td class="text-sm text-gray-500">{{ $activity['date']->format('d M Y, h:i A') }}</td>
                            <td>
                                @if ($activity['status'] === 'completed' || $activity['status'] === 'approved')
                                    <div class="badge badge-success gap-1 bg-success/10 text-success border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            class="inline-block w-4 h-4 stroke-current">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ ucfirst($activity['status']) }}
                                    </div>
                                @elseif($activity['status'] === 'pending')
                                    <div class="badge badge-warning gap-1 bg-warning/10 text-warning border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            class="inline-block w-4 h-4 stroke-current">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                        Pending
                                    </div>
                                @else
                                    <div class="badge gap-1 bg-gray-100 text-gray-800 border-0">
                                        {{ ucfirst($activity['status']) }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                No recent activities found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
