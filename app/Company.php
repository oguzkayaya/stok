<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = ['name', 'sector', 'address'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
