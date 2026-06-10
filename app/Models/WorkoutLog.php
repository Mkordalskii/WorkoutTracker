<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    protected $fillable = [
        'user_id',
        'workout_id',
        'performed_at',
        'duration_minutes',
        'summary',
        'is_active', 
    ];
    protected $casts = [
        'performed_at' => 'date',
        'is_active' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
    public function workoutLogExercises()
    {
        return $this->hasMany(WorkoutLogExercise::class);
    }
}
