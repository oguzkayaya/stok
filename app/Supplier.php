<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $guarded = [];
    //
    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function InCompanyAll()
    {
        return DB::select(
            'select * from suppliers where user_id in (
                select id from users where company_id = (
                    select company_id from users where id = ?)) order by id;',
            [auth()->user()->id]
        );
    }

}
