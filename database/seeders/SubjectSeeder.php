<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            "تفسیر شریف","عقاید","لسان اول","لسان دوم","لسان سوم","انگلیسی","ریاضی","فزیک","کیمیا","بیولوژی","جیولوژی","تاریخ","جغرافیه","تعلیمات مدنی","کمپیوتر","فرهنگ","سپورت","تهذیب"
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject,
                'classs_id' => 10,
            ]);
        }
    }
}
