<?php

namespace App\Http\Controllers;

use App\Actions\GetFilteredLearnersProgressAction;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearnerProgressController extends Controller
{
    public function index(Request $request, GetFilteredLearnersProgressAction $action): View
    {
        $courses = Course::orderBy('name')->get();

        $learners = $action->execute(
            $request->input('course_id'),
            $request->input('sort_by_progress')
        );

        return view('learner-progress', compact('courses', 'learners'));
    }
}
