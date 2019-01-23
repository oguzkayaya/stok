<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\ExpenseProduct;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        // $products = Product::all();
        //sadece kullanıcısı olduğun firmadaki kullanıcıların eklediği ürünler
        $products = DB::select(
            'select * from products where user_id in (
                select id from users where company_id = (
                    select company_id from users where id = ? )) order by id;', 
                        array(auth()->user()->id));
        return view('product.index', compact('products'));
    }

    public function store()
    {
        $this->validate(
            request(),
            [
                'title' => 'required',
                'sell' => 'required|numeric',
                'buy' => 'required|numeric',
                'tax' => 'required|numeric'
            ],
            [
                'sell.numeric' => 'The "Sell Price" must be a number.',
                'buy.numeric' => 'The "Buy Price" must be a number.',
                'sell.required' => 'The "Sell Price" field is required.',
                'buy.required' => 'The "Buy Price" field is required.',
                'title.required' => 'The Buy "Title" field is required.',
                'tax.numeric' => 'The "Tax" must be a number.',
                'tax.required' => 'The "Tax" field is required.',
            ]);

        Product::create([
            'title' => request('title'),
            'sell_price' => request('sell'),
            'buy_price' => request('buy'),
            'tax' => request('tax'),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/products');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect('/products');
    }

    public function getExpenseProducts()
    {
        $productDetail = Product::find(request('id'));
        return $productDetail;
    }
    
    public function deleteExpenseProduct()
    {
        if(ExpenseProduct::find(request('id'))->delete())
        {
            return 1;
        }
        return 0;
    }

    public function getProducts()
    {
      $products = \App\Product::InCompanyAll();
      return response()->json(['products' => $products]);
    }
}
