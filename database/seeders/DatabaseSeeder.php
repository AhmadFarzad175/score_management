<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Score;
use App\Models\Classs;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\StudentCategory;
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

        // Teacher::factory(10)->create();

        //TO CALL THE PROVICE SEEDER FOR CREATING PROVINCES
        $this->call(ProvinceSeeder::class);
        
        Classs::factory(10)->create();
        Student::factory(10)->create();
        Attendance::factory(10)->create();
        $this->call(SubjectSeeder::class);
    }
}
