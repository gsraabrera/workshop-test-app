<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon; 
use App\Models\StudentProgram;


class StudentProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::get(); // skip admin

        foreach ($students as $students) {
            StudentProgram::create([
                'student_id' => $students->id,
                'program_id' => rand(1, 5), // assuming there are 5 programs
                'term_admitted' => rand(1, 2),  // assuming 3 terms
                'term_graduated' => rand(1, 2), // assuming graduation between term 4 and 12
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
