<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'year',
        'semester',
        'code',
    ];

    public function admittedStudents()
    {
        return $this->hasMany(StudentProgram::class, 'term_admitted');
    }

    public function graduatedStudents()
    {
        return $this->hasMany(StudentProgram::class, 'term_graduated');
    }
}
