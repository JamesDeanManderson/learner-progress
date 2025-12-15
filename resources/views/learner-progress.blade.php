<x-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Learner Progress Dashboard</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Track and monitor learner progress across all courses</p>
            </div>
            
            <!-- Filters -->
            <form method="GET" action="{{ route('learner-progress.index') }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="course_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filter by Course
                        </label>
                        <select name="course_id" id="course_id" onchange="this.form.submit()" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            <option value="">All Courses</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sort_by_progress" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Sort by Progress
                        </label>
                        <select name="sort_by_progress" id="sort_by_progress" onchange="this.form.submit()" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                            <option value="">No Sort</option>
                            <option value="asc" {{ request('sort_by_progress') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort_by_progress') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Learners Container -->
            @if($learners->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No learners found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($learners as $learner)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $learner->firstname }} {{ $learner->lastname }}
                                </h3>
                            </div>
                            <div class="p-6">
                                @if($learner->enrolments->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($learner->enrolments as $enrolment)
                                            @php
                                                $progress = $enrolment->progress ?? 0;
                                                $progressColor = 'bg-red-500 dark:bg-red-400';
                                                if ($progress >= 75) {
                                                    $progressColor = 'bg-green-600 dark:bg-green-500';
                                                } elseif ($progress >= 50) {
                                                    $progressColor = 'bg-yellow-500 dark:bg-yellow-400';
                                                } elseif ($progress >= 25) {
                                                    $progressColor = 'bg-orange-500 dark:bg-orange-400';
                                                }
                                                
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
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 italic">No courses enrolled</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
