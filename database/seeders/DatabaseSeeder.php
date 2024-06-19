<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Classs;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\StudentDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        //TO CALL THE PROVICE SEEDER FOR CREATING PROVINCES
        $this->call(ProvinceSeeder::class);
        
        Classs::factory(10)->create();
        Student::factory(10)->create();
        Attendance::factory(10)->create();
        StudentDetails::factory(10)->create();
        $this->call(SubjectSeeder::class);
    }
}
