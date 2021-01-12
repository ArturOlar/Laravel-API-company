<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCompany extends Model
{
    use HasFactory;

    protected $table = 'activity_companies';
    protected $visible = ['activity'];

    // получить id рода деятельности на названии рода деятельности
    public static function getIdByName($activity)
    {
        $idActivity = ActivityCompany::select('id')->where('activity', $activity)->first();
        if (empty($idActivity)) {
            return false;
        }
        return $idActivity;
    }
}
