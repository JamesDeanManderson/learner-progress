@props(['learner'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $learner->firstname }} {{ $learner->lastname }}
        </h3>
        <x-learner-progress.progress-badge :progress="$learner->averageProgress" />
    </div>
    <div class="p-6">
        @if($learner->enrolments->isNotEmpty())
            <div class="space-y-4">
                @foreach($learner->enrolments as $enrolment)
                    <x-learner-progress.course-item :enrolment="$enrolment" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 italic">No courses enrolled</p>
        @endif
    </div>
</div>
