<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'training_date',
        'notes',
        'is_active',
    ];
    protected $casts = [
        'training_date' => 'date',
        'is_active' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
    public function workoutLogs()
    {
        return $this->hasMany(WorkoutLog::class);
    }
    //relacja wiele do wiele. Cwiczenia mogą występować w wielu różnych treningach
    //jeden trening może mieć wiele ćwiczeń i jedno ćwiczenie może być w wielu treningach
    //połączenie między nimi jest zapisane w tabeli 'workout_exercises'
    public function exercies()
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises')
        ->withPivot([ //pobiera doatkowe kolumny z tabeli workout_exercies
                'id',
                'planned_sets',
                'planned_reps',
                'planned_weight',
                'order_number',
                'notes',
                'is_active', 
            ])->withTimestamps(); //uzupełnia automatycznie created_at i updated_at
    }
}
