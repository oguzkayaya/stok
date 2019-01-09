<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $suppliers = Supplier::all();
        $suppliers = Supplier::InCompanyAll();

        return view('supplier.index', compact('suppliers'));
    }

    public function store()
    {
        $this->validate(request(),['name' => 'required']);

        Supplier::create([
            'name' => request('name'),
            'email' => request('email'),
            'telephone' => request('telephone'),
            'address' => request('address'),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/suppliers');
    }

    public function delete()
    {
            try {
                Supplier::find(request('id'))->delete();
                return 1;
            } catch (\Illuminate\Database\QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                return $errorInfo;
                // Return the response to the client..
            }
    }

}
