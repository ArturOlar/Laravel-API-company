<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert($this->getData());
    }

    private $districts = [
        'Герцаївський',
        'Глибоцький',
        'Хотинський',
        'Кельменецький',
        'Кіцманський',
        'Чернівці',
        'Новоселицький',
        'Путильський',
        'Сокирянський',
        'Сторожинецький',
        'Заставнівський',
    ];
    
    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->districts); $i++) {
            $data[] = [
                'district' => $this->districts[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        return $data;
    }
}
