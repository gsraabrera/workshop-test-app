<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $fillable = [
        'name',
        'description',
    ];

    public function studentPrograms()
    {
        return $this->hasMany(StudentProgram::class);
    }
}
