<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    protected $fillable = [
        'workout_id',
        'exercise_id',
        'planned_sets',
        'planned_reps',
        'planned_weight',
        'order_number',
        'notes',
        'is_active',
    ];
    protected $casts = [
        'planned_weight' => 'decimal:2',
        'is_active' => 'boolean',
    ];
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
    public function exercies()
    {
        return $this->belongsTo(Exercise::class);
    }
}
