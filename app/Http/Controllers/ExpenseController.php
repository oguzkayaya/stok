<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Expense;
use App\Supplier;
use App\Product;
use App\Status;

class ExpenseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $expenses = Expense::all();
        $expenses = Expense::InCompanyAll();
        return view('expense.index', compact('expenses'));
    }

    public function create()
    {
        $suppliers = Supplier::InCompanyAll();
        $products = Product::InCompanyAll();
        return view('expense.create', compact('suppliers', 'products'));
    }

    public function store()
    {
        $this->validate(request(),[
            'desc'         => 'required',
            'supplier'     => 'required',
            'expense_date' => 'required',
            'status'       => 'required',
            'payment_date' => 'required',
            'title.*'        => 'required',
            'amount.*'       => 'required',
            'price.*'        => 'required',
            'tax.*'          => 'required',
        ]);
        

        $expense = \App\Expense::create([
            'description' => request('desc'),
            'supplier_id' => request('supplier'),
            'user_id' => auth()->user()->id,
            'expense_date' => request('expense_date'),
            'payment_date' => request('payment_date'),
            'status_id' => \App\Status::where('title', request('status'))->first()->id
        ]);

        for ($i=0; $i < count(request('title')) ; $i++)
        {
            $expenseProduct[$i] = \App\ExpenseProduct::create([
                'price' => request('price')[$i],
                'amount' => request('amount')[$i],
                'tax' => request('tax')[$i],
                'expense_id' => $expense->id,
                'product_id' => request('title')[$i],
                'user_id' => auth()->user()->id
            ]);
        }

        return redirect('/expenses');
    }

    public function show(Expense $expense)
    {   
        if(!auth()->user()->isExpenseMine($expense))
            return redirect('/expenses')->withErrors(['Expense not found']);
        $suppliers = Supplier::InCompanyAll();
        $products = Product::InCompanyAll();
        return view('expense.show', compact('expense', 'products', 'suppliers'));
    }

    public function update(Expense $expense)
    {        
        $this->validate(request(),[
            'desc'         => 'required',
            'supplier'     => 'required',
            'expense_date' => 'required',
            'status'       => 'required',
            'title.*'      => 'required',
            'amount.*'     => 'required',
            'payment_date' => 'required',
            'price.*'      => 'required',
            'tax.*'        => 'required',
        ]);

        $supplier = \App\Supplier::find(request('supplier'));
        if(!auth()->user()->isSupplierMine($supplier))
            return back()->withErrors(['Supplier not found']);
        if(!auth()->user()->isExpenseMine($expense))
            return back()->withErrors(['Expense not found']);
        foreach (request('title') as $productId) {
            $product = \App\Product::find($productId);
            if(!auth()->user()->isProductMine($product))
            return back()->withErrors(['Product not found']);
        }

        $expense->update([
            'description' => request('desc'),
            'supplier_id' => request('supplier'),
            'expense_date' => request('expense_date'),
            'status_id' => Status::statusFindId(request('status')),
            'payment_date' => request('payment_date')
        ]);

        $expense->expense_product()->delete();

        for ($i=0; $i < count(request('title')) ; $i++)
        {
            $expenseProduct[$i] = \App\ExpenseProduct::create([
                'price' => request('price')[$i],
                'amount' => request('amount')[$i],
                'tax' => request('tax')[$i],
                'expense_id' => $expense->id,
                'product_id' => request('title')[$i],
                'user_id' => auth()->user()->id
            ]);
        }
        return back();
    }
}
