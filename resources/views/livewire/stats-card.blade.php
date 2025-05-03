<div class="stats bg-white shadow-sm">
    <div class="stat">
        <div class="stat-figure text-{{ $color }}">
            <div class="avatar placeholder">
                <div class="bg-{{ $color }}/10 text-{{ $color }} rounded-full w-12">
                    {!! $iconName !!}
                </div>
            </div>
        </div>
        <div class="stat-title text-gray-600">{{ $title }}</div>
        <div class="stat-value text-{{ $color }}">
            {{ $prefix }}{{ is_numeric($value) ? number_format($value, 2) : $value }}</div>
        @if ($description)
            <div class="stat-desc text-gray-500">{{ $description }}</div>
        @endif
    </div>
</div>
