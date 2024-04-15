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
            'Badakhshan', 'Badghis', 'Baghlan', 'Balkh', 'Bamyan',
            'Daykundi', 'Farah', 'Faryab', 'Ghazni', 'Ghor', 'Helmand',
            'Herat', 'Jowzjan', 'Kabul', 'Kandahar', 'Kapisa', 'Khost',
            'Kunar', 'Kunduz', 'Laghman', 'Logar', 'Nangarhar', 'Nimruz',
            'Nuristan', 'Paktia', 'Paktika', 'Panjshir', 'Parwan',
            'Samangan', 'Sar-e Pol', 'Takhar', 'Urozgan', 'Wardak', 'Zabul',
        ];

        foreach ($provinces as $province) {
            Province::create(['name' => $province]);
        }
    }
}
