<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    // получить все поселки конкретного района
    public function getVillageByDistrict(Request $request)
    {
        $villages = Village::select('id', 'village')->where('id_district', $request->id_district)->get();
        return json_encode($villages);
    }
}
