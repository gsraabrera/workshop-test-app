<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms = [
            [
                'code' => '1S25',
                'year' => 2025,
                'semester' => '1st',
                'name' => '1st Semester 2025-2026',
            
            ],
            [
                'code' => '2S25',
                'year' => 2025,
                'semester' => '2nd',
                'name' => '2nd Semester 2025-2026',
            ],
            [
                'code' => 'SS25',
                'year' => 2025,
                'semester' => 'Summer',
                'name' => 'Summer Term 2025',
            ],
        ];

        foreach ($terms as $term) {
            DB::table('terms')->insert([
                'code' => $term['code'],
                'year' => $term['year'],
                'semester' => $term['semester'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
