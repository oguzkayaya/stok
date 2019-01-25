<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    //
    public function income_product()
    {
        return $this->hasMany(IncomeProduct::class);
    }

    public function expense_product()
    {
        return $this->hasMany(ExpenseProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function InCompanyAll()
    {
        return DB::select(
            'select *,
            (
            IFNULL((select sum(amount) from expense_products where product_id = products.id), 0)- 
            IFNULL((select sum(amount) from income_products where product_id = products.id), 0)
            ) as "remained"
            from products where user_id in (
              select id from users where company_id = (
                select company_id from users where id = ?)) order by id;',
            [auth()->user()->id]
        );
    }


}
