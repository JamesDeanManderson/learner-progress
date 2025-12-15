<?php

namespace App\Actions;

use App\Models\Learner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetFilteredLearnersProgressAction
{
    public function execute(?int $courseId, ?string $sortByProgress): Collection
    {
        $query = Learner::with(['enrolments.course']);

        if ($courseId !== null) {
            $query->enrolledInCourse($courseId);
        }

        $learners = $query->get();

        if ($sortByProgress !== null) {
            $learners = $this->sortByProgress($learners, $sortByProgress);
        }

        return $learners;
    }

    private function sortByProgress(Collection $learners, string $direction): Collection
    {
        return $learners
            ->sortBy(
                fn (Learner $learner): float => $learner->averageProgress,
                SORT_REGULAR,
                $direction === 'desc'
            )
            ->values();
    }
}
