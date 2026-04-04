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
            'description' => 'Hi! I’m someone who loves expressing creativity in different forms.🎨 From art and fashion to photography and content creation, I enjoy expressing myself in fun and unique ways. Always exploring, always creating ✨',
            'profile_image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
