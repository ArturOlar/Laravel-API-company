<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = ['id_district', 'village'];
    protected $visible = ['id', 'village'];

    // получить id поселка на названии поселка
    public static function getIdByName($village)
    {
        $idVillage = Village::select('id')->where('village', $village)->first();
        if (empty($idVillage)) {
            return false;
        }
        return $idVillage;
    }
}
