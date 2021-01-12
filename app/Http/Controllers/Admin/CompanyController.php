<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyFormRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\ActivityCompany;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.companies', ['allCompany' => Company::paginate(100)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-company', [
            'allDisctrict' => District::all(),
            'allActivity' => ActivityCompany::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyFormRequest $request)
    {
        $company = Company::create($request->all());
        Session::flash('success', 'Компания успешно создана');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.edit-company', [
            'company' => Company::find($id),
            'allActivity' => ActivityCompany::all(),
            'allDisctrict' => District::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!isset($request->id_village)) {
            
        }
        $company = Company::find($id);
        $company->fill($request->all());
        $company->save();
        Session::flash('success', 'Компания успешно обновлена');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::find($id)->delete();
        Session::flash('success', 'Компания удалена');
        return redirect()->back();
    }
}
