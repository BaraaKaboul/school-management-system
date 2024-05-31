<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sections')->delete();

        $Sections = [
            ['en' => '1st section', 'ar' => 'الشعبة الأولى'],
            ['en' => '2nd section', 'ar' => 'الشعبة الثانية'],
            ['en' => '3rd section', 'ar' => 'الشعبة الثالثة'],
        ];

        foreach ($Sections as $section) {
            Section::create([
                'section_name' => $section,
                'status' => 1,
                'classroom_id' => ClassRoom::all()->unique()->random()->id
            ]);
        }
    }
}
