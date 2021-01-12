<?php

namespace Database\Seeders;

use App\Models\ActivityCompany;
use App\Models\District;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Faker::create('ru_Ru');

        // заполняем город компаниями
        $data = [];
        for ($i = 0; $i < 300; $i++) {
            $data[] = [
                'id_district' => 6,
                'id_village' => null,
                'id_activity_company' => rand(1, 5),
                'company_name' => $faker->company,
                'company_address' => $faker->streetAddress,
                'email_company' => $faker->companyEmail,
                'CEO' => $faker->name,
                'phone_company' => $faker->phoneNumber,
                'quantity_employees' => rand(10, 1000),
            ];
        }

        // заполняем села компаниями
        $idDistrictAndVillage = Village::select('id', 'id_district')->get();
        for ($i = 0; $i < 200; $i++) {
            $randId = rand(0, count($idDistrictAndVillage) - 1);

            $data[] = [
                'id_district' => $idDistrictAndVillage[$randId]->id_district,
                'id_village' => $idDistrictAndVillage[$randId]->id,
                'id_activity_company' => rand(1, 5),
                'company_name' => $faker->company,
                'company_address' => $faker->streetAddress,
                'email_company' => $faker->companyEmail,
                'CEO' => $faker->name,
                'phone_company' => $faker->phoneNumber,
                'quantity_employees' => rand(10, 500),
            ];
        }
        return $data;
    }
}
