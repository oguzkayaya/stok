<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;

class IncomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('income/index');
  }

  public function getIncomes()
  {
    $incomes = \App\Income::InCompanyAll();
    // $incomes = \App\Income::all();
    return response()->json(['incomes' => $incomes]);
  }

  public function getIncome()
  {
    $income = \App\Income::findIncome(request('id'));
    $incomeProduct = \App\IncomeProduct::findIncomeProduct(request('id'));
    return response()->json(['income' => $income, 'incomeProduct' => $incomeProduct]);

  }

  public function store()
  {
    // return request()->productData[0]['id'];
    // return request()->all();
    // return request()->incomeData['description'];
    $incomeData = request()->incomeData;
    $productData = request()->productData;

    $createdIncome = Income::create([
      'description' => $incomeData['description'],
      'status_id' => \App\Status::where('title', $incomeData['status'])->first()->id,
      'payment_date' => $incomeData['payment_date'],
      'customer_id' => $incomeData['customer_id'],
      'income_date' => $incomeData['income_date'],
      'user_id' => auth()->user()->id
    ]);


    for ($i=0; $i < count($productData) ; $i++)
    {
      $incomeProducts[$i] = \App\IncomeProduct::create([
        'price' => $productData[$i]['price'],
        'amount' => $productData[$i]['amount'],
        'tax' => $productData[$i]['tax'],
        'income_id' => $createdIncome->id,
        'product_id' => $productData[$i]['id'],
        'user_id' => auth()->user()->id
      ]);
    }
    return response()->json(['createdIncome' => $createdIncome, 'incomeProducts' => $incomeProducts]);
  }


  public function delete($id)
  {
    \App\Income::find($id)->income_product()->delete();
    \App\Income::find($id)->delete();
    return 1;
  }

  public function update()
  {
    $income = \App\Income::find(request('incomeId'));

    $incomeData = request()->incomeData;
    $productData = request()->productData;

    $income->update([
      'description' => $incomeData['description'],
      'customer_id' => $incomeData['customer_id'],
      'income_date' => $incomeData['income_date'],
      'status_id' => \App\Status::statusFindId($incomeData['status']),
      'payment_date' => $incomeData['payment_date']
    ]);

    $income->income_product()->delete();

    $incomeProduct = [];
    for ($i=0; $i < count($productData); $i++) 
    { 
      $incomeProduct[$i] = \App\IncomeProduct::create([
        'price' => $productData[$i]['price'],
        'amount' => $productData[$i]['amount'],
        'tax' => $productData[$i]['tax'],
        'income_id' => $income->id,
        'product_id' => $productData[$i]['id'],
        'user_id' => auth()->user()->id
      ]);
    }

    return response()->json(['updatedIncome' => $income, 'incomeProducts' => $incomeProduct]);    
  }
}
