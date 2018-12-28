<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    //
    public function create()
    {
        return view('company.index');
    }

    public function store()
    {
        Company::create(request()->all());
        return redirect('/register');
    }
}
