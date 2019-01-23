<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('customer.index');
  }

  public function getCustomers()
  {
    $customers = \App\Customer::InCompanyAll();
    return response()->json(['customers' => $customers]);

    // $customers = json_encode(\App\Customer::InCompanyAll());
    // return $customers;
  }

  public function delete($id)
  {
    try {
      \App\Customer::find($id)->delete();
      return 1;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function store()
  {
    $validation = Validator::make(request()->all(),[ 
      'name' => 'required|min:3',
      'email' => 'required|min:5'
    ]);
    if($validation->fails()){
      return response()->json(['errors' => $validation->errors()]);
    }
    try {
      $created = Customer::create([
        'name' => request('name'),
        'email' => request('email'),
        'telephone' => request('telephone'),
        'address' => request('address'),
        'user_id' => auth()->user()->id
      ]);
      return response()->json(['created' => $created]);
    } catch (\Throwable $th) {
      return 0;
    }

    
  }



  

}
