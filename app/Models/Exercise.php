<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'muscle_group_id',
        'name',
        'description',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function muscleGroup()
    {
        return $this->belongsTo(MuscleGroup::class);
    }
    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
    public function workoutLogExercises()
    {
        return $this->hasMany(WorkoutLogExercise::class);
    }
}
