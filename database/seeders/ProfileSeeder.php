<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'name' => 'Jessica Frederine Setiawan',
            'age' => 17,
            'birth_date' => '2008-11-21',
            'school' => 'SMAK Frateran',
            'class' => '12 E',
            'description' => 'Seorang siswi SMAK Frateran kelas 12 E yang memiliki minat di Art & Creativity.',
            'profile_image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
