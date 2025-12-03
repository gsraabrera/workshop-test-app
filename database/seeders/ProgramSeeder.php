<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            ['code' => 'BSCS', 'name' => 'Bachelor of Science in Computer Science'],
            ['code' => 'BSIT', 'name' => 'Bachelor of Science in Information Technology'],
            ['code' => 'BSA', 'name' => 'Bachelor of Science in Accountancy'],
            ['code' => 'BSE', 'name' => 'Bachelor of Science in Education'],
            ['code' => 'BSBA', 'name' => 'Bachelor of Science in Business Administration'],
        ];

        foreach ($programs as $program) {
            DB::table('programs')->insert([
                'acronym' => $program['code'],
                'name' => $program['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
