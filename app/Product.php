<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
