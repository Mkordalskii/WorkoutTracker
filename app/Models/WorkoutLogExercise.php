<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLogExercise extends Model
{
    protected $fillable = [
        'workout_log_id',
        'exercise_id',
        'actual_sets',
        'actual_reps',
        'actual_weight',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'actual_weight' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function workoutLog()
    {
        return $this->belongsTo(WorkoutLog::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
