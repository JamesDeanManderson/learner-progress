@props(['progress'])

@php
    // Determine color based on progress
    $progressColor = match(true) {
        $progress >= 75 => 'bg-green-600 dark:bg-green-500',
        $progress >= 50 => 'bg-yellow-500 dark:bg-yellow-400',
        $progress >= 25 => 'bg-orange-500 dark:bg-orange-400',
        default => 'bg-red-500 dark:bg-red-400',
    };
@endphp

<div class="flex items-center gap-2">
    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Average Progress:</span>
    <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600">
        <div class="w-16 bg-gray-200 dark:bg-gray-600 rounded-full h-2 overflow-hidden">
            <div class="{{ $progressColor }} h-full rounded-full" style="width: {{ $progress }}%"></div>
        </div>
        <span class="text-sm font-bold text-gray-900 dark:text-white min-w-[3rem] text-right">
            {{ number_format($progress, 1) }}%
        </span>
    </div>
</div>
