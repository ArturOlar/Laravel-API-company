<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $villagesByDistricts = $this->getData();
        
        foreach ($villagesByDistricts as $district => $village) {
            for ($i = 0; $i < count($village); $i++) {
                Village::create([
                    'id_district' => $district,
                    'village' => $village[$i]
                ]);
            }
        }
    }

    private function getData()
    {
        // берем из файла все села в json формате, и преобразовуем в массив
        $jsonVillages = Storage::get('csvjson.json');
        $arrayVillagesAssoc = json_decode($jsonVillages, TRUE);

        // меняем ассоциатывный массив на индексы
        $arrayVillagesIndex = [];
        for ($i = 0; $i < count($arrayVillagesAssoc); $i++) {
            $arrayVillagesIndex[] = array_values($arrayVillagesAssoc[$i]);
        }

        // получаем все районы и id района
        $districts = District::select('district', 'id')->get();

        // в цикле, сохраняем села в определенный район
        $villagesByDistricts = [];
        for ($i = 0; $i < count($arrayVillagesIndex); $i++) {
            for ($k = 0; $k < count($districts); $k++) {
                if ($arrayVillagesIndex[$i][1] == $districts[$k]->district && !empty($arrayVillagesIndex[$i][2])) {
                    $villagesByDistricts[$districts[$k]->id][] = $arrayVillagesIndex[$i][2];
                }
            }
        }

        // возвращаяем массив
        return $villagesByDistricts;
    }
}
