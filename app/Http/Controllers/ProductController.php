<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

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
        $products = DB::select('select * from products where user_id in (
            select id from users where company_id = (
                select id from companies where id = (
                    select company_id from users where id = ?))) order by id', 
                        array(auth()->user()->id));
        return view('product.index', compact('products'));
    }

    public function store()
    {
        $this->validate(request(),[
            'title' => 'required',
            'sell' => 'required',
            'buy' => 'required',
            'tax' => 'required'
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
}
