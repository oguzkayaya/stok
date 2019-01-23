<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class IncomeProduct extends Model
{
    protected $guarded = [];
    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function findIncomeProduct($id)
    {
      return DB::select("select * from income_products where income_id = ?;", [$id]);
    }
}
