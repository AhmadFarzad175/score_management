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
        $subjects10 = [
            "تفسیر شریف","عقاید","لسان اول","لسان دوم","انگلیسی","ریاضی","فزیک","کیمیا","بیولوژی","جیولوژی","تاریخ","جغرافیه","تعلیمات مدنی","کمپیوتر","فرهنگ","سپورت","تهذیب"
        ];
        $subjects11_12 = [
            "تفسیر شریف","عقاید","لسان اول","لسان دوم","انگلیسی","ریاضی","فزیک","کیمیا","بیولوژی","تاریخ","جغرافیه","تعلیمات مدنی","کمپیوتر","فرهنگ","سپورت","تهذیب"
        ];

        $this->createSubjects($subjects10, 10);
        $this->createSubjects($subjects11_12, 11);
        $this->createSubjects($subjects11_12, 12);

    }


    function createSubjects($subjects, $classId) {
        $counter = 1;
        
        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject,
                'classs_id' => $classId,
                'abb' => 'sub' . $counter,
            ]);
            $counter++;
        }
    }
    
}
