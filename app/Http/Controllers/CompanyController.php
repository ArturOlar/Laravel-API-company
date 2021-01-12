<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\District;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function allCompany()
    {
        return view('companies', ['allCompany' => Company::paginate(100) ]);
    }
}
