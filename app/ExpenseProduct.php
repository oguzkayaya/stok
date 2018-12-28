<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    //
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
