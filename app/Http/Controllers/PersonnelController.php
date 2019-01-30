<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('personnel/index');
    }


    public function getPersonnels()
    {
      $personnels = \App\Personnel::InCompanyAll();
      return response()->json(['personnels' => $personnels]);
    }

    public function delete($id)
    {
      if(\App\Personnel::find($id)->delete())
        return 1;
        return 0;
    }

    public function store()
    {
      try {
        $createdPersonnel = \App\Personnel::create([
          'name' => request('name'),
          'email' => request('email'),
          'telephone' => request('telephone'),
          'address' => request('address'),
          'salary' => request('salary'),
          'user_id' => auth()->user()->id
        ]);
        return response()->json(['createdPersonnel' => $createdPersonnel]);
      } catch (\Throwable $th) {
        return 0;
      }
    }


    public function getPayments()
    {
      $payments = \App\PersonnelPayments::InCompanyAll();
      return response()->json(['payments' => $payments]);
    }

    public function deletePayment($id)
    {
      if(\App\PersonnelPayments::find($id)->delete())
        return 1;
        return 0;
    }


    public function paymentStore()
    {
      try {
        $createdPayment = \App\PersonnelPayments::create([
          'description' => request('description'),
          'payment_date' => request('payment_date'),
          'payment_amount' => request('payment_amount'),
          'personnel_id' => request('personnel_id'),
          'user_id' => auth()->user()->id
        ]);
        return response()->json(['createdPayment' => $createdPayment]);
      } catch (\Throwable $th) {
        return 0;
      }
    }
}
