<div class="bg-white shadow-sm">
    <div class="p-4 lg:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="mt-1 text-sm text-gray-500">Here's what's happening with your institution today.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="join bg-white border border-gray-200 rounded-lg">
                    <input type="month" wire:model.live="selectedMonth"
                        class="join-item select select-bordered border-0 focus:outline-none"
                        value="{{ $selectedMonth }}">
                    <button class="join-item btn btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <livewire:user-profile />
            </div>
        </div>
    </div>
</div>
