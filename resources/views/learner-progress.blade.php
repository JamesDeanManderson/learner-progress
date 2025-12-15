<x-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <x-learner-progress.page-header />
            
            <!-- Filters -->
            <x-learner-progress.filters :courses="$courses" />

            <!-- Learners Container -->
            @if($learners->isEmpty())
                <x-learner-progress.empty-state />
            @else
                <div class="space-y-4">
                    @foreach($learners as $learner)
                        <x-learner-progress.learner-card :learner="$learner" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
