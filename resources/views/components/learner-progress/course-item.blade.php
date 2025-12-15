@props(['enrolment'])

@php
    $progress = $enrolment->progress ?? 0;
    
    // Determine color based on progress
    $progressColor = match(true) {
        $progress >= 75 => 'bg-green-600 dark:bg-green-500',
        $progress >= 50 => 'bg-yellow-500 dark:bg-yellow-400',
        $progress >= 25 => 'bg-orange-500 dark:bg-orange-400',
        default => 'bg-red-500 dark:bg-red-400',
    };
    
    // Check if this is the selected/filtered course
    $isSelected = request('course_id') && request('course_id') == $enrolment->course_id;
@endphp

<div class="flex flex-col sm:flex-row sm:items-center gap-3 {{ $isSelected ? 'bg-blue-50 dark:bg-blue-900/20 -mx-3 px-3 py-2 rounded-lg border-l-4 border-blue-500' : '' }}">
    <div class="flex-shrink-0 sm:w-48">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $isSelected ? 'bg-blue-600 dark:bg-blue-500 text-white ring-2 ring-blue-400 dark:ring-blue-300' : 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300' }}">
            {{ $enrolment->course->name }}
        </span>
    </div>
    <div class="flex-1 flex items-center gap-3">
        <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
            <div class="{{ $progressColor }} h-full rounded-full transition-all duration-500 ease-out" style="width: {{ $progress }}%"></div>
        </div>
        <span class="flex-shrink-0 text-sm font-semibold text-gray-700 dark:text-gray-300 w-16 text-right">
            {{ number_format($progress) }}%
        </span>
    </div>
</div>
