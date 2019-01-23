<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
  protected $guarded = [];
    //
    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public static function InCompanyAll()
    {
      return DB::select(
        'select * from customers where user_id in (
          select id from users where company_id = (
            select company_id from users where id = ?)) order by id;',
      [auth()->user()->id]
    );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
