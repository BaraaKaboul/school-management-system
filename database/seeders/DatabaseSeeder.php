<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(GradeSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(BloodSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(SpecializationsSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(ParentSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SpecializationsSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
