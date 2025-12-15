@props(['courses'])

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
                Sort by Average Progress
            </label>
            <select name="sort_by_progress" id="sort_by_progress" onchange="this.form.submit()" class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                <option value="">No Sort</option>
                <option value="asc" {{ request('sort_by_progress') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('sort_by_progress') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </div>
    </div>
</form>
