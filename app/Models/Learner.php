<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property float $averageProgress
 */
class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];

    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrolments')
            ->withPivot('progress')
            ->withTimestamps();
    }

    public function getAverageProgressAttribute(): float
    {
        return $this->enrolments->avg('progress') ?? 0.0;
    }

    public function scopeEnrolledInCourse(Builder $query, int $courseId): Builder
    {
        return $query->whereHas('enrolments', function (Builder $q) use ($courseId) {
            $q->where('course_id', $courseId);
        });
    }
}
