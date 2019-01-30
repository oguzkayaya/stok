<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Personnel extends Model
{
    protected $guarded = [];
    //


    public static function InCompanyAll()
    {
      return DB::select(
        'select * from personnels where user_id in (
          select id from users where company_id = (
            select company_id from users where id = ?));',
        [auth()->user()->id]
    );
    }
}
