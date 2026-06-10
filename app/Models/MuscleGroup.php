<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuscleGroup extends Model
{
    //okresla ktore pola mozna zmienic bezpiecznie na raz
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    //funkcja ktora dba o poprawny typ danych
    protected $casts = [
        'is_active' => 'boolean',
    ];

    //ustawienie relacji
    public function exercise()
    {
        return $this->hasMany(Exercise::class);
    }
}
