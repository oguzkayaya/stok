<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
{
    protected $guarded = [];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function income_product()
    {
        return $this->hasMany(IncomeProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function InCompanyAll()
    {
      return DB::select("
      select 
      *, 
      (select COALESCE(sum((price*amount)*(1 + tax / 100)), 0) from income_products where income_id = incomes.id) as 'income_price',
      (select title from statuses where id = incomes.status_id) as 'status',
      (select customers.name from customers where id = incomes.customer_id) as 'customer'
  from incomes where user_id in (
          select id from users where company_id = (
              select company_id from users where id = ?)) order by id;",
            [auth()->user()->id]);
    }

    public static function findIncome($id)
    {
      return DB::select("
      select income_date, description, payment_date, customer_id,
	   (select statuses.title from statuses where id = incomes.status_id) as 'status'
    from incomes where id = ?;", [$id]);
    }
}
