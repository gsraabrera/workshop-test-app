<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgram extends Model
{
    protected $fillable = [
        'student_id',
        'program_id',
        'term_admitted',
        'term_graduated',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function termAdmitted()
    {
        return $this->belongsTo(Term::class, 'term_admitted');
    }

    public function termGraduated()
    {
        return $this->belongsTo(Term::class, 'term_graduated');
    }
}
