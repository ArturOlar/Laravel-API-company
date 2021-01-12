<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    
    protected $fillable = ['district'];
    protected $visible = ['district'];

    // получить id района на названии района
    public static function getIdByName($district)
    {
        $idDisctrict = District::select('id')->where('district', $district)->first();
        if (empty($idDisctrict)) {
            return false;
        }
        return $idDisctrict;
    }
}
