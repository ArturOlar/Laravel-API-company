<?php

namespace App\Models;

use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['id_district', 'id_village', 'id_activity_company', 'company_name', 'email_company', 'company_address', 'CEO', 'phone_company', 'quantity_employees'];
    protected $visible = ['id', 'district', 'village', 'activity', 'company_name', 'email_company', 'company_address', 'CEO', 'phone_company', 'quantity_employees'];

    // получить пагинацию всех компании вместе из районом, поселком, родом деятельности
    public static function getAllCompaniesWithPaginate($paginate)
    {
        $allCompany = Company::paginate($paginate);
        for ($i = 0; $i < count($allCompany); $i++) {
            $allCompany[$i]['district'] = $allCompany[$i]->district;
            $allCompany[$i]['village'] = $allCompany[$i]->village;
            $allCompany[$i]['activity'] = $allCompany[$i]->activity;
        }
        return $allCompany;
    }

    // получить одну компанию вместе из районом, поселком, родом деятельности
    public static function getOneCompany($id)
    {
        $company = Company::find($id);
        $result[] = $company;
        $result[0]['district'] = $company->district;
        $result[0]['village'] = $company->village;
        $result[0]['activity'] = $company->activity;
        return $result;
    }

    // подготовить массив для массового сохранения в БД
    public static function prepareArrayForSaving(StoreCompanyRequest $request, $idDisctrict, $idVillage, $idActivity)
    {
        $data = $request->all();
        $data['id_district'] = $idDisctrict->id;
        $data['id_village'] = $idVillage->id;
        $data['id_activity_company'] = $idActivity->id;
        unset($data['district'], $data['village'], $data['activity_company']);
        return $data;
    }

    // связь с таблицей районов
    public function district()
    {
        return $this->belongsTo(District::class, 'id_district', 'id');
    }

    // связь с таблицей сел
    public function village()
    {
        return $this->belongsTo(village::class, 'id_village', 'id');
    }

    // связь с таблицей сфер деятельности компаний
    public function activity()
    {
        return $this->belongsTo(ActivityCompany::class, 'id_activity_company', 'id');
    }
}
