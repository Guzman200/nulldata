<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::firstOrCreate(['name' => 'MySQL']);
        Skill::firstOrCreate(['name' => 'Vue.js']);
        Skill::firstOrCreate(['name' => 'Laravel']);
        Skill::firstOrCreate(['name' => 'PHP']);
        Skill::firstOrCreate(['name' => 'JavaScript']);
        Skill::firstOrCreate(['name' => 'HTML']);
    }
}
