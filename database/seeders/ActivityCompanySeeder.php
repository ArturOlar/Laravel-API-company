<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_companies')->insert($this->getData());
    }

    private $activity = [
        'Ритейл',
        'Производство',
        'IT услуги',
        'Логистика',
        'Юридические услуги',
    ];

    private function getData()
    {
        $data = [];
        for ($i = 0; $i < count($this->activity); $i++) {
            $data[] = [
                'activity' => $this->activity[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        return $data;
    }
}
