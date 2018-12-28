<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\CustomerCategory;
use App\ExpenseCategory;
use App\IncomeCategory;
use App\PersonnelCategory;
use App\ProductCategory;
use App\SupplierCategory;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = [
            'customers' => CustomerCategory::all(),
            'expenses' => ExpenseCategory::all(),
            'incomes' => IncomeCategory::all(),
            'personnels' => PersonnelCategory::all(),
            'products' => ProductCategory::all(),
            'suppliers' =>SupplierCategory::all()
        ];
        return view('category.index', compact('categories'));
    }

    public function customers()
    {
        $this->validate(request(),[
            'title' => 'required'
        ]);
        CustomerCategory::create([
            'title' => request('title'),
            'user_id' => auth()->user()->id
        ]);
        return redirect('/categories');
    }
    public function expenses()
    {
        # code...
    }
    public function incomes()
    {
        # code...
    }
    public function personnels()
    {
        # code...
    }
    public function products()
    {
        # code...
    }
    public function suppliers()
    {
        # code...
    }
    





}
