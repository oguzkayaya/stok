<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
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
}
