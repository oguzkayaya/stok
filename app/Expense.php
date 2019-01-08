<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    protected $guarded = [];
    //
    public function expense_product()
    {
        return $this->hasMany(ExpenseProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function InCompanyAll()
    {
        return DB::select("
        select 
            *, 
            (select COALESCE(sum((price*amount)*(1 + tax / 100)), 0) from expense_products where expense_id = expenses.id) as 'expense_price',
            (select title from statuses where id = expenses.status_id) as 'status'
        from expenses where user_id in (
                select id from users where company_id = (
                    select company_id from users where id = ?)) order by id;",
            [auth()->user()->id]);
    }
}
