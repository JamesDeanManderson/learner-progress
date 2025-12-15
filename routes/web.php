<?php

use App\Http\Controllers\LearnerProgressController;
use Illuminate\Support\Facades\Route;

Route::get('/learner-progress', [LearnerProgressController::class, 'index'])
    ->name('learner-progress.index');

Route::get('/api/learner-progress', [LearnerProgressController::class, 'getData'])
    ->name('learner-progress.data');