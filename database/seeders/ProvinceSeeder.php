<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'بدخشان', 'بادغیس', 'بغلان', 'بلخ', 'بامیان',
            'دایکندی', 'فراه', 'فاریاب', 'غزنی', 'غور', 'هلمند',
            'هرات', 'جوزجان', 'کابل', 'قندهار', 'کاپیسا', 'خوست',
            'کنر', 'کندز', 'لغمان', 'لوگر', 'ننگرهار', 'نیمروز',
            'نورستان', 'پکتیا', 'پکتیکا', 'پنجشیر', 'پروان',
            'سمنگان', 'سرپل', 'تخار', 'ارزگان', 'وردک', 'زابل',
        ];
        

        foreach ($provinces as $province) {
            Province::create(['name' => $province]);
        }
    }
}
