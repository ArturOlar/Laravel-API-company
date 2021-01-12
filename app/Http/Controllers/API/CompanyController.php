<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\ActivityCompany;
use App\Models\Company;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([ 'all-company' => Company::getAllCompaniesWithPaginate(100), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        // получить id района по названии
        $idDisctrict = District::getIdByName($request->district);
        if ($idDisctrict == false) {
            return response(['error' => 'Такого района не найдено'], 404);
        }

        // получить id поселка по названии
        $idVillage = Village::getIdByName($request->village);
        if ($idVillage == false) {
            return response(['error' => 'Такого поселка не найдено'], 404);
        }

        // получить id рода деятельности по названии
        $idActivity = ActivityCompany::getIdByName($request->activity_company);
        if ($idActivity == false) {
            return response(['error' => 'Такой деятельности компании не найдено'], 404);
        }

        // подготовить массив для обновления данных
        $data = Company::prepareArrayForSaving($request, $idDisctrict, $idVillage, $idActivity);

        // сохранить данные
        $company = Company::create($data);
        return response(['company' => new CompanyResource($company), 'message' => 'Компания создана'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(['company' => Company::getOneCompany($id), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        // получить id района по названии
        $idDisctrict = District::getIdByName($request->district);
        if ($idDisctrict == false) {
            return response(['error' => 'Такого района не найдено'], 404);
        }

        // получить id поселка по названии
        $idVillage = Village::getIdByName($request->village);
        if ($idVillage == false) {
            return response(['error' => 'Такого поселка не найдено'], 404);
        }

        // получить id рода деятельности по названии
        $idActivity = ActivityCompany::getIdByName($request->activity_company);
        if ($idActivity == false) {
            return response(['error' => 'Такой деятельности компании не найдено'], 404);
        }

        // подготовить массив для обновления данных
        $data = Company::prepareArrayForSaving($request, $idDisctrict, $idVillage, $idActivity);

        // обновить данные
        $company->update($data);
        return response([ 'company' => new CompanyResource($company), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response(['message' => 'Deleted']);
    }
}
