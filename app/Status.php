<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];
    //
    public function expense()
    {
        return $this->hasMany(Expense::class);
    }

    public static function statusFindId($status)
    {
        return \App\Status::where('title', $status)->first()->id;
    }
}
