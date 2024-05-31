<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> '1st class', 'ar'=> 'الصف الاول'],
            ['en'=> '2nd class', 'ar'=> 'الصف الثاني'],
            ['en'=> '3rd class', 'ar'=> 'الصف الثالث'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                'class_name' => $classroom,
                'grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
